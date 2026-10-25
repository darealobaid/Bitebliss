<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiteBliss | Fresh Food, Happy Mood</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <header class="navbar">
        <a href="index.php" class="logo">Bite<span>Bliss.</span></a>

        <nav id="main-nav">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="cart.php">
                Cart <span id="cart-count">0</span>
            </a>
        </nav>

        <a href="menu.php" class="nav-btn">Order Now</a>

        <button class="menu-toggle"
                id="menu-toggle"
                type="button"
                aria-label="Open navigation menu"
                aria-controls="main-nav"
                aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>


    <main>
        <section class="hero">

            <div class="hero-content">
                <span class="eyebrow">FRESHLY MADE, JUST FOR YOU</span>

                <h1>
                    Good Food.<br>
                    <span>Good Mood.</span>
                </h1>

                <p>
                    Discover delicious food made with love.
                    Fresh ingredients, bold flavours and
                    happiness delivered to your doorstep.
                </p>

                <div class="hero-actions">
                    <a href="menu.php" class="primary-btn">
                        Explore Menu <span>↗</span>
                    </a>

                    <a href="#about" class="secondary-btn">
                        Discover More
                    </a>
                </div>

                <div class="hero-stats">
                    <div>
                        <strong>100%</strong>
                        <span>Fresh Ingredients</span>
                    </div>
                    <div>
                        <strong>20+</strong>
                        <span>Delicious Choices</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual" id="hero-visual">
                <div class="hero-circle"></div>

                <!-- <div class="food-model">
                    <div class="food-placeholder">
                        <span>🍔</span>
                    </div>
                </div> -->
                
            <div class="food-model">
                <iframe
                    src="https://my.spline.design/burger-2ZhbjKnTDLqHsIXJqtxOUQGf/"
                    title="Interactive 3D Burger"
                    width="100%"
                    height="100%"
                    style="border: none;"
                    loading="eager">
                </iframe>
            </div>


                <div class="floating-tag tag-one">
                    Fresh & Tasty
                </div>

                <div class="floating-tag tag-two">
                    Made with Love
                </div>
            </div>

        </section>

        <section class="about" id="about">
            <span class="eyebrow">WHY BITEBLISS?</span>
            <h2>Every Bite, A Little Happiness.</h2>
            <p>
                From juicy burgers to cheesy pizzas,
                we bring your favourite comfort food
                straight to your table.
            </p>
            <a href="menu.php" class="primary-btn">Explore Our Menu ↗</a>
        </section>
    </main>

    <footer>
        <p>© 2026 BiteBliss. Made with love.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html>
