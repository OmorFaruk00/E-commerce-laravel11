<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roleable extends Model
{
    /** @use HasFactory<\Database\Factories\RoleableFactory> */
    use HasFactory;

    // public function roleable(){
    //     return $this->morphedByMany();
    // }
}
