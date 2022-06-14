<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteUserExport extends Model
{
    use HasFactory;
    protected $table='user_export';
    protected $fillable=['user_id','export_id'];
    public $timestamps=true;

    public function getUser(){
     $this->belongsTo(User::class,'user_id','id');
    }

    public function getExport(){
        $this->belongsTo(Export::class,'export_id','id');
    }
}
