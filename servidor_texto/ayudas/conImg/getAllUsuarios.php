<?php
include "config.php";

$data = [];
$result = mysqli_query($con,"SELECT * FROM usuario"); 

if (mysqli_num_rows($result) > 0) 
{
  foreach($result as $res)
  {
    $data[] = [ 'id' => $res['id'], 'nombre' => $res['nombre'], 'email' => $res['email'], 'img' => $res['avatar'], 'rol' => $res['rol'], 'log' => $res['log'] ];  
  }
  echo json_encode($data);
}else 
{
  die("Error: No hay datos en la tabla seleccionada");
}

?>