<?php
    // FILTRO CATEGORIAS
    echo "<h1>Categorias</h1>";
    echo "<ul><li><a href='index.php'>Ver todas</a></li>";

    $categorias = obtenerCategorias();
    while($catrow = mysqli_fetch_assoc($categorias)) 
        echo "<li><a href='./index.php?id=". $catrow['id'] . "'>" . $catrow['categoria']. "</a></li>";
    echo "</ul>";
?>
