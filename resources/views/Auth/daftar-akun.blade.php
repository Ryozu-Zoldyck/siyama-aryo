<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIAKAD UYM - Daftar Akun</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <i class="fas fa-user-plus text-gradient" style="font-size: 3rem;"></i>
                <h2 class="mt-3">Daftar Akun</h2>
                <p class="text-muted">SIAKAD UYM - Sistem Informasi Akademik</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error!</strong> Silakan perbaiki kesalahan berikut:
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('daftar-akun.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="nama" class="form-label">
                        <i class="fas fa-user me-2"></i>Nama Lengkap
                    </label>
                    <input type="text" 
                           name="nama" 
                           id="nama" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama') }}" 
                           placeholder="Masukkan nama lengkap"
                           required 
                           autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nim" class="form-label">
                        <i class="fas fa-id-card me-2"></i>NIM
                    </label>
                    <input type="text" 
                           name="nim" 
                           id="nim" 
                           class="form-control @error('nim') is-invalid @enderror" 
                           value="{{ old('nim') }}" 
                           placeholder="Masukkan NIM"
                           required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jurusan" class="form-label">
                        <i class="fas fa-graduation-cap me-2"></i>Jurusan
                    </label>
                    <select name="jurusan" 
                            id="jurusan" 
                            class="form-control @error('jurusan') is-invalid @enderror" 
                            required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Ilmu Komputer" {{ old('jurusan') == 'Ilmu Komputer' ? 'selected' : '' }}>Ilmu Komputer</option>
                        <option value="Sistem Informasi" {{ old('jurusan') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                        <option value="Teknik Informatika" {{ old('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                        <option value="Manajemen Informatika" {{ old('jurusan') == 'Manajemen Informatika' ? 'selected' : '' }}>Manajemen Informatika</option>
                    </select>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fas fa-at me-2"></i>Username
                    </label>
                    <input type="text" 
                           name="username" 
                           id="username" 
                           class="form-control @error('username') is-invalid @enderror" 
                           value="{{ old('username') }}" 
                           placeholder="Masukkan username"
                           required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Masukkan password"
                               required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock me-2"></i>Konfirmasi Password
                    </label>
                    <div class="input-group">
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="form-control" 
                               placeholder="Konfirmasi password"
                               required>
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                            <i class="fas fa-eye" id="eyeConfirmIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="mb-0">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-gradient text-decoration-none">
                            <i class="fas fa-sign-in-alt me-1"></i>Login Sekarang
                        </a>
                    </p>
                </div>
            </form>

            <!-- Info Section -->
            <div class="mt-4 p-3 glass">
                <h6 class="text-center mb-3">
                    <i class="fas fa-info-circle me-2"></i>Informasi Pendaftaran
                </h6>
                <div class="row">
                    <div class="col-12">
                        <small class="text-muted">
                            <i class="fas fa-check-circle me-1 text-success"></i>Pendaftaran gratis<br>
                            <i class="fas fa-check-circle me-1 text-success"></i>Proses cepat dan mudah<br>
                            <i class="fas fa-check-circle me-1 text-success"></i>Akses ke semua fitur SIAKAD
                        </small>
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

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const password = document.getElementById('password_confirmation');
            const eyeIcon = document.getElementById('eyeConfirmIcon');
            
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

        // Add loading animation to submit button
        document.querySelector('form').addEventListener('submit', function() {
            const button = document.querySelector('button[type="submit"]');
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mendaftar...';
            button.disabled = true;
        });

        // Auto-focus on nama field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nama').focus();
        });
    </script>
</body>
</html> 