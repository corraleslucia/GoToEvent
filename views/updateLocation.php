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
  <title>Modificar Lugar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
      <?php if ($val)
      {?>
          <p class="alert"> <?php echo $val; ?> </p>
      <?php }
      ?>


    <form action="<?php echo BASE ?>location/updateLocation" method="POST" class="form-admin">
      <h2 class="form-title">Modificacion de Lugar:</h2>

      <div class="form-group">

        <input class="input" type="hidden" name="idLocation" value="<?php echo $id_location ?>" >

        <div class="form-group">
          <label class="label-l">Nombre lugar: </label>
          <input class="input-s" type="text" name="loc-name" placeholder="<?php echo $location->getName()?>" required>
        </div>
        <div class="form-group">
          <label class="label-l">Capacidad Maxima: </label>
          <input class="input-s" type="text" name="loc-capacity" placeholder="<?php echo $location->getCapacity()?>" required>
        </div>

        <div class="form-group">
          <label class="label-l" >Direccion: </label>
          <input class="input-s" type="text" name="loc-adress" placeholder="<?php echo $location->getAdress()?>" required>
        </div>

        <div class="form-group">
          <label class="label-l" >Ciudad: </label>
          <input class="input-s" type="text" name="loc-city" placeholder="<?php echo $location->getCity()?>" required>
        </div>


      <div class="div-form-button">
        <button type="submit" class ="form-button">Modificar Lugar</button>
      </div>
    </form>
    <div style="text-align: center">
        <a class="secondary-button margin-0"href="<?= BASE ?>location/_list/">Volver</a>
    </div>
    <br>

  </section>
</body>
</html>
