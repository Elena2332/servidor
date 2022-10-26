<?php
    // .properties
    const DB_HOST="localhost";
    const DB_USER="root";
    const DB_PASS="";
    const DB_DATABASE="ud3";

    const RUTA_APP="./";
    const RUTA_IMG="./img/";

    const TITULO="El Mundo Bajo la Mesa";
    const MONEDA="€";

    

//// obtener datos
    function obtenerItem($id_cat)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select * from items"; 
        if(!is_null($id_cat))
            $sql = $sql." where id_cat=$id_cat";
        $items = mysqli_query($conn,$sql);
        mysqli_close($conn);
        return $items;   
    }

    function obtenerCategorias()
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $catsql = "SELECT * FROM categorias ORDER BY categoria ASC;";
        $catresult = mysqli_query($conn, $catsql);
        mysqli_close($conn);
        return $catresult;
    }

    function pujasPorItem($idItem)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select count(id) from pujas where id_item=$idItem";
        $count = mysqli_fetch_row(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $count[0];
    }

    function pujaMayor($idItem)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select Max(cantidad) from pujas where id_item=$idItem";
        $max = mysqli_fetch_row(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $max[0];
    }

    function obtenerImagen($idItem)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select imagen from imagenes where id_item=$idItem";
        $res = mysqli_query($conn,$sql);
        $imgs = mysqli_fetch_array($res);
        mysqli_close($conn);
        if(empty($imgs[0]))
            return 'NO IMAGEN';
        else
            return '<img src="'.RUTA_IMG.$imgs[0].'" alt="'.$imgs[0].'" width="170"/>';
    }

    function existeUsuario($usu)  // return true si existe el usuario
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select count(id) from usuarios where username like '%$usu%';";
        $res = mysqli_fetch_row(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $res[0];
    }


///// inserts
    function insertUsuario($usu,$nom,$pass,$email,$cadena)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "insert into usuarios (username, nombre, password, email, cadenaverificacion, activo, false) 
            values ($usu,$nom,$pass,$email,$cadena, 0,0) "; 
        $res = mysqli_query($conn,$sql);
        return $res;
        mysqli_close($conn);
    }


///// alters




///// deletes




/////////////  Funciones
function crearCadenaRandom()
{
    $randomstring="";
    for($i = 0; $i < 16; $i++) {
        $randomstring .= chr(mt_rand(32,126));
    }
    return $randomstring;
}

if (isset($_GET['cadverif']))
{
    //Viene del enlace del email
    
    $cadRandom=  urldecode($_GET['cadverif']);
    $email=  urldecode($_GET['email']);
    echo "Email:$email<br/>";
    echo "Cadena de verificacion:$cadRandom<br/>";            
    //Si hay una tupla en la BD con ese email y esa cadena aleatorio, activar ese usuario
}


if (isset($_POST['registrarse']))
{
    $usuario="juan";
    $passwd="1234";
    $email="nereags@hotmail.com";
    $cadRandom=crearCadenaRandom();   //En la BD se guarda con addslashes
    
    //1. Se inserta una tupla en la BD con ese usuario, desactivado, y con la cadena random           
    
    //2. Se le manda un email para q se pueda activar
    $urlCadRandom=urlencode($cadRandom);
    $urlEmail=urlencode($email);            
    $enlace="http://127.0.0.1/ejerphp_subastas/pruebaregistro.php?email=$urlEmail&cadverif=$urlCadRandom";            

    $mens=<<<MAIL
            Hola $usuario. Haz clic en el siguiente enlace para registrarte:
            $enlace
            Gracias
MAIL;

    if (mail($email,"Registro en 127.0.0.1", $mens, "From:dwes.ciudadjardin@gmail.com"))
            echo "Mensaje enviado";
     else
        echo "No se pudo enviar mensaje";           
}
        
?>
