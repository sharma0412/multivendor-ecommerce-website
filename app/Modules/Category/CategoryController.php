<?php

namespace App\Modules\Category;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function categorylist()
    {
        $category = Category::get();
        return view('Superadmin.Category.categorylist', compact('category'));
    }
    public function addcategory()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            return view('Superadmin.Category.addcategory');
        } else {
            $category =  Category::find($id);
            return view('Superadmin.Category.addcategory', compact('category'));
        }
    }

    public function savecategory(Request $req)
    {

        if ($req->id == '') {
            $validator  = Validator::make(
                $req->all(),
                [
                    'name' => 'required',
                    'image' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $category = new Category;
            $category->name = ucfirst($req->name);
            $imagename = "";
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('uploads'), $imagename);
                $imagename = url('/') . '/uploads/' . $imagename;
            }

            $category->image = $imagename;
            $category->color = $req->color;
            $category->save();
            return redirect()->route('categorylist')->with('message', 'Added Successfully');
        } else {
            $category =  Category::find($req->id);
            $category->name = ucfirst($req->name);
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('uploads'), $imagename);
                $category->image = url('/') . '/uploads/' . $imagename;
            }
            $category->color = $req->color;
            
            $category->save();
            return redirect()->route('categorylist')->with('message', 'Updated Successfully');
        }

    }

    public function categorystatus(Request $req, $id)
    {
        $staff =  Category::find($id);
        if ($req->status == 1) {
            $staff->status = 2;
        } else {
            $staff->status = 1;
        }
        $staff->save();
        return redirect()->route('categorylist')->with('message', 'Updated Successfully');
    }
}
