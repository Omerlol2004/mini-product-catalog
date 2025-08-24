<?php echo csrf_field(); ?>
<input name="name" value="<?php echo e(old('name',$product->name??'')); ?>" class="form-control mb-2" placeholder="Name">
<input name="category_name" value="<?php echo e(old('category_name',$product->category_name??'')); ?>" class="form-control mb-2" placeholder="Category">
<input type="number" step="0.01" name="price" value="<?php echo e(old('price',$product->price??'')); ?>" class="form-control mb-2" placeholder="Price">
<textarea name="description" class="form-control mb-2"><?php echo e(old('description',$product->description??'')); ?></textarea>
<button class="btn btn-primary"><?php echo e($btnText); ?></button><?php /**PATH C:\Users\oozyb\OneDrive\Desktop\Second Assignment\resources\views/products/_form.blade.php ENDPATH**/ ?>