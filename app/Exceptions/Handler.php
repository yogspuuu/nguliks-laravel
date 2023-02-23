<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $exception)
    {

        if ($request->expectsJson()) {
            return $this->handleJsonException($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    private function handleJsonException($exception)
    {
        $statusCode = 500;
        $responses = [
            'status' => false,
            'message' => App::environment() == 'production' ? 'Internal server error.' : $exception->getMessage()
        ];

        if ($exception instanceof ValidationException) {
            $statusCode = 422;
            $errors = $exception->validator->errors();

            $messageBag = [];
            foreach ($errors->messages() as $key => $value) {
                $messageBag[] = ['attribute' => $key, 'text' => $value];
            }

            $responses['message'] = $messageBag;
        }

        if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
            $statusCode = 404;
            $responses['message'] = 'Not found.';
        }

        if ($exception instanceof AuthorizationException || $exception instanceof AuthenticationException) {
            $statusCode = 401;
            $responses['message'] = $exception->getMessage();
        }

        if ($exception instanceof AuthorizationException || $exception instanceof AccessDeniedHttpException) {
            $statusCode = Response::HTTP_FORBIDDEN;
            $responses['message'] = $exception->getMessage();
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $statusCode = Response::HTTP_METHOD_NOT_ALLOWED;
            $responses['message'] = $exception->getMessage();
        }

        return response()->json($responses, $statusCode);
    }
}
