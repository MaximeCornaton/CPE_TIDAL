const url = new URL(window.location.href);
const params = new URLSearchParams(url.search);
const page = params.get("page");
const errorValue = params.get("error");

if(errorValue == "true") {
  document.querySelector(".password-error").style.display = "block";
}

if(page == "password") {
const form = document.querySelector('.update-form');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');

    form.addEventListener('submit', function(event) {
    if (newPassword.value !== confirmPassword.value) {
        event.preventDefault();
        alert('Les mots de passe ne correspondent pas.');
        confirmPassword.focus();
    }
    });
}

if(page == null){
  document.querySelector("sctn-search-bar").style.display = "block";

}