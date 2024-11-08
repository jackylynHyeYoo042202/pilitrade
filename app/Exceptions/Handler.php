<?php

// namespace App\Exceptions;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Throwable;

// class Handler extends ExceptionHandler
// {
//     /**
//      * The list of the inputs that are never flashed to the session on validation exceptions.
//      *
//      * @var array<int, string>
//      */
//     protected $dontFlash = [
//         'current_password',
//         'password',
//         'password_confirmation',
//     ];

//     /**
//      * Register the exception handling callbacks for the application.
//      */
// //     public function register(): void
// //     {
// //         $this->reportable(function (Throwable $e) {
// //             //
// //         });
// //     }
// // }

// public function render($request, Throwable $exception)
// {
//     // Check if request is an API request
//     if ($request->expectsJson()) {
//         return response()->json([
//             'message' => $exception->getMessage(),
//         ], 500);
//     }

//     // For non-API routes, let the default HTML response work
//     return parent::render($request, $exception);
// }
// }

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
            // You can log or report the exception here if necessary
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Check if request is an API request
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }

        // For non-API routes, let the default HTML response work
        return parent::render($request, $exception);
    }
}
