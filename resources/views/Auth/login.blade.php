<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIAKAD UYM - Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .login-illustration {
            background: url('https://undraw.co/api/illustrations/undraw_login_re_4vu2.svg') no-repeat center center;
            background-size: contain;
            min-height: 350px;
        }
        @media (max-width: 991px) {
            .login-illustration {
                min-height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="row w-100 justify-content-center align-items-center">
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                <div class="login-illustration w-100"></div>
            </div>
            <div class="col-lg-5 col-md-8 col-12">
                <div class="login-card glass shadow-lg p-4 position-relative">
                    <div class="text-center mb-4">
                        <i class="fas fa-graduation-cap text-gradient" style="font-size: 3rem;"></i>
                        <h2 class="mt-3 mb-1">SIAKAD UYM</h2>
                        <p class="text-muted mb-0">Sistem Informasi Akademik</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Login gagal!</strong> Username atau password salah.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   value="{{ old('username') }}" 
                                   placeholder="Masukkan username Anda"
                                   required 
                                   autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password Anda"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary w-100 shadow-sm">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="mb-0">Belum punya akun? 
                                <a href="{{ route('daftar-akun') }}" class="text-gradient text-decoration-none">
                                    <i class="fas fa-user-plus me-1"></i>Daftar Sekarang
                                </a>
                            </p>
                        </div>
                    </form>

                    <!-- Demo Accounts Info -->
                    <div class="mt-4 p-3 glass shadow-sm">
                        <h6 class="text-center mb-3">
                            <i class="fas fa-info-circle me-2"></i>Akun Demo
                        </h6>
                        <div class="row">
                            <div class="col-12">
                                <small class="text-muted">
                                    <strong>Admin:</strong> admin / password<br>
                                    <strong>Dosen:</strong> 198501012010012001 / password<br>
                                    <strong>Mahasiswa:</strong> 23040153 / password
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Add loading animation to login button
        document.querySelector('form').addEventListener('submit', function() {
            const button = document.querySelector('button[type="submit"]');
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Logging in...';
            button.disabled = true;
        });

        // Auto-focus on username field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
    </script>
</body>
</html>