const showPassword = document.querySelector('#show-password');
const showPassword1 = document.querySelector('#show-password1');
const passwordField = document.querySelector('#login-password');
const passwordField1 = document.querySelector('#login-password1');

showPassword.addEventListener('click', function () {
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
});

showPassword1.addEventListener('click', function () {
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
    const type = passwordField1.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField1.setAttribute('type', type);
});


