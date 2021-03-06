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
  <title>Lugares</title>
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
    <h3>LUGARES</h3>
    <div class="container">
        <?php
        if ($locations)
        {
            foreach ($locations as $key => $value)
            { ?>
                <div class="element">
                    <h4><?php echo $value->getName()?></h4>
                    <div class="p-listev-plc"><p>Capacidad Maxima: <?php echo $value->getCapacity()?> </p></div>
                    <div class="p-listev-plc"><p>Direccion: <?php echo $value->getAdress()?> </p></div>
                    <div class="p-listev-plc"><p>Ciudad: <?php echo $value->getCity()?> </p></div>
                    <div style="text-align: center">
                        <a class="secondary-button" href="<?= BASE ?>location/inputUpdateData/<?php echo $value->getId()?>">Modificar</a>
                        <a class="secondary-button" href="<?= BASE ?>location/deleteLocation/<?php echo $value->getId()?>">Eliminar</a>
                    </div>
                    <br>
                </div>
        <?php
            }
        }
        else
        { ?>
            <p>SIN UBICACIONES</p>
    <?php
        } ?>
    </div>

  </section>
</body>
</html>
