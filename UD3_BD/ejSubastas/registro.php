<?php
    // REGISTRAR 
    include 'config.php';

    if(isset($_POST['btnRegistrar'])) 
    {
        // insertar usuario
        if(!existeUsuario($_POST['inpUser']))
        {
            $cad = crearCadenaRandom();
            insertUsuario($_POST['inpUser'],$_POST['inpNom'],$_POST['inpPass'],$_POST['inpEmail'],$cad);
        
            //mandarMail($_POST['inpEmail'],$cad);
        }  
        else
            echo '<p style="color:red;">El usuario '.$_POST['inpUser'].' ya existe</p>'; 
    }

?>
<html>
    <head>
        <title>Registro</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./estilos/estilo.css">
    </head>
    <body>
        <?php require_once("cabecera.php") ?>

        <div id="container">
            <div id="bar">
                <?php require_once("bar.php") ?>
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
                            <td> Nombre Completo</td>
                         <td><input type="text" name="inpNom"/> </td> 
                        </tr>
                        <tr> 
                            <td> Password</td> 
                            <td><input type="password" name="inpPass"/> </td> 
                        </tr>
                        <tr> 
                            <td> Password (de nuevo)</td>
                            <td><input type="password" name="inpPassCon"/> </td> 
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