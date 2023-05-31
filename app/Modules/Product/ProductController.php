<?php

namespace App\Modules\Product;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\productImages;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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


    public function productlist()
    {
        $product = Product::get();
        return view('Superadmin.Product.productlist', compact('product'));
    }


    public function addproduct()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            $category = Category::where('status', 1)->get();
            return view('Superadmin.Product.addproduct', compact('category'));
        } else {
            $category = Category::where('status', 1)->get();
            $product =  Product::with('catgeory')->find($id);
            $productImages =  productImages::where('product_id', $id)->get();

            return view('Superadmin.Product.addproduct', compact('product', 'category', 'productImages'));
        }
    }

    public function saveproduct(Request $req)
    {


        if ($req->id == '') {
            $validator  = Validator::make(
                $req->all(),
                [
                    'image' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $product = new Product;
            $imagename = "";
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('/uploads'), $imagename);
                $imagename = url('/') . '/uploads/' . $imagename;
            }

            $product->cat_id = $req->catid;
            $product->name = $req->name;
            $product->image = $imagename;
            $product->colorcode = $req->colorcode;
            $product->save();

            $images = array();
            if ($files = $req->file('multipleimages')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();

                    $file->move(public_path('/uploads', $name));
                    $images = url('/') . '/uploads/' . $name;
                    productImages::insert([

                        'product_id' => $product->id,
                        'image' =>  $images,

                    ]);
                }
            }
        } else {
            $product =  Product::find($req->id);
            $product->cat_id = $req->catid;
            $product->name = $req->name;
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('/uploads'), $imagename);
                $product->image = url('/') . '/uploads/' . $imagename;
            }
            $product->colorcode = $req->colorcode;
            $product->save();
            $images = array();
            if ($files = $req->file('multipleimages')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();

                    $file->move(public_path('/uploads'), $name);
                    $images = url('/') . '/uploads/' . $name;
                    productImages::insert([

                        'product_id' => $req->id,
                        'image' =>  $images,

                    ]);
                }
            }
        }

        return redirect()->route('productlist')->with('message', 'Added Successfully');
    }

    public function productstatus(Request $req, $id)
    {
        dd($req->all());
        $product =  Product::find($id);
        if ($req->status == 1) {
            $product->status = 2;
        } else {
            $product->status = 1;
        }
        $product->save();
        return redirect()->route('productlist')->with('message', 'Updated Successfully');
    }

    public function deleteimage($id)
    {
        $productimage =  productImages::find($id);

        $productimage->delete();
        return redirect()->back()->with('message', 'image Deleted Successfully');
    }
}
