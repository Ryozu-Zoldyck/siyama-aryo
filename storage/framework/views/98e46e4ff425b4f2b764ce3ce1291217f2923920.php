

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Nilai Saya</h4>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($nilai->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Nilai Tugas</th>
                                        <th>Nilai UTS</th>
                                        <th>Nilai UAS</th>
                                        <th>Nilai Akhir</th>
                                        <th>Grade</th>
                                        <th>Dosen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($item->mata_kuliah); ?></td>
                                        <td><?php echo e($item->semester); ?></td>
                                        <td><?php echo e($item->nilai_tugas); ?></td>
                                        <td><?php echo e($item->nilai_uts); ?></td>
                                        <td><?php echo e($item->nilai_uas); ?></td>
                                        <td><?php echo e($item->nilai_akhir); ?></td>
                                        <td>
                                            <span class="badge badge-<?php echo e($item->grade == 'A' ? 'success' : ($item->grade == 'B' ? 'info' : ($item->grade == 'C' ? 'warning' : 'danger'))); ?>">
                                                <?php echo e($item->grade); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($item->dosen->nama); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Statistik Nilai</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Total Mata Kuliah:</strong> <?php echo e($nilai->count()); ?></p>
                                        <p><strong>Rata-rata Nilai Akhir:</strong> <?php echo e(number_format($nilai->avg('nilai_akhir'), 2)); ?></p>
                                        <p><strong>Nilai Tertinggi:</strong> <?php echo e($nilai->max('nilai_akhir')); ?></p>
                                        <p><strong>Nilai Terendah:</strong> <?php echo e($nilai->min('nilai_akhir')); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Distribusi Grade</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $gradeA = $nilai->where('grade', 'A')->count();
                                            $gradeB = $nilai->where('grade', 'B')->count();
                                            $gradeC = $nilai->where('grade', 'C')->count();
                                            $gradeD = $nilai->where('grade', 'D')->count();
                                            $gradeE = $nilai->where('grade', 'E')->count();
                                        ?>
                                        <p><span class="badge badge-success">A:</span> <?php echo e($gradeA); ?> mata kuliah</p>
                                        <p><span class="badge badge-info">B:</span> <?php echo e($gradeB); ?> mata kuliah</p>
                                        <p><span class="badge badge-warning">C:</span> <?php echo e($gradeC); ?> mata kuliah</p>
                                        <p><span class="badge badge-danger">D:</span> <?php echo e($gradeD); ?> mata kuliah</p>
                                        <p><span class="badge badge-danger">E:</span> <?php echo e($gradeE); ?> mata kuliah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <h5>Belum ada data nilai</h5>
                            <p class="text-muted">Nilai Anda akan muncul di sini setelah dosen menginput nilai.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\mahasiswa-uym\resources\views/nilai/cek.blade.php ENDPATH**/ ?>