<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citoyens extends Model
{
    use HasFactory;
    // protected $fillable=[
    //     'nom',
    //             'prenom',
    //             'date_naissance',
    //             'lieu_naissance',
    //             'telephone',
    //             'cnib',
    // ];
    protected $guarded=[
        'id'
    ];
}
