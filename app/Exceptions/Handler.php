<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Monolog\Logger;
use NewRelic\Monolog\Enricher\Processor;
use NewRelic\Monolog\Enricher\Handler as newRelicHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $log = new Logger('exception');
        $log->pushProcessor(new Processor());
        $log->pushHandler(new newRelicHandler());

        $log->error($exception->getMessage(),[
            'request_url' => $request->url(),
            'request_method' => $request->method(),
            'request_parameters' => $request->all(),
            'trace' => $exception->getTrace(),
            'string_trace' => $exception->getTraceAsString()
        ]);

        return parent::render($request, $exception);
    }
}
