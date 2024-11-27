<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']); // Verifică dacă utilizatorul este conectat
$userName = $isLoggedIn ? $_SESSION['user_name'] : null; // Numele utilizatorului (opțional)
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">SprintX</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if (isset($categories) && count($categories) > 0): ?>
                <?php foreach ($categories as $category): ?>
                <li><a class="dropdown-item" href="/category/<?= $category->id ?>"><?= htmlspecialchars($category->name) ?></a></li>
                <?php endforeach; ?>
                <?php else: ?>
                <li><a class="dropdown-item" href="#">No categories available</a></li>
                <?php endif; ?>
            </ul>


        </li>
        <li class="nav-item">
          <a class="nav-link" href="/despre">Review</a>
        </li>
        
        <?php if ($isLoggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="/profile">Profil (<?php echo htmlspecialchars($userName); ?>)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">Log Out</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="/login">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Sign Up</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
