<?php

namespace App\Modules\Vendors;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\PermissionCategory;
use App\Models\PermissionSubcategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorsController extends Controller
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

    public function vendorlist()
    {
        $vendor = User::where('role', 1)->get();
        return view('Superadmin.Vendor.vendorslist', compact('vendor'));
    }
    public function vendordetails()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $vendor =  User::with('order.orderitem.product')->find($id);

        return view('Superadmin.Vendor.vendordetails', compact('vendor'));
    }
    public function addvendor()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            $category = Category::where('status', 1)->get();
            return view('Superadmin.Vendor.addvendors', compact('category'));
        } else {
            $vendor =  User::find($id);
            $category = Category::where('status', 1)->get();
            return view('Superadmin.Vendor.addvendors', compact('vendor', 'category'));
        }
    }

    public function savesvendor(Request $req)
    {

        if ($req->id == '') {
            $validator  = Validator::make(
                $req->all(),
                [
                    'email' => 'unique:users',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $vendor = new User;
            $vendor->username = ucfirst($req->username);
            $vendor->email = $req->email;
            $vendor->mobile = $req->phone;
            $vendor->description = $req->description;
            $vendor->category = implode(',', $req->category);
            $vendor->address = $req->address;
            $vendor->latitude = $req->latitude;
            $vendor->longitude = $req->longitude;
            $vendor->password = Hash::make(123456);
            $vendor->role = 1;
            if ($req->hasFile('profile')) {
                $imagename = $req->profile->getClientOriginalName();
                $req->profile->move(public_path('/uploads'), $imagename);
                $imagename = url('/') . '/uploads/' . $imagename;
            }
            $vendor->profile = $imagename;
            $vendor->save();
        return redirect()->route('vendorlist')->with('message', 'Added Successfully');
        } else {
            $vendor =  User::find($req->id);
            $vendor->username = ucfirst($req->username);
            $vendor->email = $req->email;
            $vendor->mobile = $req->phone;
            $vendor->description = $req->description;
            $vendor->category = implode(',', $req->category);
            $vendor->address = $req->address;
            $vendor->latitude = $req->latitude;
            $vendor->longitude = $req->longitude;
            $vendor->role = 1;
            if ($req->hasFile('profile')) {
                $imagename = $req->profile->getClientOriginalName();
                $req->profile->move(public_path('/uploads'), $imagename);
                $vendor->profile = url('/') . '/uploads/' . $imagename;
            }
            $vendor->save();
         return redirect()->route('vendorlist')->with('message', 'Updated Successfully');
        }



    }

    public function vendorstatus(Request $req, $id)
    {
        $staff =  User::find($id);
        if ($req->status == 0) {
            $staff->status = 1;
        } else {
            $staff->status = 0;
        }
        $staff->save();
        return redirect()->route('vendorlist')->with('message', 'Updated Successfully');
    }
}
