<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model

{
    protected $fillable = ['title', 'author', 'post_content', "post_date", "image_url", "category_id"];

    public function getFormattedDate($column, $format = 'd-m-Y H:i:s' )
    {
        return Carbon::create($this->$column)->format($format);
    }

    public function category(){
        
        return $this->belongsTo('App\Models\Category');
    }
}