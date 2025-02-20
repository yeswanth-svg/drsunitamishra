<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressBar extends Model
{
    use HasFactory;
    protected $fillable = ['title','progress','lang'];

}
