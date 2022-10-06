<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3</title>
</head>
<body>
    <div>
        <h2>Ciudades sin repetir</h2>
        <?php
            $arr=['Burgos','Miranda','Vitoria','Burgos','Aranda','Vitoria'];
            $sinRepes = array_unique($arr);
            foreach($sinRepes as $i=>$ciu)
            {
                echo $i.'- '.$ciu.'<br>';
            }
        ?>
        <br>
    </div>
</body>
</html>