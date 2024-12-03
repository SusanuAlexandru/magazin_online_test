<?php
namespace App\Controllers;

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController
{
    // Afișează coșul de cumpărături
    public function cart(Request $request, Response $response)
    {
        
        $cart = $_SESSION['cart'] ?? []; // Preia coșul din sesiune

        ob_start();
        require_once '../views/orders/cart.view.php'; // Vizualizare coș
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Adaugă un produs în coș
    public function addToCart(Request $request, Response $response)
    {
        
        $data = $request->getParsedBody();

        $productId = (int) $data['product_id'];
        $quantity = (int) $data['quantity'];

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = [
                'product_id' => $productId,
                'quantity' => 0,
            ];
        }

        $_SESSION['cart'][$productId]['quantity'] += $quantity;

        return $response->withHeader('Location', '/cart')->withStatus(302);
    }

    // Actualizează cantitatea unui produs în coș
    public function updateCart(Request $request, Response $response)
    {
        
        $data = $request->getParsedBody();

        foreach ($data['cart'] as $productId => $quantity) {
            $productId = (int) $productId;
            $quantity = max(0, (int) $quantity);

            if ($quantity === 0) {
                unset($_SESSION['cart'][$productId]); // Elimină produsul dacă cantitatea e 0
            } else {
                $_SESSION['cart'][$productId]['quantity'] = $quantity;
            }
        }

        return $response->withHeader('Location', '/cart')->withStatus(302);
    }

    // Șterge un produs din coș
    public function removeFromCart(Request $request, Response $response, $args)
    {
        
        $productId = (int) $args['product_id'];

        unset($_SESSION['cart'][$productId]); // Elimină produsul din coș

        return $response->withHeader('Location', '/cart')->withStatus(302);
    }

    // Creează o comandă din coșul de cumpărături
    public function store(Request $request, Response $response)
    {
        
        $userId = $_SESSION['user_id'] ?? null;
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            $_SESSION['error'] = 'Coșul de cumpărături este gol.';
            return $response->withHeader('Location', '/cart')->withStatus(302);
        }

        // Creează comanda
        $order = new Order();
        $order->user_id = $userId;
        $order->status = 'Pending';
        $order->save();

        // Adaugă produsele în tabelul `order_items`
        foreach ($cart as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->save();
        }

        unset($_SESSION['cart']); // Golește coșul după plasarea comenzii

        return $response->withHeader('Location', "/orders/show/{$order->id}")->withStatus(302);
    }

    // Afișează comenzile utilizatorului
    public function index(Request $request, Response $response)
    {
        
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $orders = Order::where('user_id', $userId)->get();

        ob_start();
        require_once '../views/orders/index.view.php'; // Vizualizare comenzi
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Afișează detaliile unei comenzi
    public function show(Request $request, Response $response, $args)
    {
        $orderId = $args['id'];
       
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $order = Order::find($orderId);
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        ob_start();
        require_once '../views/orders/details.view.php'; // Vizualizare detalii comandă
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }
}
