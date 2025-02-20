<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','user_id','status'];

    public function category(){
        return $this->belongsTo(BlogCategory::class,'category_id');
    }
    public function blog(){
        return $this->hasMany('App\BlogLang','blog_id');
    }
    public function category_default_lang(){
        return $this->hasMany('App\BlogCategoryLang','category_id','category_id')->where('lang',admin_default_lang());
    }
    public function blog_default_lang(){
        return $this->hasMany('App\BlogLang','blog_id')->where('lang',admin_default_lang());
    }
    public function category_front(){
        return $this->hasOne('App\BlogCategoryLang','category_id','category_id')->where('lang',front_default_lang());
    }
    public function blog_front(){
        return $this->hasOne('App\BlogLang','blog_id')->where('lang',front_default_lang());
    }
    public static function all_blogs(){
        $all_blogs = Blog::with(['category_front','blog_front'])->where(['status' => 'publish'])->orderBy('id', 'DESC');
        return $all_blogs;
    }

    public function lang(){
        return $this->hasOne(BlogLang::class,'blog_id')->where(['lang' => get_default_language()]);
     }
    public function lang_front(){
        return $this->hasOne(BlogLang::class,'blog_id')->where(['lang' => front_default_lang()]);
     }
    public function lang_all(){
        return $this->hasMany(BlogLang::class,'blog_id');//->groupBy('lang');
    }
}
