<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table= 'news_category';
    protected $fillable = ['news_id','category_id'];
    public $timestamps = true;

    public function getCategory(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function getNewsCategory(){
        return $this->belongsTo(News::class,'news_id','id');
    }
}
