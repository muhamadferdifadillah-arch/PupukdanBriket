<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Manfaatin</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('admin/assets/images/logos/logos.png') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />
  <style>
    .auth-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .auth-card {
      max-width: 450px;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="card shadow-lg">
        <div class="card-body p-5">
          <!-- Logo -->
          <div class="text-center mb-4">
            <img src="{{ asset('admin/assets/images/logos/logos.png') }}" alt="Manfaatin" width="120">
            <h2 class="mt-3 mb-1">Welcome Back!</h2>
            <p class="text-muted">Sign in to continue to Manfaatin</p>
          </div>

          <!-- Alert Messages -->
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ti ti-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          @endif

          @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ti ti-alert-circle me-2"></i>
            @foreach($errors->all() as $error)
              {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          @endif

          <!-- Login Form -->
          <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="ti ti-mail"></i>
                </span>
                <input 
                  type="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  id="email" 
                  name="email" 
                  value="{{ old('email') }}"
                  placeholder="Enter your email" 
                  required 
                  autofocus
                >
              </div>
              @error('email')
              <div class="text-danger mt-1 small">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="ti ti-lock"></i>
                </span>
                <input 
                  type="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  id="password" 
                  name="password" 
                  placeholder="Enter your password" 
                  required
                >
              </div>
              @error('password')
              <div class="text-danger mt-1 small">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                  Remember Me
                </label>
              </div>
              <a href="#" class="text-primary small">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
              <i class="ti ti-login me-2"></i>Sign In
            </button>

            <div class="text-center">
              <p class="mb-0">Don't have an account? 
                <a href="{{ route('register') }}" class="text-primary fw-bold">Create Account</a>
              </p>
            </div>
          </form>

          <!-- Demo Accounts -->
          <div class="mt-4 pt-4 border-top">
            <p class="text-muted text-center small mb-2">Demo Accounts:</p>
            <div class="d-flex gap-2 flex-wrap justify-content-center">
              <button class="btn btn-sm btn-outline-primary" onclick="fillDemo('admin')">
                <i class="ti ti-user-shield"></i> Admin
              </button>
              <button class="btn btn-sm btn-outline-secondary" onclick="fillDemo('user')">
                <i class="ti ti-user"></i> User
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-3">
        <p class="text-white">© 2025 Manfaatin. All rights reserved.</p>
      </div>
    </div>
  </div>

  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  
  <script>
    function fillDemo(type) {
      if (type === 'admin') {
        document.getElementById('email').value = 'admin@manfaatin.com';
        document.getElementById('password').value = 'admin123';
      } else {
        document.getElementById('email').value = 'user@manfaatin.com';
        document.getElementById('password').value = 'user123';
      }
    }
  </script>
</body>

</html>