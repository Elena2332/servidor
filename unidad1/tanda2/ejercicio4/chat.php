<?php
    if(isset($_GET['nom']))
        $usu = $_GET['nom'];
    else
    {
        header('Location: login.php?err=13');
        exit();
    }

    if(isset($_POST['inpEnviar']) && strlen(trim($_POST['inpMensaje']))>0) //si envia un mensaje que no este vacio
    {
        //eliminar ';SEPAR;' del mensaje si lo contiene
        $_POST['inpMensaje'] = str_replace(";SEPAR;","",$_POST['inpMensaje']);

        // escribir el mensaje en conversacion.txt
        $fich = fopen('./doc/conversacion.txt','a');
        $linea = PHP_EOL.$usu.';SEPAR;'.$_POST['inpMensaje'];
        fwrite($fich,$linea);
        fclose($fich);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>
</head>
<body>
    <iframe src="contenido_charla.php"></iframe>
    <br/><label>Usuario: <strong><?php echo $usu; ?></strong></label>
    <form enctype="multipart/form-data" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <table>
            <tr>
                <td><label>Mensaje:</label></td>
                <td rowspan="2"><input type=text name="inpMensaje" style="height: 40px;"/></td>
            </tr>
            <tr>
                <td><input type="submit" name="inpEnviar" value="Enviar"/></td>
            </tr>
        </table>
    </form>
</body>
</html>