<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderArticle extends Model
{
 protected $fillable = [
    'id_article', 'slider_type', 'content', 'order', 'text', 'link'
 ]; 
}
