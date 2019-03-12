<?php

namespace App\Domains\Exceptions;

class NotStylistException  extends \Exception
{
    /**
     * @var int スタイリストではない
     */
    const ERROR_CODE = 103;
}