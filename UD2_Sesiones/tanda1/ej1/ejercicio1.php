<?php
    function pintarList()
    {
        $txtHtml = "";
        if(isset($_POST['btnAniadir']))
        {
            $txtHtml = $txtHtml.'<p>Todavia no se han introducido nombres</p>';
        }
        else
        {
            // sacar nombres de $_SESSION
        }
        return $txtHtml
    }

    function validar()
    {
        if(isset($_POST['btnAniadir']))
        {
            if(!empty($_POST['inpNom']))
            {
                
                return '<p style="color: red;">No has escrito el nombre unicamente con letras y espacion</p>';
            }
            else
                return '<p style="color: red;">Esta vacio -_-</>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    <?php echo validar(); ?>
    <form>
        <label>Escribe un nombre: </label><input type="text" name="inpNom"/>
        <button type="submit" name="btnAniadir">Añadir</button>
        <button type="reset">Borrar</button>
    </form>
        <?php echo pintarLista(); ?>
    <a href="">Cerrar sesion(se perderan los datos almacenados)</a>
</body>
</html>