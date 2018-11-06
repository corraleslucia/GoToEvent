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
  <title>Plazas Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    <h3>PLAZAS EVENTO</h3>

    <div class="container">
        <br>
        <label>Evento: <?php echo $_calendar['0']->getIdEvent()?> </label>
        <br>
        <label>Fecha: <?php echo $_calendar['0']->getDate() . " - " . $_calendar['0']->getTime()?> </label>
        <br>
        <label>Lugar: <?php echo $_calendar['0']->getLocation()?> </label>
        <br>

        <?php
            foreach ($eventSeats as $key => $value) {

        ?>

        <div class="element">
            <h4><?php echo "Tipo de plaza: "  . $value->getSeatType() ?></h4>
            <h4><?php echo "Cantidad total: " . $value->getTotalQuantity()?></h4>
            <h4><?php echo "Precio: $ " . $value->getPrice()?></h4>
        </div>
    <?php } ?>
    </div>

  </section>
</body>
</html>
