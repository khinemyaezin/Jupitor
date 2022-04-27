<?php

namespace App\Models;

use App\Services\Utility;
use Illuminate\Support\Facades\DB;

class ViewResult
{
    public $success;
    public $code;
    public $message;
    public $errorMessage;
    public $error;
    public $data;
    public $list = [];
    public function __construct()
    {
        return $this;
    }

    public function isSuccess() {
        return $this->success;
    }

    public function success() {
        $this->success = true;
        $this->message = 'Success';
        $this->code = 200;

        return $this;
    }
   

    public function error(\Exception $error) {
        $this->success = false;
        $this->error = $error->getMessage();
        $this->code = $error->getCode();
        $this->errorMessage = Utility::translateError($error);
    }
    
    public function completeTransaction(){
        if($this->success){
            DB::commit();
            return $this->success;
        }else{
            DB::rollBack();
            return $this->success;
        }
    }
}
