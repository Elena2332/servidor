let selNivel, selCurso, divMensaje;

window.onload
{
    selNivel = document.getElementById("nivel");
    selCurso = document.getElementById("curso");
    divMensaje = document.getElementById("mensaje");

    selNivel.onchange = ()=> cargarCursos(selNivel.options[selNivel.selectedIndex].value);
    selCurso.onchange = ()=> mostrarEleccion(selNivel.options[selNivel.selectedIndex], selCurso.options[selCurso.selectedIndex]);
}


function cargarCursos(seleccionado)
{
    // ocultar mensaje
    divMensaje.style = "visibility: hidden;";

    // llenar select Cursos
    let options = {
        method: "POST",
        headers: { "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" },
        body : "elegido="+seleccionado
    };

    fetch("curso.php", options) 
        .then(res => res.text())
        .then(data => {
            // console.log(data);
            selCurso.innerHTML = data;        
        });
}

function mostrarEleccion(nivel,curso)
{
    // mostrar mensaje
    divMensaje.style = "visibility: visible;";
    divMensaje.innerHTML = "Estudias en <strong>"+nivel.text+"</strong> en <strong>"+curso.text+"</strong>";
}
