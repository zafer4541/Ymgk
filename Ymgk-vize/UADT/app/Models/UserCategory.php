<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table= 'user_category';
    protected $fillable = ['name','user_id','category_id'];
    public $timestamps = true;

    public function getUserCategory(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function  Category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
