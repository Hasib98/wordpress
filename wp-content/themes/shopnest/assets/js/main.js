
// Get the cart from localStorage or initialize it as an empty array
let cart = JSON.parse(localStorage.getItem('cart')) || [];


function updateCartDisplay() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    const checkoutButton = document.getElementById('checkout');
    if (cartItemsContainer) {

        cartItemsContainer.innerHTML = ''; // Clear cart items
    }
    // console.log(cart);
    if (cart.length === 0) {
        if (cartItemsContainer) {

            cartItemsContainer.innerHTML = '<p>Your cart is empty!</p>';
        }
        if (checkoutButton) {


            checkoutButton.disabled = true;
        }
        return;
    }

    let total = 0;
    let discount = 0;

    cart.forEach(item => {
        const itemElement = document.createElement('div'); //created a div
        itemElement.classList.add('cart-item'); //added class to the div

        //write content for intner html
        itemElement.innerHTML = `
        <img src="${item.image}" alt="${item.title}">
        <p>${item.title} - <span style="color:#6e202d;font-weight:bold;  text-decoration: line-through;">${item.price}</span> &rarr; <span style="color:#1bb388;font-weight:bold;">${item.price - item.discount}</span></p>
        <button data-product-id="${item.id}" id="decrease" style="  color:black;   height:50px; width:50px; background:#bcf5f5;" class=" btn  rounded-circle   ">-</button>
        <span> ${item.quantity}</span>
        <button data-product-id="${item.id}" id="increase" style="  color:black;   height:50px; width:50px; background:#bcf5f5;" class=" btn  rounded-circle  ">+</button>
        <button class="remove-item" data-product-id="${item.id}">Remove</button>
        `;
        if (cartItemsContainer) {

            cartItemsContainer.appendChild(itemElement);
        }

        // Calculate the total price
        total += item.price * item.quantity;
        discount += (item.price - item.discount) * item.quantity;
    });

    // Display total price
    const totalElement = document.createElement('div');
    totalElement.classList.add('cart-total');
    totalElement.innerHTML = `<p>Total: <span style= "${discount ? "text-decoration: line-through" : ""}">${total.toFixed(2)}</span>  &rarr; <span style="color:#1bb388;">${!discount ? total.toFixed(2) : discount.toFixed(2)}</span> </p>`;
    if (cartItemsContainer) {

        cartItemsContainer.appendChild(totalElement);
    }

    if (checkoutButton) {
        checkoutButton.disabled = false;
    }
}




// Add Item to Cart
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const product = {
            id: parseInt(this.getAttribute('product-id')),
            title: this.getAttribute('title'),
            price: parseInt(this.getAttribute('price')),
            discount: parseInt(this.getAttribute('discount')),
            image: this.getAttribute('image'),

            stock: parseInt(this.getAttribute('quantity')),

            quantity: 1,

        };
        // Check if product is already in cart
        const existingProductIndex = cart.findIndex(item => item.id === product.id);
        // alert(existingProductIndex);


        if (existingProductIndex >= 0) {
            if (cart[existingProductIndex].stock > cart[existingProductIndex].quantity) {
                cart[existingProductIndex].quantity += 1;
            }
            else {

                const qunt = cart[existingProductIndex].stock;
                alert("Stock out!!! you cant add more than " + qunt + " " + cart[existingProductIndex].title + "'s");
            }

            // Update quantity

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
document.addEventListener("DOMContentLoaded", function () {
    const cartItems = document.getElementById('cart-items');
    if (cartItems) {


        cartItems.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-item')) {
                const productId = event.target.getAttribute('data-product-id');
                // console.log(parseInt(productId));

                // console.log(cart);

                cart = cart.filter(item => item.id !== parseInt(productId));

                // console.log(cart);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const cartItems = document.getElementById('cart-items');
    if (cartItems) {
        cartItems.addEventListener('click', function (event) {
            if (event.target.id === 'increase') {
                const productId = event.target.getAttribute('data-product-id');
                let tempcart = localStorage.getItem('cart');
                tempcart = JSON.parse(tempcart);


                let updatedCart = tempcart.map(item =>
                    item.id === parseInt(productId) ? { ...item, quantity: item.stock > item.quantity ? item.quantity + 1 : item.quantity } : item
                );




                localStorage.setItem('cart', JSON.stringify(updatedCart));

                updateCartDisplay();
            }

        });
    }
});
document.addEventListener("DOMContentLoaded", function () {

    const cartItems = document.getElementById('cart-items');
    if (cartItems) {

        cartItems.addEventListener('click', function (event) {
            if (event.target.id === 'decrease') {
                const productId = event.target.getAttribute('data-product-id');
                let tempcart = localStorage.getItem('cart');
                tempcart = JSON.parse(tempcart);



                let updatedCart = tempcart.map(item =>
                    item.id === parseInt(productId) ? { ...item, quantity: item.quantity > 0 ? item.quantity - 1 : item.quantity } : item
                );


                localStorage.setItem('cart', JSON.stringify(updatedCart));

                updateCartDisplay();
            }

        });
    }
});









// Initial Cart Display
updateCartDisplay();





// Get cart data from localStorage
document.addEventListener("DOMContentLoaded", function () {

    const checkout = document.getElementById("checkout");
    if (checkout) {

        checkout.addEventListener("click", function () {
            let cartData = JSON.parse(localStorage.getItem("cart"));
            let cartjson = JSON.parse(localStorage.getItem("cart"));



            cartData = cartData.reduce((acc, item) => {
                acc.foods.push(`${item.title}(${item.quantity})`);
                acc.price += (item.price - item.discount) * item.quantity;
                acc.quantity += item.quantity;
                return acc;
            }, { foods: [], price: 0, quantity: 0 });

            cartData.foods = cartData.foods.join('-');
            console.log(cartData);
            console.log(cartjson);



            jQuery.ajax({
                type: "post",
                url: ajax_object.ajax_url,
                data: {
                    action: "my_action",  // the action to fire in the server
                    // data:       // any JS object
                    data: { cartjson, cartData },
                    nonce: ajax_object.nonce

                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                },
            });

            localStorage.removeItem('cart');
            cart = [];
            updateCartDisplay();
            // location.reload();
        });
    }
});




document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {

        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); // ✅ Prevent form from reloading the page



            const loginData = {
                // name: document.getElementById("name").value,
                email: document.getElementById("email").value,
                password: document.getElementById("password").value,
                rememberme: document.getElementById("rememberme").checked,


            };


            console.log(loginData);
            // console.log("-----------------");


            jQuery.ajax({
                type: "post",
                url: ajax_object.ajax_url,
                data: {
                    action: "custom_login",  // the action to fire in the server

                    data: loginData,
                    // nonce: ajax_object.nonce

                },
                success: function (response) {
                    console.log(response);
                    response.success ? location.replace(response.redirect) : alert(response.message)
                    // location.replace(response.redirect);

                },
                error: function (error) {
                    console.error(error);

                },
            });



        });
    }
});

