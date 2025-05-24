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
class VendorController extends Controller
{
    //


  /*category section */
  public function showRadiologyCat(Request $rest)
  {


      if($rest->id)
      {
          $arr["category_id"]=$rest->id;
      }
      else{
          $arr["category_id"]=null;
      }
      $arr['categories'] = DB::table('category')->where('type','radiology')->get();
      $cats = DB::table('category')
      //->where(['parent'=>0])
      ->where('type','radiology')->get();
      $arr['catall'] = $cats;
      $arr['heading_title'] = 'Radiology';
      $arr['cat_type'] = 'radiology';

      return view('admin.category')->with($arr);
  }
    public function loginAdmin(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

       $check_user= User::where('email',$input['email'])->where('type','1')->first();
        if(!$check_user){
            return redirect()->back()->with('error','Email-Address And Password Are Wrong.');


        }


        if (Auth::guard('admin')->attempt(['email' => $input['email'], 'password' => $input['password']])) {
             Auth::shouldUse('admin');
                return redirect()->route('admin.home');
            } else {
                return redirect()->back()->with('error', 'Invalid password.');
            }
        // if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        // {
        //     if (auth()->user()->type == 'admin') {
        //         return redirect()->route('admin.home');
        //     }else if (auth()->user()->type == 'manager') {
        //         return redirect()->route('manager.home');
        //     }else{
        //         return redirect()->route('home');
        //     }
        // }else{
        //     return redirect()->route('login')
        //         ->with('error','Invalid Password.');
        // }

    }


     function showFirmDetails()
    {


        $arr['firm']=DB::table('firmdetails')->get()[0];
        return view('admin.firmdetails',$arr);
    }
    function updateFirmDetails(Request $request)
    {

        if($request->logo)
        {

            $firmImage = time() . rand(1000, 9999) . '.' . $request->logo->extension();
            $request->logo->move(public_path('storage/firms'), $firmImage);
            $arr['logo']=$firmImage;
        }
        //$arr['terms']=$request->terms;
        $arr['name']=$request->name;
        $arr['mobile']=$request->mobile;
        // $arr['location']=$request->location;
        $arr['address']=$request->address;
        $arr['timing']=$request->timing;
        $arr['whatsapp']=$request->whatsapp;
        $arr['email']=$request->email;
        $arr['facebook']=$request->facebook;
        $arr['instagram']=$request->instagram;
        $arr['youtube']=$request->youtube;
        $arr['pmethod']=$request->pmode;
        //   $arr['about']=$request->about;
        //$arr['delivery_area']=$request->delivery_area;
       // $arr['discount_type']=$request->discount_type;
        //$arr['ridertype']=$request->ridertype;
        //$arr['amount']=$request->amount;
        //$arr['longitude']=$request->longitude;
        //$arr['latitude']=$request->latitude;
       // $arr['points']=$request->points;

        // if($request->status=='on')
        // $arr['status']=1;
        // else
        // $arr['status']=0;
        $upd=DB::table('firmdetails')->update($arr);
        if($upd)
        session()->flash('msgVendor', 'Firm details updated successfully.');
        else
        session()->flash('errorVendor', 'Unable to update details.');
        return redirect()->back();
    }

    public function AdminHome()
    {
        return view('admin.home');
    }

        public function UpdateAdminDetail(Request $rest)
    {


        $update_id= Auth::guard('admin')->user()->id;


                $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';

                if($rest->password){
                    $array['password'] = Hash::make($rest->password);
                    $array['pass_hint'] =$rest->password;
                }
                 if($rest->email){
                    $array['email'] =$rest->email;
                }

                 if($rest->mobile){
                 $array['mobile_no'] =$rest->phone;
                 }
                $array['name'] =$rest->name;



                 $array['updated_at'] = Carbon::now();

                 $ins = DB::table('users')->where('id', $update_id)->update($array);


                if ($ins) {

                    session()->flash('msgVendor', 'Profile detail Update Successfully.');

                    return redirect()->route('admin.profile');
                } else {

                session()->flash('errorVendor', 'Unable to update try after some time .');

                return redirect()->route('admin.profile');
                }



    }

