<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin Echipamente Sportive</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero-section {
            background: url('https://images.pexels.comw/photos/863988/pexels-photo-863988.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') no-repeat center center/cover;
            color: black;
            padding: 200px 0;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .card img {
            transition: transform 0.3s ease;
        }
        .card img:hover {
            transform: scale(1.05);
        }
        .review-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #212529;
            color: #adb5bd;
        }
        footer a {
            color: #ffc107;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include 'nav.view.php'; ?>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <h1>Transformă-ți pasiunea în performanță!</h1>
            <p class="lead mt-3">Descoperă echipamente sportive de top pentru fiecare sport.</p>
        </div>
    </header>
    <?php
        include __DIR__ . '/../products/index.view.php';
    ?>

    <!-- Secțiune Recenzii -->
    <section class="py-5 bg-light">
        <div class="container"  id="reviews-section">
            <h2 class="text-center mb-5">Ce spun clienții noștri</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="review-card text-center">
                        <p>"Livrare rapidă și produse de calitate. Recomand cu încredere!"</p>
                        <strong>- Maria Popescu</strong>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="review-card text-center">
                        <p>"Prețuri competitive și o selecție excelentă de produse."</p>
                        <strong>- Ion Ionescu</strong>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="review-card text-center">
                        <p>"Echipamentele cumpărate sunt perfecte pentru sportul meu preferat!"</p>
                        <strong>- Ana Georgescu</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-center">
        <div class="container">
            <p>&copy; 2024 SportStore. Toate drepturile rezervate.</p>
            <a href="#">Termeni și Condiții</a> | <a href="#">Politica de Confidențialitate</a>
        </div>
    </footer>

</body>
</html>
