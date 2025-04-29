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

class DoctorSlotController extends Controller
{
    //
    public function showSlotForm()
    {
        return view('doctor.slots.create');
    }
    

    public function generateSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'slot_duration' => 'required|integer|min:5',
        ]);
    
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $slotDuration = (int) $request->slot_duration; // 🔹 Ensuring it's an integer
        $slots = [];
    
        while ($startTime->lt($endTime)) {
            $nextEndTime = $startTime->copy()->addMinutes($slotDuration);
    
            // Ensure slot does not exceed end time
            if ($nextEndTime->gt($endTime)) {
                break;
            }
    
            $slots[] = [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $nextEndTime->format('H:i'),
            ];
    
            $startTime->addMinutes($slotDuration);
        }
    
        return view('doctor.slots.select', compact('slots', 'request'));
    }
    public function saveSelectedSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'slot_duration' => 'required|integer|min:5',
            'selected_slots' => 'array',
        ]);
    
        $doctorId = $request->doctor_id;
        $date = $request->date;
        $selectedSlots = $request->selected_slots ?? []; // Default to empty array if none selected
    
        // Ensure slot duration is an integer
        $slotDuration = (int) $request->slot_duration;
    
        // Retrieve all possible slots
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $slots = [];
    
        while ($startTime->lt($endTime)) {
            $nextEndTime = $startTime->copy()->addMinutes($slotDuration);
            if ($nextEndTime->gt($endTime)) {
                break;
            }
    
            $slotKey = $startTime->format('H:i') . '|' . $nextEndTime->format('H:i');
            $status = in_array($slotKey, $selectedSlots) ? 'available' : 'unavailable';
    
            $slots[] = [
                'doctor_id' => $doctorId,
                'date' => $date,
                'start_time' => $startTime->format('H:i:s'),
                'end_time' => $nextEndTime->format('H:i:s'),
                'slot_duration' => $slotDuration,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            $startTime->addMinutes($slotDuration);
        }
    
        // Insert slots into the database
        if (!empty($slots)) {
            DB::table('doctor_slots')->insert($slots);
        }
    
        return redirect()->route('doctor-slots.index')->with('success', 'Slots saved successfully!');
    }

    public function saveSelectedSlots11(Request $request)
{
    $request->validate([
        'doctor_id' => 'required',
        'date' => 'required|date',
        'selected_slots' => 'required|array',
    ]);

    $slots = [];
    foreach ($request->selected_slots as $slot) {
        $slotData = explode('|', $slot);
        $startTime = Carbon::parse(trim($slotData[0]));
        $endTime = Carbon::parse(trim($slotData[1]));

        $slots[] = [
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'slot_duration' => (int) $endTime->diffInMinutes($startTime),
            'status' => 'available',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    DoctorSlot::insert($slots);

    return redirect()->route('doctor-slots.index')->with('success', 'Slots saved successfully!');
}

//--------------------------------Admin side slot booking form
public function AdminDoctor_SlotForm()
{ 
    $arr['doctor_data'] = DB::table('users')->where('type', '4')->get();
    return view('admin.add_doctor_slot')->with($arr);
}    

public function Admin_Doctor_SlotView(Request $request)
{ 

    $cdate = date_create()->format('Y-m-d');
    
    if(!$request->filter){
           
        $filter= null;
        $fdate= $cdate;
        $tdate= $cdate;
        
         }else{
 
             $filter= 2;
             $fdate= $request->fdate;;
             $tdate= $request->tdate;
 
         }
    if($request->doctor_id){
       $doctor_id= $request->doctor_id;
    }else{
        $doctor_id= '';
    }
        $slots = DB::table('doctor_slots')->where('doctor_id', $request->doctor_id)->where('date', $fdate)->get();  
   // dd($slots,$request->doctor_id,$fdate    );
    $arr['doctor_data'] = DB::table('users')->where('type', 3)->get();
    $arr['slots'] =$slots;
    $arr['doctor_id'] =$doctor_id; 
    $arr['filter'] =$filter; 
    $arr['fdate'] =$fdate; 
    $arr['tdate'] =$tdate; 
    return view('admin.doctor_slot_view')->with($arr);
}  


public function Admin_generateSlots(Request $request)
{

    $request->validate([
        'doctor_id' => 'required',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'max_slot' => 'required|integer',
    ]);

    DoctorSlot::create([
        'doctor_id' => $request->doctor_id,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'slot_duration' =>'0',
        'max_slot' => $request->max_slot,
        'shift' => 'null',
        'status' => $request->status,
    ]);

    return response()->json(['success' => true , 'message' => 'Slots saved successfully!']);
}


public function Admin_generateSlots222(Request $request)
{
    $request->validate([
        'doctor_id' => 'required',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'slot_duration' => 'required|integer|min:5',
    ]);
 
    $checkDate = DB::table('doctor_slots')->where('date', $request->date)->exists();  

    // Return a response based on the result  
    if ($checkDate) { 
        session()->flash('errorVendor', 'Already Added This Date Slots.');
        return redirect()->back();
     }

    $startTime = Carbon::parse($request->start_time);
    $endTime = Carbon::parse($request->end_time);
    $slotDuration = (int) $request->slot_duration; // 🔹 Ensuring it's an integer
    $slots = [];

    while ($startTime->lt($endTime)) {
        $nextEndTime = $startTime->copy()->addMinutes($slotDuration);

        // Ensure slot does not exceed end time
        if ($nextEndTime->gt($endTime)) {
            break;
        }

        $slots[] = [
            'start_time' => $startTime->format('H:i'),
            'end_time' => $nextEndTime->format('H:i'),
        ];

        $startTime->addMinutes($slotDuration);
    }

    return view('admin.doctor_slots_select', compact('slots', 'request'));
}

public function Admin_SaveSelectedSlots(Request $request)
{
    $request->validate([
        'doctor_id' => 'required',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'slot_duration' => 'required|integer|min:5',
        'selected_slots' => 'array',
    ]);

    $doctorId = $request->doctor_id;
    $date = $request->date;
    $selectedSlots = $request->selected_slots ?? []; // Default to empty array if none selected

    // Ensure slot duration is an integer
    $slotDuration = (int) $request->slot_duration;

    // Retrieve all possible slots
    $startTime = Carbon::parse($request->start_time);
    $endTime = Carbon::parse($request->end_time);
    $slots = [];

    while ($startTime->lt($endTime)) {
        $nextEndTime = $startTime->copy()->addMinutes($slotDuration);
        if ($nextEndTime->gt($endTime)) {
            break;
        }

        $slotKey = $startTime->format('H:i') . '|' . $nextEndTime->format('H:i');
        $status = in_array($slotKey, $selectedSlots) ? 'available' : 'unavailable';

        $slots[] = [
            'doctor_id' => $doctorId,
            'date' => $date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $nextEndTime->format('H:i:s'),
            'slot_duration' => $slotDuration,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $startTime->addMinutes($slotDuration);
    }

    // Insert slots into the database
    if (!empty($slots)) {
        DB::table('doctor_slots')->insert($slots);
    }

    return redirect()->route('admin.doctor.slot')->with('msgVendor', 'Slots saved successfully!');
}

public function fetchSlots(Request $request)
{
    $slots = DoctorSlot::where('doctor_id', '1')->get();

    $events = [];

    foreach ($slots as $slot) {
        $events[] = [
            'title' => $slot->shift . ' (' . $slot->start_time . ' - ' . $slot->end_time . ') | Max: ' . $slot->max_slot,
            'start' => $slot->date,
            'allDay' => true,
        ];
    }

    return response()->json($events);
}
//-----------------

}
