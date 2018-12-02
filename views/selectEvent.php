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
  <title>Agregar a Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    <?php if ($type === "f")
    { ?>
        <form action="<?php echo BASE ?>calendar/addMoreCalendars" method="POST" class="form-admin">
    <?php }
    else if ($type === "p")
    { ?>
        <form action="<?php echo BASE ?>calendar/addMoreEventSeats" method="POST" class="form-admin">
    <?php
    } ?>

        <h2 class="form-title">Agregar a Evento</h2>
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

    <div style="text-align: center">
        <a class="secondary-button margin-0" href="<?= BASE ?>event/index">Volver</a>
    </div>
  </section>
</body>
</html>
