document
    .getElementById("commentForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        const username = document.getElementById("username").value.trim();
        const commentText = document.getElementById("commentText").value.trim();

        if (username && commentText) {
            const response = await fetch("/comments", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ username: username, text: commentText }),
            });

            if (response.ok) {
                await displayComments();
                e.target.reset();
            } else {
                alert("Ошибка при отправке комментария");
            }
        }
    });

async function displayComments() {
    const response = await fetch("/comments");
    const comments = await response.json();

    const container = document.getElementById("commentsContainer");
    container.innerHTML = "";

    comments.forEach((c) => {
        const div = document.createElement("div");
        div.innerHTML = `<strong>${c.username}</strong> (${new Date(
            c.created_at
        ).toLocaleString()}):<br>${c.text}<hr>`;
        container.appendChild(div);
    });
}

window.onload = displayComments;
