<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar cantidad</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="./eval_imag.php">
        <label>Cuantas imagenes deseas ver? </label>
        <select name="selNum">
            <?php
                echo colocarOptions();
            ?>
        </select><br/>
        <!-- <?php
            $imagenes = scandir('./img');
            var_dump($imagenes);
        ?> -->
        <button name="btnVerImg" type="submit">Ver imagenes</button>
    </form>
    <?php
        function colocarOptions()
        {
            $imagenes = scandir('./img');
            $txtOpcions = "";
            for($i=1; $i<=count($imagenes)-2 ;$i++)    
                $txtOpcions = $txtOpcions.'<option value="'.$i.'">'.$i.'</option>';
            return $txtOpcions;
        }
    ?>
</body>
</html>