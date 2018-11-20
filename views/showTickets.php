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
                  <div class="element event-elem">
                      <h2>TICKET # <b><?php echo $ticket->getNumber()?></b> </h2>
                      <p>Evento: <b><?php echo $ticket->getIdPurchaseLine()->getEventSeat()->getIdCalendar()->getIdEvent()?> </b></p>
                      <br>
                      <p>Fecha: <b><?php echo $ticket->getIdPurchaseLine()->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                      <br>
                      <p>Hora: <b><?php echo $ticket->getIdPurchaseLine()->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                      <br>
                      <p>Lugar: <b><?php echo $ticket->getIdPurchaseLine()->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                      <br>
                      <p>Tipo de Plaza: <b><?php echo $ticket->getIdPurchaseLine()->getEventSeat()->getSeatType()?></b></p>
                      <br>
                      <h2><b>QR</b></h2>
                      <div class="half mini-box">
                          <p>aca va el QR</p>
                      </div>
                  </div>
          <?php
               } ?>
        </div>

        <div class= "full">
            <a class="secondary-button" href="<?= BASE ?>purchase/listPurchasesByUser">Volver</a>
        </div>
    </section>
</body>
</html>
