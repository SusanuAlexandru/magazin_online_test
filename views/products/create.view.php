<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include __DIR__ . '/../users/nav.view.php'; ?>
    <div class="container">
        <div class="row py-2 justify-content-center h5">
            Add New Product
        </div>
        <div class="row">
            <div class="col-md-6 m-auto">
                <form action="/products/store" method="post">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                    
                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                    </div>
                    
                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" required>
                    </div>
                    
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php if (isset($categories) && count($categories) > 0): ?>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name) ?></option>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <option value="">No categories available</option>
                        <?php endif; ?>
                        </select>
                    </div>
                    
                    <!-- Brand -->
                    <div class="mb-3">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn btn-dark btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
