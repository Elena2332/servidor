<?php
include "config.php";

$data = [];
$result = mysqli_query($con,"SELECT * FROM imagenes"); 

if (mysqli_num_rows($result) > 0) 
{
  foreach($result as $res)
  {
    $data[] = [ 'id' => $res['id'], 'ruta' => $res['ruta'], 'extension' => $res['extension'], 'nombre' => $res['nombre'] ];  
  }
  echo json_encode($data);
}else 
{
  die("Error: No hay datos en la tabla seleccionada");
}

?>