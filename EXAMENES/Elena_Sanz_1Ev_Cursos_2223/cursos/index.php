<!--  menu de categorias y tabla de cursos   -->
<?php
    require_once('cabecera.php');
?>

    <main id="main">
        <!-- Radios Categorias -->
        <h1>Elija la categoria de cursos:</h1>
        <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php
                $txtHTML = "";
                $categorias = obtenerCategorias();
                while($cat = mysqli_fetch_assoc($categorias))   // listar radios categoria
                {
                    $txtHTML = $txtHTML.'<input type="radio" name="radCategoria" value="'. $cat['CATEGORIA'] . '"';
                    if(isset($_POST['radCategoria'])  &&  $cat['CATEGORIA']==$_POST['radCategoria'])  // marca el seleccionado 
                        $txtHTML = $txtHTML.' checked';
                    $txtHTML = $txtHTML.'><label>'.$cat['CATEGORIA'].'</label><br/>';
                }
                // radio todas las categorias
                $txtHTML = $txtHTML.'<input type="radio" name="radCategoria" value="todo"';  // radio todas las categorias
                if(isset($_POST['radCategoria'])  &&  "todo"==$_POST['radCategoria'])  // marca el seleccionado 
                    $txtHTML = $txtHTML.' checked';
                $txtHTML = $txtHTML.'><label> TODAS LAS CATEGIRIAS </label><br/>';  
                echo $txtHTML;  // mostrar los radios
            ?>
            <input type="submit" name="btnVerCursos" value="Ver Cursos"/>
        
        <hr>

        <!-- tabla cursos segun categoria -->
            <?php
                if(isset($_POST['btnVerCursos']))
                {
                    if(isset($_POST['radCategoria']))
                    {   
                        // categoria seleccionada
                        if($_POST['radCategoria'] == "todo") // seleccionado = todas la categorias
                            $catSeleccionada = "todas las categorias";
                        else
                            $catSeleccionada = "categoria ".$_POST['radCategoria'];
                        
                        echo '<h2>Imparticiones de cursos de '.$catSeleccionada.'</h2>';
        

                        //tabla cursos
                        $txtHTML = "<table><tr> <th>SELECCIONAR</th> <th>TEMA</th> <th>CANTIDAD DE CURSOS</th> </tr>";
                        $temas = obtenerTemaPorCategoria($_POST['radCategoria']);
                        while($tema = mysqli_fetch_assoc($temas))   // filas tabla tema
                        {
                            $txtHTML = $txtHTML.'<tr>';
                            $txtHTML = $txtHTML.'<td> <input type="checkbox" name="chTema[]" value="'.$tema['ID_TEMA'].'"/> </td>';
                            $txtHTML = $txtHTML.'<td> '.$tema['ID_TEMA'].' </td>';                    
                            $txtHTML = $txtHTML.'<td> '.mysqli_num_rows(obtenerCursosPorTema($tema['ID_TEMA'])).' cursos </td>';
                            $txtHTML = $txtHTML.'</tr>';
                        }
                        $txtHTML = $txtHTML."</table>";
                        echo $txtHTML;


                        // select descuento precio
                        echo '<input type="submit" name="btnSubir" value="Subir Precio"/>';
                        $txtHTML = '<select name="selPor">';
                        for($porcentaje=5 ; $porcentaje<=50 ; $porcentaje=$porcentaje+5)  // llenar select porcentajes
                            $txtHTML = $txtHTML.'<option value="'.$porcentaje.'">'.$porcentaje.'%</option>';
                        $txtHTML = $txtHTML."</select>";
                        echo $txtHTML;
                        echo '<input type="submit" name="btnBajar" value="Bajar Precio"/>';
                    }  
                }  
                
                //subir precio
                if(isset($_POST['btnSubir'])  &&  isset($_POST['chTema']))  
                {
                    $por = $_POST['selPor'];
                    $numCursos = 0;
                    $cantSeleccionados = count($_POST['chTema']);
                    for($i=0 ; $i<$cantSeleccionados ;$i++)  // recorremos los temas seleccionados
                    {
                        $idTema = $_POST['chTema'][$i];
                        subirPrecio($por,$idTema); 
                        $numCursos = $numCursos + mysqli_num_rows(obtenerCursosPorTema($idTema));
                    }
                    echo 'Se han cambiado el precio de '.$numCursos.'cursos';
                }

                //bajar precio
                if(isset($_POST['btnBajar']))
                {
                    $por = $_POST['selPor'];
                    $numCursos = 0;
                    $cantSeleccionados = count($_POST['chTema']);
                    for($i=0 ; $i<$cantSeleccionados ;$i++)  // recorremos los temas seleccionados
                    {
                        $idTema = $_POST['chTema'][$i];
                        bajarPrecio($por,$idTema); 
                        $numCursos = $numCursos + mysqli_num_rows(obtenerCursosPorTema($idTema));
                    }
                    echo 'Se han cambiado el precio de '.$numCursos.' cursos';
                }
            ?>
        </form>
    </main>
<?php
    require_once('footer.php');
?>