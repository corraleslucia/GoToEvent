<?php
namespace views;
include(ROOT.'views/headerUser.php');
include(ROOT.'views/navUser.php');

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TICKETS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
    <section class="content">
        <h3>TICKETS</h3>

        <div class="container">
            <?php foreach ($tickets as $key => $ticket)
              { ?>
                  <div class="element qr-elem">
                      <h2>TICKET # <b><?php echo $ticket->getNumber()?></b> </h2>
                      <p>Evento: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </b></p>
                      <br>
                      <p>Fecha: <b><?php echo$purchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                      <br>
                      <p>Hora: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                      <br>
                      <p>Lugar: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                      <br>
                      <p>Tipo de Plaza: <b><?php echo $purchaseLine->getEventSeat()->getSeatType()?></b></p>
                      <br>
                      <h2><b>QR</b></h2>
                      <div class="half mini-box">
                          <img src="<?= IMG_UPLOADS . '/qr/qr' . $ticket->getQr() ?>" />
                      </div>
                  </div>
          <?php
               } ?>
        </div>

        <div class= "full">
            <a class="secondary-button" href="<?= BASE ?>purchase/listPurchasesByUser">Volver</a>
        </div>
        <br>
    </section>
</body>
</html>
