<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     * Custom validation - separate errors for email and password
     */
    public function login(Request $request)
    {
        // Validate input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        // Check if email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Email not found
            return back()->withErrors([
                'email' => 'This email is not registered.',
            ])->withInput($request->only('email', 'remember'));
        }

        // Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            // Password is wrong
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput($request->only('email', 'remember'));
        }

        // Login the user
        Auth::login($user, $request->filled('remember'));

        // Regenerate session
        $request->session()->regenerate();

        // Redirect based on role
        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user) {
        if($user->role == 1){
          $url = url()->previous();
          $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
            if($route == 'reservation.carSelect'){
                return redirect()->back();
            }else{
                return redirect('/');
            }
        }else{
            return redirect('admin/jodan-vehicles');
        }
    }

    /**
     * Handle AJAX login request
     */
    public function ajaxLogin(Request $request)
    {
        // Validate input fields
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => ['email' => ['This email is not registered.']]
            ], 422);
        }

        // Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => ['password' => ['Incorrect password.']]
            ], 422);
        }

        // Login the user
        Auth::login($user, $request->filled('remember'));

        // Regenerate session
        $request->session()->regenerate();

        // Return redirect URL based on role
        $redirectUrl = ($user->role == 1) ? '/' : '/admin/jodan-vehicles';

        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect' => $redirectUrl
        ]);
    }

}
