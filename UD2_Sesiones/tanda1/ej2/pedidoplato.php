<?php
include './libmenu.php';
    session_start();
    if(!isset($_SESSION['usuario']) && !isset($_GET['tipo']))
    {
        header('Location: entrada.php');  // tipo random que no deberia estar aqui
        exit();
    }

    function pintar()
    {
        $txtHtml = "";
        $tipo = $_GET['tipo'];
        if(isset($_SESSION['platos'][$tipo]))  // ya hay un plato de ese tipo  
            $txtHtml = $txtHtml.'<p>Va a cambiar su eleccion'.$_SESSION['platos'][$tipo].'por:</p><select name="selPlatos">';
        else  
            $txtHtml = $txtHtml.'<p>Elija '.$tipo.'</p><select name="selPlatos">';
        $txtHtml = $txtHtml.'</select>';
        //listar platos
        $platosTipo = damePlatos($tipo);
        var_dump($platosTipo);
        foreach($platosTipo as $plato)
        {
            var_dump($plato);
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plato</title>
</head>
<body>
    <?php  pintar(); ?>
</body>
</html>