<?php

    use Illuminate\Foundation\Application;
    use Illuminate\Foundation\Configuration\Exceptions;
    use Illuminate\Foundation\Configuration\Middleware;
    use Illuminate\Auth\AuthenticationException;

    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/../routes/web.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware): void {
            $middleware->validateCsrfTokens(except: [
                'github-webhook',
            ]);
        })
        ->withExceptions(function (Exceptions $exceptions): void {
            $exceptions->render(function (AuthenticationException $e, $request) {
                return $request->expectsJson()
                    ? response()->json(['message' => 'Unauthenticated'], 401)
                    : redirect()->route('login');
            });
        })
        ->create();
