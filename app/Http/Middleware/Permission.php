<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permission
{
  protected $except = array(
    'App\Http\Controllers\DashboardController',
    'App\Http\Controllers\AuthController',
    'App\Http\Controllers\Auth\LoginController',
  );

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if(Auth::check() && !is_object($request->route()->getAction()['uses'])){
      $directRoute = explode('@', $request->route()->getAction()['uses']);
      if(Auth::User()->admin == 0 && !in_array($directRoute[0], $this->except)){
        $allowControllers = Auth::User()->permissions()->get()->toArray();
        $hasPermission = false;
        foreach($allowControllers as $controller){
          if($directRoute[0] == $controller['controller']){
            $hasPermission = true;
            break;
          }
        }
        if($hasPermission){
          return $next($request);
        }
        else{
          return redirect('/dashboard');
        }
      }
      else{
        return $next($request);
      }
    }
    else{
      return $next($request);
    }
  }
}
