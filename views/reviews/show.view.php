    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-rew {
            margin-top: 50px;
        }
        .form-title {
            text-align: center;
            color: #495057;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
        }
        .btn-dark:hover {
            background-color: #495057;
            border-color: #495057;
        }
        .alert {
            text-align: center;
        }
        .review-details {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .rating {
            font-size: 20px;
            color: #f39c12;
        }
        .comment {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container-rew">
        <div class="form-title">
            Detalii Recenzie pentru Produsul #<?= htmlspecialchars($review->product_id) ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="review-details">
                <?php if (isset($review)): ?>
                    <div class="mb-3">
                    <strong>Rating:</strong>
                <span class="rating">
                <?php
                    // Creăm un array cu 5 stele (poziții)
                    $stars = [1, 2, 3, 4, 5];
                    // Iterăm prin array pentru a crea stelele
                    foreach ($stars as $star) {
                        if ($star <= $review->rating) {
                            echo "★"; // Stea plină
                        } else {
                            echo "☆"; // Stea goală
                        }
                    }
                ?>
                </span>
            </div>

        <div class="mb-3">
        <strong>Comentariu:</strong>
        <p class="comment"><?= nl2br(htmlspecialchars($review->comment)) ?></p>
    </div>
<?php else: ?>
    <p>Recenzia nu a fost găsită.</p>
<?php endif; ?>



                    <div class="text-center">
                        <a href="/" class="btn btn-dark">Înapoi la recenzii</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
