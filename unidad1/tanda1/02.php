<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2</title>
</head>
<body>
    <h2>Array con la temperatura de varios dias</h2>
    <div>
        <?php
            $arr=[15,18,20,21,19,20,16,18,14,17,22,25,23,19];
            //mostrar temperaturas
            echo 'Temperaturas: '.implode("ªC | ", $arr);

            //Medias
            echo '<br>Media redondeada: '.round(array_sum($arr)/count($arr));  //redondeada
            echo '<br>Media truncada: '.floor(array_sum($arr)/count($arr));  //truncada

            //5 mas altas
            rsort($arr); //ordena de mayor a menor
            $bajas = [];
            for($i=0 ; $i<5 ; $i++) 
                array_push($bajas, $arr[$i]);
            echo '<br>Temperaturas más altas: '.implode(" | ", $bajas);

            //5 mas bajas            
            sort($arr); //ordena de menor a mayor
            $altas = [];
            for($i=0 ; $i<5 ; $i++) // los 5 menores estan al principio
                array_push($altas, $arr[$i]);
            echo '<br>Temperaturas más bajas: '.implode(" | ", $altas);  
        ?>
        <br>
    </div>
</body>
</html>