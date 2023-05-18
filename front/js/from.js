const login_email = document.getElementById("email-user");
const login_password = document.getElementById("password-user");
const send_login_password = document.getElementById("send-user");
const login_alert = document.getElementById("login-alert");

function validateEmail(email) {
  const regexPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regexPattern.test(email);
}

send_login_password?.addEventListener("click", (event) =>
{
    let message = `<ul>`
    let error = false;
    if (login_password) {
        if (!login_password.value) {
            message += `<li>Password must be given</li>`;
            error = true;
        }
        if (login_password.value.length < 8) {
            message += `<li>Password must be at least 8 characters</li>`
            error = true;
        }
    }
    if (login_email) {
        if (!login_email.value) {
            message += `<li>Email must be given</li>`;
            error = true;
        }
        if (!validateEmail(login_email.value)) {
            message += `<li>Email is not valid</li>`;
            error = true;
        }
    
    }
    message += '</ul>';
    login_alert.innerHTML = message;

    if (error) {
        event.preventDefault();
        login_alert.classList.remove("d-none");
    } else {
        login_alert.classList.add("d-none");
    }
});
