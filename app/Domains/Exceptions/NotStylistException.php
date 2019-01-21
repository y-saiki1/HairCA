<?php

namespace App\Domains\Exceptions;

class NotExistsException extends \Exception
{
    /**
     * @var int スタイリストではない
     */
    const ERROR_CODE = 103;
}