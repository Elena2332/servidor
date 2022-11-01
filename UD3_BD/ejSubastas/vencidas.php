<?php
    // vencidas 
    echo '<form enctype="multipart/form-data" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    echo '<table><tr> <th></th> <th>ITEM</th> <th>PRECIO FINAL</th> <th>GANADOR</th> </tr>';
    $items = obtenerItemCat(NULL);
    while($item = mysqli_fetch_assoc($items))
    { 
        $id = $item['id'];
        echo "<tr>
            <td><input type='checkbox' name='".$id."'/></td>
            <td><a href='./itemdetalles.php?id=$id'>".$item['nombre']."</a></td>
            <td>".pujaMayor($id)."</td>
            <td>".obtenerGanador($id)."</td> </tr>";
    }    
    echo '</table>';

?>