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

        if (Auth::guard('hospital')->attempt(['email' => $input['email'], 'password' => $input['password']])) {
                return redirect()->route('hospital.home');
            } else {
                return redirect()->back()->with('error', 'Invalid password.');
            }


    }
       public function Hospital_Home()
    {
        return view('hospital.home');
    }
    public function doctorHome()
    {
        return view('doctor.home');
    }



    function orders(Request $request)
    {

        $doctor_id = request('doctor') ??  "";
        $date = request('date');
        $orders = DB::table('orders as a')
            ->where('a.hospital_id', Auth::guard('hospital')->user()->id)
            ->when($doctor_id, function ($query, $doctor_id) {
                $query->where('a.doctor_id', $doctor_id);
            })
            ->when($date, fn($q) => $q->whereDate('a.booking_date', $date))
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

        $doctors = DB::table('users')->where('type', '4')->where('user_id', Auth::guard('hospital')->user()->id)->get();
        $patient = DB::table('users')->where('type', '0')->get();
        return view('hospital.order.index', compact('orders', 'doctors', 'doctor_id', 'patient'));
    }


    function appointment(Request $request)
    {
        $doctor_id = request('doctor') ??  "";
        $type = $request->type;
        $type_val = $request->type;

        if ($type == "Pending") {
            $type = "0";
        } elseif ($type == "Approved") {
            $type = "1";
        } elseif ($type == "Cancelled") {
            $type = "3";
        } elseif($type == "Completed"){
             $type = "4";
        }


        $date = request('date');
        $orders = DB::table('orders as a')
            ->where('a.hospital_id', Auth::guard('hospital')->user()->id)
            ->where('a.status', $type)
            ->where('a.payment_type', 'offline')
            ->when($doctor_id, function ($query, $doctor_id) {
                $query->where('a.doctor_id', $doctor_id);
            })
            // ->when($date, function ($q) use ($date) {
            //     $q->whereDate('a.booking_date', $date);
            // }, function ($q) {
            //     $q->whereMonth('a.booking_date', Carbon::now()->month)
            //         ->whereYear('a.booking_date', Carbon::now()->year);
            // })

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

        $doctors = DB::table('users')->where('type', '4')->where('user_id', Auth::guard('hospital')->user()->id)->get();
        $patient = DB::table('users')->where('type', '0')->get();
        return view('hospital.AppointmentType', compact('orders', 'doctors', 'doctor_id', 'patient', 'type_val'));
    }

    function updateStatus(Request $request)
    {
        $status = null;
        if ($request->type === 'approve') {
            $status = 1;
        } elseif ($request->type === 'cancel') {
            $status = 3;
        } elseif( $request->type== "Complete"){
             $status = 4;
        }
        if ($status !== null) {
            DB::table('orders')
                ->where('id', $request->id)
                ->update(['status' => $status]);
        }
        return back()->with('success', 'Order status updated.');
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
            $array['user_id'] = Auth::guard('hospital')->user()->id;
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
            $array['price']  = $rest->price;
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
            ->where('a.user_id', Auth::guard('hospital')->user()->id)->where('a.status', 1)
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
            $array['price']  = $rest->price;
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

    public function DoctorScheduleList(Request $request)
    {

        $decrypted = Crypt::decrypt($request->doctor_id);
        $data = DB::table("doctor_slots")->where('doctor_id', $decrypted)->orderBy('date', 'desc')->get();
        $last_slot = DB::table("doctor_slots")->where('doctor_id', $decrypted)->orderBy('date', 'desc')->first();
        $future_dates = DB::table("doctor_slots")
            ->where('doctor_id', $decrypted)
            ->whereDate('date', '>', now()) // Only future dates
            ->pluck('date')
            ->toArray();
        $doctor_data = DB::table("users")->where('id', $decrypted)->first();

        return view('hospital.schedule.add_doctor_slot', compact('data', 'decrypted', 'doctor_data', 'last_slot', 'future_dates'));
    }



    //======================================radiology service

      public  function Show_Radiology(Request $rest)
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
            ->where('a.type', '5')
            ->where('a.user_id', Auth::guard('hospital')->user()->id)->where('a.status', 1)
            ->orderBy('a.id', 'DESC')
            ->get();
        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
        $arr['hospital_data'] = DB::table('users')->where('type', 2)->get();
        $arr['All_staff'] = $data;
        return view('hospital.doctor.all_service')->with($arr);
    }
        public function NewRService(Request $rest)
    {
        if ($rest->id) {
            $arr["staff_id"] = $rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $user = DB::table('users')->where('id', $decrypted)->where('role_id', '5')->first();
            $arr['data'] = $user;

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
        $arr['category_data'] = DB::table('category')->where('type', 'radiology')->get();


        $arr['All_staff'] = $data;

        return view('hospital.doctor.add_service')->with($arr);
    }

        public function AddRadiology_Service(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string']);



            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/doctor'), $firmImage);
                $array['image'] = $firmImage;
            }
            $array['user_id'] = Auth::guard('hospital')->user()->id;
            $array['role_id'] = '5';
            $array['type'] = '5';
            $array['password'] =  rand(1000000, 9999999);
            $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
            $array['symptom_id'] = $rest->symptom_id ? implode(',', $rest->symptom_id) : '';

            $array['name'] = $rest->name;
            $array['price'] = $rest->price;

            $array['description'] = $rest->description;
            $array['status'] = 1;
            $array['created_at'] = Carbon::now();
            $ins = DB::table('users')->insert($array);


            if ($ins) {

                session()->flash('msgVendor', 'service Added Successfully.');

               return redirect()->back();
            } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');

                return redirect()->back();
            }

    }

