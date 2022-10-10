<?php 
    if(isset($_GET['cerrar']))
    {
        session_start();
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>
</head>
<body>
    <?php 
        if(isset($_GET['err0']))
            echo '<p style="color:red;">Rellena todos los campos</p>';
        if(isset($_GET['err1']))
            echo '<p style="color:red;">Convinacion erronea de usuario-contraseña</p>';
    ?>
    <p>Si eres SOCIO introduce tu usuario y password </p>
    <form enctype="multipart/form-data" method="POST" action="./autenticacion.php">
        <div>
            <label>Usuario</label> <input type="text" name="inpNom"/>
        </div>
        <div>
            <label>Password</label> <input type="password" name="inpPass"/>
        </div>
        <div>
            <button name="btnSocio" type="submit">Acceso Socio</button>
        </div>
        <p>Si no dispones de usuario, entra como invitado</p>
        <div>   
            <button name="btnInvitado" type="submit">Acceso Invitado</button>
        </div>        
    </form>
</body>
</html>