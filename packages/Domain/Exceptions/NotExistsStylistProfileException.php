<?php

namespace Packages\Domain\Exceptions;

class NotExistsStylistProfileException extends \Exception
{
    /**
     * @var int スタイリストのプロフィールが存在しない
     */
    const ERROR_CODE = 102;
}