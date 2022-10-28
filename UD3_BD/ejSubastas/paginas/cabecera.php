<?php 
    // CABECERA
    session_start();
    if($_SESSION['ultimaPag'] == '../index.php')
        $ruta = './paginas/';
    else
        $ruta = './';

    if(isset($_SESSION['id']))
    {
        $ruta = $ruta.'logout.php';
        $a = '<a href="'.$ruta.'">Logout</a>';        
    }
    else
    {
        $ruta = $ruta.'login.php';
        $a = '<a href="'.$ruta.'">Login</a>';
    }
?>

<div id="header">
    <h1><?php echo TITULO; ?></h1>
</div>

<div id="menu">
    <a href="../index.php">Home</a>
    <?php echo $a ?>
    <a href="./newitem.php">New Item</a>
</div>