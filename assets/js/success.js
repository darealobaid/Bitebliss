
document.addEventListener("DOMContentLoaded", () => {

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    if (reducedMotion || typeof gsap === "undefined") {
        document.querySelector(".check-circle")
            .style.strokeDashoffset = 0;

        document.querySelector(".check-mark")
            .style.strokeDashoffset = 0;

        return;
    }

    // Main celebration timeline
    const timeline = gsap.timeline();

    timeline.from(".success-card", {
        y: 65,
        opacity: 0,
        scale: 0.92,
        duration: 0.8,
        ease: "power3.out"
    });

    timeline.to(".check-circle", {
        strokeDashoffset: 0,
        duration: 0.8,
        ease: "power2.out"
    });

    timeline.to(".check-mark", {
        strokeDashoffset: 0,
        duration: 0.5,
        ease: "power2.out"
    });

    timeline.from(".success-content > *", {
        y: 20,
        opacity: 0,
        duration: 0.5,
        stagger: 0.09,
        ease: "power2.out"
    }, "-=0.2");

    // Confetti celebration
    const container = document.getElementById(
        "confetti-container"
    );

    const colors = [
        "#F97316",
        "#FFB347",
        "#27A563",
        "#FFD166",
        "#FF6B6B",
        "#FFFFFF"
    ];

    function launchConfetti() {

        for (let i = 0; i < 70; i++) {

            const piece = document.createElement("div");
            piece.className = "confetti-piece";

            piece.style.backgroundColor =
                colors[Math.floor(Math.random() * colors.length)];

            piece.style.left = Math.random() * 100 + "%";
            piece.style.top = "-30px";

            container.appendChild(piece);

            gsap.fromTo(piece,
                {
                    y: -50,
                    rotation: 0,
                    opacity: 1
                },
                {
                    y: window.innerHeight + 100,
                    x: (Math.random() - 0.5) * 300,
                    rotation: Math.random() * 900,
                    opacity: 0,
                    duration: 2.5 + Math.random() * 2,
                    delay: Math.random() * 0.7,
                    ease: "power1.in",
                    onComplete: () => piece.remove()
                }
            );
        }
    }

    timeline.call(launchConfetti, [], 0.8);

});
