<?php
    // REGISTRAR 
    include 'config.php';
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

?>
<html>
    <head>
        <title><?php echo TITULO; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./estilos/estilo.css">
    </head>
    <body>
        <?php require_once("./paginas/cabecera.php") ?>

        <div id="container">
            <div id="bar">
                <?php require_once("./paginas/bar.php") ?>
            </div>
            
            <div id="main">
                <?php 
                    require_once("./paginas/listProductos.php");
                ?>
            </div>
        </div>
    </body>
</html>