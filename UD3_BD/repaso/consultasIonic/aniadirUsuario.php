<?php
include "config.php";

$input= file_get_contents('php://input');
$data = json_decode($input,true);
    $user = $data['user'];
    $pass = md5($data['pass']);
    $email = $data['email'];
    $avatar = $data['avatar'];
    $rol = $data['rol']; 
$message = array();

    //comprobar si existe
    $results = mysqli_query($con,"select * from usuario where nombre = '$user' and pass = '$pass' ");
    if( ($results -> num_rows) == 0)
    {
        //introducir a bbdd
        $q= mysqli_query($con, "INSERT INTO `usuario`(`nombre`, `email`, `pass`, `avatar`, `rol`) VALUES('$user','$email','$pass','$avatar','$rol')");

        if($q)
            $message['status'] = "Success";
        else       
            $message['status'] = "Error";
    }
    else
        $message['status'] = "Existe";
echo json_encode($message); 
