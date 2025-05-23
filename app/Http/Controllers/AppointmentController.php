<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorSlot;
use Illuminate\View\View;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{

    public function doctor_data($id)
    {
        $slots = DoctorSlot::where('doctor_id', $id)
            ->whereDate('date', '>=', now())
            ->pluck('date')
            ->unique()
            ->values();
        $data = User::find($id);

        if ($slots || $data) {
            return response()->json([
                'slots' => $slots,
                'data' => $data
            ]);
        }

        return response()->json(['price' => 0], 404);
    }

    function generateUniqueOrderId()
    {
        do {
            // Format: ORD-20250418-AB12CD
            $orderId = 'ORD-' . now()->format('Ymd') . '-' . str::upper(Str::random(6));
        } while (Order::where('order_id', $orderId)->exists());

        return $orderId;
    }

    /* function create(Request $request)
    {

        $order_id = $this->generateUniqueOrderId();
        $orderData = [
            'user_id'         => $request->patient,
            'hospital_id'     => Auth::user()->id,
            'order_id'        => $order_id,
            'doctor_id'       => $request->doctor_id,
            'type'            => 'doctor',
            'booking_date'    => $request->booking_date,
            'total_amount'    => $request->total_amount,
            'discount'        => $request->discount,
            'status'          => '0',
            'payment_type'    => $request->payment_type,
            'payment_status'  => $request->payment_status,
            'appointment_for' => 'self',
            'pa_name'         => $request->pa_name,
            'father_name'     => $request->father_name,
            'gender'          => $request->gender,
            'age'             => $request->age,
            'contact_no'      => $request->contact_no,
            'email'           => $request->email,
        ];

        $order = Order::create($orderData);
        return response()->json(['success' => true, 'message' => 'Appointment Create successfully!']);
    }*/


    public function create(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|integer',
            'booking_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'contact_no' => 'required|string|max:15',
        ]);

        if ($request->has('id') && !empty($request->id)) {
            $order = Order::find($request->id);

            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Appointment not found.'], 404);
            }

            $order->update([
                'user_id'         => $request->patient,
                'hospital_id'     => Auth::user()->id,
                'doctor_id'       => $request->doctor_id,
                'type'            => 'doctor',
                'booking_date'    => $request->booking_date,
                'total_amount'    => $request->total_amount,
                'discount'        => $request->discount,
                'status'          => '0',
                'payment_type'    => $request->payment_type,
                'payment_status'  => $request->payment_status,
                'appointment_for' => 'self',
                'pa_name'         => $request->pa_name,
                'father_name'     => $request->father_name,
                'gender'          => $request->gender,
                'age'             => $request->age,
                'contact_no'      => $request->contact_no,
                'email'           => $request->email,
            ]);
            return response()->json(['success' => true, 'message' => 'Appointment updated successfully!']);
        } else {
            // No ID → Create new appointment
            $order_id = $this->generateUniqueOrderId();
            $orderData = [
                'user_id'         => $request->patient,
                'hospital_id'     => Auth::user()->id,
                'order_id'        => $order_id,
                'doctor_id'       => $request->doctor_id,
                'type'            => 'doctor',
                'booking_date'    => $request->booking_date,
                'total_amount'    => $request->total_amount,
                'discount'        => $request->discount,
                'status'          => '0',
                'payment_type'    => $request->payment_type,
                'payment_status'  => $request->payment_status,
                'appointment_for' => 'self',
                'pa_name'         => $request->pa_name,
                'father_name'     => $request->father_name,
                'gender'          => $request->gender,
                'age'             => $request->age,
                'contact_no'      => $request->contact_no,
                'email'           => $request->email,
            ];
            Order::create($orderData);
            return response()->json(['success' => true, 'message' => 'Appointment created successfully!']);
        }
    }


    function doctor_appointment_create(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|integer',
            'booking_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'contact_no' => 'required|string|max:15',
        ]);

        if ($request->has('id') && !empty($request->id)) {
            $order = Order::find($request->id);

            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Appointment not found.'], 404);
            }

            $order->update([
                'user_id'         => $request->patient,
                'doctor_id'       => $request->doctor_id,
                'type'            => 'doctor',
                'booking_date'    => $request->booking_date,
                'total_amount'    => $request->total_amount,
                'discount'        => $request->discount,
                'status'          => '0',
                'payment_type'    => $request->payment_type,
                'payment_status'  => $request->payment_status,
                'appointment_for' => 'self',
                'pa_name'         => $request->pa_name,
                'father_name'     => $request->father_name,
                'gender'          => $request->gender,
                'age'             => $request->age,
                'contact_no'      => $request->contact_no,
                'email'           => $request->email,
            ]);
            return response()->json(['success' => true, 'message' => 'Appointment updated successfully!']);
        } else {
            // No ID → Create new appointment
            $order_id = $this->generateUniqueOrderId();
            $orderData = [
                'user_id'         => $request->patient,
                'hospital_id'     => Auth::guard('doctor')->user()->user_id,
                'order_id'        => $order_id,
                'doctor_id'       => $request->doctor_id,
                'type'            => 'doctor',
                'booking_date'    => $request->booking_date,
                'total_amount'    => $request->total_amount,
                'discount'        => $request->discount,
                'status'          => '0',
                'payment_type'    => $request->payment_type,
                'payment_status'  => $request->payment_status,
                'appointment_for' => 'self',
                'pa_name'         => $request->pa_name,
                'father_name'     => $request->father_name,
                'gender'          => $request->gender,
                'age'             => $request->age,
                'contact_no'      => $request->contact_no,
                'email'           => $request->email,
            ];
            Order::create($orderData);
            return response()->json(['success' => true, 'message' => 'Appointment created successfully!']);
        }
    }

    function transfer_appointment(Request $request){

        $appointment = Order::find($request->Appointment);
        $appointment->doctor_id =$request->doctor;
        $appointment->update();

        return response()->json([
            'message' => 'Appointment Transfer successfully.',
        ]);

    }


    public function patient_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15|unique:users,mobile_no',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'mobile_no' => $validated['mobile_no'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'pass_hint' => $validated['password'],
            'type' => '0',

        ]);

        return response()->json([
            'message' => 'Patient created successfully.',
            'patient' => $user
        ]);
    }

    function DoctorAppointment(Request $request)
    {

        $type = $request->type;
        $type_val = $request->type;

        if ($type == "Pending") {
            $type = "0";
        } elseif ($type == "Approved") {
            $type = "1";
        } elseif ($type == "Cancelled") {
            $type = "3";
        } elseif ($type == "Completed") {
            $type = "4";
        }

        $doctor_id = Auth::guard('doctor')->user()->id;
        $date = request('date');
        $orders = DB::table('orders as a')
            ->where('a.payment_status', 'accepted')
            ->where('a.status', $type)
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


        $doctors = DB::table('users')->where('type', '4')->where('id',Auth::guard('doctor')->user()->id)->get();
        $patient = DB::table('users')->where('type', '0')->get();
        $doctorstransfer = DB::table('users')->where('type', '4')->where('user_id',Auth::guard('doctor')->user()->user_id)->get();
        return view('doctor.doctorAppointment', compact('orders', 'doctors', 'doctor_id', 'patient', 'type_val','doctorstransfer'));
    }
}
