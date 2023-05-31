<?php

namespace App\Modules\Staff;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permission;
use App\Models\AdminPermission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
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

    public function stafflist()
    {
        $staff = User::where('role', 2)->get();
        return view('Superadmin.Staff.stafflist', compact('staff'));
    }
    public function addstaff()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            $permission = Permission::get();

            return view('Superadmin.Staff.addstaff', compact('permission'));
        } else {
            $permission = Permission::get();
            $staff =  User::with('adminpermission')->find($id);
            return view('Superadmin.Staff.addstaff', compact('staff', 'permission'));
        }
    }

    public function savestaff(Request $req)
    {

        if ($req->id == '') {
            $validator  = Validator::make(
                $req->all(),
                [
                    'email' => 'unique:users',
                    'profile' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $imagename = "";
            if ($req->hasFile('profile')) {
                $imagename = $req->profile->getClientOriginalName();
                $req->profile->move(public_path('uploads'), $imagename);
                $imagename = url('/') . '/uploads/' . $imagename;
            }


            $staff = new User;
            $staff->profile = $imagename;
            $staff->username = ucfirst($req->username);
            $staff->email = $req->email;
            $staff->mobile = $req->mobile;
            $staff->password = Hash::make(123456);
            $staff->role = 2;
            $staff->save();

            foreach ($req->permission as $key => $val) {
                $permission = new AdminPermission;
                $permission->staff_id = $staff->id;
                $permission->permission_id = $val;
                $permission->save();
            }
        } else {
            $staff =  User::find($req->id);
            if ($req->hasFile('profile')) {
                $imagename = $req->profile->getClientOriginalName();
                $req->profile->move(public_path('uploads'), $imagename);
                $staff->profile = url('/') . '/uploads/' . $imagename;
            }
            $staff->username = ucfirst($req->username);
            $staff->password = Hash::make(123456);
            $staff->mobile = $req->mobile;
            $staff->role = 2;
            $staff->save();


            AdminPermission::where('staff_id', $req->id)->delete();
            foreach ($req->permission as $key => $val) {
                $permission = new AdminPermission;
                $permission->staff_id = $staff->id;
                $permission->permission_id = $val;
                $permission->save();
            }
        }



        return redirect()->route('stafflist')->with('message', 'Added Successfully');
    }

    public function changestatus(Request $req, $id)
    {
        $staff =  User::find($id);
        if ($req->status == 1) {
            $staff->status = 2;
        } else {
            $staff->status = 1;
        }
        $staff->save();
        return redirect()->route('stafflist')->with('message', 'Updated Successfully');
    }
}
