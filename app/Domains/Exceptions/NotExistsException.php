<?php

namespace App\Domains\Exceptions;

class NotExistsException extends \Exception
{
    /**
     * @var int 存在しない
     */
    const ERROR_CODE = 101;
}