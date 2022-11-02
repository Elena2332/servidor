<h1>Detalle de usuario</h1>
<!-- No tiene ninguna acción porque es informativo -->
  <form action="" method="">
    <div class="form-group text-left">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" class="form-control"
      value="<?php echo $alumno[0]->nombre; ?>" disabled
      >
    </div>
    <div class="form-group text-left">
      <label for="apellidos">Apellidos:</label>
      <input type="text" name="apellidos" class="form-control"
      value="<?php echo $alumno[0]->apellidos; ?>" disabled
      >
    </div>
    <div class="form-group text-left">
      <label for="nacimiento">Fecha de nacimiento:</label>
      <input type="text" name="nacimiento" class="form-control"
      value="<?php echo $alumno[0]->nacimiento; ?>" disabled
      >
    </div>
    <div class="form-group text-left">
      <label for="sexo">Género:</label>
      <input type="text" name="sexo" class="form-control"
      value="<?php echo $alumno[0]->sexo; ?>" disabled
      >
    </div>
    <div class="form-group text-left">
      <label for="promedio">Promedio:</label>
      <input type="text" name="promedio" class="form-control"
      value="<?php echo $alumno[0]->promedio; ?>" disabled
      >
    </div>
  </form>
  <a href="<?php echo site_url('cinicio/alumnos'); ?>" class="btn btn-success">Regresar</a>
