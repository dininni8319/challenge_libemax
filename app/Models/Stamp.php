<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dataora',
        'verso',
        'employee_id'
    ];

    public function employees(){
        return $this->belongsToMany(Employee::class);
    }
}
