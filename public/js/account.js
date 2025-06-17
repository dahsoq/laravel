/*Открытие формы*/

document.addEventListener("DOMContentLoaded", function () {
  const btn = document.querySelector(".accountcab");
  const dropdown = document.querySelector(".authorizationForm");
  const fon = document.querySelector(".autoFormfon");
  btn.addEventListener("click", function (event) {
    fon.classList.toggle("open");
    dropdown.classList.toggle("open");
  });
});

/*Смена формы*/
document.addEventListener("DOMContentLoaded", function () {
  const choices = document.querySelectorAll(".authorizationchoice");
  const loginBtn = choices[0];
  const registerBtn = choices[1];
  const forms = document.querySelectorAll(".authorizationForm");
  const loginForm = forms[0];
  const registerForm = forms[1];
  const closeBtns = document.querySelectorAll(".authclosebtn");
  const overlay = document.querySelector(".autoFormfon");

  loginBtn.addEventListener("click", function () {
    registerForm.classList.toggle("open");
    loginForm.classList.remove("open");
  });

  registerBtn.addEventListener("click", function () {
    loginForm.classList.toggle("open");
    registerForm.classList.remove("open");
  });

  closeBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      loginForm.classList.remove("open");
      registerForm.classList.remove("open");
      overlay.classList.remove("open");
    });
  });
});

/*Проверка валидности*/
const email = document.getElementById("email");
const passwordInput = document.getElementById("password");
const form = document.getElementById("authForm");
email.addEventListener("input", function (event) {
  if (email.validity.typeMismatch) {
    email.setCustomValidity("Проверьте ввод своей почты");
  } else {
    email.setCustomValidity("");
  }
  email.reportValidity();
});
form.addEventListener("submit", function (event) {
  localStorage.email = email.value;
  localStorage.password = passwordInput.value;
});

document.querySelector(".button1").addEventListener("click", function () {
  window.location.href = "./recipes.html";
});
