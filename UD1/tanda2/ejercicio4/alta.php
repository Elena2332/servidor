<?php 
    function construirHTML()
    {
        $txtHTML = '<form enctype="multipart/form-data" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                <table>
                    <tr>
                        <td>Nombre usuario:</td>
                        <td><input type="text" name="inpName"/></td>
                        <td rowspan="2"><img src="./img/aniadir.png" alt="img" height="80"/></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td><input type="password" name="inpPass"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="btnRegistrar" value="REGISTRAR"/></td>
                    </tr>
                </table>
            </form>';
        if(isset($_POST['btnRegistrar']))
        {
            if(strpos($_POST['inpName'], ';SEPAR;') != false || strpos($_POST['inpPass'], ';SEPAR;') != false)
                echo '<p style="color:red;">No uses ";SEPAR;" melón</p>';
            else
            {
                //comprobar si ya existe
                $existe = false;
                $seguir = true;
                $fich = fopen("doc/usuarios.txt", "r");
                while (!feof($fich) && $seguir) 
                {
                    $linea = fgets($fich); 
                    $linea = explode(';SEPAR;',$linea);
                    if($_POST['inpName']==$linea[0])  
                        $existe = true;
                }
                fclose($fich);
                if($existe)
                    $txtHTML = '<p style="color:red;>Lo sentimos, ya existe el usuario <strong>'.$_POST['inpName'].'</strong></p>'.$txtHTML;
                else
                {
                    $fich = fopen("doc/usuarios.txt", "a");
                    $linea = $_POST['inpName'].';SEPAR;'.$_POST['inpPass'].PHP_EOL;  //PHP_EOL:=salto de linea  _._  usuario;SEPAR;password
                    fwrite($fich, $linea); 
                    fclose($fich);
                    $txtHTML = 'El usuario <strong>'.$_POST['inpName'].'</strong> ha sido dado de alta
                                <a href="chat.php?nom='.$_POST['inpName'].'">ENTRAR AL CHAT</a>';
                }
            }            
        }
        return $txtHTML;
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>REGISTRARSE</h1>
    <?php echo construirHTML(); ?>
</body>
</html>