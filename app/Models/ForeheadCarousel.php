<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ForeheadCarousel extends Model
{
    use HasFactory;
    protected $table="forehead_carousel";
    public $imageFile = null;

    public function group(){
        return $this->hasOne(Group::class,'id','fk_group_id');
    }
    public static function boot()
    {
        parent::boot();
        self::deleted(function ($data) {
            $file = public_path('storage/' . $data->image_url);
            error_log('Image.deleting.$file : ' . $file);
            if (File::exists($file)) {
                error_log('Image.deleting.$file->exists : true');
                File::delete($file);
            } else {
                error_log('Image.deleting.$file->not exists : true');
            }
        });
    }
}
