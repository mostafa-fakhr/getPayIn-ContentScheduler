<?php

/**
 * This exception is inherited by all exceptions
 *
 */

namespace App\Exceptions;

class AppException extends \Exception
{

    public function __construct($code, $dataArr = array())
    {
        $this->httpCode = \App\Constants\Error::HTTP_CODE[$code];
        $this->dataArr = $dataArr;
        parent::__construct(\App\Constants\Error::MSG[$code], $code);
    }

    private $httpCode;
    private $dataArr;
    private $severity;

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getDataArr()
    {
        return is_null($this->dataArr) ? array() : $this->dataArr;
    }
}
