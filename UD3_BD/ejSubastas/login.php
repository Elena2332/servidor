<?php
    // LOGIN 
    include 'config.php';
    // session_start();

    if(isset($_POST['btnLogin'])) 
    {
        if(isset($_SESSION['id']))
            echo '<p style="color:oranje; font-size:2em;"> No podras hacer login hasta hacer logout. </p>';
        else
        {
            // validar usuario
            $log = login($_POST['inpUser'],$_POST['inpPass']);
            switch($log)
            {
                case 0:
                    session_start();
                    $user = obtenerUsuario($_POST['inpUser']);
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['usuario'] = $user['username'];
                    $_SESSION['nombre'] = $user['nombre'];
                    $_SESSION['email'] = $user['email'];
                    if(isset($_SESSION['ultimaPag']))
                        $pag = $_SESSION['ultimaPag'];
                    else
                        $pag = 'index.php';
                    header('Location: '.$pag);
                    exit();
                    break;
                case 1:
                    echo '<p style="color:red;">El usuario o contraseña incorrecto. Prueba de nuevo</p>';  
                    break;
                case 2:
                    echo '<p style="color:red;">Usuario inactivo. Comprueba tu correo</p>';  
                    break;
            }
        }  
    }

?>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./estilos/estilo.css">
    </head>
    <body>
        <?php require_once("./cabecera.php") ?>

        <div id="container">
            <div id="bar">
                <?php require_once("./bar.php") ?>
            </div>
            <div id="main">
                <p>Para registrarse en <em>El mundo bajo la mesa</em>, rellena el siguiente formulario.</p>
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
                            <td><input type="submit" name="btnLogin" value="Login!" /> </td> 
                        </tr>
                    </table>
                </form>
                <p><a href="registro.php">No tiene cuenta? <strong>Registrate</strong></a></p>
            </div>
    </body>
</html>