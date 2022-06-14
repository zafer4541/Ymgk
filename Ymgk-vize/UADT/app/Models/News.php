<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = ['url','title','image','description','isPublished','type'];

    public function getNewsCategory(){
        return $this->hasMany(NewsCategory::class,'news_id','id');
    }
}
