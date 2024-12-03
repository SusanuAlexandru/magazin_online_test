<?php

namespace App\Controllers;

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;

class ReviewController
{
    // Afișează toate recenziile pentru un produs
    public function index(Request $request, Response $response, $args)
    {
        $productId = $args['product_id'];
        
        $reviews = Review::where('product_id', $productId)
                 ->orderBy('review_date', 'desc')
                 ->get();

        $user = User::find($_SESSION['user_id'] ?? null);
        ob_start();
        require '../views/reviews/index.view.php'; // Fișierul de vizualizare pentru recenzii
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Afișează formularul pentru adăugarea unei recenzii
    public function create(Request $request, Response $response, $args)
    {
        // Obține ID-ul produsului din parametrii URL-ului
        $productId = $args['product_id'];
    
        // Asigură-te că produsul există (opțional, pentru validare suplimentară)
        $product = Product::find($productId);
        if (!$product) {
            return $response->withStatus(404)->write('Product not found');
        }
    
        // Transmite variabila $productId către fișierul de vizualizare
        ob_start();
        require '../views/reviews/create.view.php'; // Formular pentru recenzii
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }
    

    // Salvează o recenzie în baza de date
    public function store(Request $request, Response $response, $args)
    {
        // Obține ID-ul produsului din URL
        $productId = $args['product_id'];
        $product = Product::find($productId);
        // Verifică dacă utilizatorul este autentificat
        $userId = $_SESSION['user_id'] ?? null; // Presupunând că user_id este stocat în sesiune

        if (!$userId) {
            // Dacă nu este autentificat, redirecționează utilizatorul către pagina de login
            return $response->withHeader('Location', "/products/show/{$productId}")->withStatus(302);

        }

        // Obține datele din formular
        $data = $request->getParsedBody();
        $rating = $data['rating'] ?? null;
        $comment = $data['comment'] ?? null;

        // Creează și salvează recenzia
        $review = new Review();
        $review->product_id = $productId;
        $review->user_id = $userId; // Asociază utilizatorul cu recenzia
        $review->rating = $rating;
        $review->comment = $comment;
        $review->review_date = date('Y-m-d H:i:s'); // Data recenziei
        $review->save();

        // Redirecționează utilizatorul înapoi la pagina produsului
        return $response->withHeader('Location', "/products/show")->withStatus(302);
    }


    // Afișează o recenzie specifică
    public function show(Request $request, Response $response, $args)
    {
        // Căutăm recenzia pe baza ID-ului
        $review = Review::find($args['id']);

        // Verificăm dacă recenzia există
        if ($review === null) {
            $response->getBody()->write("Recenzia nu a fost găsită.");
            return $response;
        }

        // Pasăm recenzia la vizualizare
        ob_start();
        require '../views/reviews/show.view.php'; // Fișier pentru afișarea unei recenzii
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }


    // Afișează formularul pentru editarea unei recenzii
    public function edit(Request $request, Response $response, $args)
    {
        $review = Review::find($args['id']);

        ob_start();
        require '../views/reviews/edit.view.php'; // Formular pentru editare
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Actualizează o recenzie în baza de date
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $review = Review::find($args['id']);
        $review->rating = (int) $data['rating'];
        $review->comment = htmlspecialchars($data['comment']);
        $review->save();

        return $response->withHeader('Location', "/reviews/index/{$review->product_id}")->withStatus(302);
    }

    // Șterge o recenzie
    public function delete(Request $request, Response $response, $args)
    {
        $review = Review::find($args['id']);
        $review->delete();

        return $response->withHeader('Location', "/reviews/index/{$review->product_id}")->withStatus(302);
    }
}
