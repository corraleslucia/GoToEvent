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
  <title>Modificar Evento</title>
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


    <form action="<?php echo BASE ?>event/updateEvent" method="POST" enctype="multipart/form-data" class="form-admin">
      <h2 class="form-title">Modificacion de evento:</h2>

      <div class="form-group">

        <input class="input" type="hidden" name="idEvent" value="<?php echo $id_event ?>" >

        <div class="form-group">
            <label class="label" >Nombre: </label>
            <input class="input" type="text" name="ev-name" placeholder="<?php echo $event->getDescription()?>" required>
        </div>

        <div class="form-group">
            <label class="label" for="">Categoria</label>
            <select class="form-control" name="id_category" required>
                <?php foreach ($categories as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getDescription()?> </option>

                <?php } ?>
            </select>

        </div>
        <div class="form-group">
            <label class="label" >Imagen: </label>
            <input type="file" name="event" required>
        </div>

      <div class="div-form-button">
        <button type="submit" class ="form-button">Modificar evento</button>
      </div>
    </form>
    <div style="text-align: center">
        <a class="secondary-button margin-0"href="<?= BASE ?>event/_list">Volver</a>
    </div>
    <br>

  </section>
</body>
</html>
