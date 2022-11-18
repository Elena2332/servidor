<?php
///////// CONSTANTES
    const DB_HOST="localhost";
    const DB_USER="root";
    const DB_PASS="";
    const DB_DATABASE="bdcursos";

    const RUTA_APP="./";
    const RUTA_IMG="./img/";

    const TITULO="Elena_1ev";
    const MONEDA="€";


/////////  CONSULTAS
    // select
    function obtenerCategorias()
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "SELECT distinct(CATEGORIA) FROM temas ORDER BY CATEGORIA ASC;";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    function obtenerTemaPorCategoria($cat)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "SELECT * FROM temas where CATEGORIA = '$cat';";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    function obtenerCursosPorTema($idTema)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "SELECT * FROM cursos where ID_TEMA = '$idTema'";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    function obtenerCursosFecha($fecha)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql ="select id_curso, asistentes, tema, aulas.numero as aula, edificios.nombre as edificio "; 
        $sql = $sql."from cursos, temas ,aulas, edificios ";
        $sql = $sql."where cursos.ID_TEMA=temas.ID_TEMA  and  cursos.ID_AULA=aulas.ID_AULA  and  aulas.ID_EDIFICIO=edificios.ID_EDIFICIO ";
        $sql = $sql."and cursos.dia='$fecha'";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    // update
    function subirPrecio($porcentaje, $idTema)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        // $sql = "Update cursos set PRECIO=(cursos.PRECIO *(1+($porcentaje/100))) WHERE cursos.ID_CURSO in (select id_curso from (select id_curso from cursos, temas where cursos.id_tema=temas.id_tema and temas.categoria='$cat') as cursos);";
        $sql = "update cursos set precio=(cursos.PRECIO *(1+($porcentaje/100))) where ID_TEMA='$idTema'";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }
    function bajarPrecio($porcentaje, $idTema)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        // $sql = "Update cursos set cursos.precio=(cursos.PRECIO *(1-(YY/100))) WHERE cursos.ID_CURSO in (select id_curso from (select id_curso from cursos, temas where cursos.id_tema=temas.id_tema and temas.categoria=’XXXX’) as cursos);";
        $sql = "update cursos set precio=(cursos.PRECIO *(1-($porcentaje/100))) where ID_TEMA='$idTema'";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    function actualizarAsistencias($asis, $id) 
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        $sql = "update cursos set asistentes=$asis where ID_CURSO='$id'";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

?>