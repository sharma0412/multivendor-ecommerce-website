<?php

namespace App\VenderModules\Product;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VenderProduct;
use App\Models\Product;
use App\Models\Units;
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


    public function venderproduct()
    {
        $product = VenderProduct::with('product')->where('vendor_id', auth::id())->get();
        
        return view('Vender.Product.productlist', compact('product'));
    }


    public function addvenderproduct()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
        $usercat = User::find(Auth::id());
        $catdata = explode(',', $usercat->category);
        $Product = Product::whereIn('cat_id', $catdata)->get();
        // dd($Product);
        $units = Units::where('status', 1)->get();
       
            return view('Vender.Product.addproduct', compact('Product', 'units'));
        } else {
            $units = Units::where('status', 1)->get();
           $usercat = User::find(Auth::id());
           $catdata = explode(',', $usercat->category);
            $Product = Product::whereIn('cat_id', $catdata)->get();
            $VenderProduct =  VenderProduct::find($id);
            return view('Vender.Product.addproduct', compact('Product', 'VenderProduct', 'units'));
        }
    }

    public function savevenderproduct(Request $req)
    {
        if ($req->id == '') {

            $product = new VenderProduct;
            $product->vendor_id = Auth::id();
            $product->product_id = $req->Product;
            $product->market_price = $req->market_price;
            $product->selling_price = $req->selling_price;
            $product->description = $req->description;
            $product->stock = $req->stock;
            $product->Remaining_stock = $req->stock;
            $product->qty = $req->qty;
            $product->unit_name = $req->unit_name;
            $product->save();
        } else {
            $product =  VenderProduct::find($req->id);
            $product->vendor_id = Auth::id();
            $product->product_id = $req->Product;
            $product->market_price = $req->market_price;
            $product->selling_price = $req->selling_price;
            $product->description = $req->description;
            $product->stock = $req->stock;
            $product->qty = $req->qty;
            $product->unit_name = $req->unit_name;
            $product->save();
        }

        return redirect()->route('venderproduct')->with('message', 'Added Successfully');
    }

    public function venderproductstatus(Request $req, $id)
    {
        $product =  VenderProduct::find($id);
        if ($req->status == 1) {
            $product->status = 2;
        } else {
            $product->status = 1;
        }
        $product->save();
        return redirect()->route('venderproduct')->with('message', 'Updated Successfully');
    }
}
