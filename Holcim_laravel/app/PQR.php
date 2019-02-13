<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PQR extends Model
{
    protected $fillable = [
        'question', 'answer'
    ];
}
