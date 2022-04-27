<?php
namespace App\Services;

use App\Models\User;
use App\Models\ViewResult;
use Illuminate\Support\Facades\File;
use \nadar\quill\Lexer;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class Utility
{

    public static $IMAGE_PATH = 'images';
    public static $PAGINATION_COUNT = 15;
    public static $ERROR_DEFCODE = -1;

    public static $BIZ_STATUS = [
        'active' => 2,
        'draf' => 6,
    ];
    public static $ROW_STATUS = [
        'normal' => 2,
        'delete' => 4,
    ];
    public static $THEME_IMAGE_TYPE = [
        1 => 'src',
        2 => 'background-image',
    ];

    public static $QUOTE_STATUS = [
        'confirm' => 2,
        'pending' => 6,
    ];

    public static function quillToHtml($json)
    {
        $a = new Lexer($json);
        return $a->render();

    }
    static function jsonError($data)
    {
        $result = new ViewResult();
        $result->message = $data->customMessages;
        $result->success = false;
        return $result;
    }
    static function checkFirstTime(){
        return !User::first();
    }
    static function deleteImage($url){
        $file = public_path('storage/' . $url);
        error_log('Image.deleting.$file : ' . $file);
        if (File::exists($file)) {
            error_log('Image.deleting.$file->exists : true');
            return File::delete($file);
        } else {
            error_log('Image.deleting.$file->not exists : true');
            return false;
        }
    }
    static function translateError($error)
    {
        switch ($error->getCode()) {
            //sql error 
            case 23503:
                return "The action can't be completed because another process is using.";
                break;

            //custom error 
            case -1: 
                return $error->getMessage();
                break;

            default:
                return "Something went wrong!";
                break;
        }
    }
}
