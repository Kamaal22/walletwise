@extends('layouts.guest')

@section('content')
  <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Login to WalletWise</h2>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm text-center bg-red-50 p-2">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center text-sm">
          <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
          <span class="ml-2 text-gray-600">Remember me</span>
        </label>
        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">Forgot Password?</a>
      </div>

      <button type="submit"
        class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary/90 shadow">
        Login
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
      Don’t have an account?
      <a href="{{ route('register') }}" class="text-primary hover:underline">Sign up</a>
    </p>
  </div>
@endsection
