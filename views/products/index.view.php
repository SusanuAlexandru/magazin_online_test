<style>
    body {
        background-color: #f3f4f6;
    }
    .card {
        
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .card img {
        border-bottom: 2px solid #007bff;
        height: 200px;
        object-fit: cover;
    }
    .card-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #007bff;
    }
    .card-text {
        color: #6c757d;
        margin-bottom: 1rem;
    }
    .price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #28a745;
    }
    .btn {
        border-radius: 30px;
    }
    .btn-sm {
        padding: 0.4rem 1rem;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="row mb-4 text-center">
        <div class="col">
            <h1 class="text-dark">Product Catalog</h1>
        </div>
    </div>

    <!-- Buttons to navigate to "Add New Product" and "Add New Category" -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="/products/create" class="btn btn-success me-2">Add New Product</a>
            <a href="/categories/create" class="btn btn-success">Add New Category</a>
        </div>
    </div>

    <!-- Product cards -->
    <div class="row g-4">
        <?php if ($products->count() > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3">
                    <div class="card">
                        <!-- Product Image -->
                        <?php
                            $imagePath = '/uploads/' . htmlspecialchars($product->image);
                            // Verifică dacă fișierul imagine există
                            
                        ?>
                        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product->image) ?>" class="card-img-top">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product->name) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product->description) ?></p>
                            <p class="price"><?= $product->price ?> MDL</p>
                            <div class="d-flex justify-content gap-1">
                                <a href="/products/edit/<?= $product->id ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/products/show/<?= $product->id ?>" class="btn btn-info btn-sm">View</a>
                                <form action="/products/delete/<?= $product->id ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="_METHOD" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">There are no products available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
