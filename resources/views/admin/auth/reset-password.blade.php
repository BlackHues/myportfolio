<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow">
        <h1 class="text-xl font-semibold">Reset Admin Password</h1>
        <p class="text-sm text-slate-500 mt-1">Enter OTP from Gmail and set a new password.</p>

        @if (session('status'))
            <div class="mt-4 rounded-lg bg-emerald-50 px-3 py-2 text-sm text-emerald-800">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="mt-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-800">{{ $errors->first() }}</div>
        @endif

        <form method="post" action="{{ route('admin.reset-password.update') }}" class="mt-5 space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Admin Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email', $email ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label for="otp" class="block text-sm font-medium mb-1">OTP</label>
                <input type="text" id="otp" name="otp" required maxlength="6" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium mb-1">New Password</label>
                <input type="password" id="password" name="password" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <button type="submit" class="w-full rounded-lg bg-slate-900 text-white py-2 font-medium">Reset Password</button>
        </form>

        <a href="{{ route('admin.login') }}" class="mt-4 inline-block text-sm text-indigo-600">Back to login</a>
    </div>
</body>
</html>
