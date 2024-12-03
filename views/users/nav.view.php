<?php
use App\Models\Category;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$categories = Category::all();
$isLoggedIn = isset($_SESSION['user_id']); // Verifică dacă utilizatorul este conectat
$userName = $isLoggedIn ? $_SESSION['user_name'] : null; // Numele utilizatorului (opțional)
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
    .navbar {
        background-color: black;
        padding: 15px 20px;
    }
    .navbar .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #fff !important;
    }
    .navbar .nav-link {
        color: #f8f9fa !important;
        margin-right: 15px;
        transition: color 0.3s ease;
    }
    .navbar .nav-link:hover {
        color: #ffc107 !important;
    }
    .navbar .dropdown-menu {
        border-radius: 10px;
        background-color: #f8f9fa;
    }
    .navbar .dropdown-item {
        color: #212529;
        transition: background-color 0.3s ease;
    }
    .navbar .dropdown-item:hover {
        background-color: #007bff;
        color: #fff;
    }
    .navbar .nav-item .btn {
        margin-left: 10px;
    }
    .navbar-toggler {
        border-color: #f8f9fa;
    }
    .navbar-toggler-icon {
        background-color: #f8f9fa;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/">SprintX</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#product-section">Products</a>
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
          <a class="nav-link" href="#reviews-section">Review</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fa fa-shopping-cart" style="font-size:25px;color:white" href="/cart"></a>
        </li>
        
        <?php if ($isLoggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="/profile">Profil (<?php echo htmlspecialchars($userName); ?>)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-danger text-white" href="/logout">Log Out</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link btn btn-light text-dark" href="/login">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-white" href="/register">Sign Up</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
