<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;


$app->redirect('/', '/products');
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

$app->get('/login', [UserController::class, 'login']);
$app->get('/register', [UserController::class, 'register']);
$app->post('/authenticate', [UserController::class, 'authenticate']);
$app->get('/profile', [UserController::class, 'profile']);
$app->get('/logout', [UserController::class, 'logout']);
$app->post('/store', [UserController::class, 'store']);
$app->get('/editPassword', [UserController::class, 'editPassword']);
$app->post('/updatePassword', [UserController::class, 'updatePassword']);