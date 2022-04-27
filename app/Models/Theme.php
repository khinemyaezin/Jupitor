<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $table="theme";

    public function children()
    {
        return $this->belongsToMany(Theme::class, 'theme_group','fk_ptheme_id','fk_ctheme_id');
    }

}
