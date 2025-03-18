

document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".offer_swiper", {
        navigation: {
            nextEl: ".swiper-btn-next",
            prevEl: ".swiper-btn-prev",
        },
    });
});

















/* document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".offer_swiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-btn-next",
            prevEl: ".swiper-btn-prev",
        },
    });
}); */

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

/* 
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

*/
async function get_menu(button) {
    const categoryId = button.getAttribute('data-category-id');
    console.log('Category ID:', categoryId);

    // Change the background color of the clicked button to #FBC04E
    button.style.backgroundColor = '#FBC04E';

    // Optional: Reset background color of all other buttons (if needed)
    const categoryButtons = document.querySelectorAll('.category_btn');
    categoryButtons.forEach(function (otherButton) {
        if (otherButton !== button) {
            otherButton.style.backgroundColor = ''; // Reset to original color
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

            // Get the swiper wrapper where the slides will be added
            const swiperWrapper = document.querySelector('.swiper .menu_swiper_wrapper');
            swiperWrapper.innerHTML = ''; // Clear any existing slides

            // Loop through the posts and create a slide for each post
            data.data.posts.forEach(function (post) {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                // slide.classList.add('swiper-slide-test');
                // slide.classList.add('menu_swiper_slide');

                // Create the slide content (HTML) using the post data
                slide.innerHTML = `
                    <div class="menu_item">
                        <div>
                        <img src="${post.image}" alt="${post.title}" class="menu_item_image">
                        </div>
                        <h1 class="menu-item-title">${post.title}</h1>
                        <p class="menu-item-description">${post.description || 'No description available.'}</p>
                        <div class="divider_line"></div>
                        
                        <div class="slide_foot">
                        <a href="${post.permalink}" class="menu_item_link">Learn more</a>
                        <p class="menu_item_price">${post.price || 'No price available.'}</p>
                        </div>
                        

                    </div>
                `;

                // Append the slide to the swiper-wrapper
                swiperWrapper.appendChild(slide);
            });

            // Reinitialize Swiper to reflect the new slides
            if (window.swiperInstance) {
                window.swiperInstance.destroy(true, true); // Destroy the existing swiper instance before reinitializing
            }

            window.swiperInstance = new Swiper(".menu_swiper", {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

        } else {
            alert(data.message); // Show error message if something goes wrong
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.category_btn');

    // Ensure there's at least one category button
    if (categoryButtons.length > 0) {
        // Set the first button as active (optional, for visual feedback)
        categoryButtons[0].style.backgroundColor = '#FBC04E'; // Active color for the first button

        // Trigger the fetch for the first button
        get_menu(categoryButtons[0]);
    }

    // Add event listeners to all category buttons
    categoryButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            get_menu(button);  // Fetch menu for clicked category
        });
    });
});



// document.addEventListener('DOMContentLoaded', function () {
//     const categoryButtons = document.querySelectorAll('.category_btn');
//     // Automatically trigger click on the first button to load the initial category
//     /* if (categoryButtons.length > 0) {
//         // Trigger click on the first category button
//         categoryButtons[0].click();

//         // Set the first button as active (optional, for visual feedback)
//         categoryButtons[0].style.backgroundColor = '#FBC04E'; // Active color for the first button

//         // Optional: Reset the background color for all other buttons
//         categoryButtons.forEach(function (otherButton, index) {
//             if (index !== 0) {
//                 otherButton.style.backgroundColor = ''; // Reset to original color
//             }
//         });
//     } */

//     categoryButtons.forEach(function (button) {
//         button.addEventListener('click'),
//         button.addEventListener('click', async function () {
//             const categoryId = button.getAttribute('data-category-id');
//             console.log('Category ID:', categoryId);

//             // Change the background color of the clicked button to #FBC04E
//             button.style.backgroundColor = '#FBC04E';

//             // Optional: Reset background color of all other buttons (if needed)
//             categoryButtons.forEach(function (otherButton) {
//                 if (otherButton !== button) {
//                     otherButton.style.backgroundColor = ''; // Reset to original color
//                 }
//             });

//             // Create a new FormData object
//             const formData = new FormData();

//             // Append the categoryId and action to the FormData object
//             formData.append("category_id", categoryId);
//             formData.append("action", "get_menu_post_by_category");

//             try {
//                 // Make the fetch request with async/await
//                 const response = await fetch(ajax_object.ajax_url, {
//                     method: "POST",
//                     body: formData
//                 });

//                 const data = await response.json(); // Parse response as JSON

//                 // Check if the request was successful
//                 if (data.success) {
//                     console.log("Server Response:", data);

//                     // Get the swiper wrapper where the slides will be added
//                     const swiperWrapper = document.querySelector('.swiper .swiper-wrapper');
//                     swiperWrapper.innerHTML = ''; // Clear any existing slides

//                     // Loop through the posts and create a slide for each post
//                     data.data.posts.forEach(function (post) {
//                         const slide = document.createElement('div');
//                         slide.classList.add('swiper-slide');

