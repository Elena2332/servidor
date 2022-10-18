<?php
    include 'config.php';
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

?>
<html>
    <head>
        <title><?php echo TITULO; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./css/estilo.css" type="text/css" />
    </head>
<body>
    <div id="header">
        <h1>SUBASTAS CIUDAD JARDIN</h1>
    </div>
    <div id="menu">
        <a href="index.php">Home</a>
        <?php
            if(isset($_SESSION['USERNAME']) == TRUE) {
                echo "<a href='logout.php'>Logout</a>";
            }
            else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <a href="newitem.php">New Item</a>
    </div>
    <div id="container">
        <div id="bar">
               <?php include "bar.php" ?>
        </div>
        <div id="main">
        </div>
    </div>
</body>
</html>
