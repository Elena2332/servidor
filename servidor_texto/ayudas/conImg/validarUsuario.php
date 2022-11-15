<?php
include "config.php";

$input= file_get_contents('php://input');
$data = json_decode($input,true);
$user = $data['user'];
$pass = md5($data['pass']);
$message = array();

// si existe el usuario
$results = mysqli_query($con,"select * from usuario where nombre = '$user' ");
if( ($results -> num_rows) > 0)
{
    //si la contraseña corresponde
    $results = mysqli_query($con,"select * from usuario where nombre = '$user' and pass = '$pass' ");
    if( ($results -> num_rows) > 0)
    {
        // cambiar log 
        $q = mysqli_query($con,"UPDATE usuario set log = 1 where nombre = '$user' and pass = '$pass' ");
        if($q) // log actualizado
        {
            $message['status'] = 'Bien';

            $res = mysqli_fetch_row($results);
                $message['id'] = $res[0];
                $message['user'] = $res[1];
                $message['email'] = $res[2];
                $message['avatar'] = $res[4];
                $message['rol'] = $res[5];
        }
        else
            $message['status'] = 'Error';
    }
    else
        $message['status'] = 'Contraseña incorrecta';
}
else
    $message['status'] = 'No existe';

echo json_encode($message);
echo mysqli_error($con);
