<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
     protected $fillable = [
        'code','name','fullname','color_one','color_two','logo','status'
    ];
}
