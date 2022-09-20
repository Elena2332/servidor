<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio7</title>
</head>
<body>
    <h2>enlaces del fichero</h2>
    <div>
        <?php
            $handle = fopen("doc/enlaces.txt", "r");
            while (!feof($handle)) 
            {
                $linea = fgets($handle);  //  Va dejando en $linea cada linea del fichero (Al leer con fgets tener en cuenta que también se leen los caracteres de fin de línea)
                $linea = explode(',',$linea);
                echo '<a href='.$linea[0].'>'.$linea[1].'</a><br>';
            }
            fclose($handle);
        ?>
    </div>
</body>
</html>