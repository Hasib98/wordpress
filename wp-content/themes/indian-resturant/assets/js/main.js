/* document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".offer_cards_container", {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: ".right",
            prevEl: ".left",
        },
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
});
 */

document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".mySwiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-btn-next",
            prevEl: ".swiper-btn-prev",
        },
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("reservationForm");
    const submitButton = document.querySelector(".form_submit_button");

    form.addEventListener("submit", async function (event) {
        event.preventDefault(); // Prevent page reload

        // Get input values
        const name = document.getElementById("name").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const email = document.getElementById("email").value.trim();
        const persons = document.getElementById("persons").value;
        const date = document.getElementById("date").value;
        const time = document.getElementById("time").value;

        // Validation checks
        if (name === "" || phone === "" || email === "" || date === "" || time === "") {
            alert("All fields are required!");
            return;
        }

        if (!/^[a-zA-Z\s]+$/.test(name)) {
            alert("Please enter a valid name (letters and spaces only).");
            return;
        }

        if (!/^\d{10,15}$/.test(phone)) {
            alert("Please enter a valid phone number (10-15 digits).");
            return;
        }

        if (!/^\S+@\S+\.\S+$/.test(email)) {
            alert("Please enter a valid email address.");
            return;
        }
        submitButton.disabled = true;

        // ✅ Create FormData object
        const formData = new FormData();
        formData.append("name", name);
        formData.append("phone", phone);
        formData.append("email", email);
        formData.append("persons", persons);
        formData.append("date", date);
        formData.append("time", time);
        formData.append("action", "reservation_form_submission"); // ✅ Extra field for AJAX handling

        // ✅ Send data using fetch
        try {
            const response = await fetch(ajax_object.ajax_url, {
                method: "POST",
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                console.log("Server Response:", data);
                alert("Reservation submitted successfully!");
                form.reset(); // ✅ Clear fields after success
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        }
        submitButton.disabled = false;
    });
});


document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".menu_swiper", {
       slidesPerView: 3,
       spaceBetween: 30,
       freeMode: true,
       pagination: {
         el: ".swiper-pagination",
         clickable: true,
       },
     });
});

document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.btn');
    
    categoryButtons.forEach(function(button) {
        button.addEventListener('click', async function() {
            const categoryId = button.getAttribute('data-category-id');
            console.log('Category ID:', categoryId);  

            // Change the background color of the clicked button to #FBC04E
            button.style.backgroundColor = '#FBC04E';

            // Optional: Reset background color of all other buttons (if needed)
            categoryButtons.forEach(function(otherButton) {
                if (otherButton !== button) {
                    otherButton.style.backgroundColor = '';  // Reset to original color
                }
            });

            // Create a new FormData object
            const formData = new FormData();
            
            // Append the categoryId and action to the FormData object
            formData.append("category_id", categoryId);
            formData.append("action", "get_menu_post_by_category");

            try {
                // Make the fetch request with async/await
                const response = await fetch(ajax_object.ajax_url, {
                    method: "POST",
                    body: formData
                });

                const data = await response.json(); // Parse response as JSON

                // Check if the request was successful
                if (data.success) {
                    console.log("Server Response:", data);
                    // Insert the posts into the page (assuming you have a container for this)
                    // document.getElementById('menu-posts-container').innerHTML = data.posts;
                } else {
                    alert(data.message);  // Show error message if something goes wrong
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});



/* document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.btn');
    
    categoryButtons.forEach(function(button) {
        button.addEventListener('click', async function() {
            const categoryId = button.getAttribute('data-category-id');
            console.log('Category ID:', categoryId);  

            // Change the background color of the clicked button to #FBC04E
            button.style.backgroundColor = '#FBC04E';

            // Optional: Reset background color of all other buttons (if needed)
            categoryButtons.forEach(function(otherButton) {
                if (otherButton !== button) {
                    otherButton.style.backgroundColor = '';  // Reset to original color
                }
            });

            // Create a new FormData object
            const formData = new FormData();
            
            // Append the categoryId and action to the FormData object
            formData.append("category_id", categoryId);
            formData.append("action", "get_menu_post_by_category");

            try {
                // Make the fetch request with async/await
                const response = await fetch(ajax_object.ajax_url, {
                    method: "POST",
                    body: formData
                });

                const data = await response.json(); // Parse response as JSON

                // Check if the request was successful
                if (data.success) {
                    console.log("Server Response:", data);
                    
                    // Clear existing Swiper slides if needed (optional)
                    const postsContainer = document.querySelector('.swiper-wrapper');
                    postsContainer.innerHTML = ''; // Clear the previous posts

                    // Loop through the posts and generate new swiper slides
                    data.posts.forEach(post => {
                        const postElement = document.createElement('div');
                        postElement.classList.add('swiper-slide'); // Add the swiper-slide class

                        // Build the HTML content for the post slide
                        postElement.innerHTML = `
                            <div class="menu-item">
                                <h3><a href="${post.permalink}">${post.title}</a></h3>
                                <p>${post.excerpt}</p>
                                ${post.image ? `<img src="${post.image}" alt="${post.title}">` : ''}
                            </div>
                        `;

                        // Append the newly created slide to the swiper-wrapper
                        postsContainer.appendChild(postElement);
                    });

                    // Initialize or update Swiper instance
                    // initializeSwiper();

                } else {
                    alert(data.message);  // Show error message if something goes wrong
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});





document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper
    const swiper = new Swiper('.menu_swiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    const categoryButtons = document.querySelectorAll('.btn');
    
    categoryButtons.forEach(function(button) {
        button.addEventListener('click', async function() {
            const categoryId = button.getAttribute('data-category-id');
            console.log('Category ID:', categoryId);  

            // Change the background color of the clicked button to #FBC04E
            button.style.backgroundColor = '#FBC04E';

            // Optional: Reset background color of all other buttons (if needed)
            categoryButtons.forEach(function(otherButton) {
                if (otherButton !== button) {
                    otherButton.style.backgroundColor = '';  // Reset to original color
                }
            });

            // Create a new FormData object
            const formData = new FormData();
            
            // Append the categoryId and action to the FormData object
            formData.append("category_id", categoryId);
            formData.append("action", "get_menu_post_by_category");

            try {
                // Make the fetch request with async/await
                const response = await fetch(ajax_object.ajax_url, {
                    method: "POST",
                    body: formData
                });

                const data = await response.json(); // Parse response as JSON

                // Check if the request was successful
                if (data.success) {
                    console.log("Server Response:", data);
                    
                    // Clear existing Swiper slides if needed (optional)
                    const postsContainer = document.querySelector('.swiper-wrapper');
                    postsContainer.innerHTML = ''; // Clear the previous posts

                    // Loop through the posts and generate new swiper slides
                    data.posts.forEach(post => {
                        const postElement = document.createElement('div');
                        postElement.classList.add('swiper-slide'); // Add the swiper-slide class

                        // Build the HTML content for the post slide
                        postElement.innerHTML = `
                            <div class="menu-item">
                                <h3><a href="${post.permalink}">${post.title}</a></h3>
                                <p>${post.excerpt}</p>
                                ${post.image ? `<img src="${post.image}" alt="${post.title}">` : ''}
                            </div>
                        `;

                        // Append the newly created slide to the swiper-wrapper
                        postsContainer.appendChild(postElement);
                    });

                    // Update Swiper to include the new slides without reinitializing
                    swiper.update();

                } else {
                    alert(data.message);  // Show error message if something goes wrong
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});


 */