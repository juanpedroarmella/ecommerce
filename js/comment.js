"use strict";
let app = new Vue({
    el: '#vue-comment',
    data: {
        comment: [],
        loged: "loged"
    },
    methods: {
        deleteComment: function (id){
           let url = "api/comentario/" + id;
           console.log(url);
           fetch(url, {
                    method:'DELETE'
            })
        
            .then(function(r){
                getComment();
                })
            .catch(error => console.log(error));
        }
      }  
});


document.addEventListener('DOMContentLoaded', () => {
    getComment();
    document.querySelector('#form-comment').addEventListener('submit', e => {
        // evita el envio del form default
        e.preventDefault();
        
        addComment();
    });
    

    
});

function getComment() {
    let id = document.querySelector(".ids").id;
    console.log(id);
    let log = document.querySelector(".loged").id;
    let url = "api/producto/" + id;
    fetch(url)
    .then(response => response.json())
    .then(comment => app.comment = comment)
    //.then(function(json){
        //console.log(json.length);//devuelve cantidad del contenido de este llamado api, en este caso tiene un id, solo trae los que tiene id
      //  console.log(json);//este devuelve el contenido en forma de arreglo de json
    //})
    .catch(error => console.log(error));

    app.loged = log;
}

function addComment(){
    
    let comment = {
            comment: document.querySelector('#comment').value,
            score: document.querySelector('#score').value,
            id_product: document.querySelector(".ids").id 
    }
    console.log(comment);
    fetch("api/producto", {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(comment)
    })

    .then(response => response.json())
    .then(function(r){
        getComment();
        })
    .catch(error => console.log(error));
}


