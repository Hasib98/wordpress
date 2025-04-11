document.addEventListener("DOMContentLoaded", function () {
  let usernameField = document.querySelector("#user_login");
  let passwordField = document.querySelector("#user_pass");
  let loginButton = document.querySelector("#wp-submit");
  let rememberme = document.querySelector("#rememberme");

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
        clogin.remove();
        showMessage(result.message, result.success);
        otp_field_group.style.display = "block";

        const countdownElement = document.getElementById("countdown");
        function updateCountdown(countdownTime) {
          let minutes = Math.floor(countdownTime / 60);
          let seconds = countdownTime % 60;

          countdownElement.innerText = `${minutes}:${
            seconds < 10 ? "0" : ""
          }${seconds}`;

          if (countdownTime > 0) {
            setTimeout(() => updateCountdown(countdownTime - 1), 1000);
          } else {
            document.getElementById("label_text").remove();
            countdownElement.innerText = "OTP Expired!";
          }
        }
        updateCountdown(result.countdown);
        loginButton.style.display = "block";
      } else {
        console.log(result);
        showMessage(result.message, result.success);
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
    formData.append("rememberme", rememberme.value);
    formData.append("otp", otp_field.value);

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
        showMessage(result.message, result.success);
      }
    } catch (error) {
      console.error("Error:", error);
    }
  });
});

function showMessage(message, success) {
  console.log(success);

  if (document.getElementById("login-message")) {
    document.getElementById("login-message").remove();
  }
  let messageDiv = document.createElement("div");
  messageDiv.id = "login-message";
  messageDiv.className = `notice notice-${success ? "info" : "error"} message`;
  messageDiv.innerHTML = "<p>" + message + "</p>";

  let parentDiv = document.getElementById("login");

  let firstChild = parentDiv.children[0];

  parentDiv.insertBefore(messageDiv, firstChild.nextSibling);
}
