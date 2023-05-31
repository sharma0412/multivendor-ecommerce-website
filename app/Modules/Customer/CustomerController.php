<?php

namespace App\Modules\Customer;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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

    public function customerlist()
    {
        $customer = User::where('role', 3)->get();
        return view('Superadmin.Customer.customerlist', compact('customer'));
    }


    public function customerstatus(Request $req, $id)
    {
        $staff =  User::find($id);
        if ($req->status == 1) {
            $staff->status = 2;
        } else {
            $staff->status = 1;
        }
        $staff->save();
        return redirect()->route('customerlist')->with('message', 'Updated Successfully');
    }
}
