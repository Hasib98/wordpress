document.querySelector('input[name="log"]').value = "smhasib1999@gmail.com";
document.querySelector('input[name="pwd"]').value = "root";

document.getElementById("send_otp_btn").addEventListener("click", async function() {

    const  user = document.querySelector('input[name="log"]').value;
    const  pass = document.querySelector('input[name="pwd"]').value;
    alert("send_otp_btn_clicked" + user + pass );

    let formData = new FormData();
    formData.append('user_id_email', user);
    formData.append('pass', pass);
    formData.append('action', 'send_otp');

    document.getElementById("send_otp_btn").disabled = true;

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
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
    }
    document.getElementById("send_otp_btn").disabled = false;


});
