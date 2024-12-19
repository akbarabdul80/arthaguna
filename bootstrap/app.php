<?php

use App\Exceptions\Handler;
use App\Http\Responses\BaseResponse;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return BaseResponse::errorNotFound();
            }
        });

        $exceptions->renderable(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return BaseResponse::errorBadRequest($e->getMessage(), $e->errors());
            }
        });

        $exceptions->renderable(function (UniqueConstraintViolationException $e, Request $request) {
            if ($request->is('api/*')) {
                return BaseResponse::errorConflict('Duplicate entry.');
            }
        });

        $exceptions->renderable(function (RouteNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                return BaseResponse::errorUnauthorized('You not have access to this route.');
            }
        });


        $exceptions->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                $exceptionName = get_class($e);
                return response()->json([
                    'status' => 500,
                    'message' => 'Internal server error.',
                    'exception' => $exceptionName,
                    'data' => null,
                ], 500);
            }
        });
    })->create();