document.addEventListener("DOMContentLoaded", function () {

    const getImage = document.getElementById('getImage');
    let avatarImage = null;

    if (getImage) {

        getImage.addEventListener('change', function (e) {
            avatarImage = e.target.files[0];
        });
    }
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {

        registerForm.addEventListener("submit", async function (e) {
            e.preventDefault(); // ✅ Prevent form from reloading the page



            const regData = {
                firstName: document.getElementById("first_name").value,
                lastName: document.getElementById("last_name").value,
                username: document.getElementById("username").value,
                email: document.getElementById("email").value,
                password: document.getElementById("password").value,
                image: avatarImage,
                role: 'author',


            };


            // console.log(regData);
            // console.log("-----------------");

            let formData = new FormData();
            formData.append('firstName', regData.firstName);
            formData.append('lastName', regData.lastName);
            formData.append('username', regData.username);
            formData.append('discount', regData.discount);
            formData.append('email', regData.email);
            formData.append('password', regData.password);
            formData.append('image', regData.image);
            formData.append('action', 'custom_registration');


            /* jQuery.ajax({
                type: "post",
                url: ajax_object.ajax_url,
                data: {
                    action: "custom_registration",  // the action to fire in the server

                    data: regData,
                    // nonce: ajax_object.nonce

                },
                success: function (response) {
                    console.log(response);
                    // response.success ? location.replace(response.redirect) : alert(response.message)
                    // location.replace(response.redirect);

                },
                error: function (error) {
                    console.error(error);

                },
            }); */

            try {
                const response = await fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    console.log( data);
                    

                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }



        });
    }
});






document.addEventListener("DOMContentLoaded", function () {

    const getImage = document.getElementById('getImage');
    let avatarImage = null;

    if (getImage) {

        getImage.addEventListener('change', function (e) {
            avatarImage = e.target.files[0];
        });
    }
    const registerForm = document.getElementById("updateForm");
    if (registerForm) {

        registerForm.addEventListener("submit", async function (e) {
            e.preventDefault(); // ✅ Prevent form from reloading the page



            const regData = {
                firstName: document.getElementById("first_name").value,
                lastName: document.getElementById("last_name").value,
                email: document.getElementById("email").value,
                image: avatarImage,
            };


            // console.log(regData);
            // console.log("-----------------");

            let formData = new FormData();
            formData.append('firstName', regData.firstName);
            formData.append('lastName', regData.lastName);
            formData.append('email', regData.email);
            formData.append('image', regData.image);
            formData.append('action', 'custom_update_user');


            try {
                const response = await fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    console.log("Food Item uploaded successfully:", data);
                    // alert("Food Item uploaded successfully.");
                    // document.getElementById('output').src = ""; // Clears the image
                    // document.getElementById('getImage').value = "";
                    // document.getElementById('title').value = "";
                    // document.getElementById('description').value = "";
                    // document.getElementById('price').value = "";
                    // document.getElementById('discount').value = "";
                    // document.getElementById('quantity').value = "";
                    // window.location = document.location.href;


                } else {
                    alert("User Registration failed: " + data.message);
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }



        });
    }
});


































