<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    //
    protected $fillable = ['post_id', 'sub_category_id'];

    protected $table = 'post_sub_categories'; // テーブル名を指定
}
