<?php

namespace App\Modules\Units;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Units;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UnitsController extends Controller
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

    public function unitslist()
    {
        $units = Units::get();
        return view('Superadmin.Units.unitslist', compact('units'));
    }
    public function addunits()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            return view('Superadmin.Units.addunits');
        } else {
            $units =  Units::find($id);
            return view('Superadmin.Units.addunits', compact('units'));
        }
    }

    public function saveunits(Request $req)
    {

        if ($req->id == '') {


            $units = new Units;
            $units->unit_name = $req->unit_name;
            $units->save();
        } else {
            $units =  Units::find($req->id);
            $units->unit_name = $req->unit_name;
            $units->save();
        }

        return redirect()->route('unitslist')->with('message', 'Added Successfully');
    }

    public function unitstatus(Request $req, $id)
    {
        $staff =  Units::find($id);
        if ($req->status == 1) {
            $staff->status = 2;
        } else {
            $staff->status = 1;
        }
        $staff->save();
        return redirect()->route('unitslist')->with('message', 'Updated Successfully');
    }
}
