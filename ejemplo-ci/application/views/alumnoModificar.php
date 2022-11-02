<h1>Modificar datos del alumno</h1>
  <form action="<?php echo site_url("cinicio/alumnoActualizar"); ?>" method="post">
    <div class="form-group text-left">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" class="form-control"
      value="<?php echo $alumno[0]->nombre; ?>" 
      >
    </div>
    <div class="form-group text-left">
      <label for="apellidos">Apellidos:</label>
      <input type="text" name="apellidos" class="form-control"
      value="<?php echo $alumno[0]->apellidos; ?>" 
      >
    </div>
    <div class="form-group text-left">
      <label for="nacimiento">Fecha de nacimiento:</label>
      <input type="text" name="nacimiento" class="form-control"
      value="<?php echo $alumno[0]->nacimiento; ?>" 
      >
    </div>
    <div class="form-group text-left">
      <label for="sexo">Género:</label>
      <input type="text" name="sexo" class="form-control"
      value="<?php echo $alumno[0]->sexo; ?>" 
      >
    </div>
    <div class="form-group text-left">
      <label for="promedio">Promedio:</label>
      <input type="text" name="promedio" class="form-control"
      value="<?php echo $alumno[0]->promedio; ?>" 
      >
      <input type="hidden" name="id" 
      value="<?php echo $alumno[0]->id; ?>"/>
    </div>
    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a href="<?php echo site_url('cinicio/alumnos'); ?>" class="btn btn-info">Regresar</a>
  </form>
  
