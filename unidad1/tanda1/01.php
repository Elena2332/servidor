<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>punto 1</h1>
    <?php
        
        echo date("d\\t\h M Y, l");
    ?>
    <h1>dias para que termmine el año</h1>
    <?php 
        $ahora = time(); // ahora en segundos
        $maxSeg = 325*24*3600; // segundos en un año (dias * horas en un dia * segundos en una hora)
        $dias = ($maxSeg-$ahora) * 3600*24; // 
        echo $dias;
    ?>
</body>
</html>