    //-----------------Radiology CRUD Operation Start
    public function ShowRAdiology(Request $rest){
        if($rest->id){
            $arr["staff_id"]=$rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $user= DB::table('users')->where('id',$decrypted)->where('role_id','3')->first();
            $arr['data'] =$user;
            $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
            $arr['city_data'] = DB::table('city')->where('fstateid', $user->state)->get();
            $arr['category_data'] = DB::table('category')->where('type','category')->get();
            $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();
            return view('admin.edit_hospital')->with($arr);
        }
        else{
            $arr["staff_id"]=null;
        }

        $data = DB::table('users as a')
        ->select(['a.*', 'b.name as state_name', 'c.name as city_name'])
        ->leftJoin('state as b', 'a.state', '=', 'b.id')
        ->leftJoin('city as c', 'a.city', '=', 'c.id')
        ->where('a.type', '3')
        ->where('a.hospital_type', 'radiology')
        //->where('a.user_id', '0')->where('a.status', 1)
        ->orderBy('a.id', 'DESC')
        ->get();

        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
        $arr['category_data'] = DB::table('category')->where('type','radiology')->get();
        $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();
        $arr['All_staff'] = $data;
       // $staff = DB::table('users')->where('id','2')->get();
        //dd($staff);
        return view('admin.radiology')->with($arr);
    }

    public function AddRadiology(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);

