<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forehead extends Model
{
    use HasFactory;
    protected $table="forehead";

    public function carousels(){
        return $this->hasMany(ForeheadCarousel::class,'fk_forehead_id','id')->orderBy('order','asc');
    }
}
