
document.addEventListener("DOMContentLoaded", () => {

    const toggle = document.getElementById("menu-toggle");
    const nav = document.getElementById("main-nav");
    const cartCount = document.getElementById("cart-count");

    // Update cart counter
    function updateCartCount() {
        if (!cartCount) return;

        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        const count = cart.reduce(
            (sum, item) => sum + Number(item.quantity || 0),
            0
        );

        cartCount.textContent = count;
    }

    updateCartCount();

    // Only enable mobile menu if elements exist
    if (!toggle || !nav) return;

    function closeMenu() {
        nav.classList.remove("open");
        toggle.classList.remove("active");
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", "Open navigation menu");
    }

    toggle.addEventListener("click", () => {

        const isOpen = nav.classList.toggle("open");

        toggle.classList.toggle("active", isOpen);

        toggle.setAttribute("aria-expanded", String(isOpen));
        toggle.setAttribute(
            "aria-label",
            isOpen ? "Close navigation menu" : "Open navigation menu"
        );
    });

    // Close when clicking a navigation link
    nav.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", closeMenu);
    });

    // Close using Escape key
    document.addEventListener("keydown", event => {
        if (event.key === "Escape") closeMenu();
    });

    // Close when switching to desktop
    window.matchMedia("(min-width: 769px)")
        .addEventListener("change", event => {
            if (event.matches) closeMenu();
        });

});
