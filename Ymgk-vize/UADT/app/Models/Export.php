<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Export extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;
    protected $table ='export';
    protected $guarded = [];

    public function getFolder() {
        return $this->belongsTo(Folder::class,'modulId');
    }

    public function getUserExport(){
        return $this->hasMany(FavoriteUserExport::class,'export_id','id');
    }

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