        $checkemail = DB::table('users')->where('email', $rest->email)->where('type','2')->where('hospital_type','radiology')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back()->withInput();
            //return redirect()->route('admin.hospital');
        }

        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type','2')->where('hospital_type','radiology')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back()->withInput();
           // return redirect()->route('admin.hospital');
        }else{
            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/hospital'), $firmImage);
                $array['image'] = $firmImage;

           }
           $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';

                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                $array['role_id'] ='3';
                $array['type'] ='3';
                $array['hospital_type'] =$rest->hospital_type;
                 $array['created_at'] = Carbon::now();


                    $ins=DB::table('users')->insert($array);


                if ($ins) {

                    session()->flash('msgVendor', 'Radiology Added Successfully.');

                    return redirect()->route('admin.radiology');
                } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');

                return redirect()->route('admin.radiology');
                }



        }





    }
    public function Update_Radiology(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);
        $update_id=$rest->update_id;
        $checkemail = DB::table('users')->where('id','!=', $update_id)->where('email', $rest->email)->where('type','2')->where('hospital_type','radiology')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back();
        }

        $chkm = DB::table('users')->where('id','!=', $update_id)->where('mobile_no', $rest->mobile)->where('type','2')->where('hospital_type','radiology')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back();
        }else{
            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/hospital'), $firmImage);
                $array['image'] = $firmImage;

           }
                $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                 $array['updated_at'] = Carbon::now();

                 $ins = DB::table('users')->where('id', $update_id)->update($array);


                if ($ins) {

                    session()->flash('msgVendor', 'Radilogy detail Update Successfully.');

                    return redirect()->route('admin.radiology');
                } else {

                session()->flash('errorVendor', 'Unable to update try after some time .');

                return redirect()->route('admin.radiology');
                }

        }

    }


    public function HospitalLedgerReport(Request $request){

    $cdate = date_create()->format('Y-m-d');
    if(!$request->filter){

       $filter= null;
       $fdate= $cdate;
       $tdate= $cdate;

       $arr['fdate']=$cdate;
       $arr['tdate']='';
       $arr['filter']=null;

        }else{

            $filter= 2;
            $fdate= $request->fdate;;
            $tdate= $request->tdate;

        }

        $hospital_ids=DB::table('users')->where('type',3)->pluck('id');

        $results = DB::table('users')
        ->leftJoin('transaction', 'transaction.hospital_id', '=', 'users.id')
        ->select('users.id', 'users.name', 'users.email','users.mobile_no', // Add all columns here
                DB::raw('SUM(transaction.debit) as total_debit'),
                DB::raw('SUM(transaction.credit) as total_credit'))
        ->whereIn('users.id', $hospital_ids)
        ->where('transaction.status',1)
        ->groupBy('users.id', 'users.name', 'users.email', 'users.mobile_no') // Add all columns here
        ->get();


       $arr['Total_debit']=DB::table('transaction')->whereIn('hospital_id',$hospital_ids)->where('status','1')->sum('debit');
        $arr['Total_credit']=DB::table('transaction')->whereIn('hospital_id',$hospital_ids)->where('status','1')->sum('credit');

   // $arr['hospital_data'] = DB::table('users')->where('type', '3')->get();

    $arr['data']=$results;

     $arr['fdate']=$fdate;
     $arr['tdate']=$tdate;
     $arr['filter']=$filter;


     $arr['page_heading'] = "Hospital Balance Sheet";
     //$arr['data'] = $data;

     return view('admin.hospital_balance_sheet')->with($arr);

   }
    //-----------------Hospital CRUD Operation Start

      //-----------------Hospital CRUD Operation Start

    public function ShowLocation(Request $rest){

        $decrypted = Crypt::decrypt($rest->id);
        $data = DB::table('users as a')
        ->select(['a.*', 'b.name as state_name', 'c.name as city_name'])
        ->leftJoin('state as b', 'a.state', '=', 'b.id')
        ->leftJoin('city as c', 'a.city', '=', 'c.id')
        ->where('a.type', '3')
        ->where('a.user_id', '0')->where('a.status', 1)
        ->where('a.id', $decrypted)
        ->orderBy('a.id', 'DESC')
        ->first();

        $arr['hospital'] = $data;
        $arr['hospital_id'] = $rest->id;
       // $staff = DB::table('users')->where('id','2')->get();
        //dd($staff);
        return view('admin.hospital_map_add')->with($arr);
    }

 public function Update_Hospital_location(Request $request)
{

       // $hospital_id = Crypt::decrypt($request->hospital_id);

    $updated = DB::table('users')
        ->where('id', $request->hospital_id)
        ->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'updated_at' => Carbon::now(), // <-- Add this line
        ]);

    if ($updated) {
        session()->flash('msgVendor', 'Location Updated Successfully.');
    } else {
        session()->flash('errorVendor', 'Unable to update, try again later.');
    }
           $type_check=DB::table('users')->whereIn('id',$request->hospital_id)->first();

   if($type_check->hospital_type=='hospital'){
      return redirect()->route('admin.hospital');
   }else{
     return redirect()->route('admin.hospital');

   }

}


    public function ProfileHospital(Request $rest){
        if($rest->id){
            $arr["staff_id"]=$rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $user= DB::table('users')->where('id',$decrypted)->first();
            $arr['data'] =$user;
            $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
            $arr['city_data'] = DB::table('city')->where('fstateid', $user->state)->get();
            $arr['category_data'] = DB::table('category')->where('type','category')->get();
            $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();
            return view('hospital.profile')->with($arr);
        }
    }



    public function ShowHospital(Request $rest){
        if($rest->id){
            $arr["staff_id"]=$rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $user= DB::table('users')->where('id',$decrypted)->first();
            $arr['data'] =$user;
            $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
            $arr['city_data'] = DB::table('city')->where('fstateid', $user->state)->get();
            $arr['category_data'] = DB::table('category')->where('type','category')->get();
            $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();
            return view('admin.edit_hospital')->with($arr);
        }
        else{
            $arr["staff_id"]=null;
        }

        $data = DB::table('users as a')
        ->select(['a.*', 'b.name as state_name', 'c.name as city_name'])
        ->leftJoin('state as b', 'a.state', '=', 'b.id')
        ->leftJoin('city as c', 'a.city', '=', 'c.id')
        ->where('a.type', '3')->where('a.hospital_type','hospital')
        ->where('a.user_id', '0')->where('a.status', 1)
        ->orderBy('a.id', 'DESC')
        ->get();

        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
        $arr['category_data'] = DB::table('category')->where('type','category')->get();
        $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();
        $arr['All_staff'] = $data;
       // $staff = DB::table('users')->where('id','2')->get();
        //dd($staff);
        return view('admin.hospital')->with($arr);
    }

    public function AddHospital(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);

        $checkemail = DB::table('users')->where('email', $rest->email)->where('type','2')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back()->withInput();
            //return redirect()->route('admin.hospital');
        }

        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type','2')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back()->withInput();
           // return redirect()->route('admin.hospital');
        }else{
            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/hospital'), $firmImage);
                $array['image'] = $firmImage;

           }
               $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                $array['role_id'] ='3';
                $array['type'] ='3';
                $array['hospital_type'] =$rest->hospital_type;
                 $array['created_at'] = Carbon::now();


                    $ins=DB::table('users')->insert($array);


                if ($ins) {

                    session()->flash('msgVendor', 'Hospital Added Successfully.');

                    return redirect()->route('admin.hospital');
                } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');

                return redirect()->route('admin.hospital');
                }



        }





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
        $checkemail = DB::table('users')->where('id','!=', $update_id)->where('email', $rest->email)->where('type','2')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back();
        }

        $chkm = DB::table('users')->where('id','!=', $update_id)->where('mobile_no', $rest->mobile)->where('type','2')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back();
        }else{
            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/hospital'), $firmImage);
                $array['image'] = $firmImage;

           }
                $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                 $array['updated_at'] = Carbon::now();

                 $ins = DB::table('users')->where('id', $update_id)->update($array);


                if ($ins) {

                    session()->flash('msgVendor', 'Hospital detail Update Successfully.');

                    return redirect()->route('admin.hospital');
                } else {

                session()->flash('errorVendor', 'Unable to update try after some time .');

                return redirect()->route('admin.hospital');
                }

        }

    }
    public function UpdateStore(Request $rest){

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',


        ]);
        $decrypted = Crypt::decrypt($rest->id);
        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type','2')->where('id','!=', $decrypted)->count();
        if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->route('admin.hospital');
        }else{

                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                $array['role_id'] ='2';
                $array['type'] ='2';
                $array['updated_at'] = Carbon::now();

                    $ins = DB::table('users')->where('id', $decrypted)->update($array);


                if ($ins) {

                session()->flash('msgVendor', 'Hospital Updated Successfully.');

                    return redirect()->route('admin.hospital');
                } else {

                    session()->flash('errorVendor', 'Unable to Update try after some time .');

                    return redirect()->route('admin.hospital');
                }



        }





    }

    //---------------------------------------------------------------Hospital Area End

    //-----------------Doctor CRUD Operation Start
    public function ShowDoctor(Request $rest){
        if($rest->id){
            $arr["staff_id"]=$rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $arr['data'] = DB::table('users')->where('id',$decrypted)->where('role_id','4')->first();
            return view('admin.edit_hospital')->with($arr);
        }
        else{
            $arr["staff_id"]=null;
        }

        $data = DB::table('users as a')
        ->select(['a.*', 'b.name as state_name', 'c.name as city_name', 'h.name as hospital_name', 'h.mobile_no as hospital_mobile'])
        ->leftJoin('state as b', 'a.state', '=', 'b.id')
        ->leftJoin('city as c', 'a.city', '=', 'c.id')
        ->leftJoin('users as h', 'h.id', '=', 'a.user_id')
        ->where('a.type', '4')
        //->where('a.user_id', '0')->where('a.status', 1)
        ->orderBy('a.id', 'DESC')
        ->get();

        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
        $arr['hospital_data'] = DB::table('users')->where('type', 2)->get();

        $arr['All_staff'] = $data;

        return view('admin.all_doctor')->with($arr);
    }
    public function NewDoctor(Request $rest){
        if($rest->id){
            $arr["staff_id"]=$rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $user= DB::table('users')->where('id',$decrypted)->where('role_id','4')->first();
            $arr['data'] =$user;
            $arr['hospital_data'] = DB::table('users')->where('type', 3)->get();
            $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();
            $arr['city_data'] = DB::table('city')->where('fstateid', $user->state)->get();
            $arr['category_data'] = DB::table('category')->where('type','category')->get();
            $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();
            return view('admin.edit_doctor')->with($arr);
        }
        else{
            $arr["staff_id"]=null;
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
        $arr['category_data'] = DB::table('category')->where('type','category')->get();
        $arr['symptom_data'] = DB::table('category')->where('type','symptom')->get();

        $arr['All_staff'] = $data;

        return view('admin.add_doctor')->with($arr);
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

        $checkemail = DB::table('users')->where('email', $rest->email)->where('type','4')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->back()->withInput();
           // return redirect()->route('admin.doctor');
        }

        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type','4')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->back()->withInput();
           // return redirect()->route('admin.doctor');
        }else{

            if ($rest->image) {
                $firmImage = time() . rand(1000000, 9999999) . '.' . $rest->image->extension();
                $rest->image->move(public_path('storage/doctor'), $firmImage);
                $array['image'] = $firmImage;

           }
            $array['user_id'] = $rest->hospital;
            $array['role_id'] ='4';
            $array['type'] ='4';
            $array['category_id'] = $rest->category_id ? implode(',', $rest->category_id) : '';
            $array['symptom_id'] = $rest->symptom_id ? implode(',', $rest->symptom_id) : '';

            $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['qualification'] =$rest->qualification;
                $array['experience'] =$rest->experience;
                $array['description'] =$rest->description;


                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                $array['created_at'] = Carbon::now();


                    $ins=DB::table('users')->insert($array);


                if ($ins) {

                    session()->flash('msgVendor', 'doctor Added Successfully.');

                    return redirect()->route('admin.doctor');
                } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');

                return redirect()->route('admin.doctor');
                }



        }





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

                    return redirect()->route('admin.doctor');
                } else {

                session()->flash('errorVendor', 'Unable to update try after some time .');

                return redirect()->route('admin.doctor');
                }



        }

    }

       public function showSymptom(Request $rest)
       {
           if($rest->id)
           {
               $arr["category_id"]=$rest->id;
           }
           else{
               $arr["category_id"]=null;
           }
           $arr['categories'] = DB::table('category')->where('type','symptom')->get();
           $cats = DB::table('category')->where(['parent'=>0])->where('type','symptom')->get();
           $arr['catall'] = $cats;
           $arr['heading_title'] = 'Symptom';
           $arr['cat_type'] = 'symptom';

           return view('admin.category')->with($arr);
       }
       public function showCategory(Request $rest)
       {
           if($rest->id)
           {
               $arr["category_id"]=$rest->id;
           }
           else{
               $arr["category_id"]=null;
           }
           $arr['categories'] = DB::table('category')->where('type','category')->get();
           $cats = DB::table('category')
           //->where(['parent'=>0])
           ->where('type','category')->get();
           $arr['catall'] = $cats;
           $arr['heading_title'] = 'category';
           $arr['cat_type'] = 'category';
           return view('admin.category')->with($arr);
       }
       public function editCategoryFinal($id, Request $request)
       {
           $this->validate($request, [
               'name' => 'required|string'
           ]);
           try {
               $decrypted = Crypt::decrypt($id);

               $array = $request->except(['_token','parent']);
               if ($request->image) {
                   $categoryImage = time() . rand(1000, 9999) . '.' . $request->image->extension();
                   $request->image->storeAs('category', $categoryImage, 'public');
                   $array['image'] = $categoryImage;
               }
               if($request->parent)
               {
                   $array['parent']=$request->parent;
               }
               else
               {
                   $array['parent']=0;
               }

               $upd = DB::table('category')->where('id', $decrypted)->update($array);
               if ($upd) {
                   session()->flash('msgVendor', 'Catgeory Updated Successfully .');
                   return redirect()->route('admin.category');
               } else {
                   session()->flash('errorVendor', 'Unable to Update try after some time .');
                   return redirect()->route('admin.category.edit', ['id' => $id]);
               }
           } catch (Exception $e) {

               session()->flash('errorVendor', 'Unable to Update try after some time .');
               return redirect()->route('admin.category.edit', ['id' => $id]);
           }
       }
       public function deleteCategory($id){
           try {
               $decrypted = Crypt::decrypt($id);
               $rslt = DB::table('category')->where('id', $decrypted)->delete();
               if ($rslt) {
                   session()->flash('errorVendor', 'Category Deleted Successfully .');
                   return redirect()->route('admin.category');
               } else {
                   session()->flash('errorVendor', 'Unable to Delete try after some time .');
                   return redirect()->route('admin.category');
               }
           } catch (Exception $e) {
               session()->flash('errorVendor', 'Unable to Delete try after some time .');
               return redirect()->route('admin.category');
           }
       }
       public function categoryChangeStatus($id)
       {
           $decrypted = Crypt::decrypt($id);
           $get = DB::table('category')->find($decrypted);


           if ($get->status == 0)
               $status = 1;
           else
               $status = 0;


           $rslt = DB::table('category')->where('id', $decrypted)->update(['status' => $status]);
           if ($rslt) {
               Session()->flash('msgVendor', 'Status changed successfully');
               return redirect()->back();
           } else {
               Session()->flash('errorVendor', 'Unable to change Status,try after some time');
               return redirect()->back();
           }
       }
       public function categorySearch(Request $rest){
        if (!$rest->keyword) {

            $cats = DB::table('category')
            ->where('fuserid', Auth::guard('admin')->user()->id)
            ->where(['parent'=>0,'status'=>1])
            ->get();

            $arr['catall'] = $cats;
        }
        else{


            $cats = DB::table('category', 'a')
            ->leftJoin('category as b', 'a.parent', '=', 'b.id')
            ->select(['a.*', 'b.name as parentName'])
            ->where('a.fuserid', Auth::guard('admin')->user()->id)
            ->where('a.name','like','%'. $rest->keyword.'%')
            ->get();
            $arr['catall'] = $cats;
            // dd($arr);

        }
        $arr['categories'] = DB::table('category')->where('fuserid', Auth::guard('admin')->user()->id)->get();
        return view('admin.category')->with($arr);

    }
    public function insertCategory(Request $request)
    {

        $this->validate($request, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'image' => 'image',

        ]);


          if ($request->image) {
             $firmImage = time() . rand(1000000, 9999999) . '.' . $request->image->extension();
             $request->image->move(public_path('storage/category'), $firmImage);
             $array['image'] = $firmImage;

        }

        // $array = $request->except('_token');
        if ($request->parent) {
            $array['parent'] = $request->parent;
        } else {
            $array['parent'] = 0;
        };
        $array['name'] = $request->name;
        $array['type'] = $request->type;
        $array['fuserid'] = Auth::guard('admin')->user()->id;

        if($request->id==''){
            $ins=DB::table('category')->insert($array);
        }
        else{

            $ins = DB::table('category')->where('id', $request->id)->update($array);
        }

        if ($ins) {
            if ($request->id=='') {
                session()->flash('msgVendor', $request->type.' Added Successfully.');
            }
            else{
                session()->flash('msgVendor', $request->type.' Updated Successfully.');
            }
                if($request->type=="category"){
                    return redirect()->route('admin.category');
                }elseif($request->type=="radiology"){
                    return redirect()->route('admin.radiology-category');
                }
                else{
                    return redirect()->route('admin.symptom');
                }

        } else {
            if ($request->id=='') {
                session()->flash('errorVendor', 'Unable to add try after some time .');
            }
            else{
                session()->flash('errorVendor', 'Unable to update try after some time .');
            }

            if($request->type=="category"){
                return redirect()->route('admin.category');
            }else{
                return redirect()->route('admin.symptom');
            }
        }
    }
    public function editCategory($id)
    {

        try {
            $decrypted = Crypt::decrypt($id);
            $arr['cat'] = DB::table('category')->where('id', $decrypted)->get();
            $arr['categories'] = DB::table('category')->where('id', '!=', $decrypted)->where('fuserid',Auth::guard('admin')->user()->id)->get();
            return view('admin.categoryEdit')->with($arr);
        } catch (Exception $e) {
            session()->flash('errorVendor', 'Unable to update try after some time .');
            return redirect()->route('admin.category.edit', ['id' => $id]);
        }
    }

  //========================================================================= Slider

  function showSlider()
  {


      $arr['slider']=DB::table('slider')->orderby('id','DESC')->get();

      return view('admin.slider',$arr);
  }

  function AddSlider(Request $request)
  {



      if ($request->img) {
        $firmImage = time() . rand(1000000, 9999999) . '.' . $request->img->extension();
        $request->img->move(public_path('storage/slider'), $firmImage);
        $arr['image'] = $firmImage;

   }
        $arr['type']=$request->type_slider;
        $arr['title']=$request->heading;
        $arr['url']=$request->web_link;
        $ins=DB::table('slider')->insert($arr);
      if($ins){
      session()->flash('msgVendor', 'Slider added successfully.');
      }else{
      session()->flash('errorVendor', 'Unable to Add Please try after some time.');

      }
      return redirect()->back();
  }

      function DeleteSlider(Request $request)
  {
      try
      {
           $decrypted = Crypt::decrypt($request->id);
      $del=DB::table("slider")->where('id',$decrypted)->delete();

      if($del)
      {

           Session()->flash('msgVendor', 'Slider deleted successfully.');
      }
      else
      {
           Session()->flash('msgVendor', 'Unable to delete slider.');
      }
      }
      catch(Exception $ex)
      {
          Session()->flash('msgVendor', 'Unable to delete Slider Please try after some time');
      }
      return redirect()->back();
  }




