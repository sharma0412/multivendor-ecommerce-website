<?php

namespace App\WebModules\Product;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\VenderProduct;
use App\Models\User;
use App\Models\productImages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

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


    public function products($id)
    {
       $vendorid =isset($_GET['vendorid']) ? $_GET['vendorid'] : '';
        $product = Product::with('catgeory')->find($id);
        $VenderProduct = VenderProduct::where(['vendor_id'=>$vendorid,'product_id'=>$id])->first();
        
        $productimages = productImages::where('product_id',$id)->get();
        return view('Frontend.Product.product_details',compact('product','VenderProduct','productimages'));
    }
}
