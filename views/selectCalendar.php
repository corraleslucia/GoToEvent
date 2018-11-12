<?php
namespace views;

include(ROOT.'views/headerAdmin.php');
include(ROOT.'views/navAdmin.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agregar a Fecha</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">

        <form action="<?php echo BASE ?>eventSeat/addMoreEventSeats" method="POST" class="form-admin">
        <h2 class="form-title">Agregar a fecha</h2>
        <div class="form-group">
            <label>Evento: <?php echo $event['0']->getDescription()?>  </label>
            <?php if ($calendars)
            { ?>
                <label>Fecha: </label>
                <select class="form-control" name="id_calendar" required>
                <?php foreach ($calendars as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getDate() . " - " . $value->gettime() . " - " . $value->getLocation() ?> </option>

           <?php } ?>
               </select>

       <?php }
            else
            { ?>
                <p> No hay fechas cargadas.

      <?php }?>
        </div>

      <div class="div-form-button">
    <?php if (!$calendars)
          { ?>
              <button type="button" class ="form-button"> <a href="<?= BASE ?>event/selectEvent/f">Agregar Fecha a Evento</a></button>
    <?php }
          else
          { ?>
              <button type="submit" class ="form-button">Seleccionar Fecha</button>
    <?php } ?>
      </div>

    </form>

  </section>
</body>
</html>
