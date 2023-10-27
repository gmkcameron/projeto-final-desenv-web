// Código JavaScript para criar e listar postagens
document.addEventListener("DOMContentLoaded", function () {
    const postList = document.getElementById("post-list");
    const postForm = document.getElementById("post-form");

    postForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const title = document.getElementById("title").value;
        const content = document.getElementById("content").value;
        
        const post = { title, content };
        savePost(post);
        displayPosts();
        postForm.reset();
    });

    function savePost(post) {
        let posts = JSON.parse(localStorage.getItem("posts")) || [];
        posts.push(post);
        localStorage.setItem("posts", JSON.stringify(posts));
    }

    function displayPosts() {
        postList.innerHTML = "";
        const posts = JSON.parse(localStorage.getItem("posts")) || [];
        posts.forEach((post, index) => {
            const postItem = document.createElement("div");
            postItem.innerHTML = `<h3>${post.title}</h3><p>${post.content}</p>`;
            postList.appendChild(postItem);
        });
    }

    displayPosts();
});
