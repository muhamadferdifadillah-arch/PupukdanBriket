<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Manfaatin</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('admin/assets/images/logos/logos.png') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />
  <style>
    .auth-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 20px 0;
    }
    .auth-card {
      max-width: 500px;
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
            <h2 class="mt-3 mb-1">Create Account</h2>
            <p class="text-muted">Join Manfaatin today!</p>
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
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          @endif

          <!-- Register Form -->
          <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="ti ti-user"></i>
                </span>
                <input 
                  type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  id="name" 
                  name="name" 
                  value="{{ old('name') }}"
                  placeholder="Enter your full name" 
                  required 
                  autofocus
                >
              </div>
              @error('name')
              <div class="text-danger mt-1 small">{{ $message }}</div>
              @enderror
            </div>

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
                >
              </div>
              @error('email')
              <div class="text-danger mt-1 small">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="ti ti-phone"></i>
                </span>
                <input 
                  type="tel" 
                  class="form-control @error('phone') is-invalid @enderror" 
                  id="phone" 
                  name="phone" 
                  value="{{ old('phone') }}"
                  placeholder="08123456789"
                >
              </div>
              @error('phone')
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
                  placeholder="Min. 6 characters" 
                  required
                >
              </div>
              @error('password')
              <div class="text-danger mt-1 small">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="ti ti-lock-check"></i>
                </span>
                <input 
                  type="password" 
                  class="form-control" 
                  id="password_confirmation" 
                  name="password_confirmation" 
                  placeholder="Re-enter password" 
                  required
                >
              </div>
            </div>

            <div class="mb-3 form-check">
              <input class="form-check-input" type="checkbox" id="terms" required>
              <label class="form-check-label small" for="terms">
                I agree to the <a href="#" class="text-primary">Terms & Conditions</a> and <a href="#" class="text-primary">Privacy Policy</a>
              </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
              <i class="ti ti-user-plus me-2"></i>Create Account
            </button>

            <div class="text-center">
              <p class="mb-0">Already have an account? 
                <a href="{{ route('login') }}" class="text-primary fw-bold">Sign In</a>
              </p>
            </div>
          </form>
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
    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
      const password = this.value;
      const strength = password.length >= 8 ? 'Strong' : password.length >= 6 ? 'Medium' : 'Weak';
      console.log('Password strength:', strength);
    });

    // Password match validation
    document.getElementById('password_confirmation').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirm = this.value;
      
      if (password !== confirm && confirm.length > 0) {
        this.setCustomValidity('Passwords do not match');
      } else {
        this.setCustomValidity('');
      }
    });
  </script>
</body>

</html>