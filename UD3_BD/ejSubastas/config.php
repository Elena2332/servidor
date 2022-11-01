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
    function obtenerItemId($id)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select * from items where id=$id";
        $item = mysqli_fetch_assoc(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $item;   
    }

    function obtenerItem($idCat, $idUser, $nom, $fecha, $precio)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select id from items where id_cat=$idCat and id_user=$idUser and nombre='$nom' and preciopartida=$precio and fechafin='$fecha'";
        $item = mysqli_fetch_assoc(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $item;   
    }

    function obtenerItemCat($id_cat)
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

    function obtenerGanador($idItem)
    {

    }

    function pujasPorItemDatos($idItem)  // return array con nom_usuario y catidad_dinero
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select username,cantidad from pujas,usuarios where id_item=$idItem and id_user=usuarios.id";
        $items = mysqli_query($conn,$sql);
        mysqli_close($conn);
        return $items;
    }

    function pujasPorItemNum($idItem)
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

    function pujasDia($idUser,$idItem)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select count(id) from pujas where id_item=$idItem and id_user=$idUser and fecha=sysdate()";
        $count = mysqli_fetch_row(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $count[0];
    }

    function obtenerPrimImagen($idItem)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select imagen from imagenes where id_item=$idItem";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) > 0)  // hay imagenes  si ha debuelto filas  __.__  [$res -> num_rows] = [mysqli_num_rows($res)]
        {
            $imgs = mysqli_fetch_array($res);
            mysqli_close($conn);
            return '<img src="'.RUTA_IMG.$imgs[0].'" alt="'.$imgs[0].'" width="170"/>';
        }
        else
        {
            mysqli_close($conn);
            return 'NO IMAGEN';
        }
    }
    
    function obtenerImagenes($idItem)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select imagen from imagenes where id_item=$idItem";
        $res = mysqli_query($conn,$sql);
        mysqli_close($conn);
        return $res;
    }

    function obtenerUsuario($usu)  // return id,username,nombre,email del usuario 
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select id,username,nombre,email from usuarios where username='$usu';";
        $res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $res;
    }

    function existeUsuario($usu)  // return true si existe el usuario
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "select count(id) from usuarios where username='$usu';";
        $res = mysqli_fetch_row(mysqli_query($conn,$sql));
        mysqli_close($conn);
        return $res[0];
    }

    function login($usu, $pass)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        //comprobar usuario y contrasena 
        $sql = "select activo from usuarios where username='$usu' and password='$pass';";
        $res = mysqli_query($conn,$sql);    
        $us = mysqli_fetch_assoc($res);
        mysqli_close($conn);  
        if($res -> num_rows > 0)
        {
            // comprobar si esta activo
            if($us['activo'] == 0) // usuario inactivo
                return 2; 
            else
                return 0; // correcto
        }
        else
            return 1; //incorrecto
    }

///// inserts
    function insertUsuario($usu,$nom,$pass,$email,$cadena)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "insert into usuarios (username, nombre, password, email, cadenaverificacion, activo, permisos) 
            values ('$usu','$nom','$pass','$email','$cadena', 1,0) ";  // el mail no funciona, activo por defecto
        $res = mysqli_query($conn,$sql);        
        mysqli_close($conn);

        return $res;
    }

    function insertPuja($idUser, $idItem, $cant)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "insert into pujas (id_item, id_user, cantidad, fecha) 
            values ('$idItem','$idUser','$cant',sysdate()) ";  
        $res = mysqli_query($conn,$sql);        
        mysqli_close($conn);

        return $res;
    }

    function insertItem($idCat, $idUser, $nom, $desc, $fecha, $precio)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "insert into items (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) 
            values ('$idCat','$idUser','$nom',$precio, '$desc', '$fecha') ";  
        $res = mysqli_query($conn,$sql);        
        mysqli_close($conn);
        return $res;
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
/*
function mandarMail($email,$cadena)
{
    // mandar mail
    $urlCadRandom=urlencode($cadena);
    $urlEmail=urlencode($email);            
    $enlace="http://127.0.0.1/ejerphp_subastas/pruebaregistro.php?email=$urlEmail&cadverif=$urlCadRandom";            

    $mens=<<<MAIL
            Hola $usuario. Haz clic en el siguiente enlace para registrarte:
            $enlace
            Gracias
    MAIL;

    if (mail($email,"Registro en 127.0.0.1", $mens, "From:dwes.ciudadjardin@gmail.com"))  //dwes.ciudadjardin@gmail.com
        echo "<p>Mensaje enviado</p>";
    else
        echo '<p style="color:red;">No se pudo enviar mensaje</p>';  
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
*/
        
?>
