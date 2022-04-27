<?php

namespace App\Models;

use App\Services\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Quotation extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = "quotations";
    protected $fillable = ['name','email','phone','created_at'];
    public $sortable = ['name','email','phone','created_at'];

    public function isActive()
    {
        $key = array_search($this->biz_status, Utility::$BIZ_STATUS);
        return $key == 'active';
    }

    public function status()
    {
        return array_search($this->biz_status, Utility::$BIZ_STATUS);

    }
   
}
