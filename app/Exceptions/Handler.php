<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'success' => 0,
                'message' => 'This Method is not allowed for the requested route',
                'status' => '405',
            ], 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json( [
                'success' => 0,
                'message' => 'This Route is not found',
                'status' => '404',
            ], 404 );
        }

        if ($exception instanceof \BadMethodCallException) {
            return response()->json( [
                'success' => 0,
                'message' => 'Bad Method Called',
                'status' => '404',
            ], 404 );
        }
    }
}
