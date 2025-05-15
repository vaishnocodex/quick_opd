<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use PDF;
use TCPDF as GlobalTCPDF;
use Hash;
use function Ramsey\Uuid\v1;
use webhelper;
use backHelper;
use Log;

class HospitalController extends Controller
{
    //
    public function Login_Hospital(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check_user = User::where('email', $input['email'])->where('type', '3')->first();
        if (!$check_user) {
            return redirect()->back()->with('error', 'Email-Address And Password Are Wrong.');
        }

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            if (auth()->user()->type == 'hospital') {
                return view('hospital.home');
                // return redirect()->route('hospital.home');
            } else if (auth()->user()->type == 'manager') {
                return redirect()->route('manager.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Invalid Password.');
        }
    }
    public function doctorHome()
    {
        return view('doctor.home');
    }

    public function NewDoctor(Request $rest)
    {
        if ($rest->id) {
            $arr["staff_id"] = $rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $user = DB::table('users')->where('id', $decrypted)->where('role_id', '4')->first();
            $arr['data'] = $user;
            $arr['hospital_data'] = DB::table('users')->where('type', 3)->get();
            $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
            $arr['city_data'] = DB::table('city')->where('fstateid', $user->state)->get();
            $arr['category_data'] = DB::table('category')->where('type', 'category')->get();
            $arr['symptom_data'] = DB::table('category')->where('type', 'symptom')->get();
            return view('hospital.doctor.edit_doctor')->with($arr);
        } else {
            $arr["staff_id"] = null;
        }

        $data = DB::table('users as a')
            ->select(['a.*', 'b.name as state_name', 'c.name as city_name'])
            ->leftJoin('state as b', 'a.state', '=', 'b.id')
            ->leftJoin('city as c', 'a.city', '=', 'c.id')
            ->where('a.type', '4')
            //->where('a.user_id', '0')->where('a.status', 1)
            ->orderBy('a.id', 'DESC')
            ->get();

        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
        $arr['hospital_data'] = DB::table('users')->where('type', 2)->get();
        $arr['category_data'] = DB::table('category')->where('type', 'category')->get();
        $arr['symptom_data'] = DB::table('category')->where('type', 'symptom')->get();

        $arr['All_staff'] = $data;

        return view('hospital.doctor.add_doctor')->with($arr);
    }


    public function AddDoctor(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);

        $checkemail = DB::table('users')->where('email', $rest->email)->where('type', '4')->count();
        if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back()->withInput();
            // return redirect()->route('admin.doctor');
        }

        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type', '4')->count();
        if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back()->withInput();
            // return redirect()->route('admin.doctor');
        } else {

            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/doctor'), $firmImage);
                $array['image'] = $firmImage;
            }
            $array['user_id'] = Auth::user()->id;
            $array['role_id'] = '4';
            $array['type'] = '4';
            $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
            $array['symptom_id'] = $rest->symptom_id ? implode(',', $rest->symptom_id) : '';

            $array['name'] = $rest->name;
            $array['mobile_no'] = $rest->mobile;
            $array['password'] = Hash::make($rest->password);
            $array['pass_hint'] = $rest->password;
            $array['qualification'] = $rest->qualification;
            $array['experience'] = $rest->experience;
            $array['description'] = $rest->description;


            $array['email'] = $rest->email;
            $array['state'] = $rest->state;
            $array['city'] = $rest->city;
            $array['pincode'] = $rest->pincode;
            $array['address'] = $rest->address;
            $array['status'] = 1;
            $array['created_at'] = Carbon::now();
            $ins = DB::table('users')->insert($array);


            if ($ins) {

                session()->flash('msgVendor', 'doctor Added Successfully.');

                return redirect()->route('admin.doctor');
            } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');

                return redirect()->route('hospital.doctor');
            }
        }
    }

    public  function ShowDoctor(Request $rest)
    {
        if ($rest->id) {
            $arr["staff_id"] = $rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $arr['data'] = DB::table('users')->where('id', $decrypted)->where('role_id', '4')->first();
            return view('admin.edit_hospital')->with($arr);
        } else {
            $arr["staff_id"] = null;
        }

        $data = DB::table('users as a')
            ->select(['a.*', 'b.name as state_name', 'c.name as city_name', 'h.name as hospital_name', 'h.mobile_no as hospital_mobile'])
            ->leftJoin('state as b', 'a.state', '=', 'b.id')
            ->leftJoin('city as c', 'a.city', '=', 'c.id')
            ->leftJoin('users as h', 'h.id', '=', 'a.user_id')
            ->where('a.type', '4')
            ->where('a.user_id', Auth::user()->id)->where('a.status', 1)
            ->orderBy('a.id', 'DESC')
            ->get();
        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
        $arr['hospital_data'] = DB::table('users')->where('type', 2)->get();
        $arr['All_staff'] = $data;
        return view('hospital.doctor.all_doctor')->with($arr);
    }


    public function UpdateDoctor(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);

        $update_id = $rest->update_id;
        $checkemail = DB::table('users')->where('id', '!=', $update_id)->where('email', $rest->email)->where('type', '4')->count();
        if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back();
        }

        $chkm = DB::table('users')->where('id', '!=', $update_id)->where('mobile_no', $rest->mobile)->where('type', '4')->count();
        if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back();
        } else {

            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/doctor'), $firmImage);
                $array['image'] = $firmImage;
            }
            // $array['user_id'] = $rest->hospital;
            $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
            $array['symptom_id'] = $rest->symptom_id ? implode(',', $rest->symptom_id) : '';
            $array['name'] = $rest->name;
            $array['mobile_no'] = $rest->mobile;
            $array['password'] = Hash::make($rest->password);
            $array['pass_hint'] = $rest->password;
            $array['email'] = $rest->email;
            $array['state'] = $rest->state;
            $array['city'] = $rest->city;
            $array['pincode'] = $rest->pincode;
            $array['address'] = $rest->address;
            $array['qualification'] = $rest->qualification;
            $array['experience'] = $rest->experience;
            $array['description'] = $rest->description;
            $array['status'] = 1;
            $array['updated_at'] = Carbon::now();

            $ins = DB::table('users')->where('id', $update_id)->update($array);

            if ($ins) {

                session()->flash('msgVendor', 'doctor detail update Successfully.');

                return redirect()->route('hospital.doctor');
            } else {

                session()->flash('errorVendor', 'Unable to update try after some time .');

                return redirect()->route('hospital.doctor');
            }
        }
    }
}
