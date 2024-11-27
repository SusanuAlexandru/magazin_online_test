<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;

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
        Product::create($product);
        return $response
            ->withHeader('Location', '/products')
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
        $data = $request->getParsedBody();
        $product = Product::find($args['id']);
        $product->fill($data);
        $product->save();
        return $response
            ->withHeader('Location', '/products')
            ->withStatus(302);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $product = Product::find($args['id']);
        $product->delete();
        return $response
            ->withHeader('Location', '/products')
            ->withStatus(302);
    }

    public function show(Request $request, Response $response, $args)
    {
        $product = Product::find($args['id']);
        ob_start();
        require '../views/products/show.view.php';
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
