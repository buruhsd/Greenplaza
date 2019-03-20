<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response = [];

        $response['exception'] = get_class($exception);
        $response['status_code'] = $exception->getCode();

        switch($response['status_code'])
        {
            case 403:
                $response['message'] = "You are not authorized to view that page!";
                break;
            case 404:
                $response['message'] = "Page not found!";
                break;
            default:
                $response['message'] = "Something went wrong!";
                break;
        }

        if($this->isHttpException($exception) && env('APP_DEBUG') == false){
            return response()->view('web_errors.maintenance', compact('response'));
        }
        return parent::render($request, $exception);
    }
}
