function togglePassword() {
    var passwordField = document.getElementById("password");
    var toggleIcon = document.getElementById("togglePassword");

    if (passwordField.type === "password") {
      passwordField.type = "text";
      toggleIcon.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; // Change to an open eye icon
    } else {
      passwordField.type = "password";
      toggleIcon.innerHTML = '<i class="fa-regular fa-eye"></i>'; // Change to a closed eye icon
    }
  }