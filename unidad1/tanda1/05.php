<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
</head>
<body>
    <h2>Array de array de peliculas</h2>
    <div>
        <?php     
            function favoritos($peli)
            {
                $arr= [ 'Patri'=> ['star wars','el marciano','alien'],
                        'Nadim'=> ['star wars','cenicienta','encanto','dumbo'],
                        'Marta'=> ['cenicienta','lobezno','dumbo'],
                        'Mario'=> ['el marciano','dumbo','terminator'],
                        'Ander'=> ['star wars','aristogatos','encanto']
                ];
                $cont=0;
                foreach($arr as $peliculas)
                    if(in_array($peli, $peliculas))
                        $cont++;
                return $cont;
            }

            function pelisAleatorias()
            {
                $arr= [ 'Patri'=> ['star wars','el marciano','alien','predator'],
                        'Nadim'=> ['star wars','cenicienta','encanto','dumbo'],
                        'Marta'=> ['cenicienta','lobezno','dumbo','blancanieves','el rey leon'],
                        'Mario'=> ['el marciano','dumbo','terminator','alien'],
                        'Ander'=> ['star wars','aristogatos','encanto','dumbo']
                ];
                foreach($arr as $persona=>$peliculas)
                {
                    $p1=0;
                    $p2=0;
                    do{
                        $p1 = random_int(0,count($peliculas)-1);
                        $p2 = random_int(0,count($peliculas)-1);
                    }while($p1 == $p2);
                    echo '<br>Favoritas de '.$persona.': '.$peliculas[$p1].', '.$peliculas[$p2].'<br>';
                }
            }
            
            echo favoritos('el marciano').' personas más tienen "el marciano" entre sus favoritas<br>';
            pelisAleatorias();
        ?>
    </div>
</body>
</html>