<?php

namespace App\Modules\MyListCategory;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyListCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MyListCategoryController extends Controller
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

    public function MyListCategorylist()
    {
        $MyListCategory = MyListCategory::get();
        return view('Superadmin.MyListCategory.MyListCategorylist', compact('MyListCategory'));
    }
    public function addMyListCategory()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            return view('Superadmin.MyListCategory.addMyListCategory');
        } else {
            $MyListCategory =  MyListCategory::find($id);
            return view('Superadmin.MyListCategory.addMyListCategory', compact('MyListCategory'));
        }
    }

    public function saveMyListCategory(Request $req)
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

            $MyListCategory = new MyListCategory;
            $MyListCategory->name = ucfirst($req->name);
            $imagename = "";
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('uploads'), $imagename);
                $imagename = url('/') . '/uploads/' . $imagename;
            }

            $MyListCategory->image = $imagename;
            $MyListCategory->color = $req->color;
            $MyListCategory->save();
            return redirect()->route('MyListCategorylist')->with('message', 'Added Successfully');
        } else {
            $MyListCategory =  MyListCategory::find($req->id);
            $MyListCategory->name = ucfirst($req->name);
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('uploads'), $imagename);
                $MyListCategory->image = url('/') . '/uploads/' . $imagename;
            }
            $MyListCategory->color = $req->color;
            
            $MyListCategory->save();
            return redirect()->route('MyListCategorylist')->with('message', 'Updated Successfully');
        }

    }

    public function MyListCategorystatus(Request $req, $id)
    {
        $staff =  MyListCategory::find($id);
        if ($req->status == 1) {
            $staff->status = 2;
        } else {
            $staff->status = 1;
        }
        $staff->save();
        return redirect()->route('MyListCategorylist')->with('message', 'Updated Successfully');
    }
}
