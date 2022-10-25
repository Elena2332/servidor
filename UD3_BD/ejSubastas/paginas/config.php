<?php
    // .properties
    const DB_HOST="localhost";
    const DB_USER="root";
    const DB_PASS="";
    const DB_DATABASE="ud3";

    const RUTA_APP="./";
    const RUTA_IMG="../img/";

    const TITULO="El Mundo Bajo la Mesa";
    const MONEDA="€";

    // session_start();


    function obtenerItem($conn,$id_cat)
    {
        $sql = "select * from items"; 
        if(!is_null($id_cat))
            $sql = $sql." where id_cat=$id_cat";
        $items = mysqli_query($conn,$sql);
        return $items;   
    }

    function pujasPorItem($conn,$idItem)
    {
        $sql = "select count(id) from pujas where id_item=$idItem";
        $count = mysqli_fetch_row(mysqli_query($conn,$sql));
        return $count[0];
    }

    function pujaMayor($conn,$idItem)
    {
        $sql = "select Max(cantidad) from pujas where id_item=$idItem";
        $max = mysqli_fetch_row(mysqli_query($conn,$sql));
        return $max[0];
    }

    function obtenerImagen($conn,$idItem)
    {
        $sql = "select imagen from imagenes where id_item=$idItem";
        $res = mysqli_query($conn,$sql);
        $imgs = mysqli_fetch_array($res);
        if(empty($imgs[0]))
            return 'NO IMAGEN';
        else
            return '<img src="'.RUTA_IMG.$imgs[0].'" alt="'.$imgs[0].'" width="170"/>';
    }




