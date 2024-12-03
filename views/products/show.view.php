<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <?php include __DIR__ . '/../users/nav.view.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .product-card img {
            margin-top: 20px;
            border-radius: 30px;
            padding: 20px;
            width: 500px;
            height: auto;
        }
        .product-card {
            width: 1000px; /* Asigură-te că cardul ocupă întreaga lățime disponibilă */
            height: 500px; /* Poți ajusta înălțimea după cum dorești */
            margin: 0 auto; /* Centrează cardul pe pagină */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .card-title{
            margin-top: 30px;
            margin-left: 150px;
        }
        .card-text{
            margin-top: 30px;
            margin-left: 150px;
        }
        .btn-buy{
            margin-top: 30px;
            margin-left: 150px;
        }
        .link-review {
            margin-top: 30px; 
            display: block; /* Transformă link-ul în element bloc */
            text-align: center; /* Aliniază textul în centru */
            font-size: 16px;
            color: #007bff; /* Culoare albastră pentru link */
            text-decoration: none; /* Îndepărtează linia subliniată */
        }

        .link-review:hover {
            color: #0056b3; /* Schimbă culoarea la hover */
            text-decoration: underline; /* Adaugă subliniere la hover */
        }

    </style>
</head>
<body>

    <div class="container mt-5">
        <?php if ($product): ?>
        <div class="row justify-content-center">
            <div class="product-card-container"> <!-- Mărire card pe ecrane mari -->
                <div class="card product-card">
                    <div class="row g-0">
                        <!-- Imaginea produsului pe partea stângă -->
                        <div class="col-md-5">
                            <?php 
                                $imagePath = '/uploads/' . htmlspecialchars($product->image);
                            ?>
                            <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product->image) ?>" class="product-image-lg card-img">
                        </div>

                        <!-- Informațiile produsului pe partea dreaptă -->
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product->name); ?></h5>
                                <p class="card-text"><strong>Brand:</strong> <?php echo htmlspecialchars($product->brand); ?></p>
                                <p class="card-text"><strong>Categore:</strong> <?php echo htmlspecialchars($product->category->name); ?></p>
                                <p class="card-text"><strong>Descriere:</strong> <?php echo nl2br(htmlspecialchars($product->description)); ?></p>
                                <p class="card-text"><strong>Pret:</strong> <?php echo number_format($product->price, 2); ?> MDL</p>
                                <p class="card-text"><strong>Stock:</strong> <?php echo htmlspecialchars($product->stock); ?> items available</p>
                                <a href="/cart/add" class="btn btn-buy btn-primary">Adauga in cos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($product): ?>
            <?php endif; ?>
        <?php include __DIR__ . '/../reviews/create.view.php'; ?>
        <?php include __DIR__ . '/../reviews/show.view.php'; ?>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Sorry, the product you are looking for could not be found.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
