
document.addEventListener("DOMContentLoaded", () => {

    // Update cart counter
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    const count = cart.reduce(
        (sum, item) => sum + item.quantity, 0
    );

    document.getElementById("cart-count").textContent = count;

    // Respect reduced motion preferences
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        return;
    }

    // Hero entrance animations
    gsap.from(".navbar", {
        y: -50,
        opacity: 0,
        duration: 0.9,
        ease: "power3.out"
    });

    gsap.from(".hero-content > *", {
        y: 45,
        opacity: 0,
        duration: 1,
        stagger: 0.15,
        ease: "power3.out"
    });

    gsap.from(".hero-visual", {
        scale: 0.85,
        opacity: 0,
        duration: 1.3,
        ease: "power3.out"
    });

    // Floating food animation
    gsap.to(".food-placeholder", {
        y: -20,
        rotation: 3,
        duration: 2.5,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });

    gsap.to(".tag-one", {
        y: -15,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });

    gsap.to(".tag-two", {
        y: 15,
        duration: 2.8,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });

    // Mouse responsive food movement
    const hero = document.getElementById("hero-visual");
    const food = document.querySelector(".food-placeholder");

    hero.addEventListener("pointermove", (e) => {
        const rect = hero.getBoundingClientRect();

        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;

        gsap.to(food, {
            x: x * 35,
            rotationY: x * 18,
            rotationX: -y * 18,
            duration: 0.6,
            ease: "power2.out",
            overwrite: "auto"
        });
    });

    hero.addEventListener("pointerleave", () => {
        gsap.to(food, {
            x: 0,
            rotationX: 0,
            rotationY: 0,
            duration: 0.8
        });
    });

});
