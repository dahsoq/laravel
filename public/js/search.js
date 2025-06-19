document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search');

    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        const container = document.querySelector('.ffrs');
        if (!container) return;

        if (query === '') {
            container.innerHTML = '<p class="empty">Введите запрос...</p>';
            return;
        }

        fetch(`/api/recipe/search?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="empty">Ничего не найдено</p>';
                    return;
                }

                data.forEach(recipe => {
                    container.innerHTML += `
                        <div class="recipe1" id="recipe-${recipe.id}">
                            <img class="recipeimg" src="/${recipe.imgpath}" alt="${recipe.name}">
                            <div class="recipe1txt">${recipe.name}</div>
                            <div class="recipe1txt2">${recipe.description}</div>
                            <div class="clock-warp">
                                <img class="clockrecipe1" src="/Image/clock.jpg" alt="">
                                <div class="clockrecipe1txt">${recipe.timeforcooking} Минут</div>
                            </div>
                            <div class="calories-warp">
                                <img class="caloriesrecipe1" src="/Image/calories.jpg" alt="">
                                <div class="caloriesrecipe1txt">${recipe.amountofcalories} Калорий</div>
                            </div>
                            <button class="recipe1btn" type="button" onclick="openModal(${recipe.id})">Читать подробнее</button>
                        </div>
                    `;
                });
            });
    });
});
