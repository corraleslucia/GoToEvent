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
  <title>Alta Tipo plaza</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
      <?php if ($val)
      {?>
          <p> <?php echo $val; ?> </p>
      <?php }
      ?>

    <form action="<?php echo BASE ?>seatType/store" method="POST" class="form-admin">
      <h2 class="form-title">Alta de tipo plaza:</h2>
      <?php
      if ($fromEventSeat)
      {  ?>
          <input class="input" type="hidden" name="fromEventSeat" value="<?php echo $fromEventSeat ?>" >
          <?php
      }
      else
      { ?>
          <input class="input" type="hidden" name="none" value="">
    <?php
      } ?>
      <div class="form-group">
        <label class="label">Nombre: </label>
        <input class="input" type="text" name="st-name" required>
      </div>
      <div class="div-form-button">
        <button type="submit" class ="form-button">Agregar tipo plaza</button>
      </div>

    </form>

    <div style="text-align: center">
        <?php
        if ($fromEventSeat)
        {  ?>
            <a class="secondary-button"href="<?= BASE ?>eventSeat/addMoreEventSeats/<?php echo $fromEventSeat ?>">Volver</a>
    <?php
        }
        else
        { ?>
            <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
    <?php
        } ?>
        <br>
    </div>
    <br>
  </section>
</body>
</html>
