<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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

        // A 419 usually just means the session/CSRF token expired while a form
        // sat open. Send the user back with their input intact and a plain
        // message instead of Laravel's blank "Page Expired" error page.
        // Note: Laravel's Handler::prepareException() converts the original
        // TokenMismatchException into a generic HttpException(419, ...)
        // before renderable callbacks run, so this must match on that instead.
        $this->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() !== 419 || $request->expectsJson()) {
                return null;
            }

            return redirect()
                ->back()
                ->withInput($request->except(['password', 'password_confirmation', 'current_password', '_token']))
                ->with('error', 'Your session timed out for security reasons. Please try again.');
        });
    }
}
