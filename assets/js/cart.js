function addToCart(id, name, price) {

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    let item = cart.find(product => product.id === id);

    if (item) {
        item.quantity++;
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    // alert(name + " added to cart!");
}
