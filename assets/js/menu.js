
document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".food-card");
    const filters = document.querySelectorAll(".filter-btn");
    const cartCount = document.getElementById("cart-count");

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        cartCount.textContent = cart.reduce(
            (sum, item) => sum + item.quantity, 0
        );
    }

    updateCartCount();

    // Category filtering
    filters.forEach(button => {
        button.addEventListener("click", () => {

            filters.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            const selected = button.dataset.filter;

            cards.forEach(card => {
                const visible = selected === "all" ||
                    card.dataset.category === selected;

                card.style.display = visible ? "" : "none";

                if (visible && !reducedMotion && typeof gsap !== "undefined") {
                    gsap.fromTo(card,
                        { opacity: 0, y: 15 },
                        { opacity: 1, y: 0, duration: 0.35 }
                    );
                }
            });
        });
    });

    // 3D tilt effect
    if (!reducedMotion && window.matchMedia("(hover: hover)").matches) {
        cards.forEach(card => {
            card.addEventListener("mousemove", e => {
                const rect = card.getBoundingClientRect();

                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;

                gsap.to(card, {
                    rotationY: x * 9,
                    rotationX: -y * 9,
                    duration: 0.35,
                    ease: "power2.out",
                    overwrite: "auto"
                });
            });

            card.addEventListener("mouseleave", () => {
                gsap.to(card, {
                    rotationX: 0,
                    rotationY: 0,
                    duration: 0.5,
                    ease: "power2.out"
                });
            });
        });
    }

    // Add to Cart

    // Animated Add to Cart

    const toast = document.getElementById("cart-toast");
    const toastMessage = document.getElementById("toast-message");

    let toastTimer;

    function showToast(name) {
        toastMessage.textContent = name + " added successfully";

        toast.classList.add("show");

        clearTimeout(toastTimer);

        toastTimer = setTimeout(() => {
            toast.classList.remove("show");
        }, 2500);
    }

    // Only ONE loop for all Add buttons
    document.querySelectorAll(".add-btn").forEach(button => {

        let buttonTimer;

        button.addEventListener("click", () => {

            const id = Number(button.dataset.id);
            const name = button.dataset.name;
            const price = Number(button.dataset.price);

            // Add exactly one item
            addToCart(id, name, price);

            // Update cart counter
            updateCartCount();

            // Button animation
            button.textContent = "Added ✓";

            if (!reducedMotion && typeof gsap !== "undefined") {
                gsap.fromTo(button,
                    { scale: 0.85 },
                    {
                        scale: 1,
                        duration: 0.45,
                        ease: "back.out(2)"
                    }
                );
            }

            // Show notification
            showToast(name);

            // Reset button
            clearTimeout(buttonTimer);

            buttonTimer = setTimeout(() => {
                button.textContent = "Add +";
            }, 1500);
        });
    });

});
