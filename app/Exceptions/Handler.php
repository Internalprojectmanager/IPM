<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
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
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($this->isHttpException($e) && env('APP_DEBUG') == false)
        {
            switch (intval($e->getStatusCode())) {
                // not found
                case 404:
                    return \Response::view('errors.404',array('request' => $request, 'exceptions' => $e),404);
                    break;
                // internal error
                case 500:
                    return \Response::view('errors.500',array('request' => $request, 'exceptions' => $e),500);
                    break;
                case 503:
                    return \Response::view('errors.503',array('request' => $request, 'exceptions' => $e),503);
                    break;
                default:
                    return \Response::view('errors.404',array('request' => $request, 'exceptions' => $e), 404);
                    break;
            }
        }

        dd($e);
        return parent::render($request, $e);
    }
}
