<?php

namespace App\Http\Controllers\Auth;

use App\Assets\JsonResponser;
use App\Http\Controllers\GlobalController as Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Transformers\Auth\EmployeeTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    use JsonResponser;

    public function __construct()
    {
        $this->middleware('guest')->except('destroy', 'profile');
        $this->middleware('auth:sanctum')->only('profile', 'destroy'); 
    }
    
    
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return RouteServiceProvider::home();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        if (request()->wantsJson()) {
            return $this->message('La session ha terminado.');
        }
        
        return redirect(env('APP_URL'));
    }

    public function profile()
    { 
        return  $this->showOne(request()->user(), EmployeeTransformer::class);
    }
}