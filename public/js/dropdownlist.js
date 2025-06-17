document.addEventListener("DOMContentLoaded", function () {
  const btn = document.querySelector(".abtn");
  const dropdown = document.getElementById("dropdown-menu");
  const elem = document.querySelectorAll("li");
  btn.addEventListener("click", function (event) {
    dropdown.classList.toggle("open");
  });
  document.addEventListener("click", function (event) {
    if (!dropdown.contains(event.target) && !btn.contains(event.target)) {
      dropdown.classList.remove("open");
    }
  });
});
/*Анимация выпадающего списка*/
$(document).ready(function () {
  $(".abtn").click(function (e) {
    e.preventDefault();
    $("#dropdown-menu").slideToggle();
  });

  $(document).click(function (e) {
    if (!$(e.target).closest(".dropdown-menu, .abtn").length) {
      $("#dropdown-menu").slideUp();
    }
  });
});
