<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\Posts;
=======
>>>>>>> 5969b92fa9151d5117741b904ef47933df39b742
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory()
    {
        // リレーションの定義
        return $this->belongsTo('App\Models\Categories\MainCategory');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_sub_categories', 'sub_category_id', 'post_id');
    }
}
