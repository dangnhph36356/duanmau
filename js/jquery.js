function register(){
document.getElementById("register-button").addEventListener("click", function (event) {
            event.preventDefault();
            const fullName = document.getElementById("full-name").value;
            const dateOfBirth = document.getElementById("date-of-birth").value;
            const location = document.getElementById("location").value;
            const username = document.getElementById("register-username").value;
            const email = document.getElementById("register-email").value;
            const password = document.getElementById("register-password").value;
            const confirmPassword = document.getElementById("confirm-password").value;

            if (fullName && dateOfBirth && location && username && email && password && confirmPassword) {
                if (password === confirmPassword) {
                    // Replace this with your registration logic
                    // For this example, we'll simply show a success message
                    document.getElementById("message").innerText = "Registration successful!";
                } else {
                    document.getElementById("message").innerText = "Passwords do not match.";
                }
            } else {
                document.getElementById("message").innerText = "Please fill in all fields.";
            }
        });
    }
register();
const passwordInput = document.getElementById("login-password");
const passwordToggle = document.getElementById("password-toggle");

passwordToggle.addEventListener("click", () => {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.classList.remove("fa-eye");
        passwordToggle.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        passwordToggle.classList.remove("fa-eye-slash");
        passwordToggle.classList.add("fa-eye");
    }
});

document.getElementById("login-button").addEventListener("click", function (event) {
    event.preventDefault();
    const username = document.getElementById("login-username").value;
    const password = document.getElementById("login-password").value;

    if (username && password) {
        // Replace this with your login logic
        // For this example, we'll simply show a success message
        document.getElementById("message").innerText = "Login successful!";
        document.getElementById("message").classList.add("success");
    } else {
        document.getElementById("message").innerText = "Please fill in all fields.";
        document.getElementById("message").classList.remove("success");
    }
});
  