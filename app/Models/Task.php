<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function employees(){
        return $this->belongsToMany(employee::class,'assignments');
    }
}
