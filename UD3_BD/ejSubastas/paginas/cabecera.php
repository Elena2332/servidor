<?php //session_start(); ?>

<div id="header">
    <h1><?php echo TITULO; ?></h1>
</div>

<div id="menu">
    <a href="../index.php">Home</a>
    <?php
        if(isset($_SESSION['USERNAME']) == TRUE) 
            echo "<a href='./paginas/logout.php'>Logout</a>";
        else 
            echo "<a href='./paginas/login.php'>Login</a>";
    ?>
    <a href="./newitem.php">New Item</a>
</div>