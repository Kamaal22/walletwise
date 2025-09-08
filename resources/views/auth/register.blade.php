@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
  <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Create your WalletWise account</h2>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus
          class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
          class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" required
          class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="password_confirmation" required
          class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary">
      </div>

      <button type="submit"
        class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary/90 shadow">
        Sign Up
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
      Already have an account?
      <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a>
    </p>
  </div>
</div>
@endsection