//                         // Create the slide content (HTML) using the post data
//                         slide.innerHTML = `
//                             <div class="menu-item">
//                                 <img src="${post.image}" alt="${post.title}" class="menu-item-image">
//                                 <h3 class="menu-item-title">${post.title}</h3>
//                                 <p class="menu-item-description">${post.excerpt || 'No description available.'}</p>
//                                 <a href="${post.permalink}" class="menu-item-link">View Item</a>
//                             </div>
//                         `;

//                         // Append the slide to the swiper-wrapper
//                         swiperWrapper.appendChild(slide);
//                     });

//                     // Reinitialize Swiper to reflect the new slides
//                     new Swiper(".menu_swiper", {
//                         slidesPerView: 3,
//                         spaceBetween: 30,
//                         freeMode: true,
//                         pagination: {
//                             el: ".swiper-pagination",
//                             clickable: true,
//                         },
//                     });
//                 } else {
//                     alert(data.message); // Show error message if something goes wrong
//                 }
//             } catch (error) {
//                 console.error("Error:", error);
//                 alert("An error occurred. Please try again.");
//             }
//         });
//     });
// });


/* 
document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.category_btn');

    // Automatically trigger click on the first button to load the initial category
    if (categoryButtons.length > 0) {
        // Trigger click on the first category button
        categoryButtons[0].click();

        // Set the first button as active (optional, for visual feedback)
        categoryButtons[0].style.backgroundColor = '#FBC04E'; // Active color for the first button

        // Optional: Reset the background color for all other buttons
        categoryButtons.forEach(function (otherButton, index) {
            if (index !== 0) {
                otherButton.style.backgroundColor = ''; // Reset to original color
            }
        });
    }

    // Add event listeners to all category buttons
    categoryButtons.forEach(function (button) {
        button.addEventListener('click', async function () {
            const categoryId = button.getAttribute('data-category-id');
            console.log('Category ID:', categoryId);

            // Change the background color of the clicked button to #FBC04E
            button.style.backgroundColor = '#FBC04E';

            // Optional: Reset background color of all other buttons (if needed)
            categoryButtons.forEach(function (otherButton) {
                if (otherButton !== button) {
                    otherButton.style.backgroundColor = ''; // Reset to original color
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

                    // Get the swiper wrapper where the slides will be added
                    const swiperWrapper = document.querySelector('.swiper .swiper-wrapper');
                    swiperWrapper.innerHTML = ''; // Clear any existing slides

                    // Loop through the posts and create a slide for each post
                    data.data.posts.forEach(function (post) {
                        const slide = document.createElement('div');
                        slide.classList.add('swiper-slide');

                        // Create the slide content (HTML) using the post data
                        slide.innerHTML = `
                            <div class="menu-item">
                                <img src="${post.image}" alt="${post.title}" class="menu-item-image">
                                <h3 class="menu-item-title">${post.title}</h3>
                                <p class="menu-item-description">${post.excerpt || 'No description available.'}</p>
                                <a href="${post.permalink}" class="menu-item-link">View Item</a>
                            </div>
                        `;

                        // Append the slide to the swiper-wrapper
                        swiperWrapper.appendChild(slide);
                    });

                    // Reinitialize Swiper to reflect the new slides
                    new Swiper(".menu_swiper", {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        freeMode: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                    });
                } else {
                    alert(data.message); // Show error message if something goes wrong
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});
 */

/* document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.category_btn');

    // Ensure there's at least one category button
    if (categoryButtons.length > 0) {
        // Add the 'active' class to the first button visually
        categoryButtons[0].classList.add('active');

        // Trigger click on the first button to load the content via fetch request
        categoryButtons[0].click(); // Simulate a click on the first button directly
    }

    // Add event listeners to all category buttons
    categoryButtons.forEach(function (button) {
        button.addEventListener('click', async function () {
            const categoryId = button.getAttribute('data-category-id');
            console.log('Category ID:', categoryId);

            // Change the background color of the clicked button to #FBC04E
            button.style.backgroundColor = '#FBC04E';

            // Optional: Reset background color of all other buttons (if needed)
            categoryButtons.forEach(function (otherButton) {
                if (otherButton !== button) {
                    otherButton.style.backgroundColor = ''; // Reset to original color
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

                    // Get the swiper wrapper where the slides will be added
                    const swiperWrapper = document.querySelector('.swiper .swiper-wrapper');
                    swiperWrapper.innerHTML = ''; // Clear any existing slides

                    // Loop through the posts and create a slide for each post
                    data.data.posts.forEach(function (post) {
                        const slide = document.createElement('div');
                        slide.classList.add('swiper-slide');

                        // Create the slide content (HTML) using the post data
                        slide.innerHTML = `
                            <div class="menu-item">
                                <img src="${post.image}" alt="${post.title}" class="menu-item-image">
                                <h3 class="menu-item-title">${post.title}</h3>
                                <p class="menu-item-description">${post.excerpt || 'No description available.'}</p>
                                <a href="${post.permalink}" class="menu-item-link">View Item</a>
                            </div>
                        `;

                        // Append the slide to the swiper-wrapper
                        swiperWrapper.appendChild(slide);
                    });

                    // Reinitialize Swiper to reflect the new slides after the content is added
                    new Swiper(".menu_swiper", {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        freeMode: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                    });
                } else {
                    alert(data.message); // Show error message if something goes wrong
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});
 */