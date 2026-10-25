
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | BiteBliss</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/cart.css">
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">Bite<span>Bliss.</span></a>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="cart.php">Cart <span id="cart-count">0</span></a>
    </nav>

    <a href="menu.php" class="nav-btn">Order More</a>
</header>

<main class="cart-page">

    <div class="cart-heading">
        <span class="eyebrow">YOUR DELICIOUS PICKS</span>
        <h1>Your <span>Cart.</span></h1>
        <p>Almost there! Your next delicious meal awaits.</p>
    </div>

    <div class="cart-layout">

        <section class="cart-items" id="cart-items"></section>

        <aside class="cart-summary" id="cart-summary">
            <h2>Order Summary</h2>

            <div class="summary-line">
                <span>Subtotal</span>
                <strong id="subtotal">₹0.00</strong>
            </div>

            <div class="summary-line">
                <span>Delivery</span>
                <strong>FREE</strong>
            </div>

            <div class="summary-divider"></div>

            <div class="summary-line total-line">
                <span>Total</span>
                <strong id="total">₹0.00</strong>
            </div>

            <a href="checkout.php" class="checkout-btn" id="checkout-btn">
                Proceed to Checkout <span>↗</span>
            </a>

            <a href="menu.php" class="continue-link">Continue Shopping</a>
        </aside>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
<div id="cart-toast" class="cart-toast"
     role="status" aria-live="polite"></div>
<script src="assets/js/cart.js"></script>
<script src="assets/js/cart-page.js"></script>

</body>
</html>
