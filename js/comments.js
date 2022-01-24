"use strict";
document.addEventListener("DOMContentLoaded", function (event) {

    function getComments() {

        let box = document.querySelector('#commentsBox');
        let permits = box.dataset.permits;
        let product = box.dataset.id;
        let url = 'api/comments/' + product;
        fetch(url)
            .then(response => response.json())
            .then(comments => {
                if (comments.length > 0) {
                    box.innerHTML = "";
                    for (let comment of comments) {
                        box.appendChild(createComment(comment, permits));
                        box.innerHTML += "<hr>";
                    } 
                }else
                box.innerHTML = "<p>Esta publicacion no tiene comentarios aun.</p>";
                activateButtons();
            })
            .catch(error => console.log(error));
    }

    function createComment(comment, permits) {
        //Creo los elementos del comentario
        let commentDiv = document.createElement('div');
        let username = document.createElement('h3');
        let score = document.createElement('p');
        let text = document.createElement('p');
        //Creo el contenido
        let content = document.createTextNode(comment.user);
        username.appendChild(content);
        content = document.createTextNode("Puntuación: " + comment.score);
        score.appendChild(content);
        content = document.createTextNode(comment.text);
        text.appendChild(content);
        //Construyo el comentario
        commentDiv.appendChild(username);
        commentDiv.appendChild(score);
        commentDiv.appendChild(text);
        if (permits == 'admin') {
            let button = document.createElement('button');
            button.dataset.id = comment.id;
            button.classList.add('deleteButton');
            button.innerHTML = 'borrar';
            commentDiv.appendChild(button);
        }
        return commentDiv;
    }

    function activateButtons() {
        let buttons = document.querySelectorAll('.deleteButton');
        let commentButton = document.querySelector('#commentButton');
        commentButton.addEventListener('click',insertComment);
        for (let button of buttons) {
            button.addEventListener('click', deleteComment);
        }
    }

    function deleteComment() {
        let id = this.dataset.id;
        let url = 'api/comments/'+id;
        fetch(url, {
            method: 'DELETE'
        })
        .then(response => {
            response.text().then(console.log);
            getComments();
        })
        .catch(error => console.log(error));
    }

    function insertComment(event) {
        
        
        let product = this.dataset.product;
        let user = this.dataset.user;
        let url = 'api/comments/';
        let score = document.querySelector("#score").value;
        let review = document.querySelector("#review").value;
        console.log(user);
        if ((product != '')&&(score != '')&&(review != '')) {
            let data = {
                "user": user,
                "score": parseInt(score),
                "text": review,
                "product": parseInt(product)
            }
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers:{
                  'Content-Type': 'application/json'
                }
              }).then(response => {
                response.json();
                getComments();     
            }).catch(error => console.log(error));
        }
    }

    getComments();
});