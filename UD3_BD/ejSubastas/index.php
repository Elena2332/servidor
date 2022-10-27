<?php
    // PAGINA PRINCIPAL
    include './paginas/config.php';
    session_start();
    if(isset($_SESSION['id']))
        $_SESSION['ultimaPag'] = '../index.php';
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
