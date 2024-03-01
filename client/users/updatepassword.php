

<div class="login-template">
<div class="form-container">
    <h2 class="form-title">Quên mật khẩu</h2>
    <form id="forgot-password-form" method="post" action="index.php?act=forgotpassword" >
        <input type="text" name="user_forgot" id="forgot-username" placeholder="Tên" >
        <div class="password-container">
            <input type="text" name="email" id="forgot-password" placeholder="email" >
        </div>
        <input id="login-button" type="submit" value="Gửi">
        
    <p id="message" class="message"></p>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var forgotPasswordForm = document.getElementById("forgot-password-form");

    forgotPasswordForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting by default

        // Perform validation
        var username = document.getElementById("forgot-username").value;
        var email = document.getElementById("forgot-password").value;

        var messageElement = document.getElementById("message");
        messageElement.innerHTML = ""; // Clear previous error messages

        if (!username || !email) {
            messageElement.innerHTML = "Vui lòng nhập tên và email.";
        } else {
            // The form is valid, you can submit it or perform additional actions
            forgotPasswordForm.submit();
        }
    });
});
</script>