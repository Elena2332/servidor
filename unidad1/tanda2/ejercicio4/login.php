<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!-- <form enctype="multipart/form-data" method="POST" action="./validacion.php"> -->
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td>Nombre usuario:</td>
                <td><input type="text" name="inpName"/></td>
                <td rowspan="2"><input type="submit" name="btnValidar" value="ENTRAR"/></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" name="inpPass"/></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['btnValidar']))
        {
            if(strlen($_POST['inpName'])<3  && strlen($_POST['inpPass'])<3)
                echo '<p style="color:red;">Los campos deben tener minimo 3 caracteres</p>';
            else
            {
                $fich = fopen("doc/usuarios.txt", "r");
                $seguir = true;
                $existe = false;
                while (!feof($fich) && $seguir==true) 
                {
                    $linea = fgets($fich); 
                    $linea = explode(';;;',$linea);
                    if($_POST['inpName']==$linea[0])
                    {   
                        $seguir = false;
                        fclose($fich);
                        $existe = true;

                        if($_POST['inpPass']==$linea[1])  // usuario y password correctos
                        {
                            header('Location: chat.php');
                            exit();
                        }
                        else  //contraseña erronea
                        {
                            echo '<p style="font-size:1.2em;">CONTRASEÑA ERRONEA para '.$_POST['inpName'].'.</p><p>Intentalo de nuevo.</p>';
                        }
                    }
                }
                if(!$existe)   //ir a alta.php
                    header('Location: alta.php');
            }           
        }
    ?>
</body>
</html>