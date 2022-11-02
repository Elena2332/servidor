<h1>Alumnos</h1>
<?php 
    echo "<table class='table'>";
    echo "<tr><th>id</th><th>Nombre</th><th>Apellidos</th><th>Nacimiento</th><th>Género</th><th>Promedio</th><th>Modificar</th><th>Borrar</th></tr>";
    foreach ($alumnos->result() as $alumno) {
      echo "<tr>";
      echo "<td><a href='";
      echo site_url('cinicio/alumnoDetalle/'.$alumno->id);
      echo "'>".$alumno->id."</a></td>";
      echo "<td>".$alumno->nombre."</td>";
      echo "<td>".$alumno->apellidos."</td>";
      echo "<td>".$alumno->nacimiento."</td>";
      echo "<td>".$alumno->sexo."</td>";
      echo "<td>".$alumno->promedio."</td>";
      echo "<td><a href='";
      echo site_url('cinicio/alumnoModificar/'.$alumno->id);
      echo "' class='btn btn-info'>Modificar</a></td>";
      echo "<td><a href='";
      echo site_url('cinicio/alumnoBorrar/'.$alumno->id);
      echo "' class='btn btn-danger'>Borrar</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo $this->pagination->create_links();
    ?>
    <a href="<?php echo site_url('cinicio/alumnoAlta'); ?>" class="btn btn-info">Alta de alumnos</a>