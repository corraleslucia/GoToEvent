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
  <title>COMPRAS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
    <section class="content">
        <h3>MIS TICKETS</h3>

        <div class="container">
        <?php if (!$purchases)
        { ?>
            <h2> AUN NO HAS COMPRADO TICKETS </h2>
    <?php
        }
        else
        { ?>
                <?php foreach ($purchases as $key => $purchase)
                  { ?>
                      <div class="element event-elem">
                          <h2>COMPRA # <b><?php echo $purchase->getId()?></b> </h2>
                          <h2>FECHA: <b> <?php echo $purchase->getDate()?></b> </h2>
                          <div class="element event-elem">
                          <h2><b>DETALLES </b></h2>
                          <?php foreach ($purchase->getPurchaseLines() as $key => $purchaseLine)
                          { ?>
                                  <div class="half mini-box">

                                  <p>Evento: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </b></p>
                                  <br>
                                  <p>Fecha: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                                  <br>
                                  <p>Hora: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                                  <br>
                                  <p>Lugar: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                                  <br>
                                  <p>Tipo de Plaza: <b><?php echo $purchaseLine->getEventSeat()->getSeatType()?></b></p>
                                  <br>
                                  <p>Cantidad: <b><?php echo $purchaseLine->getQuantity()?></b></p>
                                  <br>
                                  <p>Precio: $ <b><?php echo $purchaseLine->getPrice()?></b></p>
                                  <br>
                                  <p>Subtotal: $ <b><?php echo intval($purchaseLine->getPrice()) * intval($purchaseLine->getQuantity())?></b></p>
                                  <div class= "full">
                                      <a class="secondary-button" href="<?= BASE ?>ticket/showTicketsByPurchaseLine/<?php echo $purchaseLine->getId()?>">Ver Tickets</a>
                                  </div>
                                  </div>

                        <?php
                          } ?>
                          </div>
                          <h2>TOTAL: $ <b> <?php echo $purchase->getTotal()?></b> </h2>
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
