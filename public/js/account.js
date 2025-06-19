document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const overlay = document.querySelector(".autoFormfon");

    const loginChoice = document.querySelector("#loginChoice");
    const registerChoice = document.querySelector("#registerChoice");

    const openBtn = document.querySelector(".accountcab"); // только если пользователь не авторизован
    const closeBtns = document.querySelectorAll(".authclosebtn");

    //формы входа
    if (openBtn && loginForm && registerForm && overlay) {
        openBtn.addEventListener("click", function () {
            overlay.classList.add("open");
            loginForm.classList.add("open");
            registerForm.classList.remove("open");
        });
    }

    
    if (registerChoice && loginForm && registerForm) {
        registerChoice.addEventListener("click", function () {
            registerForm.classList.add("open");
            loginForm.classList.remove("open");
        });
    }

    if (loginChoice && loginForm && registerForm) {
        loginChoice.addEventListener("click", function () {
            loginForm.classList.add("open");
            registerForm.classList.remove("open");
        });
    }

    closeBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            loginForm.classList.remove("open");
            registerForm.classList.remove("open");
            overlay.classList.remove("open");
        });
    });
});
