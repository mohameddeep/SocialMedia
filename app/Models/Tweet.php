<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tweet extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable=["user_id","content"];

    public $translatable = [
        'content',
    ];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
