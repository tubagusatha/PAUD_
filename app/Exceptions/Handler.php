<?php
// app/Exceptions/Handler.php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ErrorException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        // ...
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // app/Exceptions/Handler.php

public function render($request, Throwable $exception): Response
{
    // Menangani kesalahan NotFoundHttpException (404)
    if ($exception instanceof NotFoundHttpException) {
        return response()->view('errors.404', [], Response::HTTP_NOT_FOUND);
    }

    // Menangani kesalahan lain, seperti kesalahan server (500)
    if ($exception instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException || $exception instanceof ErrorException) {
        return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    // Jika tidak ada penanganan khusus, panggil penanganan default
    return parent::render($request, $exception);
}
}

