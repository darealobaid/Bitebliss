
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("checkout-form");
    const itemsContainer = document.getElementById("checkout-items");
    const subtotal = document.getElementById("checkout-subtotal");
    const total = document.getElementById("checkout-total");
    const button = document.getElementById("place-order-btn");
    const buttonText = document.getElementById("order-btn-text");
    const errorBox = document.getElementById("checkout-error");

    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    function money(amount) {
        return "₹" + Number(amount).toFixed(2);
    }

    if (cart.length === 0) {
        window.location.href = "cart.php";
        return;
    }

    let grandTotal = 0;

    cart.forEach(item => {
        const quantity = Number(item.quantity);
        const price = Number(item.price);

        grandTotal += price * quantity;

        const row = document.createElement("div");
        row.className = "checkout-order-item";

        const details = document.createElement("div");
        const name = document.createElement("strong");
        const description = document.createElement("p");
        const priceLabel = document.createElement("span");

        name.textContent = item.name;
        description.textContent = "Quantity: " + quantity;
        priceLabel.textContent = money(price * quantity);
        priceLabel.className = "item-price";

        details.append(name, description);
        row.append(details, priceLabel);
        itemsContainer.appendChild(row);
    });

    subtotal.textContent = money(grandTotal);
    total.textContent = money(grandTotal);

    // Smooth page entrance
    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    if (!reducedMotion && typeof gsap !== "undefined") {
        gsap.from(".checkout-heading", {
            y: 25,
            opacity: 0,
            duration: 0.6,
            ease: "power2.out"
        });

        gsap.from(".checkout-form-card, .checkout-summary", {
            y: 35,
            opacity: 0,
            duration: 0.7,
            stagger: 0.12,
            ease: "power2.out"
        });
    }

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        if (!form.reportValidity()) return;

        errorBox.hidden = true;
        button.disabled = true;
        buttonText.textContent = "Placing your order...";

        const payload = {
            name: document.getElementById("name").value.trim(),
            email: document.getElementById("email").value.trim(),
            phone: document.getElementById("phone").value.trim(),
            address: document.getElementById("address").value.trim(),
            cart: cart.map(item => ({
                id: Number(item.id),
                quantity: Number(item.quantity)
            }))
        };

        try {
            const response = await fetch("api/place_order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || "Unable to place order.");
            }

            localStorage.removeItem("cart");

            window.location.href =
                "success.php?order_id=" + encodeURIComponent(result.order_id);

        } catch (error) {
            errorBox.textContent = error.message;
            errorBox.hidden = false;

            button.disabled = false;
            buttonText.textContent = "Place My Order";
        }
    });
});
