@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
  <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Forgot your password?</h2>
    <p class="mb-4 text-sm text-gray-600 text-center">
      Enter your email address and we’ll send you a password reset link.
    </p>

    @if (session('status'))
      <div class="mb-4 text-green-600 text-sm">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
      </div>

      <button type="submit"
        class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary/90 shadow">
        Send Reset Link
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
      <a href="{{ route('login') }}" class="text-primary hover:underline">Back to Login</a>
    </p>
  </div>
</div>
@endsection
