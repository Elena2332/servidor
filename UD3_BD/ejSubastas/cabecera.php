<?php 
    // CABECERA
    session_start();
    if(isset($_SESSION['id']))
    {
        $enlaces = '<a href="logout.php">Logout</a>';  
        $enlaces = $enlaces.'<a href="./newitem.php">New Item</a>';
    }
    else
        $enlaces = '<a href="login.php">Login</a>';

    if(isset($_SESSION['nombre'])  &&  $_SESSION['nombre'] == 'admin')
        $enlaces = $enlaces.'<a href="./vencidas.php">Subastas vencidas</a> <a href="./publi.php">Anunciantes</a>';
?>

<div id="header">
    <h1><?php echo TITULO; ?></h1>
</div>

<div id="menu">
    <a href="index.php">Home</a>
    <?php echo $enlaces ;?>
</div>