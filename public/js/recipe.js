const a = document.querySelector(".recipe1btn");
const b = document.getElementById("recipeOverlay");
const c = document.querySelector(".close-button");
const overlay = document.querySelector(".autoFormfon");
/*Открытие рецепта*/
a.addEventListener("click", function (event) {
  b.classList.toggle("open");
  overlay.classList.toggle("open");
});
c.addEventListener("click", function (event) {
  b.classList.remove("open");
  overlay.classList.remove("open");
});
