<h1>Borrar alumno</h1>
<div class="alert alert-danger" role="alert"><b>Atención:</b> una vez borrado el registro no se podrá recuperar la información.</div>
  <form action="<?php echo site_url('cinicio/alumnoBorrarRegistro'); ?>" method="post">
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
    <input type="hidden" name="id" 
    value="<?php echo $alumno[0]->id; ?>"/>
    <input type="submit" class="btn btn-danger" value="Borrar registro">
    <a href="<?php echo site_url('cinicio/alumnos'); ?>" class="btn btn-info">Regresar</a>
  </form>
