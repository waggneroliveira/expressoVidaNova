<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            HandleInertiaRequests::class,
            // \App\Console\Commands\ImportRssBlogs::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->view('client.errors.404', [], 404);
        });

        $exceptions->respond(function (Response $response) {
            if ($response->getStatusCode() === 419) {
                return back()->with([
                    'message' => 'The page expired, please try again.',
                ]);
            }
    
            return $response;
        });
    })->withSchedule(function (Schedule $schedule) {
        $schedule->command('rss:g1bahia')->everyMinute();
            // ->everyFifteenMinutes()
            // ->withoutOverlapping()
            // ->appendOutputTo(storage_path('logs/rss-g1bahia.log'));
        
        $schedule->command('rss:govba')->everyMinute();
            // ->everyFifteenMinutes()
            // ->withoutOverlapping()
            // ->appendOutputTo(storage_path('logs/rss-govba.log'));
        
        $schedule->command('rss:bahianoticias')->everyMinute();
            // ->everyFifteenMinutes()
            // ->withoutOverlapping()
            // ->appendOutputTo(storage_path('logs/rss-bahianoticias.log'));
    })
    ->create();
    
