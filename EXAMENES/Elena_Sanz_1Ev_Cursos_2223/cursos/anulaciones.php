<!--  anulaciones   -->
<?php
    require_once('cabecera.php');
    $hoy = date('Y-m-d');   // formato = anio-mes-dia   

    // session
    session_start();
    if(!isset($_SESSION['cursos']))   // se crea la primera vez que entramos
    {
        $_SESSION['cursos'] = [];
        
        // guardar datos en la sesion
        $cursosHoy = obtenerCursosFecha($hoy);
        while($curso = mysqli_fetch_assoc($cursosHoy))  
            array_push($_SESSION['cursos'] , $curso);  //session['42'] = [id_curso:42, asistentes:53, tema:"ashedeje", aula:1, edificio:"nombre del edificio"]
    }
    
    if(isset($_GET['anulado']))
    {
        $numCursos = count($_SESSION['cursos']);
        for($i=0 ; $i<$numCursos ;$i++)
        {
            if($_SESSION['cursos'][$i]['id_curso'] == $_GET['anulado'])
                --$_SESSION['cursos'][$i]['asistentes'];
        }
    }

?>
    <main id="main">
        <h1>CURSOS DE HOY (<?php echo $hoy;?>)</h1>
    
        <?php
            // guardar anulaciones
            if(isset($_GET['guardar'])  &&  $_GET['guardar']) 
            {
                // actualizamos la base de datos
                $numCursos = count($_SESSION['cursos']);
                for($i=0 ; $i<$numCursos ;$i++)
                {
                    $curso = $_SESSION['cursos'][$i];
                    actualizarAsistencias($curso['asistentes'], $curso['id_curso']);  
                }
                //mostramos mensaje confirmacion
                echo '<p>Las anulaciones han sido guardadas correctamente</p>';
            }
        ?>

        <!--  Tabla cursos  -->
        <table>
            <?php 
                foreach($_SESSION['cursos'] as $curso)
                {
                    $txtHTML = "<tr>";
                    $txtHTML = $txtHTML.'<td>Curso '.$curso['id_curso'].'('.$curso['edificio'].$curso['aula'].','.$curso['tema'].')</td>';
                    $txtHTML = $txtHTML.'<td>'.$curso['asistentes'].' asistentes</td>';
                    if($curso['asistentes'] > 0)
                        $txtHTML = $txtHTML.'<td><a href="anulaciones.php?anulado='.$curso['id_curso'].'">Cancelar 1 asistencia</a></td>';
                    else
                        $txtHTML = $txtHTML.'<td></td>';  // si no hay asistentes tampoco enlace
                    $txtHTML = $txtHTML."</tr>";
                    echo $txtHTML;
                }
            ?>
        </table>
        <a href="anulaciones.php?guardar=true">Guardar anulaciones</a>
    </main>
<?php
    require_once('footer.php');
?>