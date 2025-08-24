<?php $__env->startSection('content'); ?>
<?php if(session('ok')): ?>
    <div class="alert alert-success"><?php echo e(session('ok')); ?></div>
<?php endif; ?>

<form class="row g-2 mb-3">
    <div class="col">
        <input name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Search products...">
    </div>
    <div class="col">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c); ?>" <?php if(request('category')==$c): echo 'selected'; endif; ?>><?php echo e($c); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col">
        <input name="min_price" type="number" step="0.01" value="<?php echo e(request('min_price')); ?>" class="form-control" placeholder="Min Price">
    </div>
    <div class="col">
        <input name="max_price" type="number" step="0.01" value="<?php echo e(request('max_price')); ?>" class="form-control" placeholder="Max Price">
    </div>
    <div class="col">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<?php $dir = request('dir') === 'asc' ? 'desc' : 'asc'; ?>
<div class="mb-3">
    <a class="btn btn-outline-dark me-2" href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'name','dir'=>$dir])); ?>">
        Sort by Name
    </a>
    <a class="btn btn-outline-dark me-2" href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'price','dir'=>$dir])); ?>">
        Sort by Price
    </a>
    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-success">Add New Product</a>
</div>

<div class="row g-3">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($p->name); ?></h5>
                    <p class="text-muted"><?php echo e($p->category_name); ?></p>
                    <p class="card-text"><?php echo e(Str::limit($p->description, 100)); ?></p>
                    <p class="fw-bold text-success">$<?php echo e(number_format($p->price, 2)); ?></p>
                    <div class="btn-group w-100" role="group">
                        <button type="button" class="btn btn-primary view-details-btn" data-product-id="<?php echo e($p->id); ?>">
                            View Details
                        </button>
                        <a href="<?php echo e(route('products.edit', $p)); ?>" class="btn btn-outline-secondary">Edit</a>
                        <form action="<?php echo e(route('products.destroy', $p)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-4">
    <?php echo e($products->links()); ?>

</div>

<!-- Product Details Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="productModalBody">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="editProductBtn" class="btn btn-primary">Edit Product</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewDetailsBtns = document.querySelectorAll('.view-details-btn');
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    const modalBody = document.getElementById('productModalBody');
    const modalTitle = document.getElementById('productModalLabel');
    const editBtn = document.getElementById('editProductBtn');

    viewDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            
            // Show loading spinner
            modalBody.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
            
            // Show modal
            productModal.show();
            
            // Fetch product details
            fetch(`/products/${productId}/details`)
                .then(response => response.json())
                .then(data => {
                    modalTitle.textContent = data.name;
                    editBtn.href = `/products/${productId}/edit`;
                    
                    modalBody.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Product Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Name:</td>
                                        <td>${data.name}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Category:</td>
                                        <td><span class="badge bg-secondary">${data.category_name}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Price:</td>
                                        <td class="text-success fw-bold">$${parseFloat(data.price).toFixed(2)}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Timestamps</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Created:</td>
                                        <td>${data.created_at}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Updated:</td>
                                        <td>${data.updated_at}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-muted">Description</h6>
                            <div class="p-3 bg-light rounded">
                                ${data.description || '<em class="text-muted">No description available</em>'}
                            </div>
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalBody.innerHTML = `
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle"></i>
                            Error loading product details. Please try again.
                        </div>
                    `;
                });
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\oozyb\OneDrive\Desktop\Second Assignment\resources\views/products/index.blade.php ENDPATH**/ ?>