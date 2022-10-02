<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes</title>
    <style>
        body
        {
            diplay: flex;
        }
    </style>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
            $arr = [];
            $extensiones = ["jpg","png","jfif","gif"];
            $imagenes = scandir('./img/');
            foreach($imagenes as $img)
            {
                $ext = explode('.',$img)[1];
                if(in_array($ext, $extensiones))  // para evitar los dos ficheros que cuenta de mas
                    array_push($arr, $img);                
            }

            $txt = "";
            for ($i = 0; $i< $_POST['selNum']; $i++)
            {
                $txt = $txt. "<img width = '200' height ='120'  src='../img/".$arr[$i]."'/>";
                $txt =$txt. "<input type='checkbox' name='chMeGusta[]' value='".$arr[$i]."'>
                             <label>Me gusta</label> <br>";
            }
            echo $txt;
        ?>
    </form>
</body>
</html>