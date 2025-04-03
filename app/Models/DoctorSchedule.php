<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class DoctorSchedule extends Model  
{  
    use HasFactory;  

    // Define the table associated with the model (optional if table name is plural form of model)  
    protected $table = 'doctor_schedules';  

    // Specify which attributes should be mass assignable  
    protected $fillable = [  
        'doctor_id',  
        'date',  
        'start_time',  
        'end_time',  
        'status'  
    ];  

    // Define the relationship with the Doctor model (assuming you have a Doctor model)  
    // public function doctor()  
    // {  
    //     return $this->belongsTo(Doctor::class);  
    // }  
}