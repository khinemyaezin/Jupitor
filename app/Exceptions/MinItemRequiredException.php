<?php

namespace App\Exceptions;

use Exception;

class MinItemRequiredException extends Exception
{
    protected $message = "Requested process cannot be proceed!";

    public function render($request)
    {       
        return response()->json(["error" => true, "message" => $this->getMessage()?$this->getMessage(): $this->message]);       
    }
}
