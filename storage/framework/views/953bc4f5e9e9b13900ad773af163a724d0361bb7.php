<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIAKAD UYM - <?php echo $__env->yieldContent('title', 'Sistem Informasi Akademik'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
                <i class="fas fa-graduation-cap me-2"></i>
                SIAKAD UYM
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-users-cog me-1"></i> Manajemen
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo e(route('mahasiswa.index')); ?>">
                                        <i class="fas fa-user-graduate me-2"></i> Mahasiswa
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('dosen.index')); ?>">
                                        <i class="fas fa-chalkboard-teacher me-2"></i> Dosen
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('pendaftaran.index')); ?>">
                                        <i class="fas fa-user-plus me-2"></i> Pendaftaran
                                    </a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(in_array(auth()->user()->role, ['admin', 'dosen'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('nilai.index')); ?>">
                                    <i class="fas fa-chart-line me-1"></i> Nilai
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(auth()->user()->role === 'mahasiswa'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('nilai.cek')); ?>">
                                    <i class="fas fa-chart-bar me-1"></i> Cek Nilai
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> <?php echo e(auth()->user()->username); ?>

                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                    <i class="fas fa-user me-2"></i> Profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('daftar-akun')); ?>">
                                <i class="fas fa-user-plus me-1"></i> Daftar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content" style="padding-top: 80px; min-height: calc(100vh - 80px);">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Modern Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-gradient mb-3">
                        <i class="fas fa-graduation-cap me-2"></i>SIAKAD UYM
                    </h5>
                    <p class="mb-0">Sistem Informasi Akademik Universitas Yatsi Madani</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <i class="fas fa-code me-1"></i>Developed with 
                        <i class="fas fa-heart text-danger"></i> by UYM Team
                    </p>
                    <small class="text-muted">© 2025 All rights reserved</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
    
    <!-- Custom JavaScript for animations -->
    <script>
        // Add fade-in animation to cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });
            
            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.classList.add('hover-lift');
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
        
        // Add loading animation ONLY to login/daftar forms
        document.addEventListener('DOMContentLoaded', function() {
            const loginOrDaftarForm = document.querySelector('form[action*="login"], form[action*="daftar-akun"]');
            if (loginOrDaftarForm) {
                loginOrDaftarForm.addEventListener('submit', function() {
                    const button = this.querySelector('button[type="submit"]');
                    if (button) {
                        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
                        button.disabled = true;
                    }
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laravel\mahasiswa-uym\resources\views/layouts/app.blade.php ENDPATH**/ ?>