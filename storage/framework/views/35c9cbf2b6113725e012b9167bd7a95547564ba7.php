<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-stats">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="mb-2">
                            <i class="fas fa-user-circle me-3"></i>
                            Selamat Datang, <?php echo e(auth()->user()->username); ?>!
                        </h1>
                        <p class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <?php echo e(now()->format('l, d F Y')); ?> | 
                            <i class="fas fa-clock me-2"></i>
                            <?php echo e(now()->format('H:i')); ?> WIB
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="status-indicator status-active"></div>
                        <span class="text-white">Status: Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <?php if(auth()->user()->role === 'admin'): ?>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-user-graduate text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e(\App\Models\Mahasiswa::count()); ?></h3>
                        <p class="text-muted mb-0">Total Mahasiswa</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-chalkboard-teacher text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e(\App\Models\Dosen::count()); ?></h3>
                        <p class="text-muted mb-0">Total Dosen</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-chart-line text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e(\App\Models\Nilai::count()); ?></h3>
                        <p class="text-muted mb-0">Total Nilai</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-users text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e(\App\Models\User::count()); ?></h3>
                        <p class="text-muted mb-0">Total User</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(auth()->user()->role === 'dosen'): ?>
            <?php
                $dosen = auth()->user()->dosen;
            ?>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-chart-line text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient">
                            <?php echo e($dosen ? \App\Models\Nilai::where('dosen_id', $dosen->id)->count() : 0); ?>

                        </h3>
                        <p class="text-muted mb-0">Nilai yang Diinput</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-user-graduate text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e(\App\Models\Mahasiswa::count()); ?></h3>
                        <p class="text-muted mb-0">Total Mahasiswa</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-book text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient">
                            <?php echo e($dosen ? \App\Models\Nilai::where('dosen_id', $dosen->id)->distinct('mata_kuliah')->count('mata_kuliah') : 0); ?>

                        </h3>
                        <p class="text-muted mb-0">Mata Kuliah</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(auth()->user()->role === 'mahasiswa'): ?>
            <?php
                $mahasiswa = \App\Models\Mahasiswa::where('user_id', auth()->user()->id)->first();
                $nilai = $mahasiswa ? \App\Models\Nilai::where('mahasiswa_id', $mahasiswa->id)->get() : collect();
            ?>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-chart-bar text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e($nilai->count()); ?></h3>
                        <p class="text-muted mb-0">Total Nilai</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e($nilai->count() > 0 ? number_format($nilai->avg('nilai_akhir'), 1) : '0'); ?></h3>
                        <p class="text-muted mb-0">Rata-rata Nilai</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-trophy text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e($nilai->where('grade', 'A')->count()); ?></h3>
                        <p class="text-muted mb-0">Nilai A</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card hover-lift">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-book text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="text-gradient"><?php echo e($nilai->unique('mata_kuliah')->count()); ?></h3>
                        <p class="text-muted mb-0">Mata Kuliah</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo e(route('mahasiswa.index')); ?>" class="btn btn-primary w-100">
                                    <i class="fas fa-user-graduate me-2"></i>Kelola Mahasiswa
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo e(route('dosen.index')); ?>" class="btn btn-success w-100">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Kelola Dosen
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo e(route('nilai.index')); ?>" class="btn btn-warning w-100">
                                    <i class="fas fa-chart-line me-2"></i>Kelola Nilai
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo e(route('pendaftaran.index')); ?>" class="btn btn-info w-100">
                                    <i class="fas fa-user-plus me-2"></i>Pendaftaran
                                </a>
                            </div>
    <?php endif; ?>

                        <?php if(auth()->user()->role === 'dosen'): ?>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('nilai.create')); ?>" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-2"></i>Input Nilai Baru
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('nilai.index')); ?>" class="btn btn-success w-100">
                                    <i class="fas fa-list me-2"></i>Lihat Semua Nilai
                                </a>
                            </div>
    <?php endif; ?>

                        <?php if(auth()->user()->role === 'mahasiswa'): ?>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('nilai.cek')); ?>" class="btn btn-primary w-100">
                                    <i class="fas fa-chart-bar me-2"></i>Cek Nilai Saya
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="#" class="btn btn-success w-100">
                                    <i class="fas fa-download me-2"></i>Download Transkrip
                                </a>
                            </div>
    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <?php
                            $recentNilai = \App\Models\Nilai::with(['mahasiswa', 'dosen'])->latest()->take(5)->get();
                        ?>
                        
                        <?php $__empty_1 = true; $__currentLoopData = $recentNilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nilai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">
                                        <i class="fas fa-chart-line me-2"></i>
                                        Nilai <?php echo e($nilai->mata_kuliah); ?> untuk <?php echo e($nilai->mahasiswa->nama); ?>

                                    </h6>
                                    <p class="text-muted mb-0">
                                        <small>
                                            <i class="fas fa-user me-1"></i><?php echo e($nilai->dosen->nama); ?> | 
                                            <i class="fas fa-calendar me-1"></i><?php echo e($nilai->created_at->format('d M Y H:i')); ?>

                                        </small>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted text-center">Belum ada aktivitas terbaru</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <i class="fas fa-server text-primary me-2"></i>
                        <strong>Server:</strong> Online
                    </div>
                    <div class="info-item mb-3">
                        <i class="fas fa-database text-success me-2"></i>
                        <strong>Database:</strong> Connected
                    </div>
                    <div class="info-item mb-3">
                        <i class="fas fa-clock text-warning me-2"></i>
                        <strong>Last Update:</strong> <?php echo e(now()->format('H:i')); ?>

                    </div>
                    <div class="info-item">
                        <i class="fas fa-shield-alt text-info me-2"></i>
                        <strong>Security:</strong> Active
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e2e8f0;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #667eea;
}

.timeline-content {
    background: #f8fafc;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #667eea;
}

.info-item {
    padding: 10px 0;
    border-bottom: 1px solid #e2e8f0;
}

.info-item:last-child {
    border-bottom: none;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\mahasiswa-uym\resources\views/dashboard.blade.php ENDPATH**/ ?>