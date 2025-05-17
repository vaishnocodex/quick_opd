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
use App\Models\DoctorSlot;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class WebController extends Controller
{
    //

    public function User_RegisterSubmit(Request $request)
    {
        // Validation Rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:6',
            'agree_terms_and_policy' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Get Last 10 Digits of Mobile Number
        $lastTenDigits = substr($request->phone, -10);

        // Check if Mobile Number Exists
        $user_check = User::where('mobile_no', $lastTenDigits)->where('type', '0')->first();
        if ($user_check) {
            return response()->json(['status' => false, 'message' => 'Mobile Number already exists']);
        }

        // Check if Email Exists
        $user_check = User::where('email', $request->email)->where('type', '0')->first();
        if ($user_check) {
            return response()->json(['status' => false, 'message' => 'Email Address already exists']);
        }

        // Create New User
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $lastTenDigits;
        $user->type = '0';
        $user->password = Hash::make($request->password);
        $user->pass_hint = $request->password;
        $user->save();

        // Authenticate User
        Auth::login($user);

        // Redirect to Dashboard
        return response()->json([
            'status' => true,
            'message' => 'Registration successful!',
            'redirect' => route('user.dashboard') // Ensure you have a named route for dashboard
        ]);
    }
    public function login_User_Submit(Request $request)
    {

        // dd($request->all());

        // Find the user by mobile number
        if (Auth::check()){
            Auth::logout();

        }
        // $user = User::where('mobile_no', $request->username)->where('type','0')->first();
        // if (!$user) {
        //     return redirect()->route('login.user')->with('error', 'User not found.');
        // }
        // if (!Hash::check($request->password, $user->password)) {
        //     return redirect()->route('login.user')->with('error', 'Incorrect password.');
        // }

           $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return redirect()->route('login.user')->with('error', 'Incorrect email or password.');
    }



        // Log in the user manually
        Auth::login($user);

        //return redirect()->intended('welcome');
        // Retrieve intended URL or default to home
        $redirectTo = session('url.intended', route('welcome'));

        // Clear session value
        session()->forget('url.intended');

        // Redirect based on user type
        return ($user->type == 'user')
            ? redirect()->intended($redirectTo)  // Redirect to previous page or default
            : redirect()->route('welcome');
    }

    public function User_Login(Request $request)
    {

          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();

            return view('website.user_login')->with($arr);

    }
    public function User_Register(Request $request)
    {

          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();

            return view('website.register_user')->with($arr);

    }
    public function Home_View(Request $request)
    {

          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['radiology_category'] = Category::where('status', '1')
            ->where('parent', '0')
            ->where('type', 'radiology')->orderBy('id', 'desc')
            ->take(10)
            ->get();

            return view('website.home')->with($arr);

    }
    public function Radiology_Subcategory(Request $request)
    {
        $decrypted = Crypt::decrypt($request->id);
        $arr['category'] =  Category::where('status', '1')->where('id', $decrypted)->get();

        $arr['radiology_category'] = Category::where('status', '1')
        ->where('parent', $decrypted)
        ->where('type', 'radiology')->orderBy('id', 'desc')
       //->take(10)
        ->get();
           $arr['heading'] = "Subcategory of";

            return view('website.radiology_subcat')->with($arr);

    }
    public function Home_View3(Request $request)
    {

          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['radiology_category'] = Category::where('status', '1')
            ->where('parent', '0')
            ->where('type', 'category')
            ->where('is_top', '1')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

            return view('website.oldhoe')->with($arr);

    }
    public function All_Hospital(Request $request)
    {


        $arr['hospital'] = DB::table('users as hospital')

        ->leftJoin('city', 'hospital.city', '=', 'city.id')
        ->leftJoin('state', 'hospital.state', '=', 'state.id')
        ->where('hospital.status', '1')
        ->where('hospital.type', '3')
        ->select(
            'hospital.*','city.name as city_name','state.name as state_name'
        )
        ->get();

          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.all_hospital')->with($arr);

    }

    public function All_Specialist_Doctor(Request $request)
    {
         $decrypted = Crypt::decrypt($request->id);
         $arr['hospital'] =  User::where('status', '1')->where('type', '3')->get();
          $arr['doctor'] =  User::where('status', '1')->where('type', '4')->get();
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.all_doctor')->with($arr);

    }

    public function AllHospital_Doctor(Request $request)
    {
         $decrypted = Crypt::decrypt($request->id);
         $arr['hospital'] =  User::where('status', '1')->where('type', '3')->get();

         $arr['doctor'] = DB::table('users as doctor')
         ->leftJoin('users as hospital', 'doctor.user_id', '=', 'hospital.id')
         ->leftJoin('city', 'doctor.city', '=', 'city.id')
        // ->where('doctor.id', $decrypted)
         ->where('doctor.status', '1')
         ->where('doctor.type', '4')
         ->select(
             'doctor.*',
             'hospital.name as hospital_name',
             'city.name as city_name'
         )
         ->get();

          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.all_doctor')->with($arr);

    }


    public function SingleDoctorDetail(Request $request)
    {
         $decrypted = Crypt::decrypt($request->id);
         $cdate = Carbon::today()->format('Y-m-d'); // today's date
         $futureDate = Carbon::today()->addDays(6)->format('Y-m-d');
         $arr['hospital'] =  User::where('status', '1')->where('type', '3')->get();

         $arr['doctor'] = DB::table('users as doctor')
         ->leftJoin('users as hospital', 'doctor.user_id', '=', 'hospital.id')
         ->leftJoin('city', 'doctor.city', '=', 'city.id')
         ->where('doctor.id', $decrypted)
         ->where('doctor.status', '1')
         ->where('doctor.type', '4')
         ->select(
             'doctor.*',
             'hospital.name as hospital_name',
             'city.name as city_name'
         )
         ->first();
         $slots= DoctorSlot::whereBetween('date', [$cdate,$futureDate])->get();

         $arr['slots'] =$slots;
          $arr['similar_doctor'] =  User::where('status', '1')->where('type', '4')->get();
            return view('website.doctor_detail')->with($arr);

    }

    public function SingleRadiologyDetail(Request $request)
    {
         $decrypted = Crypt::decrypt($request->id);
         $cdate = Carbon::today()->format('Y-m-d'); // today's date
         $futureDate = Carbon::today()->addDays(6)->format('Y-m-d');
         $arr['hospital'] =  User::where('status', '1')->where('type', '3')->get();

         $arr['doctor'] = DB::table('users as doctor')
         ->leftJoin('users as hospital', 'doctor.user_id', '=', 'hospital.id')
         ->leftJoin('city', 'doctor.city', '=', 'city.id')
         ->where('doctor.id', $decrypted)
         ->where('doctor.status', '1')
         ->where('doctor.type', '4')
         ->select(
             'doctor.*',
             'hospital.name as hospital_name',
             'city.name as city_name'
         )
         ->first();
         $slots= DoctorSlot::where('doctor_id',$decrypted)->whereBetween('date', [$cdate,$futureDate])->get();

         $arr['slots'] =$slots;
          $arr['similar_doctor'] =  User::where('status', '1')->where('type', '4')->get();
            return view('website.radiology_detail')->with($arr);

    }

    public function All_Doctor(Request $request)
    {

          $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
          $arr['doctor'] = DB::table('users as doctor')
          ->leftJoin('users as hospital', 'doctor.user_id', '=', 'hospital.id')
          ->leftJoin('city', 'doctor.city', '=', 'city.id')
          ->where('doctor.status', '1')
          ->where('doctor.type', '4')
          ->select(
              'doctor.*',
              'hospital.name as hospital_name',
              'city.name as city_name'
          )
          ->get();
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['heading'] = "All Doctors";

            return view('website.all_doctor')->with($arr);

    }
    public function All_Radiology(Request $request)
    {

          $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
          $arr['radiology'] = DB::table('users as doctor')
          ->leftJoin('users as hospital', 'doctor.user_id', '=', 'hospital.id')
          ->leftJoin('city', 'doctor.city', '=', 'city.id')
          ->where('doctor.status', '1')
          ->where('doctor.type', '3')
          ->where('doctor.hospital_type', 'radiology')
          ->select(
              'doctor.*',
              'hospital.name as hospital_name',
              'city.name as city_name'
          )
          ->get();
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['heading'] = "All Radiology";

            return view('website.radiology_list')->with($arr);

    }

    public function Radiology_ServiceList(Request $request)
    {
        $decrypted = Crypt::decrypt($request->id);
        //dd($decrypted);
         $radiology_singlelist=  User::where('id', $decrypted)->where('status', '1')->first();
          $arr['doctor'] = DB::table('users as doctor')
          ->leftJoin('users as hospital', 'doctor.user_id', '=', 'hospital.id')
          ->leftJoin('city', 'doctor.city', '=', 'city.id')
          ->where('doctor.user_id', $radiology_singlelist->id)
          ->where('doctor.status', '1')
          ->where('doctor.type', '4')
          ->select(
              'doctor.*',
              'hospital.name as hospital_name',
              'city.name as city_name'
          )
          ->get();

           $arr['radiology'] = $radiology_singlelist;
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['heading'] = "All Doctors";

            return view('website.radiology_service_list')->with($arr);

    }

  // DoctorController.php
