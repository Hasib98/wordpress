// Get the cart from localStorage or initialize it as an empty array
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Update the Cart Display
function updateCartDisplay() {
    const cartItemsContainer = document.getElementById('cart-items');
    const checkoutButton = document.getElementById('checkout');
    cartItemsContainer.innerHTML = ''; // Clear cart items

    // if (cart.length === 0) {
    //     cartItemsContainer.innerHTML = '<p>Your cart is empty!</p>';
    //     checkoutButton.disabled = true;
    //     return;
    // }

    let total = 0;
    cart.forEach(item => {
        const itemElement = document.createElement('div'); //created a div
        itemElement.classList.add('cart-item'); //added class to the div

        //write content for intner html
        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <p>${item.name} - $${item.price}</p>
            <input type="number" value="${item.quantity}" min="1" max="${item.stock}" data-product-id="${item.id}" class="item-quantity">
            <button class="remove-item" data-product-id="${item.id}">Remove</button>
        `;
        cartItemsContainer.appendChild(itemElement);

        // Calculate the total price
        total += item.price * item.quantity;
    });

    // Display total price
    const totalElement = document.createElement('div');
    totalElement.classList.add('cart-total');
    totalElement.innerHTML = `<p>Total: $${total.toFixed(2)}</p>`;
    cartItemsContainer.appendChild(totalElement);

    checkoutButton.disabled = false;
}

// Add Item to Cart
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const product = {
            id: this.getAttribute('data-product-id'),
            name: this.getAttribute('data-product-name'),
            price: parseFloat(this.getAttribute('data-product-price')),
            image: this.getAttribute('data-product-image'),
            quantity: 1, // Default quantity is 1
            stock: 10 // Replace with actual stock data if needed
        };


        // Check if product is already in cart
        const existingProductIndex = cart.findIndex(item => item.id === product.id);
        if (existingProductIndex >= 0) {
            // Update quantity
            cart[existingProductIndex].quantity += 1;
        } else {
            // Add new product to cart
            cart.push(product);
        }

        // Save updated cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    });
});

// Remove Item from Cart
document.getElementById('cart-items').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-item')) {
        const productId = event.target.getAttribute('data-product-id');
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }
});

// Update Item Quantity
document.getElementById('cart-items').addEventListener('change', function (event) {
    if (event.target.classList.contains('item-quantity')) {
        const productId = event.target.getAttribute('data-product-id');
        const newQuantity = parseInt(event.target.value);

        const product = cart.find(item => item.id === productId);
        if (product && newQuantity >= 1 && newQuantity <= product.stock) {
            product.quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
        }
    }
});

// Handle Checkout (For demonstration, you can replace this with actual backend processing)
document.getElementById('checkout').addEventListener('click', function () {
    // Send the cart data to the server or process it here
    alert('Proceeding to checkout...');
    // Clear the cart after checkout
    localStorage.removeItem('cart');
    cart = [];
    updateCartDisplay();
});

// Initial Cart Display
updateCartDisplay();
