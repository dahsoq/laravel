function deleteRecipe(id) {
    if (!confirm("Вы уверены, что хотите удалить рецепт?")) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/recipe/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(res => {
        if (res.ok) {
            const card = document.getElementById(`recipe-${id}`);
            card.classList.add("fade-out");

            setTimeout(() => card.remove(), 300);
        } else {
            return res.json().then(data => {
                alert(data.message || "Ошибка удаления");
            });
        }
    }).catch(() => {
        alert("Ошибка при попытке удалить рецепт.");
    });
}