public function checkAvailability(Request $request)
{
    // Get doctor id and selected date
    $doctorId = $request->doctor_id;
    $selectedDate = $request->selected_date;

    // Check if the doctor is available on the selected date
    $getdetail = DoctorSlot::where('doctor_id', $doctorId)->where('date', $selectedDate)->where('status','available')->first();
        if($getdetail){
          $total_booking=$getdetail->max_slot;
            $cart_count = Cart::where('doctor_id', $doctorId)->where('booking_date', $selectedDate)->count('id');
            $order_count = Order::where('doctor_id', $doctorId)->where('booking_date', $selectedDate)->count('id');
            $total_bookings_have =$cart_count+$order_count;
            if($total_bookings_have<$total_booking){

                $isAvailable=1;

            }else{
                $isAvailable=0;

            }


        }else{
            $isAvailable=0;
        }

    // Return the availability status
    return response()->json(['isAvailable' => $isAvailable]);
}
public function CheckoutPage(Request $request)
{
     $cartId = Crypt::decrypt($request->id);



        $cart = Cart::findOrFail($cartId);

        $arr['doctor'] = User::where('id', $cart->doctor_id)
                           ->where('status', '1')
                           ->where('type', '4')
                           ->firstOrFail();

        // You might also want to pass the cart data to the view
        $arr['cart'] = $cart;
     $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();

        return view('website.checkout')->with($arr);

}
public function addToCart(Request $request)
{

    $sessionId = Session::get('session_id');

    if (!$sessionId) {
        $newId = Str::uuid();
        Session::put('session_id', $newId);
    //    return response("Session created: $newId");
    }

    //return response("Session exists: $sessionId");


    $doctor_table =  User::where('id',$request->doctor_id)->where('status', '1')->where('type', '4')->first();

    $check_cart =  Cart::where('session_id', $sessionId)->count('id');
    if($check_cart){
        Cart::where('session_id', $sessionId)->delete();
    }
    // Check if the user is authenticated
    $userId = Auth::check() ? Auth::user()->id : null;

    // Cart data (from your form or request)
    $cartData = [
        'user_id' => $userId,
        'session_id' => $sessionId,
        'p_name' => $doctor_table->name,
        'hospital_id' => $doctor_table->user_id,
        'doctor_id' => $doctor_table->id,
        'booking_date' => $request->attribute_weight_1907920428,
        'qty' => '1',
        'price' => $doctor_table->price,
        'gst' => '0',
        'total' => $doctor_table->price,
        'type' => 'doctor',
        'created_at' => now(),
    ];
        // Insert the data into the cart table
        $cart = Cart::create($cartData);

        // Redirect to the checkout page with the cart ID
        return redirect()->route('booking.checkout', ['id' => Crypt::encrypt($cart->id)]);

    // Redirect or return response
    return redirect()->route('website.checkout');  // Adjust based on your route
}

