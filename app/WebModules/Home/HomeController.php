<?php

namespace App\WebModules\Home;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\VenderProduct;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
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


    function point2point_distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public function webhome()
    {

        // return view('auth.login');
            $lat1 = session::get('lat');
            $lon1 = session::get('long');
            $latlng = User::where('role', 1)->get();
            $under5KM=array('');
            foreach ($latlng as $value) {
              $lat2 = $value['latitude'];
              $lon2 = $value['longitude'];
              $result = $this->point2point_distance($lat1,$lon1,$lat2,$lon2);
              if ($result <= 5 ) {
                array_push($under5KM,$value['id']);
              }
            }

        $category = Category::where('status', 1)->limit(10)->get();

        $cat = Category::where('status', 1)->limit(3)->get();
        $order_item = OrderItem::groupBy('product_id')->get();

        $most_sold_product = OrderItem::select('product_id', DB::raw('count(*) as max', 'product_id'))->groupBy('product_id')->orderBy('max', 'DESC')->get();
        $product_id[] = '';
        $i = 0;
        foreach ($most_sold_product as $product) {
            $product_id[$i] = $product->product_id;
            $i++;
        }

        $product = Product::where('status', 1)->whereIn('id', $product_id)->take(5)->get();

        $user = User::where('role', 1)->whereIn('id',$under5KM)->orderBy('id', 'desc')->take(6)->get();

        return view('Frontend.home', compact('category', 'product', 'user','cat'));
    }

    public function weblogin()
    {
        return view('Frontend.weblogin');
    }

    public function webregister()
    {
        return view('Frontend.webregister');
    }
    public function about()
    {
        return view('Frontend.about');
    }
    public function faq()
    {
        return view('Frontend.faq');
    }
    public function mylist()
    {
        return view('Frontend.mylist');
    }
    public function listcategory()
    {

        $category = Category::where('status', 1)->get();

        return view('Frontend.listcategory', compact('category'));
    }
    public function saveusers(Request $req)
    {
        $validator  = Validator::make(
            $req->all(),
            [
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required',
                'password' => 'required|min:8',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->mobile = $req->mobile;
        $user->password = Hash::make($req->password);
        $user->role = 3;
        $user->save();

        $guest_id = session::get('guest_id');
        $address = session::get('address');
        $lat = session::get('lat');
        $lng = session::get('long');

        $UserAddress = new UserAddress;
        $UserAddress->user_id = $user->id;
        $UserAddress->guest_id = '';
        $UserAddress->address = $address;
        $UserAddress->latitude = $lat;
        $UserAddress->longitude = $lng;
        $UserAddress->save();
        return redirect('/')->with('message', 'Register Successfully');
    }

    public function websitelogin(Request $request)
    {

        $validator  = Validator::make(
            $request->all(),
            [

                'email' => 'required|email',
                'password' => 'required',

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pass = $request->password;
        $password = Hash::make($request->password);
        $email = $request->email;
        if (Auth::attempt(['email' => $email, 'password' => $pass, 'role' => 3])) {
            $userdata = User::where('email', $email)->first();
            Auth::login($userdata, true);

            if (Session::has('currentShopUrl')) {
                $currentShopUrl = session::get('currentShopUrl');
                session(['currentShopUrl' => '']);
                return redirect($currentShopUrl)->with('message', 'Login Successfully');
            } else {
                return redirect('/')->with('message', 'Login Successfully');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }

    public function weblogout()
    {
        Auth::logout();
        return redirect()->back();
    }
    public function thankyou()
    {
        return view('Frontend.thanku');
    }

    public function globalsearch(Request $request)
    {
        $query = $_POST['query'];
        $pid =  Product::where('name', 'LIKE', '%' . $query . '%')->pluck('id');
        $vid = VenderProduct::whereIn('product_id', $pid)->groupBy('vendor_id')->pluck('vendor_id');

        $lat1 = session::get('lat');
        $lon1 = session::get('long');
        $latlng = User::where('role', 1)->get();
        $under5KM = array('');
        foreach ($latlng as $value) {
            $lat2 = $value['latitude'];
            $lon2 = $value['longitude'];
            $result = $this->point2point_distance($lat1, $lon1, $lat2, $lon2);
            if ($result <= 5) {
                array_push($under5KM, $value['id']);
            }
        }
        $data =  User::whereIn('id', $vid)->whereIn('id', $under5KM)->get();
        if ($request->ajax()) {
            $view = view('Frontend.renderglobalsearch', compact('data'))->render();
            return response()->json(['html' => $view]);
        }
    }
    public function guestaddress(Request $request)
    {

        $guest_id = uniqid();
        session(['lat' => $request->lat]);
        session(['long' => $request->lng]);
        session(['address' => $request->address]);

        if (Auth::check()) {
            session(['guest_id' => '']);
            if (!empty($request->type)) {
                $UserAddress = UserAddress::where('user_id', Auth::id())->latest()->first();
                $UserAddress->address = $request->address;
                $UserAddress->latitude = $request->lat;
                $UserAddress->longitude = $request->lng;
                $UserAddress->save();
                return response()->json(['html' => 'Current address changed!']);
            }
        } else {
            session(['guest_id' => $guest_id]);
            $UserAddress = new UserAddress;
            $UserAddress->guest_id = $guest_id;
            $UserAddress->address = $request->address;
            $UserAddress->latitude = $request->lat;
            $UserAddress->longitude = $request->lng;
            $UserAddress->save();
            return response()->json(['html' => 'Current address of guest changed!']);
        }
    }
}
