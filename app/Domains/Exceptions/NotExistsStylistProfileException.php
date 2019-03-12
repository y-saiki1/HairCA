<?php

namespace App\Domains\Exceptions;

class NotExistsStylistProfileException extends \Exception
{
    /**
     * @var int スタイリストのプロフィールが存在しない
     */
    const ERROR_CODE = 102;
}