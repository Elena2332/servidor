<?php
    // TABLA PRODUCTOS
    $id_cat;
    if(isset($_GET['id']))
        $id_cat = $_GET['id'];
    else
        $id_cat = "true";

    echo '<table>';
    while($item = mysqli_fetch_assoc(obtenerItem($con,$id_cat)))
    { 
        echo "<tr>
            <td>".obtenerImagen($con,$item['id'])."</td>
            <td>".$item['nombre']."</td>
            <td>".pujasPorItem($con,$item['id'])."</td>
            <td>".pujaMayor($con,$item['id'])."</td>
            <td>".$item['fechafin']."</td>
        </tr>";
    }    

    echo '</table>';
?>