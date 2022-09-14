<?php
    ///// decalaraciones
    // array
    $listaNombres=array("pepa");
    $listaNombres=["pepa","para","para","pepin","pon","pan"];
    // diccionario
    $nombreDinero= [ "Elena" => 23,
                     "Elena2" => 24
                   ];
    //constantes
    define("nombre", "valor");

    
    ///// FECHAS
    date_default_timezone_set('Europe/Madrid');  //zona horaria    
    [ // parametros de date()
        "AM_PM" => "A",
        "miliseg" => "v",
        "seg" => "s",
        "min" => "i",
        "hora_12" => "h",
        "hora_24" => "H",
        "dia numero" => "d",
        "dia texto" => "l",
        "dia abrebiado" => "D",
        "mes num" => "m",
        "mes texto" => "F",
        "año" => "Y"
    ];

    // AHORA
    date('parametros'); // parametros = letras del array 
    date('r');  //formato: Wed, 14 Sep 2022  12:08:17  +0000
    time();  // ahora en segundos

    // REFORMATEAR 
    new Datetime(date("r")); // parametro = una fecha
    function getFormatedDate($datestr, $format)
    {
        $date=new Datetime($datestr);
        return $date->format($format);
    }
    
    // FECHA EN SEGUNDOS
    mktime(0,0,0,1,1,2023); // parametros = seg,min,h,dia,mes,año -.- devuelve la fecha en segundos


    //// facilidades
    echo "<p>".join(", ", $listaNombres)."</p>"; //concatena contenido de un array
?>