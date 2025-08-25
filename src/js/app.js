let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); //muestra y oculta secciones
    tabs(); //cambia seccion al presionar el tab
    botonesPaginador(); //agrega o quita botones del paginador
    paginaAnterior();
    paginaSiguiente();

    consultarAPI(); //consulta api en backend php
}

function mostrarSeccion(){
    //ocultar las mostradas previamente
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){  
        seccionAnterior.classList.remove('mostrar'); 
    }
   
    //seleccionar la seccion
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){  
        tabAnterior.classList.remove('actual'); 
    }
    //resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
        mostrarSeccion();
    });
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
        mostrarSeccion();
    });
}

async function consultarAPI(){
    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch(e){
        console.log(e);
    }
}

function mostrarServicios(servicios){
    servicios.forEach( servicio => {
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

    });
}

