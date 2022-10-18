<?php

    define("DB_HOST","localhost" );  
    define("DB_USER", "root");  
    define("DB_PASS", "");  
    define("DB_DATABASE", "ud03" );  

    /*
    * Interfaz orientada a objetos
    */
    $conOO = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);   
    if($conn->connect_errno > 0){   
         die("Imposible conectarse con la base de datos [" . $conOO->connect_error . "]");   
    }  
    // $conOO = new mysqli(DB_HOST, DB_USER, DB_PASS);   
    // if(!$conOO->select_db(DB_DATABASE)) die ($conOO->error);  

   /*
   *Interfaz procedimental
   */
   $conP = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);  
   if (mysqli_connect_errno())  
   {  
        echo "Imposible conectarse a la base de datos: " . mysqli_connect_error();  
   } else {   
   }  
//    $conP = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
//    mysqli_select_db($conP, DB_DATABASE);
   




?>