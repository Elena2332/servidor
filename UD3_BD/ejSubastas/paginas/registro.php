<?php
    // REGISTRAR 
    include 'config.php';
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

    if(isset($_POST['btnRegistrar'])) 
    {
        // insertar usuario
        if(!existeUsuario($_POST['inpUser']))
            insertUsuario($_POST['inpUser'],$_POST['inpNom'],$_POST['inpPass'],$_POST['inpEmail'],crearCadenaRandom());
        
        // mandar mail
        $urlCadRandom=urlencode($cadRandom);
        $urlEmail=urlencode($email);            
        $enlace="http://127.0.0.1/ejerphp_subastas/pruebaregistro.php?email=$urlEmail&cadverif=$urlCadRandom";            

        $mens=<<<MAIL
                Hola $usuario. Haz clic en el siguiente enlace para registrarte:
                $enlace
                Gracias
        MAIL;

        if (mail($email,"Registro en 127.0.0.1", $mens, "From:dwes.ciudadjardin@gmail.com"))
                echo "Mensaje enviado";
        else
            echo "No se pudo enviar mensaje";  
    }

?>
<html>
    <head>
        <title>Registro</title>
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
                            <td> Nombre Completo</td>
                         <td><input type="text" name="inpNom"/> </td> 
                        </tr>
                        <tr> 
                            <td> Password</td> 
                            <td><input type="text" name="inpPass"/> </td> 
                        </tr>
                        <tr> 
                            <td> Password (de nuevo)</td>
                            <td><input type="text" name="inpPassCon"/> </td> 
                        </tr>
                        <tr> 
                            <td> Email</td>
                            <td><input type="text" name="inpEmail"/> </td> 
                        </tr>
                        <tr>
                            <td></td> 
                            <td><button type="submit" name="btnRegistrar">Registrarse</button> </td> 
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>