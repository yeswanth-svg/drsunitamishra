<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    protected $fillable = ['status'];
    public function lang(){
        return $this->hasOne(PageLang::class,'page_id')->where(['lang' => get_default_language()]);
     }
    public function lang_front(){
        return $this->hasOne(PageLang::class,'page_id')->where(['lang' => front_default_lang()]);
     }
    public function lang_all(){
        return $this->hasMany(PageLang::class,'page_id');
    }
}
