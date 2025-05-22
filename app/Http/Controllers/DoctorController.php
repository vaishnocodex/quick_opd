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
class DoctorController extends Controller
{
    //

    public function Login_Doctor(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

       $check_user= User::where('email',$input['email'])->where('type','4')->first();
        if(!$check_user){
            return redirect()->back()->with('error','Email-Address And Password Are Wrong.');


        }

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'doctor') {
                return redirect()->route('doctor.home');
            }else if (auth()->user()->type == 'manager') {
                return redirect()->route('manager.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Invalid Password.');
        }

    }
    public function doctorHome()
    {
        return view('doctor.home');
    }


     public function DoctorScheduleList(Request $request)
    {

        $decrypted =Auth::user()->id;
        $data = DB::table("doctor_slots")->where('doctor_id', Auth::user()->id)->orderBy('date', 'desc')->get();
        $last_slot = DB::table("doctor_slots")->where('doctor_id', $decrypted)->orderBy('date', 'desc')->first();
        $future_dates = DB::table("doctor_slots")
            ->where('doctor_id', $decrypted)
            ->whereDate('date', '>', now()) // Only future dates
            ->pluck('date')
            ->toArray();
        $doctor_data = DB::table("users")->where('id', $decrypted)->first();

        return view('doctor.add_schedule', compact('data', 'decrypted', 'doctor_data', 'last_slot', 'future_dates'));
    }

}
