<?php

namespace Auth\Core\Errors;


class ErrorMessage {

    public $errorCode;
    public $errorMessage;

    function __construct($errorCode, $errorMessage)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
    }

    function __tostring()
    {
        return json_encode($this);
    }
}