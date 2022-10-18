<?php
include "config.php";

$id = $_GET['id'];
$message = array();

// eliminar
$results = mysqli_query($con,"delete from usuario where id = '$id' ");
if( $results )
    $message['status'] = 'Bien';
else
    $message['status'] = 'Error';

echo json_encode($message);
echo mysqli_error($con);
