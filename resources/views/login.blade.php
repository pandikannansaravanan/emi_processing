@extends('common.template')

@section('title', 'Login Page')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
  <div class="row justify-content-center w-100">
    <div class="col-12 d-flex justify-content-center">
      <div class="bg-white p-4 rounded shadow" style="width: 100%; max-width: 400px;">
        <h2 class="mb-4 text-center">Sign In</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
          <div class="mb-3">
            <label for="username" class="form-label">User name</label>
            <input name="username" type="username" class="form-control" id="username" placeholder="Enter the username" value="{{ old('username') }}" />
            <span class="text-danger">{{ $errors->first('username') }}</span>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Enter the password" value="{{ old('password') }}" />
            <span class="text-danger">{{ $errors->first('password') }}</span>
          </div>
          <div class="mb-3 form-check">
           <span class="text-danger">{{ $errors->first('invalid_credentials') }}</span>
          </div>
          <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script>
        console.log('This script only runs on the home page!');
    </script>
@endpush
