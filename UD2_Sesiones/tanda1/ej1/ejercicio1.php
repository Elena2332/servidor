<?php
    
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
    <form>
        <label>Escribe un nombre: </label><input type="text" name="inpNom"/>
        <button type="submit" name="btnAniadir">Añadir</button>
        <button type="reset">Borrar</button>
    </form>
        <?php 
            pintarLista();
        ?>
    <a href="">Cerrar sesion(se perderan los datos almacenados)</a>
</body>
</html>