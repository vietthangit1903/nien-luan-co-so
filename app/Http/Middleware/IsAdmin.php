<?php

namespace App\Http\Middleware;

use App\Models\Admin\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lecture = Auth::guard('lecture')->user();
        if ($lecture) {
            if ($lecture->role_id === Role::where('name', 'Admin')->first()->id)
                return $next($request);
        }

        Session::flash('error', 'Bạn không thể truy cập vào phân vùng này!');
        return redirect()->back();
    }
}
