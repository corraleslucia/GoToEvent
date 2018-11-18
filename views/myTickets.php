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
  <title>Carrito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
    <section class="content">
        <h3>MIS TICKETS</h3>

        <div class="container">
        <?php if (!$tickets)
        { ?>
            <h2> AUN NO HAS COMPRADO TICKETS </h2>
    <?php
        }
        else
        { ?>
                <?php foreach ($purchases as $key => $purchase)
                  { ?>
                      <div class="element event-elem">
                          <h2>Fecha de compra: <?php echo $purchase->getDate()?> </h2>
                          <p><b>DETALLE </b></p>
                          <?php foreach ($purchase->getPurchaseLines() as $key => $purchaseLine)
                          { ?>
                              <div class="element event-elem">
                                  <p>Evento: <?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </p>
                                  <p>Fecha: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                                  <p>Hora: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                                  <p>Lugar: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                                  <p>Tipo de Plaza: <b><?php echo $purchaseLine->getEventSeat()->getSeatType()?></b></p>
                                  <p>Cantidad: <b><?php echo $purchaseLine->getQuantity()?></b></p>
                                  <p>Precio: $ <b><?php echo $purchaseLine->getPrice()?></b></p>
                                  <p>Total: $ <b><?php echo intval($purchaseLine->getPrice()) * intval($purchaseLine->getQuantity())?></b></p>
                              </div>
                        <?php
                          } ?>
                    </div>
              <?php
                  }
        } ?>
        <div class= "full">
        <a class="secondary-button" href="<?= BASE ?>event/listForUser/byArtist">Ver Mas Eventos</a>
        </div>
        </div>

    </section>
</body>
</html>
