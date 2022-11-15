<?php
include "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$input= file_get_contents('php://input');
$data = json_decode($input,true);
    $nombre = $data['nombre'];
    $telf = $data['telefono'];
    $email = $data['email'];
    $empresa = $data['empresa'];
    $asunto = $data['asunto'];
    $mensaje = $data['mensaje'];
$response = array();

$mail = new PHPMailer;
try{
    $mail->setFrom($email,'App Ionic');
    $mail->addAddress('practicas@coaser.com');
    $mail->Mailer = "smtp";

    //Asignamos a Host el nombre de nuestro servidor smtp
    $mail->Host = "smtp.office365.com";
  
    //Le indicamos que el servidor smtp requiere autenticación
    $mail->SMTPAuth = true;
  
    //Le decimos cual es nuestro nombre de usuario y password
    $mail->Username = "practicas@coaser.com"; 
    $mail->Password = "Zaz60112";
  
    //Indicamos cual es nuestra dirección de correo y el nombre que 
    //queremos que vea el usuario que lee nuestro correo
    $mail->From = "practicas@coaser.com";
    $mail->FromName = "Elena Test";
    $mail->Subject  = 'Asunto: '.$asunto;
    
        $message ="<p>Nombre: ".utf8_encode(htmlentities($nombre, ENT_QUOTES, "UTF-8"));
        $message .=",  De: ".utf8_encode(htmlentities($empresa, ENT_QUOTES, "UTF-8"))."</p>";  
        $message .="<p>Email: ".utf8_encode(htmlentities($email, ENT_QUOTES, "UTF-8")).",   ";
        $message .="Telefono: ".utf8_encode(htmlentities($telf, ENT_QUOTES, "UTF-8"))."</p>"; 
        $message .="<p>".utf8_encode(htmlentities($mensaje, ENT_QUOTES, "UTF-8"))."</p>";

    $mail->Body  = $message;
    $mail->IsHTML(true); 

    if(!$mail->send()) 
        $response["success"] = 'Email not sent';
    else 
        $response["success"] = 'bien';
    echo json_encode($response);
}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>