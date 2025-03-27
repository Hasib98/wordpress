document.addEventListener("DOMContentLoaded", function () {
  let usernameField = document.querySelector("#user_login");
  let passwordField = document.querySelector("#user_pass");
  let loginButton = document.querySelector("#wp-submit");
  let clogin = document.querySelector("#clogin");
  let otp_field_group = document.querySelector(".otp_field_group");
  let otp_field = document.querySelector("#custom_otp");

  loginButton.style.display = "none";

  otp_field_group.style.display = "none";
  // clogin__________________________________________________________________________________
  clogin.addEventListener("click", async function (e) {
    e.preventDefault();
    let formData = new FormData();
    formData.append("username", usernameField.value);
    formData.append("password", passwordField.value);
    formData.append("action", "send_otp");
    try {
      let response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      let result = await response.json();

      if (result.success) {
        console.log(result);
        clogin.style.display = "none";
        otp_field_group.style.display = "block";

        const countdownElement = document.getElementById("countdown");
        function updateCountdown(countdownTime) {
          let minutes = Math.floor(countdownTime / 60);
          let seconds = countdownTime % 60;

          // Format time as MM:SS
          countdownElement.innerText = `${minutes}:${
            seconds < 10 ? "0" : ""
          }${seconds}`;

          if (countdownTime > 0) {
            setTimeout(() => updateCountdown(countdownTime - 1), 1000); // Pass updated time
          } else {
            document.getElementById("label_text").remove();
            countdownElement.innerText = "OTP Expired!";
          }
        }

        // Start the countdown (5 minutes = 300 seconds)
        updateCountdown(result.countdown);

        loginButton.style.display = "block";
      } else {
        console.log(result.message);
        otp_field_group.style.display = "none";
      }
    } catch (error) {
      console.error("Error:", error);
    }
  });

  //   loginbtn--------------------------------------------------------------------------------
  loginButton.addEventListener("click", async function (e) {
    e.preventDefault();
    let formData = new FormData();
    formData.append("username", usernameField.value);
    formData.append("password", passwordField.value);
    formData.append("otp", otp_field.value);
    console.log(otp_field.value);
    console.log(usernameField.value);
    console.log(passwordField.value);

    formData.append("action", "otp_validation");
    try {
      let response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      let result = await response.json();

      if (result.success) {
        console.log(result);
        window.location.href = result.redirect;
      } else {
        console.log(result.message);
      }
    } catch (error) {
      console.error("Error:", error);
    }
  });
});
