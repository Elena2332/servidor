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
            date_default_timezone_set('Europe/Madrid');  //zona horaria  
            echo date("d\\t\h M Y, l");
        ?>
        <br>
    </div>

    <h2>cuántos días quedan para finalizar el año</h2>
    <div>
        <?php
            $ahora = time(); // ahora en segundos
            $maxSeg = mktime(0,0,0,01,01,2023);
            $dias = round( ($maxSeg-$ahora) / (60*60*24) ) ; // pasar de segundos a dias
            echo $maxSeg.' - '.$ahora.' = '.$dias;
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
            echo "original: ".$ori."<br>";
            $texto = str_replace("ñ", "gn", $ori);
            echo "cambiada: ".$texto;
        ?>
        <br>
    </div>

    <h2>Función que devuelve un array con n números aleatorios entre limite1 y limite2</h2>
    <div>
        <?php
            function fun($i, $lim1, $lim2)
            {
                $arr=[];
                for(; $i>0 ;$i--)
                {
                    if($lim1<$lim2)
                        $n = random_int($lim1,$lim2);
                    else
                        $n = random_int($lim2,$lim1);
                    array_push($arr,$n);
                }
                return $arr;
            }
            var_dump(fun(4, 1, 50));
        ?>
        <br>
    </div>

    <h2>Función que recibe una cadena y la devuelve cifrada.</h2>
    <div>
        <?php
            //  “A”=>”20”, “H”=>”9R”, “M”=>”abcd”
            $ori="HOLA AMO HERMOSO";
            $texto = str_replace("H", "9R", $ori);
            $texto = str_replace("A", "20", $texto);
            $texto = str_replace("M", "abcd", $texto);
            echo $texto;
        ?>
        <br>
    </div>
</body>
</html>