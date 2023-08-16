const password1 = document.querySelector('#login-password');
const password2 = document.querySelector('#login-password1');

function checkPasswords() {
    const password1Value = password1.value;
    const password2Value = password2.value;
    const paragraphText = document.querySelector(".result-text");

    if (password1Value.length > 4) {
        if (password1Value === password2Value) {
            paragraphText.textContent = "Hesla jsou stejná!";
            paragraphText.classList.add("valid");
            paragraphText.classList.remove("invalid");
        } else {
            paragraphText.textContent = "Hesla nejsou stejná!";
            paragraphText.classList.add("invalid");
            paragraphText.classList.remove("valid");
        }
    } else {
        paragraphText.textContent = "Heslo musí mít minimálně 5 znaků.";
        paragraphText.classList.add("invalid");
        paragraphText.classList.remove("valid");
    }
}

password1.addEventListener("input", checkPasswords);
password2.addEventListener("input", checkPasswords);



