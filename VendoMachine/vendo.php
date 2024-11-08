<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
</head>

<body>

    <h2>Vendo Machine</h2>

    <form method="post">
        <fieldset class="fset">
            <legend>Products:</legend>
            <?php
                $products = [
                    "Coke" => 15,
                    "Sprite" => 20,
                    "Royal" => 20,
                    "Pepsi" => 15,
                    "Mountain Dew" => 20
                ];
                
                foreach ($products as $name => $price) {
                    echo "<label><input type='checkbox' name='product[]' value='{$name}'> {$name} - ₱{$price}</label><br>";
                }
            ?>
        </fieldset>

        <fieldset class="fset">
            <legend>Options:</legend>
            <label for="size">Size:</label>
            <select name="size">
                <option value="regular">Regular</option>
                <option value="upsize">Up-Size (add ₱5)</option>
                <option value="jumbo">Jumbo (add ₱10)</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" min="0" value="0" id="qntty-sec">
            <button type="submit" name="checkout" id="checkout">Checkout</button>
        </fieldset>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout']) && !empty($_POST['product'])) {
        $selectedProducts = $_POST['product'];
        $quantity = max(1, intval($_POST['quantity']));
        $size = $_POST['size'];

        $sizeAdjustments = [
            "regular" => 0,
            "upsize" => 5,
            "jumbo" => 10
        ];

        $totalItems = 0;
        $totalPrice = 0;
        
        echo "<hr><b>Purchase Summary:</b><br>";
        foreach ($selectedProducts as $product) {
            $basePrice = $products[$product];
            $sizeAdjustment = $sizeAdjustments[$size];
            $totalPricePerItem = ($basePrice + $sizeAdjustment) * $quantity;

            $totalItems += $quantity;
            $totalPrice += $totalPricePerItem;

            echo "<ul><li>{$quantity} " . ($quantity > 1 ? "pieces" : "piece") . 
                 " of {$size} {$product} amounting to ₱{$totalPricePerItem}</li></ul>";
        }

        echo "<hr><b>Total Items:</b> {$totalItems}<br>";
        echo "<b>Total Price:</b> ₱{$totalPrice}";

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<hr>No Selected Product, Try Again.";
    }
    ?>
</body>
</html>