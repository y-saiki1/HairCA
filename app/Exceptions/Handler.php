<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;

use App\Domains\Exceptions\NotExistsException;
use App\Domains\Exceptions\StylistProfileNotExistsException;

use App\Http\Responders\Exceptions\ErrorResponder;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotExistsException) {
            $errorResponder = new ErrorResponder;
            return $errorResponder($exception, $request->all(), Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof StylistProfileNotExistsException) {
            $errorResponder = new ErrorResponder;
            return $errorResponder($exception, $request->all(), Response::HTTP_FAILED_DEPENDENCY);
        }

        return parent::render($request, $exception);
    }
}
