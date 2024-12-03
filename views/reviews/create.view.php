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
        select, textarea {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container-rew">
        <div class="form-title">
            Add Review for Product #<?= htmlspecialchars($productId) ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['message']) ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>

                    <form action="/reviews/store/{product_id}<?= htmlspecialchars($productId) ?>" method="post">
                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating:</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="">Selectează un rating</option>
                                <option value="1">1 - Foarte slab</option>
                                <option value="2">2 - Slab</option>
                                <option value="3">3 - Mediu</option>
                                <option value="4">4 - Bun</option>
                                <option value="5">5 - Excelent</option>
                            </select>
                        </div>

                        <!-- Comment -->
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comentariu:</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Scrie aici comentariul tău..." required></textarea>
                        </div>

                        <!-- Submit button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark btn-lg w-100">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
