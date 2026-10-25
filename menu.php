
<?php
require_once "config/database.php";

$sql = "SELECT * FROM products WHERE is_available = 1";
$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Our Menu | BiteBliss</title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/menu.css">
</head>

<body>

<header class="navbar">
    <a href="index.php" class="logo">
        Bite<span>Bliss.</span>
    </a>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="cart.php">
            Cart <span id="cart-count">0</span>
        </a>
    </nav>

    <a href="cart.php" class="nav-btn">View Cart</a>
</header>

<main class="menu-page">

    <section class="menu-heading">
        <span class="eyebrow">MADE FRESH, SERVED HAPPY</span>

        <h1>Explore Our <span>Menu.</span></h1>

        <p>
            Craving something delicious?
            Find your next favourite bite.
        </p>
    </section>

    <div class="category-filters">
        <button class="filter-btn active" data-filter="all">
            All Food
        </button>

        <?php
        $categories = array_unique(
            array_column($products, "category")
        );

        foreach ($categories as $category):
        ?>
            <button
                class="filter-btn"
                data-filter="<?= htmlspecialchars($category, ENT_QUOTES) ?>">
                <?= htmlspecialchars($category) ?>
            </button>
        <?php endforeach; ?>
    </div>

    <section class="food-grid">

        <?php foreach ($products as $product): ?>

        <article
            class="food-card"
            data-category="<?= htmlspecialchars($product['category'] ?? '', ENT_QUOTES) ?>">

            <div class="food-image">
                <img
                    src="assets/images/<?= htmlspecialchars($product['image'] ?? '', ENT_QUOTES) ?>"
                    alt="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>"
                    loading="lazy">
            </div>

            <div class="food-info">

                <span class="food-category">
                    <?= htmlspecialchars($product['category'] ?? '') ?>
                </span>

                <h2><?= htmlspecialchars($product['name']) ?></h2>

                <p>
                    <?= htmlspecialchars($product['description'] ?? '') ?>
                </p>

                <div class="food-bottom">
                    <strong>
                        ₹<?= number_format($product['price'], 2) ?>
                    </strong>

                    <button
                        class="add-btn"
                        data-id="<?= (int)$product['product_id'] ?>"
                        data-name="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>"
                        data-price="<?= htmlspecialchars($product['price'], ENT_QUOTES) ?>">
                        Add +
                    </button>
                </div>

            </div>
        </article>

        <?php endforeach; ?>

    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
<div id="cart-toast" class="cart-toast" role="status" aria-live="polite">
    <div class="toast-icon">✓</div>

    <div class="toast-content">
        <strong>Added to cart!</strong>
        <p id="toast-message">Your food is ready in the cart</p>
    </div>
</div>
<script src="assets/js/cart.js"></script>
<script src="assets/js/menu.js"></script>

</body>
</html>
