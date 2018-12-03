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
    <h3>INFORMES - Facturacion por Evento</h3>

    <div class="container">
        <?php if ($events)
        {
            foreach ($events as $key => $event)
            { ?>
                <div class="element event-elem align-center">
                    <h2>Evento: <b><?php echo $event->getDescription()?></b></h2>
                    <p style="padding: 1%">Categoria: <b><?php echo $event->getCategory()?></b> </p>
                    <br>
                    <p style="padding: 1%">Facturacion:<b><?php echo " $ " . $totalsSoldMoney[$event->getId()] ?></b></p>
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


  </section>
</body>
</html>
