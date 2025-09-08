@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
  <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Create your WalletWise account</h2>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm text-center bg-red-50 p-2">
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
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
      </div>

      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
          class="mt-1 w-full border border-gray-300 rounded-md  focus:ring-primary p-1">
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
