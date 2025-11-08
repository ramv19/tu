

<?php $__env->startSection('title', 'Mi Historial de Búsquedas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 fw-bold text-primary mb-4">
                <i class="fas fa-history me-2"></i>Mi Historial de Búsquedas
            </h1>

            <?php if($searches->count() > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 mb-4">
                            <div class="card card-hover h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><?php echo e($search->name); ?></h5>
                                    <small class="text-muted">Buscado el <?php echo e($search->created_at->format('d/m/Y H:i')); ?></small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>Significado:</strong> 
                                        <?php echo e(Str::limit(strip_tags($search->etimologia), 150)); ?>

                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">
                                            <?php echo e($search->comments->count()); ?> Comentarios
                                        </span>
                                        <a href="<?php echo e(route('name.search')); ?>?name=<?php echo e(urlencode($search->name)); ?>" 
                                           class="btn btn-outline-primary btn-sm">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">No has realizado ninguna búsqueda</h3>
                    <p class="text-muted">Comienza a explorar los significados de los nombres</p>
                    <a href="<?php echo e(route('name.search')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-search me-2"></i>Realizar Primera Búsqueda
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tu\resources\views/search-history.blade.php ENDPATH**/ ?>