<?php
include "config.php";
$input = file_get_contents('php://input');
$message = array();

$id=$_GET['id'];
$q= mysqli_query($con,"delete from imagenes where id = '$id'");

if($q)
{
    http_response_code(201);
    $message['status'] = "Eliminada correctamente";
}else
{
    http_response_code(422);
    $message['status'] = "Error al eliminar";
}

echo json_encode($message);
echo mysqli_error($con);