//=============schedule add of service

        public function Service_ScheduleList(Request $request)
    {
        $radiology_id= Auth::guard('hospital')->user()->id;
        $data = DB::table("doctor_slots")->where('doctor_id', $radiology_id)->orderBy('date', 'desc')->get();
        $last_slot = DB::table("doctor_slots")->where('doctor_id', $radiology_id)->orderBy('date', 'desc')->first();
        $future_dates = DB::table("doctor_slots")
            ->where('doctor_id', $radiology_id)
            ->whereDate('date', '>', now()) // Only future dates
            ->pluck('date')
            ->toArray();
        $doctor_data = DB::table("users")->where('id', $radiology_id)->first();
      $decrypted='';
        return view('hospital.schedule.add_schedule', compact('data', 'decrypted', 'doctor_data', 'last_slot', 'future_dates'));
    }

      public function UpdateHospital(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);

        $update_id=$rest->update_id;
        $checkemail = DB::table('users')->where('id','!=', $update_id)->where('email', $rest->email)->where('type','4')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back();
        }

        $chkm = DB::table('users')->where('id','!=', $update_id)->where('mobile_no', $rest->mobile)->where('type','4')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back();
        }else{

            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/doctor'), $firmImage);
                $array['image'] = $firmImage;

           }
            $array['user_id'] = $rest->hospital;
            $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
            $array['symptom_id'] = $rest->symptom_id ? implode(',', $rest->symptom_id) : '';
            $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['qualification'] =$rest->qualification;
                $array['experience'] =$rest->experience;
                $array['description'] =$rest->description;
                $array['status'] =1;
                $array['updated_at'] = Carbon::now();

                    $ins = DB::table('users')->where('id', $update_id)->update($array);

                if ($ins) {

                    session()->flash('msgVendor', 'doctor detail update Successfully.');

                    return redirect()->route('profile.hospital', ['id'=>Crypt::encrypt( Auth::guard('hospital')->user()->id)]);
                } else {

                session()->flash('errorVendor', 'Unable to update try after some time .');

                return redirect()->route('profile.hospital', ['id'=>Crypt::encrypt( Auth::guard('hospital')->user()->id)]);
                }



        }

    }


    //==>endcode
}
