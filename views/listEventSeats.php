<?php
namespace views;
include(ROOT.'views/header.php');
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
    <div class="events-content">
        <?php
            foreach ($eventSeats as $key => $value) {

        ?>

        <div class="event">
            <h4><?php echo $value->getSeatType()?></h4>
            <h4><?php echo $value->getTotalQuantity()?></h4>
            <h4><?php echo $value->getPrice()?></h4>
        </div>


    <?php } ?>
    </div>

  </section>
</body>
</html>
