

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