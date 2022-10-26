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



///// deletes


