<?php
include "config.php";

$id = $_GET['id'];
$message = array();

// cambiar log 
$q = mysqli_query($con,"UPDATE usuario set log = 0 where id = $id");
if($q)
    $message['status'] = "Bien";
else       
    $message['status'] = "Error";
    
echo json_encode($message); 
