<?php
    // TABLA PRODUCTOS
    $id_cat;
    if(isset($_GET['id']))
        $id_cat = $_GET['id'];
    else
        $id_cat = NULL;

    echo '<table><tr> <th>IMAGEN</th> <th>ITEM</th> <th>PUJAS</th> <th>PRECIO</th> <th>PUJAS HASTA</th> </tr>';
    $items = obtenerItem($con,$id_cat);
    while($item = mysqli_fetch_assoc($items))
    { 
        $id = $item['id'];
        echo "<tr>
            <td>".obtenerImagen($con,$id)."</td>
            <td><a href='./paginas/itemdetalles.php?id=$id'>".$item['nombre']."</a></td>
            <td>".pujasPorItem($con,$id)."</td>";
            $pujaMax = pujaMayor($con,$id);
            if(is_null($pujaMax))
               echo "<td>".$item['preciopartida'].MONEDA."</td>";
            else
                echo "<td>".$pujaMax.MONEDA."</td>";
        echo "<td>".$item['fechafin']."</td> </tr>";
    }    
    echo '</table>';
?>