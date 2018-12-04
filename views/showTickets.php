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
            <div class="element event-elem ev-elem-clr">
            <?php foreach ($tickets as $key => $ticket)
              { ?>
                      <div class="half mini-box" style="padding: 0">
                          <p class="mini-box-title">TICKET # <b><?php echo $ticket->getNumber()?></b> </p>
                          <p class="mini-box-price">Evento: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </b></p>
                          <br>
                          <p class="mini-box-price">Fecha: <b><?php echo$purchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                          <br>
                          <p class="mini-box-price">Hora: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                          <br>
                          <p class="mini-box-price">Lugar: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                          <br>
                          <p class="mini-box-price">Tipo de Plaza: <b><?php echo $purchaseLine->getEventSeat()->getSeatType()?></b></p>
                          <br>
                          <p class="mini-box-title"> QR </p>
                          <div class="qr-elem">
                              <img src="<?= IMG_UPLOADS . '/qr/qr' . $ticket->getQr() ?>" />
                          </div>


                      </div>
          <?php
               } ?>
           </div>
        </div>

        <div class= "full">
            <a class="secondary-button" href="<?= BASE ?>purchase/listPurchasesByUser">Volver</a>
        </div>
        <br>
    </section>
</body>
</html>
