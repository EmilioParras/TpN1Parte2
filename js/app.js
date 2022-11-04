"use strict"

const URL = "api/zapatillas/";


let zapatillas = [];

let form = document.querySelector('#zapatillas-form');
form.addEventListener('submit', insertZapatilla);

    async function getAll() {
        try {
            let response = await fetch(URL);
            if (!response.ok) {
                throw new Error ('Recurso inexistente');
            }
                zapatillas = await response.json();

                showZapatillas();
        } catch(e) {
            console.log(e);
        }
    }

    async function insertZapatilla(e) {
        e.preventDefault();
        
        let data = new FormData(form);
        let zapatilla = {
            nombre: data.get('nombre'),
            marca: data.get('descripcion'),
            precio: data.get('precio'),
            talle: data.get('talle'),
            id_categoria_fk: data.get('id_categoria_fk'),
        };
    
        try {
            let response = await fetch(URL, {
                method: "POST",
                headers: { 'Content-Type': 'application/json'},
                body: JSON.stringify(zapatilla)
            });
            if (!response.ok) {
                throw new Error('Error del servidor');
            }
    
            let nZapatilla = await response.json();
    
            // inserto la tarea nuevo
            tasks.push(nZapatilla);
            showTasks();
    
            form.reset();
        } catch(e) {
            console.log(e);
        }
    } 
    
    async function deleteTask(e) {
        e.preventDefault();
        try {
            let id = e.target.dataset.zapatilla;
            let response = await fetch(URL + id, {method: 'DELETE'});
            if (!response.ok) {
                throw new Error('Recurso no existe');
            }
    
            // eliminar la tarea del arreglo global
            zapatilla = zapatilla.filter(zapatilla => zapatilla.id != id);
            showTasks();
        } catch(e) {
            console.log(e);
        }
    }

    function showZapatillas() {
        let ul = document.querySelector("#zapatillas-list");
        ul.innerHTML = "";
        for (const zapa of zapatillas) {
    
            let html = `
            <div class="container d-flex justify-content-center">
                <div class="align-items-center">
                    <h1 class="text-center">Zapatillas</h1>
                    <ul class="row">
                        <div class="card mt-5 mx-5 col-xl-2" style="width: 20rem;">
                            <img src=${zapa.imagen} class="card-img-top" alt="{$zapa->nombre}>
                            <div class="card-body">
                                <h5 class="card-title">${zapa.nombre}</h5>
                                <p class="card-text">Talles disponibles:${zapa.talles}</p>
                                <p class="card-text">Precio:${zapa.precio}</p>
                                <a href="show/${zapa.id}" class="btn btn-primary">Ver detalles</a>
                            </div>
                        </div>
                    </ul> 
                </div>
            </div>   
            `;
            ul.innerHTML += html;
        }
    
   // asigno event listener para los botones
   const btnsDelete = document.querySelectorAll('a.btn-delete');
   for (const btnDelete of btnsDelete) {
       btnDelete.addEventListener('click', deleteTask);
   }
}

getAll();
    
