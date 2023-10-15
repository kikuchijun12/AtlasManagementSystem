<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];
    protected $table = 'subjects';//テーブル名を定義

    public function users(){
        return $this->belongsTo('App\Models\Users\User');//リレーションの定義
    }
}
