<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        // Normalize email to avoid case/whitespace mismatches across browsers/autofill.
        $email = strtolower(trim($credentials['email']));
        $remember = $request->boolean('remember');
        $password = trim($credentials['password']);

        // Verify reCAPTCHA
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        if ($recaptchaSecret) {
            $verify = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);
            $passed = (bool) ($verify->json('success') ?? false);
            if (!$passed) {
                return response()->view('admin.auth.login', [
                    'login_email' => $email,
                    'captcha_error' => 'reCAPTCHA verification failed. Please try again.',
                ]);
            }
        }

        // Case-insensitive email lookup to avoid collation/browser casing issues.
        $user = User::whereRaw('LOWER(email) = ?', [$email])->first();

        if (!$user) {
            return response()->view('admin.auth.login', [
                'login_email' => $email,
                'email_error' => 'Email mismatch.',
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->view('admin.auth.login', [
                'login_email'    => $email,
                'password_error' => 'Password incorrect.',
            ]);
        }

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);

            if (!$user->is_active) {
                Auth::logout();
                return response()->view('admin.auth.login', [
                    'login_email' => $email,
                    'email_error' => 'Your account has been deactivated.',
                ]);
            }

            $request->session()->regenerate();

            // Log the login
            \App\Models\ActivityLog::create([
                'user_id'    => $user->id,
                'action'     => 'login',
                'model_type' => 'User',
                'model_id'   => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->intended(route('admin.dashboard'));
        }

        return response()->view('admin.auth.login', [
            'login_email' => $email,
            'login_error' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        $userId = Auth::id();

        \App\Models\ActivityLog::create([
            'user_id'    => $userId,
            'action'     => 'logout',
            'model_type' => 'User',
            'model_id'   => $userId,
            'ip_address' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
