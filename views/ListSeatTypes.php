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
  <title>Tipos de Plazas</title>
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
    <h3>TIPOS DE PLAZAS</h3>
    <div class="container">
        <?php
        if ($seatTypes)
        {
            foreach ($seatTypes as $key => $value)
            { ?>

                <div class="element">
                    <div>
                        <h4><?php echo $value->getName()?></h4>
                        <a class="secondary-button margin-0" href="<?= BASE ?>seatType/inputUpdateData/<?php echo $value->getId()?>">Modificar</a>
                        <h4></h4>
                        <a class="secondary-button margin-0" href="<?= BASE ?>seatType/deleteSeatType/<?php echo $value->getId()?>">Eliminar</a>
                    </div>
                    <br>
                </div>
      <?php }
        }
        else
        { ?>
            <p>SIN TIPOS DE PLAZAS</p>
   <?php
        }
   ?>
    </div>


  </section>
</body>
</html>
