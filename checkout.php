
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | BiteBliss</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">Bite<span>Bliss.</span></a>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="cart.php">Cart</a>
    </nav>

    <a href="cart.php" class="nav-btn">← Back to Cart</a>
</header>

<main class="checkout-page">

    <div class="checkout-heading">
        <span class="eyebrow">ONE STEP AWAY FROM DELICIOUS</span>
        <h1>Almost <span>Yours.</span></h1>
        <p>Fill in your details and we'll get your order ready.</p>
    </div>

    <div class="checkout-layout">

        <section class="checkout-form-card">
            <div class="section-heading">
                <span class="step-number">01</span>
                <div>
                    <h2>Delivery Details</h2>
                    <p>Where should we send your delicious food?</p>
                </div>
            </div>

            <form id="checkout-form">

                <div class="form-row">
                    <div class="form-field">
                        <input type="text" id="name" name="name"
                               placeholder=" " autocomplete="name"
                               required maxlength="100">
                        <label for="name">Full Name</label>
                    </div>

                    <div class="form-field">
                        <input type="tel" id="phone" name="phone"
                               placeholder=" " autocomplete="tel"
                               required maxlength="20">
                        <label for="phone">Phone Number</label>
                    </div>
                </div>

                <div class="form-field">
                    <input type="email" id="email" name="email"
                           placeholder=" " autocomplete="email"
                           required maxlength="150">
                    <label for="email">Email Address</label>
                </div>

                <div class="form-field">
                    <textarea id="address" name="address"
                              placeholder=" " rows="4"
                              required maxlength="500"></textarea>
                    <label for="address">Delivery Address</label>
                </div>

                <div class="payment-note">
                    <span class="payment-icon">✦</span>
                    <div>
                        <strong>Simple & Secure Ordering</strong>
                        <p>Confirm your order below. No online payment required.</p>
                    </div>
                </div>

                <p class="checkout-error" id="checkout-error"
                   role="alert" hidden></p>

                <button type="submit" class="place-order-btn"
                        id="place-order-btn">
                    <span id="order-btn-text">Place My Order</span>
                    <span>↗</span>
                </button>

            </form>
        </section>

        <aside class="checkout-summary">
            <div class="section-heading">
                <span class="step-number">02</span>
                <div>
                    <h2>Your Order</h2>
                    <p>Here's what you're craving.</p>
                </div>
            </div>

            <div id="checkout-items"></div>

            <div class="summary-divider"></div>

            <div class="summary-line">
                <span>Subtotal</span>
                <strong id="checkout-subtotal">₹0.00</strong>
            </div>

            <div class="summary-line">
                <span>Delivery</span>
                <strong class="free-delivery">FREE</strong>
            </div>

            <div class="summary-divider"></div>

            <div class="summary-line grand-total">
                <span>Total</span>
                <strong id="checkout-total">₹0.00</strong>
            </div>

            <p class="summary-footnote">
                Final prices are verified when your order is placed.
            </p>
        </aside>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
<script src="assets/js/checkout.js"></script>

</body>
</html>
