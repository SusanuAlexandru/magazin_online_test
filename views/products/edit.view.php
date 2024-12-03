<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include __DIR__ . '/../users/nav.view.php'; ?>
    <div class="container">
        <div class="row py-2 justify-content-center h5">
            Edit Product
        </div>
        <div class="row">
            <div class="col-md-6 m-auto">
                <!-- Form to update product -->
                <form action="/products/update/<?=$product->id?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_METHOD" value="PUT" />
                    <!-- Img -->
                    <div class="mb-3">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label>Current Image</label><br>
                        <?php
                            // Verifică dacă imaginea există sau folosește imaginea implicită
                            $currentImage = (!empty($product->image) && file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $product->image)) ? $product->image : 'default.png';
                        ?>
                        <img src="public/uploads/<?= htmlspecialchars($currentImage) ?>" alt="Product Image"
                            class="img-fluid" style="max-height: 200px;">
                    </div>
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product->name) ?>" required>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required><?= htmlspecialchars($product->description) ?></textarea>
                    </div>
                    
                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" value="<?= $product->price ?>" required>
                    </div>
                    
                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" value="<?= $product->stock ?>" required>
                    </div>
                    
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            <?php if (isset($categories) && count($categories) > 0): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>" <?= ($product->category_id == $category->id) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">No categories available</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <!-- Brand -->
                    <div class="mb-3">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" value="<?= htmlspecialchars($product->brand) ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-dark btn-sm">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
