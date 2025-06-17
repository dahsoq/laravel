function openModal(recipeId) {
    fetch(`/recipe/${recipeId}/json`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalName').textContent = data.name;
            document.getElementById('modalServings').textContent = data.details.servings;
            document.getElementById('modalTime').textContent = data.timeforcooking;
            document.getElementById('modalImg').src = '/' + data.imgpath;

            const ingredientsList = document.getElementById('modalIngredients');
            ingredientsList.innerHTML = '';
            data.ingredients.forEach(item => {
                ingredientsList.innerHTML += `
                    <li>
                        <span class="name">${item.name}</span>
                        <span class="dots"></span>
                        <span class="amount">${item.amount}</span>
                    </li>`;
            });

            const instructionsList = document.getElementById('modalInstructions');
            instructionsList.innerHTML = '';
            data.details.instruction.split('\n').forEach(step => {
                if (step.trim()) {
                    instructionsList.innerHTML += `<li>${step.trim()}</li>`;
                }
            });

            document.getElementById('recipeOverlay').style.display = 'block';
        });
}

function closeModal() {
    document.getElementById('recipeOverlay').style.display = 'none';
}
