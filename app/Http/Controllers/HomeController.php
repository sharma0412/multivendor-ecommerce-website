<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Order;
use App\Models\VenderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $staff = User::where('role', 2)->count();
        $Category  = Category::count();
        $Vender = User::where('role', 1)->count();
        $Customer = User::where('role', 3)->count();

        $Banner = Banner::count();


        if (Auth::User()->role == 0) {
            $product = Product::count();
            $Order = Order::count();
        } else {
            $product = VenderProduct::where('vendor_id', Auth::id())->count();
            $Order = Order::where('vendor_id', Auth::id())->count();
        }
        return view('Superadmin.index', compact('staff', 'Category', 'Vender', 'Customer', 'Banner', 'Order', 'product'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        return view('Superadmin.profile');
    }

    public function updateprofile(Request $req, $id)
    {

        $profile = User::find($id);
        $profile->username = $req->name;
        $profile->email = $req->email;


        if ($req->hasFile('profile')) {
            $imagename = $req->profile->getClientOriginalName();
            $req->profile->move(public_path('uploads'), $imagename);
            $profile->profile = url('/') . '/uploads/' . $imagename;
        }


        $profile->save();
        return redirect('/profile')->with('message', 'profile updated Successfully');
    }
    public function changepass(Request $request, $id)
    {
        //dd($request->all());
        $user = User::findOrFail($id);

        $validator  = Validator::make(
            $request->all(),
            [
                'password' => 'required',
                'new_password' => 'required|max:8|different:password',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();


            return redirect()->route('profile')->with('message', 'password updated Successfully');
        } else {

            return redirect()->route('profile')->with('message', 'password not matched');
        }
    }
}
