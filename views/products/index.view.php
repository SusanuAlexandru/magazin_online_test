<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include __DIR__ . '/../users/nav.view.php'; ?>


    <div class="container my-5">
        <div class="row py-2 justify-content-center h5">
            List all products
        </div>

        <!-- Button to navigate to the "Add New Product" form -->
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="/products/create" class="btn btn-success">Add New Product</a>
                <a href="/categories/create" class="btn btn-success">Add New Category</a>
            </div>
        </div>

        <!-- Card wrapped around products data -->
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Product List</h5>
                    </div>
                    <div class="card-body">
                        <?php if($products->count() > 0): ?>
                            <?php foreach($products as $product): ?>
                                <div class="mb-3">
                                    <h5><?= htmlspecialchars($product->name) ?></h5>
                                    <p><strong>Description:</strong> <?= htmlspecialchars($product->description) ?></p>
                                    <p><strong>Price:</strong> <?= $product->price ?> MDL</p>
                                    <p><strong>Stock:</strong> <?= $product->stock ?></p>
                                    <p><strong>Brand:</strong> <?= htmlspecialchars($product->brand) ?></p>
                                    <p><strong>Category:</strong> <?= $product->category ? $product->category->name : 'No category' ?></p>
                                    <div class="d-flex my-4">
                                        <a href="/products/edit/<?= $product->id ?>" class="btn btn-warning btn-sm me-2">Edit</a>
                                        <a href="/products/show/<?=$product->id?>" class="btn btn-info btn-sm me-2">Show</a>
                                        <form action="/products/delete/<?= $product->id ?>" method="post" style="display:inline;">
                                            <input type="hidden" name="_METHOD" value="DELETE"/>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>There are no products available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
