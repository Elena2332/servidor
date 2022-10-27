<?php
    // LOGIN 
    include 'config.php';

    if(isset($_POST['btnLogin'])) 
    {
        if(isset($_SESSION['usuario']))
            echo '<p style="color:oranje; font-size:2em;"> No podras hacer login hasta hacer logout. </p>';
        else
        {
            // validar usuario
            $log = login($_POST['inpUser'],$_POST['inpPass']);
            switch($log)
            {
                case 0:
                    session_start();
                    $_SESSION['usuario'] = obtenerUsuario($_POST['inpUser']);
                    header('Location: ../index.php');
                    break;
                case 1:
                    echo '<p style="color:red;">El usuario o contraseña incorrecto. Prueba de nuevo</p>';  
                    break;
                case 2:
                    echo '<p style="color:red;">Usuario inactivo. Comprueba tu correo</p>';  
                    break;
                case 3:
                    echo '<p style="color:red;">Error al logerar. Intentalo más tarde</p>';  
                    break;
            }
        }  
    }

?>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilos/estilo.css">
    </head>
    <body>
        <?php require_once("cabecera.php") ?>

        <div id="container">
            <div id="bar">
                <?php require_once("bar.php") ?>
            </div>
            
            <div id="main">
                <p>Para registrarse en <em>El mundo ajo la mesa</em>, rellena el siguiente formulario.</p>
                <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table>
                        <tr> 
                            <td> Usuario </td> 
                            <td><input type="text" name="inpUser"/> </td> 
                        </tr>
                        <tr> 
                            <td> Password </td>
                         <td><input type="password" name="inpPass"/> </td> 
                        </tr>
                        <tr>
                            <td></td> 
                            <td><button type="submit" name="btnLog">Login!</button> </td> 
                        </tr>
                    </table>
                </form>
                <p><a href="">No tiene cuenta? <strong>Registrate</strong></a></p>
            </div>
        </div>
    </body>
</html>