//////////////////////////////////////////////////////////////////////////////////////////





document.addEventListener("DOMContentLoaded", function () {
    const getImage = document.getElementById('getImage');
    let foodImage = null;

    if (getImage) {

        getImage.addEventListener('change', function (e) {
            foodImage = e.target.files[0];
        });
    }

    const custom_post_type = document.getElementById("custom_post_form");
    if (custom_post_type) {
        custom_post_type.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Validate input fields
            const title = document.getElementById("title").value.trim();
            const description = document.getElementById("description").value.trim();
            const price = document.getElementById("price").value.trim();
            const discount = document.getElementById("discount").value.trim();
            const quantity = document.getElementById("quantity").value.trim();

            if (!title || !description || !price || !quantity) {
                alert("Please fill in all required fields.");
                return;
            }

            if (!foodImage) {
                alert("Please upload an image.");
                return;
            }

            let formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            formData.append('price', price);
            formData.append('discount', discount);
            formData.append('quantity', quantity);
            formData.append('image', foodImage);
            formData.append('action', 'testfnc');
            // console.log([...formData]);

            try {
                const response = await fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    console.log("Food Item uploaded successfully:", data);
                    alert("Food Item uploaded successfully.");
                    document.getElementById('output').src = ""; // Clears the image
                    document.getElementById('getImage').value = "";
                    document.getElementById('title').value = "";
                    document.getElementById('description').value = "";
                    document.getElementById('price').value = "";
                    document.getElementById('discount').value = "";
                    document.getElementById('quantity').value = "";
                    window.location = document.location.href;


                } else {
                    alert("Upload failed: " + data.message);
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const addFood = document.getElementById('add-food');
    if (addFood) {

        addFood.addEventListener('click', function () {
            let form = document.getElementById('form-div');
            if (form) {
                if (form.style.display === 'none' || form.style.display === '') {
                    form.style.display = 'block';
                    addFood.innerHTML = 'Close';
                } else {
                    form.style.display = 'none';
                    addFood.innerHTML = 'Add Food';
                }
            }

        });
    }
});


function previewImage(event) {
    document.getElementById('output').src = URL.createObjectURL(event.target.files[0]);
}




document.addEventListener("DOMContentLoaded", function () {
    const getImage = document.getElementById('getImage');
    let foodImage = null;

    if (getImage) {

        getImage.addEventListener('change', function (e) {
            foodImage = e.target.files[0];
        });
    }

    const edit_custom_post_form = document.getElementById("edit_custom_post_form");
    if (edit_custom_post_form) {
        edit_custom_post_form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Validate input fields
            const postId = document.getElementById("post_id").value.trim();
            const title = document.getElementById("title").value.trim();
            const description = document.getElementById("description").value.trim();
            const price = document.getElementById("price").value.trim();
            const discount = document.getElementById("discount").value.trim();
            const quantity = document.getElementById("quantity").value.trim();

            if (!title || !description || !price || !quantity) {
                alert("Please fill in all required fields.");
                return;
            }

            if (!foodImage) {
                alert("Please upload an image.");
                return;
            }

            let formData = new FormData();
            formData.append('post_id', postId);
            formData.append('title', title);
            formData.append('description', description);
            formData.append('price', price);
            formData.append('discount', discount);
            formData.append('quantity', quantity);
            formData.append('image', foodImage);
            formData.append('action', 'updatefnc');
            console.log([...formData]);

            try {
                const response = await fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    console.log("Image uploaded successfully:", data);
                    alert("Food Item uploaded successfully.");
                    document.getElementById('output').src = ""; // Clears the image
                    document.getElementById('getImage').value = "";
                    document.getElementById('title').value = "";
                    document.getElementById('description').value = "";
                    document.getElementById('price').value = "";
                    document.getElementById('discount').value = "";
                    document.getElementById('quantity').value = "";

                } else {
                    alert("Upload failed: " + data.message);
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    }
});


// delete post
document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", async function (e) {
        if (e.target.classList.contains("delete-post-btn")) {
            const postId = e.target.dataset.postId;

            if (!postId) {
                alert("Invalid post ID.");
                return;
            }

            if (!confirm("Are you sure you want to delete this post?")) {
                return;
            }

            let formData = new FormData();
            formData.append('post_id', postId);
            formData.append('action', 'deletefnc');

            try {
                const response = await fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    console.log("deleted successfully:", data);
                    // alert("Food Item deleted successfully.");
                    // location.reload();
                    window.location = document.location.href;

                } else {
                    alert("Upload failed: " + data.message);
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        }
    });
});
