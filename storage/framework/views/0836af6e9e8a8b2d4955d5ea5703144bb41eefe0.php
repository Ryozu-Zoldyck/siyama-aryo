

<?php $__env->startSection('title', 'Data Pendaftaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Data Pendaftaran Mahasiswa Baru
                    </h4>
                    <a href="<?php echo e(route('pendaftaran.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Pendaftaran
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telp</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $pendaftaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user me-2 text-primary"></i>
                                            <?php echo e($item->nama); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope me-2 text-info"></i>
                                        <?php echo e($item->email); ?>

                                    </td>
                                    <td><?php echo e($item->no_telp ?? '-'); ?></td>
                                    <td>
                                        <span class="badge badge-info"><?php echo e($item->jurusan); ?></span>
                                    </td>
                                    <td>
                                        <?php if($item->status === 'pending'): ?>
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        <?php elseif($item->status === 'approved'): ?>
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Diterima
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times me-1"></i>Ditolak
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                        <?php echo e($item->created_at->format('d/m/Y H:i')); ?>

                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('pendaftaran.edit', $item->id)); ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('pendaftaran.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data pendaftaran</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\mahasiswa-uym\resources\views/pendaftaran/index.blade.php ENDPATH**/ ?>