<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class Category extends Model  
{  
    use HasFactory;  

    // Specify the table if not following Laravel's naming convention  
    protected $table = 'category';  

    // Specify the primary key if not 'id'  
    protected $primaryKey = 'id';  

    // Disable timestamps if you don't have 'created_at' and 'updated_at' columns  
    public $timestamps = true;  

    // Specify which attributes are mass assignable  
    protected $fillable = [  
        'name',  
        'parent',  
        'image',  
        'status',  
        'type',  
        'is_top',  
        'fuserid'  
    ];  

    // You can define relationships here if applicable.  
    // Example: A category might have many subcategories  
   
    

    public function subcategories()
{
    return $this->hasMany(self::class, 'parent', 'id');
}

    // Or if it has a parent category  
    public function parentCategory()  
    {  
        return $this->belongsTo(Category::class, 'parent', 'id');  
    }  
}