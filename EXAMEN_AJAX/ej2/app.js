let divInfo, btnDatos;

window.onload
{
    divInfo = document.getElementById("informacion");
    btnDatos = document.getElementById("btnDatos");
    
    btnDatos.addEventListener("click",pedirDatos);
}

function pedirDatos()
{
    //mostrar gif
    gif = document.createElement("img");
    gif.src = "images/cargando.gif";
    divInfo.appendChild(gif);

    let options = {
        method: "POST",
        headers: { "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" },
        body : ""
    };

    fetch("cargar.php", options) 
        .then(res => res.text())
        .then(data => {
            console.log(data);
            divInfo.innerHTML = data;
        });        
}

