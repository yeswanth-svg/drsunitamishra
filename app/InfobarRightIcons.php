<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfobarRightIcons extends Model
{
    use HasFactory;
    protected $fillable = ['icon','title','details','lang'];
}
