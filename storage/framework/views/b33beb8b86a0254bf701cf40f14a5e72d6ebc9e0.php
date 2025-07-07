

<?php $__env->startSection('title', 'Data Nilai'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>Data Nilai Mahasiswa
                    </h4>
                    <a href="<?php echo e(route('nilai.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Nilai
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
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Mata Kuliah</th>
                                    <th>Semester</th>
                                    <th>Nilai Tugas</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    <th>Nilai Akhir</th>
                                    <th>Grade</th>
                                    <th>Dosen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <span class="badge badge-info"><?php echo e($item->mahasiswa->nim); ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-graduate me-2 text-primary"></i>
                                            <?php echo e($item->mahasiswa->nama); ?>

                                        </div>
                                    </td>
                                    <td><?php echo e($item->mata_kuliah); ?></td>
                                    <td>
                                        <span class="badge badge-warning">Semester <?php echo e($item->semester); ?></span>
                                    </td>
                                    <td><?php echo e($item->nilai_tugas); ?></td>
                                    <td><?php echo e($item->nilai_uts); ?></td>
                                    <td><?php echo e($item->nilai_uas); ?></td>
                                    <td>
                                        <strong><?php echo e($item->nilai_akhir); ?></strong>
                                    </td>
                                    <td>
                                        <?php if($item->grade == 'A'): ?>
                                            <span class="badge badge-success"><?php echo e($item->grade); ?></span>
                                        <?php elseif($item->grade == 'B'): ?>
                                            <span class="badge badge-info"><?php echo e($item->grade); ?></span>
                                        <?php elseif($item->grade == 'C'): ?>
                                            <span class="badge badge-warning"><?php echo e($item->grade); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php echo e($item->grade); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher me-2 text-success"></i>
                                            <?php echo e($item->dosen->nama); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('nilai.edit', $item->id)); ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('nilai.destroy', $item->id)); ?>" method="POST" class="d-inline">
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
                                    <td colspan="12" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data nilai</p>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\mahasiswa-uym\resources\views/nilai/index.blade.php ENDPATH**/ ?>