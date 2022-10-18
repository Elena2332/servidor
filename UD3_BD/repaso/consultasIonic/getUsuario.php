<?php
include "config.php";

$id = $_GET['id'];
$message = array();

// si existe el usuario
$results = mysqli_query($con,"select * from usuario where id = '$id' ");
if( ($results -> num_rows) > 0)
{
    $message['status'] = 'Bien';

    $res = mysqli_fetch_row($results);
        $message['nombre'] = $res[1];
        $message['email'] = $res[2];
        $message['img'] = $res[4];
        $message['rol'] = $res[5];
        $message['log'] = $res[6];
}
else
    $message['status'] = 'No existe';

echo json_encode($message);
echo mysqli_error($con);
