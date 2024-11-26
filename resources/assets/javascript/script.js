const eyeIcon = document.getElementById("eye");
const passwordField = document.getElementById("password");
eyeIcon &&
  eyeIcon.addEventListener("click", () => {
    if (passwordField.type === "password" && passwordField.value) {
      passwordField.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  });

const showButton = document.getElementById("showButton");
const form = document.getElementById("form");
var closeButtons = document.querySelectorAll("#form  .close");

showButton &&
  showButton.addEventListener("click", function () {
    form.style.display = "block";
    overlay.style.display = "block";
    form.style.overflowY = "scroll";

    document.body.style.overflow = "hidden";
  });

closeButtons &&
  closeButtons.forEach(function (closeButton) {
    closeButton.addEventListener("click", function () {
      form.style.display = "none";
      overlay.style.display = "none";
      document.body.style.overflow = "auto";
    });
  });
