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
  <title>Alta Categoria</title>
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

    <form action="<?php echo BASE ?>category/store" method="POST" class="form-admin">
      <h2 class="form-title">Alta de categoria:</h2>
      <div class="form-group">
        <label class="label-l" >Descripcion: </label>
        <input class="input-s" type="text" name="cat-name" required>
      </div>

      <?php
      if ($from)
      {  ?>
          <input class="input" type="hidden" name="from" value="<?php echo $from ?>" >
          <?php
      }?>


      <div class="div-form-button">
        <button type="submit" class ="form-button">Agregar categoria</button>
      </div>
    </form>
    <div style="text-align: center">
        <?php
        if ($from)
        {  ?>
            <a class="secondary-button margin-0" href="<?= BASE ?>event/add">Volver</a>
    <?php
        } ?>

        <br>
    </div>
    <br>

  </section>
</body>
</html>
