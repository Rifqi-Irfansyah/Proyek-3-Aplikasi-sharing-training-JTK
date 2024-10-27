<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //CUSTOM ERROR 404 VIEW
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            if (strpos($exception->getMessage(), 'storage/uploads') !== false) {
                return response()->view('errors.404', ['exception' => ['message' => 'modul']], 404);
            }
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.404', ['exception' => ['message' => $exception->getMessage()]], 404);
            }
            if ($exception->getStatusCode() == 403) {
                return response()->view('errors.403', ['exception' => $exception], 403);
            }
        }

        return parent::render($request, $exception);
    }
}
