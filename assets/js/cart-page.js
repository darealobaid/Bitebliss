
document.addEventListener("DOMContentLoaded", () => {

    const container = document.getElementById("cart-items");
    const cartCount = document.getElementById("cart-count");
    const subtotalElement = document.getElementById("subtotal");
    const totalElement = document.getElementById("total");
    const checkoutBtn = document.getElementById("checkout-btn");

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    const images = {
        1: "burger.png",
        2: "pizza.png",
        3: "fries.png",
        4: "coffee.png",
        5: "wrap.png"
    };

    function getCart() {
        return JSON.parse(localStorage.getItem("cart")) || [];
    }

    function saveCart(cart) {
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    }

    function money(value) {
        return "₹" + Number(value).toFixed(2);
    }

    function renderCart(animate = false) {
        const cart = getCart();

        container.innerHTML = "";

        const count = cart.reduce(
            (sum, item) => sum + item.quantity, 0
        );

        const total = cart.reduce(
            (sum, item) => sum + item.price * item.quantity, 0
        );

        cartCount.textContent = count;
        subtotalElement.textContent = money(total);
        totalElement.textContent = money(total);

        checkoutBtn.classList.toggle("disabled", cart.length === 0);

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="empty-cart">
                    <h2>Your cart is empty</h2>
                    <p>Looks like you haven't added anything yet.</p>
                    <a href="menu.php" class="primary-btn">
                        Explore Menu ↗
                    </a>
                </div>
            `;
            return;
        }

        cart.forEach(item => {
            const element = document.createElement("div");
            element.className = "cart-item";

            const image = images[item.id] || "burger.png";

            element.innerHTML = `
                <div class="cart-item-image">
                    <img src="assets/images/${image}" alt="">
                </div>

                <div class="cart-item-info">
                    <h3></h3>
                    <p>${money(item.price)} each</p>

                    <div class="cart-item-controls">
                        <button class="qty-btn minus" aria-label="Decrease quantity">−</button>
                        <span class="qty-value">${item.quantity}</span>
                        <button class="qty-btn plus" aria-label="Increase quantity">+</button>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>

                <div class="cart-item-price">
                    ${money(item.price * item.quantity)}
                </div>
            `;

            element.querySelector("h3").textContent = item.name;

            element.querySelector(".plus").addEventListener("click", () => {
                changeQuantity(item.id, 1);
            });

            element.querySelector(".minus").addEventListener("click", () => {
                changeQuantity(item.id, -1);
            });

            element.querySelector(".remove-btn").addEventListener("click", () => {
                removeItem(item.id, element);
            });

            container.appendChild(element);
        });

        if (animate && !reducedMotion && typeof gsap !== "undefined") {
            gsap.from(".cart-item", {
                y: 25,
                opacity: 0,
                duration: 0.45,
                stagger: 0.07,
                ease: "power2.out"
            });
        }
    }
    
    let cartToastTimer;

    function showCartToast(message) {
        const toast = document.getElementById("cart-toast");

        toast.textContent = message;
        toast.classList.add("show");

        clearTimeout(cartToastTimer);

        cartToastTimer = setTimeout(() => {
            toast.classList.remove("show");
        }, 2500);
    }


    
    function changeQuantity(id, amount) {
        const cart = getCart();

        const item = cart.find(product => product.id === id);

        if (!item) return;

        // Minimum quantity reached
        if (item.quantity === 1 && amount === -1) {
            showCartToast("Minimum quantity is 1");
            return;
        }

        // Maximum quantity reached
        if (item.quantity === 99 && amount === 1) {
            showCartToast("Maximum quantity is 99");
            return;
        }

        item.quantity += amount;

        saveCart(cart);
    }


    function removeItem(id, element) {
        const finish = () => {
            const cart = getCart().filter(item => item.id !== id);
            saveCart(cart);
        };

        if (reducedMotion || typeof gsap === "undefined") {
            finish();
            return;
        }

        gsap.to(element, {
            x: -70,
            opacity: 0,
            duration: 0.3,
            ease: "power2.in",
            onComplete: finish
        });
    }

    renderCart(true);
});
