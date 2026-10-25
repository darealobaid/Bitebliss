
<?php
$orderId = filter_input(
    INPUT_GET,
    'order_id',
    FILTER_VALIDATE_INT
);

if (!$orderId || $orderId < 1) {
    header("Location: menu.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Order Confirmed | BiteBliss</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/success.css">
</head>

<body>

<header class="navbar">
    <a href="index.php" class="logo">
        Bite<span>Bliss.</span>
    </a>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
    </nav>

    <a href="menu.php" class="nav-btn">
        Order Again
    </a>
</header>

<main class="success-page">

    <div class="confetti-container"
         id="confetti-container"
         aria-hidden="true"></div>

    <div class="success-card">

        <div class="success-icon-wrap">
            <svg class="success-check"
                 viewBox="0 0 100 100"
                 aria-hidden="true">

                <circle class="check-circle"
                        cx="50" cy="50" r="44"/>

                <path class="check-mark"
                      d="M28 51 L43 66 L73 35"/>
            </svg>
        </div>

        <div class="success-content">

            <span class="success-eyebrow">
                YAY! YOU DID IT
            </span>

            <h1>Order <span>Confirmed!</span></h1>

            <p class="success-description">
                Your cravings are officially on their way
                to becoming reality. We're getting your
                delicious order ready!
            </p>

            <div class="order-number-box">
                <span>YOUR ORDER NUMBER</span>

                <strong>
                    #<?php echo htmlspecialchars(
                        (string) $orderId,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>
                </strong>

                <small>
                    Keep this number for your reference.
                </small>
            </div>

            <div class="success-message">
                <span class="message-icon">✦</span>

                <div>
                    <strong>Freshly made with love</strong>
                    <p>
                        Thank you for choosing BiteBliss.
                        We can't wait to serve you again!
                    </p>
                </div>
            </div>

            <div class="success-actions">
                <a href="index.php" class="home-button">
                    Back to Home <span>↗</span>
                </a>

                <a href="menu.php" class="order-again-link">
                    Order Something Else
                </a>
            </div>

        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
<script src="assets/js/success.js"></script>

</body>
</html>
