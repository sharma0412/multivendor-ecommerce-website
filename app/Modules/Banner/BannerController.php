<?php

namespace App\Modules\Banner;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Banner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
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


    public function bannerlist()
    {
        $banner = Banner::get();
        return view('Superadmin.Banner.bannerlist', compact('banner'));
    }


       public function addbanner()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id == "") {
            return view('Superadmin.Banner.addbanner');
        } else {
            $banner =  Banner::find($id);
            return view('Superadmin.Banner.addbanner', compact('banner'));
        }
    }

    public function savebanner(Request $req)
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

            $banner = new Banner;
            $imagename = "";
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('/uploads'), $imagename);
                $imagename = url('/') . '/uploads/' . $imagename;
            }

            $banner->type = $req->imagetype;
            $banner->image = $imagename;
            $banner->save();
        } else {
            $banner =  Banner::find($req->id);
            $banner->type = $req->imagetype;
            if ($req->hasFile('image')) {
                $imagename = $req->image->getClientOriginalName();
                $req->image->move(public_path('/uploads'), $imagename);
                $banner->image = url('/') . '/uploads/' . $imagename;
            }
            $banner->save();
        }

        return redirect()->route('bannerlist')->with('message', 'Added Successfully');
    }

    public function bannerstatus(Request $req, $id)
    {
        $banner =  Banner::find($id);
        if ($req->status == 1) {
            $banner->status = 2;
        } else {
            $banner->status = 1;
        }
        $banner->save();
        return redirect()->route('bannerlist')->with('message', 'Updated Successfully');
    }
}
