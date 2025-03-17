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
     new Swiper(".xxxxx", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
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
