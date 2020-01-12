'use strict';

function enviarDatos(){
    let formulario = document.querySelector('#formulario');
    let input = formulario.getElementsByTagName('input');
    let mensaje = document.querySelector('#mensaje');

    formulario.addEventListener('submit',envetoFormulario);

    function envetoFormulario(){
        event.preventDefault();

        if(!input[0].value){
            alert('Ingrese el nombre');
        }
        else if(!mensaje.value){
            alert('Ingrese el mensaje');
        }
        else{
            let fecha = new Date();
            let timestamp = `${fecha.getFullYear()}-${fecha.getMonth()+1}-${fecha.getDate()}  ${fecha.getHours()}:${fecha.getMinutes()}:${fecha.getSeconds()}`;
            var datos = 
                { nombre: input[0].value,
                  mensaje: mensaje.value,
                  fecha:timestamp
                }
                console.log(datos);
            $.ajax({
                type:'POST',
                url:'http://localhost:8088/cristian/salaChat/php/ingresarDatos.php',
                data:datos,
                success:function(response){
                    console.log(response);
                },
                error:function(err){
                    console.log(err);
                }
            })
            // let sonido = document.createElement('embed');
            // sonido.loop = false;
            // sonido.src = '';
            // sonido.hidden = true;
            // sonido.autoplay = true;

            // input[0].value = '';
            mensaje.value = '';
        }
    }
}

function recargarPagina(){
    $.ajax({
        type:'POST',
        url:'http://localhost:8088/cristian/salaChat/php/llamarMostrarTodo.php',
        success:function(response){
            rellenarDatos(JSON.parse(response));
            console.log('Refrescar');
        },
        error:function(err){
            console.log(err);
        }
    })
}

function rellenarDatos(res){
    let divContenedor = document.querySelector('.divContenedor');
    divContenedor.innerHTML = '';
    
    for(let valor in res){
        divContenedor.innerHTML += 
            `<div class="divMensajes">
                <span class="spNombre">${res[valor].usuario}: </span>
                <span class="spMensaje">${res[valor].mensaje}</span>
                <span class="spHora">${res[valor].hora} pm</span>
            </div>
            `;
    }

}