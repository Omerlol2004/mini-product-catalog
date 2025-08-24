<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('products.index')); ?>">
                <i class="bi bi-shop"></i> Product Catalog
            </a>
            <div class="navbar-nav ms-auto">
                <a class="btn btn-light" href="<?php echo e(route('products.create')); ?>">
                    <i class="bi bi-plus-circle"></i> Add Product
                </a>
            </div>
        </div>
    </nav>
    
    <main class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\oozyb\OneDrive\Desktop\Second Assignment\resources\views/layouts/app.blade.php ENDPATH**/ ?>