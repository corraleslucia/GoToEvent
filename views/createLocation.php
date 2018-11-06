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

    <form action="store" method="POST" class="form-admin form-med-size">
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

  </section>
</body>
</html>
