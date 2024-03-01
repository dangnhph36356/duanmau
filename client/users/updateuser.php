<div class="register">
    <div class="form-container">
        <h2 class="form-title">Cập nhật tài khoản</h2>
        <form id="update-form" method="post" action="index.php?act=updatepassword">
            <input type="text" name="email" id="update-email" placeholder="Email">
            <input type="text" name="name" id="update-username" placeholder="Tên đăng nhập">
            
            <div class="password-container">
                <input type="password" name="password" id="update-password" placeholder="Mật khẩu">
                <i class="fas fa-eye password-icon" id="password-toggle-update"></i>
            </div>
            
            <div class="password-container">
                <input type="password" id="confirm-password" placeholder="Nhập lại mật khẩu">
                <i class="fas fa-eye password-icon" id="password-toggle-confirm"></i>
            </div>
            
            <input type="date" name="birthday" id="date-of-birth" placeholder="Ngày sinh">
            <input type="text" name="location" id="location" placeholder="Địa chỉ">
            <input id="register-button" type="submit" value="Cập nhật">
        </form>
        
        <p id="message" class="message"></p>
        
        <div class="social-buttons">
            <button class="social-button google">
                <i class="fab fa-google"></i>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var passwordToggleUpdate = document.getElementById("password-toggle-update");
    var passwordInputUpdate = document.getElementById("update-password");
    var confirmPasswordInput = document.getElementById("confirm-password");

    // Toggle password visibility for the update password field
    passwordToggleUpdate.addEventListener("click", function () {
        togglePasswordVisibility(passwordInputUpdate);
    });

    function togglePasswordVisibility(passwordInput) {
        var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
    }

    var updateForm = document.getElementById("update-form");
    updateForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting by default

        // Perform validation
        var email = document.getElementById("update-email").value;
        var username = document.getElementById("update-username").value;
        var password = passwordInputUpdate.value;
        var confirmPassword = confirmPasswordInput.value;
        var dateOfBirth = document.getElementById("date-of-birth").value;
        var location = document.getElementById("location").value;

        var messageElement = document.getElementById("message");
        messageElement.innerHTML = ""; 

        if (!email || !username || !password || !confirmPassword || !dateOfBirth || !location) {
            messageElement.innerHTML = "Vui lòng điền đầy đủ thông tin.";
        } else if (password !== confirmPassword) {
            messageElement.innerHTML = "Mật khẩu và xác nhận mật khẩu không khớp.";
        } else {
            // The form is valid, you can submit it or perform additional actions
            updateForm.submit();
        }
    });
});
</script>
