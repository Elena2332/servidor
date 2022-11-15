<?php
include "config.php";

$input= file_get_contents('php://input');
$data = json_decode($input,true);
    $user = $data['user'];
    $email = $data['email'];
    $avatar = $data['avatar'];
    $rol = $data['rol']; 
    $id = $_GET['id'];
$message = array();
// editar
$q= mysqli_query($con, "UPDATE usuario set nombre='$user', email='$email', avatar='$avatar', rol='$rol' where id = '$id'");
if($q)
{
    $message['status'] = "Success";
}
else       
    $message['status'] = "Error";
    
echo json_encode($message); 
