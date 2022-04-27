<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Article extends Model
{
    use HasFactory;
    protected $table="article";
    public $imageFile = null;
    public $detailImageFile = null;

    public function group()
    {
        return $this->belongsTo(Group::class,'fk_group_id','id');
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'fk_theme_id', 'id');
    }
    public static function boot()
    {
        parent::boot();
        self::deleted(function ($article) {
            $file = public_path('storage/' . $article->image_url);
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