//==========================================================================

    public function create()
    {
        return view('doctor.slots.create');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'slot_duration' => 'required|integer|min:5|max:60',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $date = Carbon::parse($request->date);
        $slotDuration = 30;//$request->slot_duration;
        $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $endTime = Carbon::parse($request->date . ' ' . $request->end_time);

        $slots = $this->generateSlots($startTime, $endTime, $slotDuration);

        return view('doctor.slots.select', compact('slots', 'date', 'slotDuration', 'startTime', 'endTime'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slots' => 'required|array',
        ]);

        $doctorId = Auth::id();
        foreach ($request->slots as $slot) {
            [$start, $end] = explode('|', $slot);
            Slot::create([
                'doctor_id' => $doctorId,
                'start_time' => Carbon::parse($start),
                'end_time' => Carbon::parse($end),
            ]);
        }

        return redirect()->route('doctor.slots.create')->with('success', 'Slots added successfully!');
    }

    private function generateSlots($startTime, $endTime, $duration)
    {
        $slots = [];
        while ($startTime < $endTime) {
            $slots[] = [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $startTime->copy()->addMinutes($duration)->format('H:i'),
            ];
            $startTime->addMinutes($duration);
        }
        return $slots;
    }

    public function DoctorScheduleList(Request $request){

        $decrypted = Crypt::decrypt($request->doctor_id);
        $data=DB::table("doctor_slots")->where('doctor_id',$decrypted)->orderBy('date', 'desc')->get();
        $last_slot=DB::table("doctor_slots")->where('doctor_id',$decrypted)->orderBy('date', 'desc')->first();
        $future_dates = DB::table("doctor_slots")
        ->where('doctor_id', $decrypted)
        ->whereDate('date', '>', now()) // Only future dates
        ->pluck('date')
        ->toArray();
        $doctor_data=DB::table("users")->where('id',$decrypted)->first();

        return view('admin.add_doctor_slot', compact('data', 'decrypted','doctor_data','last_slot','future_dates'));

    }
    public function getDoctorSchedule($doctor_id = 1)
{
    // Get current week's Monday-Sunday dates
    $currentWeekStart = Carbon::now()->startOfWeek(Carbon::MONDAY);
    $dates = [];

    for ($i = 0; $i < 7; $i++) {
        $dates[] = $currentWeekStart->copy()->addDays($i)->format('Y-m-d');
    }

    // Fetch doctor's existing schedule for the current week
    $existingSchedule = DoctorSchedule::where('doctor_id', $doctor_id)
        ->whereIn('date', $dates)
        ->get()
        ->keyBy('date'); // Key by date for easy access

    // Return view with data
    return view('admin.add_doctor_schedule', compact('dates', 'existingSchedule', 'doctor_id'));
}

    //---End
}
