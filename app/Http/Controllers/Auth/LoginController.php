<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Override the authenticated method to check for admin.
     */
    public function authenticated(Request $request, $user)
    {
        if ($user instanceof Admin) {
            return redirect()->route('admin.dashboard'); // إذا كان admin
        }

        return redirect()->route('home'); // إذا كان user عادي
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // First, check if the email exists in the admins table
        $admin = Admin::where('email', $request->email)->whereNull('deleted_at')->first();

        // dd($admin);
        if ($admin && Hash::check($request->password, $admin->password)) {
            // dd('ss');
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        $user = User::where('email', $request->email)->whereNull('deleted_at')->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            return redirect()->route('home');
        }


        // If the credentials are incorrect
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect'],
        ]);
    }

    /**
     * Handle logout request.
     */
    public function destroy(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/');
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect('/login'); 
        } else {
            return redirect('/login');
        }
    }
}
