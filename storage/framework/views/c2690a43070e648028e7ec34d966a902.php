

<?php $__env->startSection('title', 'Descubre el Significado Profundo de tu Nombre'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">
                    Descubre el <span class="text-warning">Significado Secreto</span> de tu Nombre
                </h1>
                <p class="lead mb-5 fs-5">
                    Cada nombre tiene una historia única. Descubre su significado etimológico, 
                    conexión bíblica y simbolismo espiritual en una experiencia transformadora.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="search-card p-4 p-md-5 mb-5">
                <div class="text-center mb-4">
                    <div class="feature-icon pulse-animation">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2 class="section-title">Buscar Significado</h2>
                    <p class="text-muted">Ingresa un nombre simple o compuesto para descubrir su profundo significado</p>
                </div>
                
                <div class="card-body">
                    <?php if(session('pending_search')): ?>
                        <div class="alert alert-info glass-effect border-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Continúa con tu búsqueda de: <strong><?php echo e(session('pending_search')); ?></strong>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('name.search.post')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label for="name" class="form-label fs-6 fw-bold text-dark mb-3">
                                <i class="fas fa-user me-2 text-primary"></i>Nombre a buscar:
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg border-2 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="name" 
                                   name="name" 
                                   value="<?php echo e(old('name', session('pending_search'))); ?>"
                                   placeholder="Ej: María, Juan Carlos, Ana Sofía..." 
                                   style="border-color: #e2e8f0; border-radius: 12px; padding: 15px;"
                                   required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fs-6 fw-bold pulse-animation">
                                <i class="fas fa-crystal-ball me-2"></i>Descubrir Significado Espiritual
                            </button>
                        </div>
                    </form>

                    <?php if(auth()->guard()->check()): ?>
                        <div class="mt-4 text-center">
                            <div class="glass-effect p-3 rounded-3">
                                <i class="fas fa-chart-line me-2 text-primary"></i>
                                <span class="fw-bold">Has realizado <?php echo e(Auth::user()->search_count); ?> búsquedas</span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="mt-4 alert alert-warning glass-effect border-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Nota:</strong> Debes registrarte para ver los resultados completos de la búsqueda.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="row mt-5">
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Significado Etimológico</h5>
                    <p class="text-muted">Descubre el origen histórico y lingüístico de tu nombre con análisis profesional</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon gradient-secondary">
                        <i class="fas fa-cross"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Conexión Bíblica</h5>
                    <p class="text-muted">Explora las referencias y simbolismo en la tradición cristiana católica</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon gradient-warning">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Interpretación Espiritual</h5>
                    <p class="text-muted">Comprende el significado profundo y propósito espiritual de tu nombre</p>
                </div>
            </div>

            <!-- Testimonials Section Corregida -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-center mb-5">
                        <h3 class="section-title">Lo que dicen nuestros usuarios</h3>
                        <p class="text-muted mb-4">Descubre las experiencias de quienes ya encontraron el significado de sus nombres</p>
                    </div>
                    
                    <div class="row justify-content-center">
                        <!-- Testimonio 1 -->
                        <div class="col-lg-10 mb-4">
                            <div class="testimonial-item">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="testimonial-avatar bg-primary me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">María González</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>Hace 2 días
                                        </small>
                                    </div>
                                </div>
                                <p class="testimonial-text mb-0">
                                    "Descubrí un significado tan profundo en mi nombre que me emocioné. 
                                    La conexión espiritual que encontré fue increíble. ¡Recomiendo esta 
                                    experiencia a todos!"
                                </p>
                            </div>
                        </div>

                        <!-- Testimonio 2 -->
                        <div class="col-lg-10 mb-4">
                            <div class="testimonial-item">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="testimonial-avatar bg-success me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Carlos Rodríguez</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>Hace 1 semana
                                        </small>
                                    </div>
                                </div>
                                <p class="testimonial-text mb-0">
                                    "La conexión bíblica de mi nombre me ayudó a entender mejor mi fe 
                                    y propósito de vida. El análisis fue muy completo y profesional."
                                </p>
                            </div>
                        </div>

                        <!-- Testimonio 3 -->
                        <div class="col-lg-10 mb-4">
                            <div class="testimonial-item">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="testimonial-avatar bg-warning me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Ana Martínez</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>Hace 3 días
                                        </small>
                                    </div>
                                </div>
                                <p class="testimonial-text mb-0">
                                    "Compartí los resultados con mi familia y todos quedaron asombrados. 
                                    El servicio es excelente y los significados son muy precisos."
                                </p>
                            </div>
                        </div>

                        <!-- Testimonio 4 -->
                        <div class="col-lg-10 mb-4">
                            <div class="testimonial-item">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="testimonial-avatar bg-info me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">David López</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>Hace 5 días
                                        </small>
                                    </div>
                                </div>
                                <p class="testimonial-text mb-0">
                                    "Increíble precisión en los significados. Me ayudó a comprender 
                                    aspectos de mi personalidad que nunca había relacionado con mi nombre."
                                </p>
                            </div>
                        </div>

                        <!-- Testimonio 5 -->
                        <div class="col-lg-10 mb-4">
                            <div class="testimonial-item">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="testimonial-avatar bg-danger me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Laura Sánchez</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>Hace 1 semana
                                        </small>
                                    </div>
                                </div>
                                <p class="testimonial-text mb-0">
                                    "El análisis espiritual fue tan profundo que me hizo reflexionar 
                                    sobre mi camino de vida. Una experiencia verdaderamente transformadora."
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas de confianza -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card glass-effect border-0">
                                <div class="card-body py-4">
                                    <div class="row text-center">
                                        <div class="col-md-3">
                                            <h3 class="fw-bold text-primary mb-1">500+</h3>
                                            <p class="text-muted mb-0">Reseñas verificadas</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="fw-bold text-success mb-1">4.9/5</h3>
                                            <p class="text-muted mb-0">Calificación promedio</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="fw-bold text-warning mb-1">1,200+</h3>
                                            <p class="text-muted mb-0">Nombres analizados</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="fw-bold text-info mb-1">98%</h3>
                                            <p class="text-muted mb-0">Satisfacción</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tu\resources\views/name-search.blade.php ENDPATH**/ ?>