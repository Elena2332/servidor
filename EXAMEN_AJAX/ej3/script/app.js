let btnObtener, inpSalario
let divContenido, divEstadisticas

window.onload
{
    btnObtener = document.getElementsByTagName("button")[0]
    inpSalario = document.getElementById("salarioMinimo")
    divContenido = document.getElementById("contenido")
    divEstadisticas = document.getElementById("estadisticas")
    
    btnObtener.addEventListener("click",cargarTabla)
    // btnObtener.onclick = () => cargarTabla ()
}

function cargarTabla ()
{
    fetch("tabla.json") 
        .then(data => data.json())
        .then(json => {
            // vaciar div para no repetir la tabla
            divContenido.innerHTML='';

            // declaraciones
            let minimo = inpSalario.value;
            let salarioMin = 99999;
            let edadMax = 0;
            let mayorNom = "";
            let salarioMinNom = "";
            let totalPer = 0;
            let sumaEdades = 0;

            if(isNaN(minimo))  // si esta vacio o hay letras/simbolos
                minimo = 0;
            
            let tabla = document.createElement("table");
            let tablaHTML = "<tr><th>#</th> <th>Nombre</th> <th>Email</th> <th>Edad</th> <th>Estado</th> <th>Salario</th></tr>";

            for(let key in json)
            {
                let sal = json[key]["salario"];
                let nom = json[key]["nombre"];
                let edad = json[key]["edad"];
                if(sal >= minimo)  // cumple el filtro del salario
                {
                    console.log(nom)
                    tablaHTML = tablaHTML+"<tr><td>"+json[key]["id"]+"</td>";
                    tablaHTML = tablaHTML+"<td>"+nom+"</td>";
                    tablaHTML = tablaHTML+"<td>"+json[key]["email"]+"</td>";
                    tablaHTML = tablaHTML+"<td>"+edad+"</td>";
                    tablaHTML = tablaHTML+"<td>"+json[key]["estado"]+"</td>";
                    tablaHTML = tablaHTML+"<td>"+sal+"</td></tr>"

                    if (salarioMin > sal)   // salario mas pequeño
                    {
                        salarioMin = sal;
                        salarioMinNom = nom;
                    }

                    if (edadMax < edad)  // persona mas mayor
                    {
                        edadMax = edad;
                        mayorNom = nom;
                    }
                    totalPer++;
                    sumaEdades+= edad;
                }
            }
            tabla.innerHTML = tablaHTML;
            divContenido.appendChild(tabla);
            
            //calcular media
            let mediaEdad = (sumaEdades/totalPer).toFixed(2);

            //estadisticas
            let txt = "La media de edad es " + mediaEdad +".<br/>La persona de más edad es " + mayorNom + " y la de menor salario es " + salarioMinNom;
            divEstadisticas.innerHTML = txt;
        });
}

