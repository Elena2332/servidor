<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="./validacion.php">
        <table>
            <tr>
                <td>Nombre usuario:</td>
                <?php
                    $nom = "";
                    if(isset($_GET['invPass']))
                        $nom = $_GET['invPass'];
                    echo '<td><input type="text" name="inpName" value="'.$nom.'"/></td>';
                ?>
                <td rowspan="2"><input type="submit" name="btnValidar" value="ENTRAR"/></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" name="inpPass"/></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_GET['minCar']))
            echo '<p style="color:red;">Los campos deben tener minimo 3 caracteres</p>';
        else
        {
            if(isset($_GET['invPass']))
                echo '<p style="font-size:1.2em;">CONTRASEÑA ERRONEA para '.$_GET['invPass'].'.</p><p>Intentalo de nuevo.</p>';
        }
    ?>
</body>
</html>