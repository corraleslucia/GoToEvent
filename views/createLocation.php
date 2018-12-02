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
  <title>Alta Lugar Evento</title>
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

    <form action="<?php echo BASE ?>location/store" method="POST" class="form-admin form-med-size">
        <?php
        if ($fromEvent)
        {  ?>
            <input class="input" type="hidden" name="fromEvent" value="<?php echo $fromEvent ?>" >
            <?php
        }
        else
        { ?>
            <input class="input" type="hidden" name="none" value="">
      <?php
        } ?>
      <h2 class="form-title">Alta de lugar de evento:</h2>
      <div class="form-group">
        <label class="label-l">Nombre lugar: </label>
        <input class="input-s" type="text" name="loc-name" required>
      </div>
      <div class="form-group">
        <label class="label-l">Capacidad Maxima: </label>
        <input class="input-s" type="text" name="loc-capacity" required>
      </div>

      <div class="form-group">
        <label class="label-l" >Direccion: </label>
        <input class="input-s" type="text" name="loc-adress" required>
      </div>

      <div class="form-group">
        <label class="label-l" >Ciudad: </label>
        <input class="input-s" type="text" name="loc-city" required>
      </div>
      <div class="div-form-button">
        <button type="submit" class ="form-button">Agregar lugar evento</button>
      </div>

    </form>

    <div style="text-align: center">
        <?php
        if ($fromEvent)
        {  ?>
            <a class="secondary-button" href="<?= BASE ?>calendar/add/<?php echo $fromEvent ?>">Volver</a>
    <?php
        }
        else
        { ?>
            <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
    <?php
        } ?>
    </div>
    <br>
  </section>
</body>
</html>
