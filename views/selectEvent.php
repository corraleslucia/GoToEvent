<?php
namespace views;

include('header.php');
include('navAdmin.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agregar Nuevo Calendario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    
    <form action="<?php echo BASE ?>calendar/readEvent" method="POST" class="form-admin">
        <h2 class="form-title">Agregar Nuevo Calendario</h2>
        <div class="form-group">
            <label>Evento: </label>
            <select class="form-control" name="id_event" required>
                <?php foreach ($events as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getDescription()?> </option>

                <?php } ?>
            </select>
        </div>
      <div class="div-form-button">
        <button type="submit" class ="form-button">Seleccionar Evento</button>
      </div>
      
    </form>

  </section>
</body>
</html>
