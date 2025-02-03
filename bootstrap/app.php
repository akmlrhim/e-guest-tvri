<?php

use App\Http\Middleware\InternSubmitted;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__ . '/../routes/web.php',
		commands: __DIR__ . '/../routes/console.php',
		health: '/up',
	)
	->withMiddleware(function (Middleware $middleware) {
		$middleware->trustHosts(at: ['127.0.0.1', 'localhost']);
		$middleware->alias([
			'intern-submitted' => InternSubmitted::class
		]);
	})
	->withExceptions(function (Exceptions $exceptions) {
		//
	})->create();
