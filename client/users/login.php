
<div class="login-template">
<div class="form-container">
    <h2 class="form-title">Đăng nhập</h2>
    <form id="login-form" method="post" action="index.php?act=login" >
        <input type="text" name="user_login" id="login-username" placeholder="Username" >
        <div class="password-container">
            <input type="password" name="password_login" id="login-password" placeholder="Password" >
            <i class="fas fa-eye password-icon" id="password-toggle"></i>
        </div>
        <input id="login-button" type="submit" value="Đăng nhập">
        <a   id="login-button" href="register.php">Đăng ký</a>

    </form>
    <p><a href="index.php?act=forgotpassword">Quên mật khẩu</a></p>
    <p id="message" class="message"></p>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var loginForm = document.getElementById("login-form");
    var passwordInput = document.getElementById("login-password");
    var passwordToggle = document.getElementById("password-toggle");

    passwordToggle.addEventListener("click", function () {
        var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
    });

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault(); 

        var username = document.getElementById("login-username").value;
        var password = document.getElementById("login-password").value;

        var messageElement = document.getElementById("message");
        messageElement.innerHTML = ""; 

        if (!username || !password) {
            messageElement.innerHTML = "Vui lòng điền đầy đủ thông tin.";
        } else {
            loginForm.submit();
        }
    });
});
</script>
