<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HospitalController extends Controller
{
    public function index() 
    {
        $doctors = User::where([
            ['type',3],
            ['user_id',auth()->user()->id],
            ])->get();
        return view('hospital.doctor.index',compact('doctors'));
    }

    public function create() 
    {
        
        $state_data = State::where('fcountryid', 101)->get();
        $city_data = City::where('fstateid', auth()->user()->state)->get();
        $category_data = Category::where('type','category')->get();
        $symptom_data = Category::where('type','symptom')->get();
        return view('hospital.doctor.create',compact('state_data','city_data','category_data','symptom_data'));
    }



    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
             'mobile' => 'required|string|unique:users,mobile_no',
             'password' => 'required|string|min:6',
             'email' => 'required|string|email|unique:users,email',
            'category_id' => 'required|array',
             'symptom_id' => 'required|array',
             'state' => 'required',
             'city' => 'required',
             'address' => 'required',
             'image' => 'required',
        ]);


        
        if (User::where('email', $request->email)->where('type', '3')->exists()) {
            return redirect()->route('doctor.index')->with('msgVendor', 'Email Address already exists');
        }
        if (User::where('mobile_no', $request->mobile)->where('type', '3')->exists()) {
            return redirect()->route('doctor.index')->with('msgVendor', 'This Mobile No. already exists.');
        }

        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = time() . rand(1000000, 9999999) . '.' . $request->image->extension();
            $request->image->move(public_path('storage/doctor'), $imagePath);
        }

        // Create user
        $doctor = User::create([
            'user_id' => auth()->user()->id,
            'role_id' => 3,
            'type' => 3,
            'category_id' => implode(',', $request->category_id),
            'symptom_id' => implode(',', $request->symptom_id),
            'name' => $request->name,
            'mobile_no' => $request->mobile,
            'password' => Hash::make($request->password),
            'pass_hint' => $request->password,
            'email' => $request->email,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'address' => $request->address,
            'image' => $imagePath,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        

        if ($doctor) {
            return redirect()->route('doctor.index')->with('msgVendor', 'Doctor Added Successfully.');

        } else {
            return redirect()->route('doctor.index')->with('errorVendor', 'Unable to add. Try again later.');
        }

        
        }


    }


