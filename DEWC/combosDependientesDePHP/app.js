let prov,muni;

window.onload
{
    prov = document.getElementById("provincia")//.onchange = cargarMunicipios;
    muni = document.getElementById("municipio")//.onchange = mostrarMensaje;
    prov.addEventListener("change",cargarMunicipios);
    muni.addEventListener("change",mostrarMensaje);

    cargarProvincia();
}

function cargarProvincia()
{
    let formulario = new FormData()
    fetch('http://localhost/PHP/controller/pruebaFetch.php', {
        method: "post",
        body: formulario
    }).then((response) => {
        console.log( response.json()) 
    }).then((data) => {
        console.log(data)
    });
}

function cargarMunicipios()
{

}

function mostrarMensaje()
{

}