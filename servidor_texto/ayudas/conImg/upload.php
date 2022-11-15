<?php
include "config.php";

$nombre = $_FILES['file']['name'];
$tipo = $_FILES['file']['type'];
$target_path = "uploads/";
$target_path = $target_path . basename($nombre);


// mover imagen a la carpeta
if(move_uploaded_file($_FILES['file']['tmp_name'] , $target_path))
{
    //comprobar si existe
    $q = mysqli_query($con,"select * from imagenes where ruta = '$target_path'");
    if($q -> num_rows == 0)  // si no existe
    {
        //introducir a bbdd
        $q= mysqli_query($con, "INSERT INTO `imagenes` (`ruta`,`extension`,`nombre`) VALUES('$target_path','$tipo','$nombre')");
        if($q)
            $data = ['success' => true, 'message' => 'Subido correctamente'];
        else       
            $data = ['success' => false, 'message' => 'Error al subir'];
    }
    else  // si ya existe
        $data = ['success' => true, 'message' => 'Ya existe'];  
}
else
    $data = ['success' => false, 'message' => 'No es posible cargar'];   
    
 echo json_encode($data);

?>