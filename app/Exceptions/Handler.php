<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
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
        return parent::render($request, $exception);
    }

    /**
     * If not authenticate
     *
     * @return mix
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
      if($request->expectsJson()){
        return response()->json(['error' => 'Unauthenticated.'], 401);
      }

      // Get value from exception guards if not authenticate, example output : guards = 'admin'
      $guard = $exception->guards()[0];
      switch ($guard) {
        // If guard admin then redirect to admin login form
        case 'admin':
            return redirect()->route('admin.login_form');
              break;

        // If guard customer then redirect to customer login form
        case 'customer':
            return redirect()->route('customer.login_form');
              break;

        // If undefined guard then redirect default page
        default:
            return redirect('/');
              break;
      }

    // return redirect('/');

    }

}
