<?php

namespace App\Domains\Exceptions;

class StylistProfileNotExistsException extends \Exception
{
    /**
     * @var int スタイリストのプロフィールが存在しない
     */
    const ERROR_CODE = 102;
}