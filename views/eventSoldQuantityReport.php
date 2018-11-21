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
  <title>Informes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href= "<?php echo BASE ?>/css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>/css/style.css" />

</head>
<body>
  <section class="content">
    <h3>INFORMES - Entradas vendidas por Evento</h3>

    <div class="container">
        <?php if ($events)
        {
            foreach ($events as $key => $event)
            { ?>
                <div class="element event-elem">
                    <h2>Evento: <b><?php echo $event->getDescription()?></b></h2>
                    <p>Categoria: <b><?php echo $event->getCategory()?></b> </p>
                    <br>
                    <p>Cantidad de entradas vendidas:<b><?php echo $totalsSoldQuantity[$event->getId()] ?></b></p>
                </div>
                <?php
            }
        }
        else
        { ?>
            <p>SIN EVENTOS</p>
    <?php
} ?>
    </div>
    <div style="text-align: center">
        <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
        <br>
    </div>
    <br>

  </section>
</body>
</html>
