<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilizator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'nav.view.php'; ?>
    <div class="container">
        <h1>Profilul Utilizatorului</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']); ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <h2>Bun venit, <?= htmlspecialchars($user->name); ?>!</h2>

        <p><strong>Email:</strong> <?= htmlspecialchars($user->email); ?></p>

        <a href="/editPassword" class="btn btn-secondary">Schimbă parola</a>

        <a href="/logout" class="btn btn-danger">Deconectare</a>
    </div>
</body>
</html>
