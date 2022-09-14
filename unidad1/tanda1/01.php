<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    <h2>Muestra la fecha actual con el formato: 17th  September 2021, Wednesday</h2>
    <div>
        <?php
            echo date("d\\t\h M Y, l");
        ?>
        <br>
    </div>

    <h2>cuántos días quedan para finalizar el año</h2>
    <div>
        <?php
            $ahora = time(); // ahora en segundos
            $maxSeg = 325*24*3600; // segundos en un año (dias * horas en un dia * segundos en una hora)
            $dias = ($maxSeg-$ahora) * 3600*24; // 
            echo $dias;
        ?>
        <br>
    </div>

    <h2>Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza</h2>
    <div>
        <?php
            $arr=array("Sin","poder","un","indeal","es","imaginario","y","sin","ideales","el","poder","es","vacuo","-","Rimuru","Tempest");
            $str="";
            for($i=0 ; $i<count($arr) ;$i++)
                $str=$str.$arr[$i]." ";
            
            echo $str;
        ?>
        <br>
    </div>

    <h2>A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”</h2>
    <div>
        <?php
            $ori="En la mañana del año se añora al ñu de gran tamaño que limpia con un paño";
            $texto = str_replace("ñ", "gn", $ori);
            echo $texto;
        ?>
        <br>
    </div>

    <h2>Función que devuelve un array con n números aleatorios entre limite1 y limite2</h2>
    <div>
        <?php
            
        ?>
        <br>
    </div>

    <h2>Función que recibe una cadena y la devuelve cifrada.</h2>
    <div>
        <?php

        ?>
        <br>
    </div>
</body>
</html>