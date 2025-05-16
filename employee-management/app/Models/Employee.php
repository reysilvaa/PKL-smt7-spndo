<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'address',
        'dob',
        'dept_id',
        'status'
    ];
    
    public $timestamps = true;
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
