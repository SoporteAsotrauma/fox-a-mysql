<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;

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

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception): JsonResponse
    {
        // Devuelve todas las excepciones en formato JSON
        return response()->json([
            'error' => true,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode() ?: 500,
        ], $this->getStatusCode($exception));
    }

    /**
     * Get the status code for the exception.
     */
    protected function getStatusCode(Throwable $exception): int
    {
        return method_exists($exception, 'getStatusCode')
            ? $exception->getStatusCode()
            : 500; // Retorna 500 por defecto si no tiene un código HTTP
    }
}
