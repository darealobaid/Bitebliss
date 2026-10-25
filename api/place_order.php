<?php
header("Content-Type: application/json");

require_once "../config/database.php";

function failOrder($message, $status = 400) {
    http_response_code($status);
    echo json_encode([
        "success" => false,
        "message" => $message
    ]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    failOrder("Invalid request method", 405);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!is_array($data)) {
    failOrder("Invalid request data");
}

$name = trim($data["name"] ?? "");
$email = trim($data["email"] ?? "");
$phone = trim($data["phone"] ?? "");
$address = trim($data["address"] ?? "");
$cart = $data["cart"] ?? [];

if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || $phone === "" || $address === "") {
    failOrder("Please enter valid customer details");
}

if (!is_array($cart) || count($cart) === 0) {
    failOrder("Your cart is empty");
}

if (count($cart) > 100) {
    failOrder("Too many cart items");
}

$items = [];
$total = 0;

try {
    // Fetch actual product prices from MySQL
    $productQuery = $conn->prepare(
        "SELECT product_id, price
         FROM products
         WHERE product_id = ? AND is_available = 1"
    );

    foreach ($cart as $item) {
        $id = filter_var(
            $item["id"] ?? null,
            FILTER_VALIDATE_INT
        );

        $quantity = filter_var(
            $item["quantity"] ?? null,
            FILTER_VALIDATE_INT
        );

        if (!$id || !$quantity || $quantity < 1 || $quantity > 99) {
            failOrder("Invalid product or quantity");
        }

        $productQuery->execute([$id]);
        $product = $productQuery->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            failOrder("A product is unavailable");
        }

        // Merge duplicate product entries
        if (isset($items[$id])) {
            $items[$id]["quantity"] += $quantity;
        } else {
            $items[$id] = [
                "id" => $id,
                "quantity" => $quantity,
                "price" => $product["price"]
            ];
        }

        if ($items[$id]["quantity"] > 99) {
            failOrder("Maximum 99 units per product");
        }
    }

    foreach ($items as $item) {
        $total += $item["price"] * $item["quantity"];
    }

    $conn->beginTransaction();

    // Save customer
    $stmt = $conn->prepare(
        "INSERT INTO customers (name, email, phone)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$name, $email, $phone]);

    $customerId = $conn->lastInsertId();

    // Save order
    $stmt = $conn->prepare(
        "INSERT INTO orders
         (customer_id, delivery_address, total_amount)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$customerId, $address, $total]);

    $orderId = $conn->lastInsertId();

    // Save each ordered product
    $stmt = $conn->prepare(
        "INSERT INTO order_items
         (order_id, product_id, quantity, unit_price)
         VALUES (?, ?, ?, ?)"
    );

    foreach ($items as $item) {
        $stmt->execute([
            $orderId,
            $item["id"],
            $item["quantity"],
            $item["price"]
        ]);
    }

    $conn->commit();

    echo json_encode([
        "success" => true,
        "order_id" => (int)$orderId
    ]);

} catch (Throwable $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }

    error_log($e->getMessage());
    failOrder("Unable to place order", 500);
}
?>
