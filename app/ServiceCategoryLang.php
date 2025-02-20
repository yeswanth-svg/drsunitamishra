<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryLang extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name','lang'];
}
