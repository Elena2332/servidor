// function postSimple() {

//     const properties = {
//         url : "http://192.168.0.28:8029/api/v1/login/",
//     };

//     const parameters = {
//         username : "admin",
//         password : "0810",
//         device : "192.168.0.1"
//     }

//     let options = {
//         method: HTTPS_METHOD.POST,
//         headers: { "Content-type": "application/json; charset=UTF-8" },
//         body : JSON.stringify(parameters)
//     };

//     fetch(properties.url, options) // promise
//     .then(data => data.json())
//     .then(json => {
//         console.log(json);
//     });

// }


let combo_provincia, combo_municipio

window.onload = function(){
    combo_municipio = document.getElementById("municipio")
    combo_provincia = document.getElementById("provincia")

    cargarProvincias()
    // console.log(combo_provincia.options)
    combo_provincia.onchange = ()=> cargarMunicipios(combo_provincia.options[combo_provincia.selectedIndex].value)
    
}

function cargarProvincias (){
    const properties = {
        url : "cargarJSON.php"
    };

    let options = {
        method: "POST",
        headers: { "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" },
        body : "tipo=provincia"
    };

    fetch(properties.url, options) // promise
    .then(data => data.json())
    .then(json => {
        console.log(json);
        combo_provincia.innerHTML = ''
        for (const key in json) {
            
            let provincia = document.createElement('option');
            provincia.value = key
            provincia.innerText = json[key]
            combo_provincia.appendChild(provincia)
        }
    });
}

function cargarMunicipios (codigo_provincia){
    const properties = {
        url : "cargarJSON.php"
    };

    let options = {
        method: "POST",
        headers: { "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" },
        body : "tipo=municipio&codigo_provincia=" + codigo_provincia
    };

    fetch(properties.url, options) // promise
    .then(data => data.json())
    .then(json => {
        console.log(json);
        combo_municipio.innerHTML = ''
        for (const key in json) {
            
            let municipio = document.createElement('option');
            municipio.value = key
            municipio.innerText = json[key]
            combo_municipio.appendChild(municipio)
        }
    });
}