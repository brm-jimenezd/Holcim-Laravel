<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    protected $fillable = [
        'title', 'category', 'date', 'description', 'image_link', 'id_category'
       ];
  }

