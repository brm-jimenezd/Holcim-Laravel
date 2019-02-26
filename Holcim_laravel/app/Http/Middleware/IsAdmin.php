<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class IsAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
   public function handle($request, Closure $next)
   {
      if (Auth::user() && Auth::user()->active == true && (Auth::user()->role == "Admin" || Auth::user()->role == "Mod")) {
        return $next($request);
      }
      return redirect('/');
   }
}
