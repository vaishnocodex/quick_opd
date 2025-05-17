<?php

namespace App\Http\Controllers;

use Redirect, Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PartnerRegOtp;
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class WebUserController extends Controller
{
    //



    public function UserDashboard(Request $request)
    {

        $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
        $arr['doctor'] =  User::where('status', '1')->where('type', '3')->get();
        $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
        $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();
        $arr['states'] = State::select('id', 'name')->where('fcountryid', 101)->get();
        $arr['slider'] = Slider::where('status', 1)->get();



       $arr['orders'] = DB::table('orders as a')
       ->where('a.user_id', Auth::user()->id)
       ->select([
        'a.*',
        'b.name as patient_name',
        'b.mobile_no as patient_mobile',
        'b.address as patient_address',
        'c.name as hospital_name',
        'c.mobile_no as hospital_mobile',
        'c.address as hospital_address',
        'd.name as doctor_name',
        'd.mobile_no as doctor_mobile',
        'd.address as doctor_address',
    ])
    ->leftJoin('users as b', function ($join) {
        $join->on('a.user_id', '=', 'b.id')->where('b.type', 0);
    })
    ->leftJoin('users as c', function ($join) {
        $join->on('a.hospital_id', '=', 'c.id')->where('c.type', 3);
    })
    ->leftJoin('users as d', function ($join) {
        $join->on('a.doctor_id', '=', 'd.id')->where('d.type', 4);
    })
    ->orderByDesc('a.id')
    ->get();

        return view('website.user.dashboard')->with($arr);
    }

    public function User_Update_Password(Request $request)
    {
        // Validate Input
        $request->validate([
            'password'  => 'required',
            'npassword' => 'required|min:6',
            'cpassword' => 'required|same:npassword',
        ]);

        // Get authenticated user
        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect!');
        }

        // Update the password
        $user->password = Hash::make($request->npassword);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function update_UserProfile(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to update profile.');
        }

        // Validate Input
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255' . Auth::id(),
            'state'     => 'required|string|max:255',
            'district'  => 'required|string|max:255',
            'pincode'   => 'required|digits:6',
            'address'   => 'required|string|max:500',
        ]);

        // Retrieve Authenticated User
        $user = Auth::user();

        // Update User Details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->state = $request->state;
        $user->district = $request->district;
        $user->pincode = $request->pincode;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
