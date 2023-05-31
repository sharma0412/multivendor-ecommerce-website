<?php

namespace App\WebModules\Shop;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VenderProduct;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\Models\OrderAddresses;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stripe;
use Session;

class ShopController extends Controller
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
        function point2point_distance($lat1, $lon1, $lat2, $lon2, $unit='K') 
    { 
        $theta = $lon1 - $lon2; 
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
        $dist = acos($dist); 
        $dist = rad2deg($dist); 
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") 
        {
            return ($miles * 1.609344); 
        } 
        else if ($unit == "N") 
        {
        return ($miles * 0.8684);
        } 
        else 
        {
        return $miles;
      }
    }

    public function shops()
    {
        $lat1 = session::get('lat');
        $lon1 = session::get('long');

        $latlng = User::where('role', 1)->orderBy('id', 'desc')->get();
        $under5KM=array('');
        foreach ($latlng as $value) {
          $lat2 = $value['latitude'];
          $lon2 = $value['longitude'];
          $result = $this->point2point_distance($lat1,$lon1,$lat2,$lon2);
          if ($result <= 5 ) {
            array_push($under5KM,$value['id']);
          }
        }
        $catid = isset($_GET['catid']) ? $_GET['catid'] : '';
        $catDetails = Category::find($catid);
        $user = User::where(['role' => 1])->whereIn('id',$under5KM)->whereRaw("find_in_set('$catid',category)")->orderBy('id', 'desc')->get();
        return view('Frontend.Shop.shop', compact('user','catDetails'));
    }

    public function shopdetails($id)
    {
        $catid = isset($_GET['catid'])?$_GET['catid']:"";
        if($catid == ''){
        $user = User::with('vendor')->find($id);
        $cat_product = Product::get();
        }else{
        $cat_product = Product::where('cat_id',$catid)->get();
        $user = User::with('vendor')->find($id);
        }
        return view('Frontend.Shop.shopdetails', compact('user','cat_product'));
    }

    public function cart()
    {
        $cart =  Cart::with('product', 'user')->where('user_id', Auth::id())->get();
        $subtotal =  Cart::where('user_id', Auth::id())->sum('actual_price');
        $totalsum = $subtotal + 0 + 0;
        return view('Frontend.Shop.cart', compact('cart', 'subtotal', 'totalsum'));
    }

    public function addtocart(Request $req)
    {
        $cart =  Cart::where(['user_id' => Auth::id(), 'product_id' => $req->productid])->first();
        $cartdata =  Cart::where(['user_id' => Auth::id()])->get();
        if (count($cartdata) > 0) {

            $vendorid = $cartdata[0]->vendor_id;
            if ($vendorid == $req->vendorid) {

                if ($cart) {
                    $qty = $cart->quantity + 1;
                    $cart->quantity = $qty;
                    $cart->actual_price =  $cart->product_price * $qty;
                    $cart->save();
                } else {
                    $cart = new Cart;
                    $cart->user_id = Auth::id();
                    $cart->vendor_id = $req->vendorid;
                    $cart->product_id = $req->productid;
                    $cart->product_price = $req->product_price;
                    $cart->actual_price = $req->product_price;
                    $cart->market_price = $req->market_price;
                    $cart->quantity = 1;
                    $cart->save();
                }
                // return response()->json([$value1, $value2]);
                return response()->json(['mestype' => 'success','mes' => 'Product Added Successfully']);
            } else {
                return response()->json(['mestype' => 'info','mes' => 'If you want to change vendor please empty your cart first!']);
            }
        } else {
            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->vendor_id = $req->vendorid;
            $cart->product_id = $req->productid;
            $cart->product_price = $req->product_price;
            $cart->actual_price = $req->product_price;
            $cart->market_price = $req->market_price;
            $cart->quantity = 1;
            $cart->save();
            return response()->json(['mestype' => 'success','mes' => 'Product Added Successfully']);
        }
    }

    public function updatecart(Request $req)
    {
        $cart =  Cart::where('product_id', $req->productid)->first();
        if ($req->datatype == 2) {
            $qty = $cart->quantity + 1;
            $cart->quantity = $qty;
            $cart->actual_price =  $cart->product_price * $qty;
            $cart->save();
        } else {
            $cart =  Cart::where('product_id', $req->productid)->first();
            $qty = $cart->quantity - 1;
            $cart->quantity = $qty;
            $cart->actual_price =  $cart->product_price * $qty;
            $cart->save();
        }
        $totalCartPrice = Cart::where(['user_id' => auth::user()->id])->sum('actual_price');
        $cart->subtotalPrice = $totalCartPrice;
        $cart->totalPrice = $totalCartPrice + 0 + 0;
        return $cart;
    }
    public function removecart($id)
    {
        $cart =  Cart::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function checkout()
    {
        $totalCartPrice =  Cart::where('user_id', Auth::id())->sum('actual_price');
        $address = UserAddress::where('user_id',Auth::id())->get();

        return view('Frontend.Shop.checkout', compact('totalCartPrice','address'));
    }
    public function save_useraddress(Request $req)
    {
        $UserAddress = new UserAddress;
        $UserAddress->user_id = Auth::id();
        $UserAddress->first_name = $req->first_name;
        $UserAddress->last_name = $req->last_name;
        $UserAddress->contact = $req->contact;
        $UserAddress->houseno = $req->houseno;
        $UserAddress->landmark = $req->landmark;
        $UserAddress->address = $req->address;
        $UserAddress->pincode = $req->pincode;

        $lat = session::get('lat');
        $lng = session::get('long');        
        $UserAddress->latitude = $lat;
        $UserAddress->longitude = $lng;
        $UserAddress->save();
        return redirect()->back()->with('message', 'Address Added Successfully');
        
    } 
    public function update_useraddress(Request $req)
    {
        $UserAddress = UserAddress::find($req->add_id);
        $UserAddress->first_name = $req->first_name;
        $UserAddress->last_name = $req->last_name;
        $UserAddress->contact = $req->contact;
        $UserAddress->houseno = $req->houseno;
        $UserAddress->landmark = $req->landmark;
        
        $UserAddress->pincode = $req->pincode;

        $address = session::get('address');
        $lat = session::get('lat');
        $lng = session::get('long');
        $UserAddress->address = $address;
        $UserAddress->latitude = $lat;
        $UserAddress->longitude = $lng;        
        $UserAddress->save();
        return redirect('checkout')->with('message', 'Address Updated Successfully');
        
    }     
      

    public function payment(Request $request)
    {
        require_once('stripe/stripe-php/init.php');
        $stripe = new \Stripe\StripeClient(
            'YOUR STRIPE SECRET KEY'
        );

        try {
            $respone = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->expiry_month,
                    'exp_year' => $request->expiry_year,
                    'cvc' => $request->cvv,
                ],
            ]);

            $respone =  $stripe->tokens->create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->expiry_month,
                    'exp_year' => $request->expiry_year,
                    'cvc' => $request->cvv,
                ],
            ]);



            $charge =  $stripe->charges->create([
                'amount' => $request->totalCartPrice * 100,
                'currency' => 'inr',
                'source' => $respone['id'],
                'description' => 123,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            $error = $e->getError()->message;
            return redirect()->back()->with('error', $error);
        }
        $cardata = Cart::where(['user_id' => auth::user()->id])->get();
        $order = new Order;
        $order->transaction_id = $charge['balance_transaction'];
        $order->user_id = Auth::id();
        $order->vendor_id = $cardata[0]->vendor_id;
        $order->user_address_id = $request->addressid;
        $order->amount = $request->totalCartPrice;
        $order->status = 1;
        $order->type = 2;

        $order->save();
        foreach ($cardata as $card_data) {
            $cart = new OrderItem;
            $cart->order_id = $order->id;
            $cart->product_id = $card_data->product_id;
            $cart->quantity = $card_data->quantity;
            $cart->save();
            
            $VenderProduct = VenderProduct::where(['product_id'=>$card_data->product_id,'vendor_id'=>$cardata[0]->vendor_id])->first();
            $qyt = $VenderProduct->remaining_stock - $card_data->quantity;
            $VenderProduct->remaining_stock = $qyt;
            $VenderProduct->save();

        }
        Cart::where(['user_id' => auth::user()->id])->delete();
        return redirect('thankyou');
    }
    public function saveCurrentUrl(Request $req){
        session(['currentShopUrl' => $req->currentShopUrl]);
        return $req->currentShopUrl;
    }
}
