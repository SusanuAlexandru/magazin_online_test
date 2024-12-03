<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class ProductController
{
    public function index(Request $request, Response $response, $args)
    {
        $products = Product::all();
        ob_start();
        require '../views/products/index.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function create(Request $request, Response $response, $args)
    {
        
        $categories = Category::all();
        ob_start();
        require '../views/products/create.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function store(Request $request, Response $response, $args)
    {
        $product = $request->getParsedBody();
       
         // Verifică dacă fișierul imagine a fost încărcat
        $uploadedFiles = $request->getUploadedFiles();
        $image = $uploadedFiles['image'] ?? null;

        if ($image && $image->getError() === UPLOAD_ERR_OK) {
        // Nume unic pentru imagine
        $filename = uniqid() . '_' . $image->getClientFilename();
        $targetPath = '../public/uploads/' . $filename;

        // Mută fișierul în directorul de destinație
        $image->moveTo($targetPath);

        // Adaugă calea imaginii în datele produsului
        $product['image'] = $filename;
        } 
        
        Product::create($product);
        
        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }

    public function edit(Request $request, Response $response, $args)
    {
        $categories = Category::all();
        $product = Product::find($args['id']);
        ob_start();
        require '../views/products/edit.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function update(Request $request, Response $response, $args)
    {
        // Obține datele trimise prin formular
        $data = $request->getParsedBody();
        
        // Găsește produsul în funcție de ID
        $product = Product::find($args['id']);
        
        // Verificăm dacă s-a trimis o imagine nouă
        $uploadedFiles = $request->getUploadedFiles();
        $image = $uploadedFiles['image'] ?? null;
        
        // Dacă există o imagine nouă, o actualizăm
        if ($image && $image->getError() === UPLOAD_ERR_OK) {
            // Generează un nume unic pentru imagine
            $filename = uniqid() . '_' . $image->getClientFilename();
            $targetPath = '../public/uploads/' . $filename;
            
            // Mută fișierul în directorul de destinație
            $image->moveTo($targetPath);
            
            // Setează noul nume al imaginii
            $product->image = $filename;
        }else {
            // Gestionarea erorilor (opțional)
            $product['image'] = 'default.png'; // Imagine implicită
        }
        
        // Actualizăm restul câmpurilor
        $product->fill($data);
        
        // Salvăm produsul actualizat
        $product->save();
        
        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }
    

    public function delete(Request $request, Response $response, $args)
    {
        $product = Product::find($args['id']);
        $product->delete();
        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }

    public function show(Request $request, Response $response, $args)
    {
        
        $product = Product::find($args['id']);
        if (!$product) {
            return $response->withStatus(404)->write('Produsul nu a fost găsit');
        }
        ob_start();
        require '../views/products/show.view.php'; // Asigură-te că fișierul corect este încărcat
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    
    public function search(Request $request, Response $response, $args)
    {
        // Obține parametrii de căutare
        $queryParams = $request->getQueryParams();
        $searchTerm = $queryParams['search'] ?? '';

        // Caută produsele după nume, categorie sau sport
        $products = Product::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('category', 'LIKE', "%{$searchTerm}%")
            ->orWhere('sport', 'LIKE', "%{$searchTerm}%")
            ->get();

        ob_start();
        require '../views/products/search.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function filter(Request $request, Response $response, $args)
    {
        // Obține parametrii de filtrare
        $queryParams = $request->getQueryParams();
        $products = Product::query();

        if (!empty($queryParams['type'])) {
            $products = $products->where('type', $queryParams['type']);
        }
        if (!empty($queryParams['price_min'])) {
            $products = $products->where('price', '>=', $queryParams['price_min']);
        }
        if (!empty($queryParams['price_max'])) {
            $products = $products->where('price', '<=', $queryParams['price_max']);
        }
        if (!empty($queryParams['brand'])) {
            $products = $products->where('brand', $queryParams['brand']);
        }
        if (!empty($queryParams['sport'])) {
            $products = $products->where('sport', $queryParams['sport']);
        }

        $products = $products->get();

        ob_start();
        require '../views/products/filter.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }
}
