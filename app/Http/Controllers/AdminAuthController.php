<?php

namespace App\Http\Controllers;

use App\Mail\AdminPasswordOtpMail;
use App\Models\AdminPasswordOtp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, (bool) $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials.',
            ]);
        }

        $request->session()->regenerate();

        if (!Auth::user()?->is_admin) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'This account does not have admin access.',
            ]);
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function showForgotPassword(): View
    {
        return view('admin.auth.forgot-password');
    }

    public function sendOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $configuredAdminEmail = (string) env('ADMIN_EMAIL', '');
        if ($configuredAdminEmail !== '' && strcasecmp($configuredAdminEmail, $data['email']) !== 0) {
            throw ValidationException::withMessages([
                'email' => 'Only the configured admin email can request OTP.',
            ]);
        }

        $user = User::query()
            ->where('email', $data['email'])
            ->where('is_admin', true)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Admin account not found for this email.',
            ]);
        }

        $otp = (string) random_int(100000, 999999);

        AdminPasswordOtp::create([
            'email' => $user->email,
            'otp_hash' => Hash::make($otp),
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new AdminPasswordOtpMail($otp));

        return redirect()->route('admin.reset-password.form', ['email' => $user->email])
            ->with('status', 'OTP sent to your email.');
    }

    public function showResetPassword(Request $request): View
    {
        return view('admin.auth.reset-password', [
            'email' => (string) $request->query('email', ''),
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = User::query()
            ->where('email', $data['email'])
            ->where('is_admin', true)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Admin account not found.',
            ]);
        }

        $record = AdminPasswordOtp::query()
            ->where('email', $data['email'])
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$record || !Hash::check($data['otp'], $record->otp_hash)) {
            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP.',
            ]);
        }

        $record->update(['used_at' => now()]);
        $user->update(['password' => $data['password']]);

        return redirect()->route('admin.login')->with('status', 'Password reset successful. Please login.');
    }
}
