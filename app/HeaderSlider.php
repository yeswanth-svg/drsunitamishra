<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSlider extends Model
{
    use HasFactory;
    protected $fillable = ['title','subtitle','title_ext','subtitle_ext','details','btn_text','btn_url','btn_status','support_title', 'support_details','image','lang','icon'];
    
}