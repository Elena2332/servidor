<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio4</title>
</head>
<body>
    <h2>Tabla de imagenes</h2>
    <div>
        <table style="border: 2px solid grey">
        <?php            
            function pasarArray($arr)
            {
                $nuevo=[];
                foreach($arr as $elm)
                    array_push($nuevo, $elm);
                return $nuevo;
            }
            function mostrarImagenes($arr)
            {
                $arr = array_unique($arr); // quita repes pero deja vacios los huecos
                $sinRepes = pasarArray($arr);
                $fila = "<tr>";
                for($i=0 ; $i<count($sinRepes) ;$i++)
                {
                    $fila = $fila."<td><a href=".$sinRepes[$i]."><img src=".$sinRepes[$i]." alt=".$sinRepes[$i]." width='200' heigth='200'/></a></td>";
                    var_dump($fila);
                    if(($i+1) %3 == 0)
                    {
                        $fila=$fila.'</tr>';
                        if(($i+1) < count($sinRepes))
                            $fila=$fila.'<tr>';
                    }
                } 
                echo $fila;
            }

            $img=['img/bordes.png','img/logo1.png','img/casita.png','img/movil.png','img/bordes.png','img/reloj.png','img/logo1.png','img/casita.png'];
            mostrarImagenes($img);
        ?>
        </table>
    </div>
</body>
</html>