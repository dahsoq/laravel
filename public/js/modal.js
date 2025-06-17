let ingredientIndex = 1;

function addIngredient() {
    const container = document.getElementById('ingredients-container');
    const div = document.createElement('div');
    div.innerHTML = `<input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Название" required>
                     <input type="text" name="ingredients[${ingredientIndex}][amount]" placeholder="Количество" required>`;
    container.appendChild(div);
    ingredientIndex++;
}

function openRecipeModal(id) {
    fetch(`/recipe/${id}/json`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalName').textContent = data.name;
            document.getElementById('modalServings').textContent = data.details.servings;
            document.getElementById('modalTime').textContent = data.timeforcooking;
            document.getElementById('modalImg').src = '/' + data.imgpath;
            let ingrList = document.getElementById('modalIngredients');
            ingrList.innerHTML = '';
            data.ingredients.forEach(ingr => {
                const li = document.createElement('li');
                li.textContent = `${ingr.name} — ${ingr.amount}`;
                ingrList.appendChild(li);
            });
            document.getElementById('modalInstruction').textContent = data.details.instruction;
            document.getElementById('recipeModal').style.display = 'block';
        });
}

function closeRecipeModal() {
    document.getElementById('recipeModal').style.display = 'none';
}
