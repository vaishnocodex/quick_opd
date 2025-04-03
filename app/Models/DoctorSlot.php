<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class DoctorSlot extends Model  
{  
    use HasFactory;  

    // Specify the table associated with the model  
    protected $table = 'doctor_slots';  

    // Define the fillable properties (mass assignable)  
    protected $fillable = [  
        'doctor_id',  
        'date',  
        'start_time',  
        'end_time',  
        'slot_duration',  
        'status',  
    ];  

    // Optionally, you can define the timestamps if you want to customize them  
    public $timestamps = true; // This is true by default  

    // If you want to define any relationships, you can do so here  
    // For example, if you have a Doctor model:  
    public function doctor()  
    {  
        return $this->belongsTo(User::class);  
    }  
}