<?php 
// CREAR TABLA
// -	Submit para crear la tabla alimentos (con sus campos) if not exists

function fncCrearTabla($conn, $tabla, $queryCreateTable){

    global $mensajeUsuario;
    //Si la tabla existe la borramos para crearla desde 0
    $queryDropIfExists="DROP table IF EXISTS $tabla"; 
    $conn->query($queryDropIfExists);  
    if($conn->errno){
        $mensajeUsuario="Error en la conexión con la base de datos";
        die($conn->error);
    }else{

        $resultado = mysqli_query($conn, $queryCreateTable);  
        if(mysqli_errno($conn)){
            $mensajeUsuario="Error en la conexión con la base de datos";
            die(mysqli_error($conn));   
        }else{
            $mensajeUsuario="Tabla $tabla creada correctamente";
        }
    }  
}


// INSERTAR ALIMENTO NUEVO
// -	Nombre (caja de texto) + precio (caja de texto) + select (con primero, segundo, postre) +submit  Para insertar nuevo alimento en la tabla con la fecha de hoy
function fncInsertarNuevoAlimento($conn,$tabla, $arrayInfoAlimento){

    $nombre=$arrayInfoAlimento['nombreAlimento'];
    $precio=(float)$arrayInfoAlimento['precioAlimento'];
    $tipo= $arrayInfoAlimento['tipoAlimento'];
    //$fecha=$arrayInfoAlimento['fechaAlimento'];
    
    $sql = "INSERT INTO $tabla (nombre, precio, tipo, fecha) VALUES ('$nombre',$precio,'$tipo',SYSDATE())"; 
    $resultado = mysqli_query($conn, $sql);  
    if(mysqli_errno($conn)) die(mysqli_error($conn));  

}
// ACTUALIZAR CAMPO FECHA
// -	Submit  Para actualizar todos los alimentos de la tabla con “fecha anterior al 1 de Enero de 2014” y ponerles la fecha de hoy
function fncActualizarCampoFecha($conn,$nobreTabla){

    $sql = "UPDATE $nobreTabla SET fecha=SYSDATE() WHERE fecha < '2014-01-01'";  
    $resultado = mysqli_query($conn, $sql);  
    if(mysqli_errno($conn)) die(mysqli_error($conn)); 

}
// CONSULTA DE ALIMENTOS BARATOS
// -	Submit  Para visualizar una tabla html con los 
// alimentos de precio menor al precio medio: Usando mysql_fetch_assoc
function fncConsultaAlimentosBaratos($conn,$nobreTabla){

    $sql = "SELECT nombre, precio, tipo, fecha FROM $nobreTabla
    WHERE precio < (select AVG(precio) from $nobreTabla)";

    $resultado= mysqli_query($conn,$sql);
    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 


}
// CONSULTA DE ALIMENTOS POR TIPO
// -	3 radios (primero, segundo, postre) + submit  Para visualizar una lista html con los alimentos del tipo seleccionado: Usando mysql_fetch_array
function fncConsultaAlimentosPorTipo($conn,$nobreTabla,$tipo){

    $sql = "SELECT nombre, precio, tipo, fecha FROM $nobreTabla 
    WHERE tipo='$tipo'";

    $resultado= mysqli_query($conn,$sql);
    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}

//Mostrar tabla con datos de la tabla de alimentos
function fncMostrarDatosTabla($conn,$nobreTabla){
    
    $sql = "SELECT alimentos.nombre, alimentos.precio, alimentos.tipo, alimentos.fecha FROM $nobreTabla";   
    $resultado = mysqli_query($conn, $sql);   
    if(mysqli_errno($conn)) die(mysqli_error($conn)); 

    if($resultado==false)
        return array();
    else
        return $resultado;
}
?>