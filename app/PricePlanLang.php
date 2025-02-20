<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePlanLang extends Model
{
    use HasFactory;
    protected $fillable = ['price_plan_id','title','type','features','btn_text','lang'];
}
