<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Controllers\ReviewController;
use App\Controllers\OrderController;


$app->get('/products', [ProductController::class, 'index']); 
$app->get('/products/create', [ProductController::class, 'create']);
$app->post('/products/store', [ProductController::class, 'store']); 
$app->get('/products/edit/{id}', [ProductController::class, 'edit']); 
$app->put('/products/update/{id}', [ProductController::class, 'update']); 
$app->delete('/products/delete/{id}', [ProductController::class, 'delete']); 
$app->get('/products/show/{id}', [ProductController::class, 'show']); 
$app->get('/products/search', [ProductController::class, 'search']); 
$app->get('/products/filter', [ProductController::class, 'filter']);
 

$app->get('/categories', [CategoryController::class, 'index']);  // Afișează lista de categorii
$app->get('/categories/create', [CategoryController::class, 'create']);  // Afișează formularul de creare categorie
$app->post('/categories/store', [CategoryController::class, 'store']);  // Salvează o categorie nouă
$app->get('/categories/edit/{id}', [CategoryController::class, 'edit']);  // Afișează formularul de editare pentru o categorie
$app->put('/categories/update/{id}', [CategoryController::class, 'update']);  // Actualizează o categorie existentă
$app->delete('/categories/delete/{id}', [CategoryController::class, 'delete']);  // Șterge o categorie
$app->get('/categories/show/{id}', [CategoryController::class, 'show']);  // Afișează detaliile unei categorii

//$app->redirect('/', '/index');
$app->get('/',[UserController::class, 'index']);
$app->get('/login', [UserController::class, 'login']);
$app->get('/register', [UserController::class, 'register']);
$app->post('/authenticate', [UserController::class, 'authenticate']);
$app->get('/profile', [UserController::class, 'profile']);
$app->get('/logout', [UserController::class, 'logout']);
$app->post('/store', [UserController::class, 'store']);
$app->get('/editPassword', [UserController::class, 'editPassword']);
$app->post('/updatePassword', [UserController::class, 'updatePassword']);

$app->get('/reviews/index/{product_id}', [ReviewController::class, 'index']); // Afișează recenziile unui produs
$app->get('/reviews/create/{product_id}', [ReviewController::class, 'create']); // Formular pentru adăugarea unei recenzii
$app->post('/reviews/store/{product_id}', [ReviewController::class, 'store']); // Salvează o nouă recenzie
$app->get('/reviews/show/{id}', [ReviewController::class, 'show']); // Afișează o recenzie specifică
$app->get('/reviews/edit/{id}', [ReviewController::class, 'edit']); // Formular pentru editarea unei recenzii
$app->post('/reviews/update/{id}', [ReviewController::class, 'update']); // Actualizează o recenzie
$app->delete('/reviews/delete/{id}', [ReviewController::class, 'delete']); // Șterge o recenzie 

$app->get('/cart', [OrderController::class, 'cart']); // Afișează coșul de cumpărături
$app->post('/cart/add', [OrderController::class, 'addToCart']); // Adaugă un produs în coș
$app->post('/cart/update', [OrderController::class, 'updateCart']); // Actualizează cantitatea produselor în coș
$app->get('/cart/remove/{product_id}', [OrderController::class, 'removeFromCart']); // Șterge un produs din coș
$app->post('/order/store', [OrderController::class, 'store']); // Creează o comandă din coșul de cumpărături
$app->get('/orders', [OrderController::class, 'index']); // Afișează comenzile utilizatorului
$app->get('/orders/show/{id}', [OrderController::class, 'show']); // Afișează detaliile unei comenzi
