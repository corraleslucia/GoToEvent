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
  <title>Alta Evento</title>
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

    <form action="store" method="POST" class="form-admin">
        <h2 class="form-title">Alta de evento:</h2>
        <div class="form-group">
        <label class="label" >Nombre: </label>
        <input class="input" type="text" name="ev-name" required>
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
      <div class="div-form-button">
        <button type="submit" class ="form-button">Agregar evento</button>
      </div>

    </form>

  </section>
</body>
</html>
