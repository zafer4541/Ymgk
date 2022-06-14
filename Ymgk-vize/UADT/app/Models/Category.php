<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table= 'categories';
    protected $fillable = ['name', 'timeline_id'];
    public $timestamps = true;

    public function getUserCategory(){
        return $this->hasMany(UserCategory::class,'category_id','id');
    }

    public function getNewsCategory(){
        return $this->hasMany(NewsCategory::class,'category_id','id');
    }

    public function defaultTimeline()
    {
        return $this->hasOne(Timeline::class,'timeline_id','id');
    }

}
