<?php
include "config.php";

$input= file_get_contents('php://input');
$data = json_decode($input,true);
    $pass = md5($data['new']);
    $val = md5($data['val']);
$id = $_GET['id'];
$message = array();

//confirmar
if($pass == $val)
{
    // editar
    $q= mysqli_query($con, "UPDATE usuario set pass='$pass' where id = '$id'");
    if($q)
    {
        $message['status'] = "Bien";
    }
    else       
        $message['status'] = "Error";
}
else
    $message['status'] = "No coincide";

    
echo json_encode($message); 
