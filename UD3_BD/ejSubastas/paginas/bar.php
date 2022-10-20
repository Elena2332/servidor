<?php
    // FILTRO CATEGORIAS
    echo "<h1>Categorias</h1>";
    echo "<ul><li><a href='index.php'>Ver todas</a></li>";

    $catsql = "SELECT * FROM categorias ORDER BY categoria ASC;";
    $catresult = mysqli_query($con, $catsql);

    while($catrow = mysqli_fetch_assoc($catresult)) 
        echo "<li><a href='./index.php?id=". $catrow['id'] . "'>" . $catrow['categoria']. "</a></li>";
    echo "</ul>";
?>
