<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilizator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .profile-container {
            margin-top: 50px;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            background: linear-gradient(90deg, #007bff, #6c757d);
            color: #fff;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }
        .btn-container a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include 'nav.view.php'; ?>

<div class="container d-flex justify-content-center">
    <div class="col-md-8 profile-container">
        <div class="profile-header text-center">
            <h1>Profil Utilizator</h1>
        </div>

        <div class="p-4">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success text-center">
                    <?= htmlspecialchars($_SESSION['success']); ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <h2 class="text-center mt-4">Bun venit, <strong><?= htmlspecialchars($user->name); ?></strong>!</h2>
            <p class="text-center"><strong>Email:</strong> <?= htmlspecialchars($user->email); ?></p>

            <div class="d-flex justify-content-center btn-container mt-4">
                <a href="/editPassword" class="btn btn-secondary">Schimbă parola</a>
                <a href="/logout" class="btn btn-danger">Deconectare</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
