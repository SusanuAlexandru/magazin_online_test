<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../users/nav.view.php'; ?>
    <div class="container mt-5">
        <?php if ($product): ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="row g-0">
                        <!-- Imaginea produsului (poți lăsa un loc de imagine implicit) -->
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product->name); ?></h5>
                                <p class="card-text"><strong>Brand:</strong> <?php echo htmlspecialchars($product->brand); ?></p>
                                <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($product->category->name); ?></p>
                                <p class="card-text"><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($product->description)); ?></p>
                                <p class="card-text"><strong>Price:</strong> <?php echo number_format($product->price, 2); ?> MDL</p>
                                <p class="card-text"><strong>Stock:</strong> <?php echo htmlspecialchars($product->stock); ?> items available</p>
                                <a href="#" class="btn btn-primary btn-sm">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Sorry, the product you are looking for could not be found.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
