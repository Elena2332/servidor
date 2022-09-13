<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
   <?php 
        // echo "<script>console.log('Hola');</script>";
        echo "<ul>";
        $ficheros = scandir('./');
        foreach($ficheros as $fich)
        {
            if(!is_dir($fich) && $fich!= 'index.php')
                echo "<li><a href='".$fich."'>".$fich."</a></li>";
        }
        echo "</ul>";
    ?>
</body>
</html>