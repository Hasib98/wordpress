document.addEventListener("DOMContentLoaded", function () {
    let usernameField = document.querySelector("#user_login");
    let passwordField = document.querySelector("#user_pass");
    let submitButton = document.querySelector("#wp-submit");
    let clogin = document.querySelector("#clogin");

    submitButton.style.display = "none";
    
    let otp_field_group = document.querySelector(".otp_field_group");
    otp_field_group.style.display = "none";
    console.log(otp_field_group.style.display === 'none');


    if(otp_field_group.style.display === 'none'){

        clogin.addEventListener("click", async function (e) {
                e.preventDefault();
                let formData = new FormData();
                formData.append("action", "send_otp");
                formData.append("username", usernameField.value);
                formData.append("password", passwordField.value);
    
                try {
                    let response = await fetch(ajax_object.ajax_url, {
                        method: "POST",
                        body: formData
                    });
    
                    let result = await response.json();
    
                    if (result.success) {
                        otp_field_group.style.display = "block";
                        submitButton.style.display = "block";
                        clogin.style.display = "none";
    
                    } else {
                        console.log( result.message);
                        otp_field_group.style.display = "none";
    
                    }
                } catch (error) {
                    console.error("Error:", error);
                }
            
        });
    }
    if(otp_field_group.style.display === 'block'){
        submitButton.removeEventListener('click',)
    }
    
});


/* 

document.addEventListener("DOMContentLoaded", function () {
    let usernameField = document.querySelector("#user_login");
    let user_pass_wrap = document.querySelector(".user-pass-wrap");
    let passwordField = document.querySelector("#user_pass");
    let submitButton = document.querySelector("#wp-submit");

    let otp_field_group = document.querySelector(".otp_field_group");


    if (otp_field_group) {
        otp_field_group.style.display = "none"; 
        console.log(getComputedStyle(otp_field_group).display === "none");

        submitButton.addEventListener("click", async function (e) {
            e.preventDefault();
            
            let formData = new FormData();
            formData.append("action", "send_otp");
            formData.append("username", usernameField.value);
            formData.append("password", passwordField.value);

            try {
                let response = await fetch(ajax_object.ajax_url, {
                    method: "POST",
                    body: formData
                });

                let result = await response.json();

                if (result.success) {
                    usernameField.parentElement.style.display = "none";
                    user_pass_wrap.style.display = "none";
                    otp_field_group.style.display = "block";
                } else {
                    console.log(result.message);
                    otp_field_group.style.display = "none";
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });
    }
});
 */