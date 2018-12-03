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
  <title>Modificar Tipo de Plaza</title>
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


    <form action="<?php echo BASE ?>seatType/updateSeatType" method="POST" class="form-admin">
      <h2 class="form-title">Modificacion de tipo de plaza:</h2>

      <div class="form-group">

        <input class="input" type="hidden" name="idSeatType" value="<?php echo $id_seatType ?>" >

        <label class="label" >Nombre: </label>
        <input class="input" type="text" name="art-name" placeholder="<?php echo $seatType->getName()?>" required>
      </div>

      <div class="div-form-button">
        <button type="submit" class ="form-button">Modificar tipo de plaza</button>
      </div>
    </form>
    <div style="text-align: center">
        <a class="secondary-button margin-0"href="<?= BASE ?>seatType/_list/">Volver</a>
    </div>
    <br>

  </section>
</body>
</html>
