<?php
// Preia coșul din sesiune
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<p>Coșul de cumpărături este gol.</p>";
} else {
    // Afișează lista de produse din coș
    echo "<h1>Coșul de cumpărături</h1>";
    echo "<table border='1'>
            <tr>
                <th>Produs</th>
                <th>Cantitate</th>
                <th>Preț</th>
                <th>Total</th>
             </tr>";
    
    $total = 0;
    
    foreach ($cart as $productId => $item) {
        // Obține detaliile produsului din baza de date (folosind modelul Product)
        $product = Product::find($productId);
        if ($product) {
            $productName = $product->name;
            $productPrice = $product->price;
            $itemTotal = $productPrice * $item['quantity'];
            $total += $itemTotal;
            
            echo "<tr>
                    <td>{$productName}</td>
                    <td>{$item['quantity']}</td>
                    <td>{$productPrice} lei</td>
                    <td>{$itemTotal} lei</td>
                    <td>
                        <a href='/remove/{$productId}'>Șterge</a> |
                        <a href='/update/{$productId}'>Actualizează</a>
                    </td>
                  </tr>";
        }
    }
    
    echo "</table>";
    
    // Afișează totalul coșului
    echo "<h3>Total: {$total} lei</h3>";

    // Butoane pentru continuarea achiziției
    echo "<a href='/checkout' class='btn btn-primary'>Finalizare comandă</a>";
    echo "<a href='/products' class='btn btn-secondary'>Continuă cumpărăturile</a>";
}
?>
