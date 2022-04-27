<?php

namespace App\Models;

use App\Services\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Group extends Model
{
    use HasFactory;
    protected $table = "group";
    public $imageFile = null;

    public function articles()
    {
        return $this->hasMany(Article::class, 'fk_group_id', "id")
        ->where('biz_status', Utility::$BIZ_STATUS['active'])
        ->where('status', Utility::$ROW_STATUS['normal'])
        ->orderBy('order', 'asc');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'fk_type_id', 'id')
        ->where('biz_status', Utility::$BIZ_STATUS['active'])
        ->where('status', Utility::$ROW_STATUS['normal']);
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'fk_theme_id', 'id')
        ->where('biz_status', Utility::$BIZ_STATUS['active'])
        ->where('status', Utility::$ROW_STATUS['normal']);
    }
    public function groupTheme()
    {
        return $this->belongsTo(Theme::class, 'fk_group_theme_id', 'id')
        ->where('biz_status', Utility::$BIZ_STATUS['active'])
        ->where('status', Utility::$ROW_STATUS['normal']);
    }
    

    public function isActive()
    {
        $key = array_search($this->biz_status, Utility::$BIZ_STATUS);
        return $key == 'active';
    }
    public function status()
    {
        return array_search($this->biz_status, Utility::$BIZ_STATUS);
    }
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($group) { // before delete() method call this
            error_log('deleting-----------------------------------------------');
            $group->articles()->delete();
        });
        self::deleted(function ($group) {
            $file = public_path('storage/' . $group->image_url);
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