public function Payment_SubmitPage(Request $request)
{
    $cart_id = $request->cart_id;
    $user_id= Auth::user()->id;
    $cart_table = Cart::where('id', $cart_id)->first();

    if (!$cart_table) {
        return back()->with('error', 'Cart not found');
    }
     $order_id= $this->generateUniqueOrderId();
    $orderData = [
        'user_id'         => $user_id, // use logged-in user or fallback
        'hospital_id'     => $cart_table->hospital_id,
        'order_id'       => $order_id,
        'doctor_id'       => $cart_table->doctor_id,
        'type'            => $cart_table->type,
        'booking_date'    => $cart_table->booking_date,
        'time_slot'       => $cart_table->time_slot,
        'total_amount'    => $cart_table->price,
        'discount'       => '0',
        'status'          => '0',
        'payment_type'    => $request->payment_option,
        'payment_status'  => 'pending',
        'appointment_for' => 'self',
        'pa_name'         => $request->full_name,
        'father_name'     => $request->father_name,
        'gender'          => $request->gender,
        'age'             => $request->age,
        'contact_no'      => $request->mobile,
        'email'           => $request->email,
    ];

    $order = Order::create($orderData);

    if ($order) {
        $cdate = date_create()->format('Y-m-d');
            // Insert into transaction table
            Transaction::create([
                'hospital_id' => $order->hospital_id,
                'user_id'     => $order->user_id,
                'order_id'    => $order->order_id,
                'debit'       => 0,
                'credit'      => $cart_table->price,
                'amount'      => $cart_table->price,
                'gst'         => 0,
                'type'        => 'appointment',
                'remark'      => 'Appointment booking',
                'date'        => $cdate,
                'status'      => 0,
            ]);
        Cart::where('id', $cart_id)->delete();

        if ($request->payment_option === "cash") {
            return redirect()->route('thank-you')->with('success', 'Appointment booked. Pay at hospital.');
        } else {



            return redirect()->route('payment.gateway', ['order_id' => $order->id]);
        }
    }

    return back()->with('error', 'Something went wrong while processing your order.');
}


function generateUniqueOrderId()
{
    do {
        // Format: ORD-20250418-AB12CD
        $orderId = 'ORD-' .now()->format('Ymd').'-'.str::upper(Str::random(6));
    } while (Order::where('order_id', $orderId)->exists());

    return $orderId;
}
 //=======>End page
}
