<!DOCTYPE html>
<html lang="en">
<head>
    @include('auth.css')
</head>
<body>

  <!-- Login Form -->
  <div class="container" id="loginForm">
    <a href="{{url('/')}}"><img src="img/Logo.png" alt="" class="mb-4"></a>
    <x-validation-errors class="mb-4" />
    <form class="text-center" method="POST" action="{{ route('register') }}">
        @csrf
      <div class="mt-3">
        <input id="name" type="text" class="form-control custom-input" placeholder="Nama" name="name" :value="old('name')" required>
      </div>

      <div class="mt-3">
        <input id="email" type="email" class="form-control custom-input" placeholder="Email" name="email" :value="old('email')" required>
      </div>

      <div class="mt-3">
        <input id="name" type="text" class="form-control custom-input" placeholder="Phone" name="phone" :value="old('phone')" required>
      </div>

      <div class="mt-3">
        <input id="password" type="password" class="form-control custom-input" placeholder="Password" name="password" required>
      </div>

      <div class="mt-3">
        <input id="password_confirmation" type="password" class="form-control custom-input" placeholder="Confirm Password" name="password_confirmation" required>
      </div>

      <button type="submit" class="btn btn-primary px-5">Register</button>
    </form>

    <p class="switch">Sudah punya akun? <a href="{{route('login')}}">Login disini</a></p>
  </div>

    @include('auth.script')
</body>
</html>
