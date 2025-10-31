<!DOCTYPE html>
<html lang="en">
<head>
  @notifyCss
  @include('auth.css')
</head>
<body>


    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
    @endsession


  <!-- Login Form -->
  <div class="container" id="loginForm">
    <a href="{{url('/')}}"><img src="img/Logo.png" alt="" class="mb-4"></a>
    <x-validation-errors class="mb-4" />
    <form class="text-center" method="POST" action="{{ route('login') }}">
        @csrf
      <div class="mb-3">
        <input type="email" class="form-control custom-input" placeholder="Email" name="email" :value="old('email')" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control custom-input" placeholder="Password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary px-5">Login</button>
    </form>

    <p class="switch">Belum punya akun? <a href="{{route('register')}}">Daftar Sekarang</a></p>
  </div>

  @include('auth.script')
  @notifyJs
  <x-notify::notify />
</body>
</html>
