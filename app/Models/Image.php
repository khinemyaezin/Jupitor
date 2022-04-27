<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Image extends Model
{
    use HasFactory;
    protected $table="image";

    public static function boot() {
        parent::boot();
        self::deleting(function($image) { 
            $file = public_path('storage/'.$image->url);
            error_log('Image.deleting.$file : ' .$file);
            if(File::exists($file)){
                error_log('Image.deleting.$file->exists : true');
                File::delete($file);
            }else{
                error_log('Image.deleting.$file->not exists : true');
            }
        });
    }
}
