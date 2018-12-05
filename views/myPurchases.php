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
                      <div class="">
                          <div class="subtitle">
                            <h2 class="margin-0" style="float: left">COMPRA # <b><?php echo $purchase->getId()?></b> </h2>
                            <h2 class="margin-0" style="float: right"><b> <?php echo $purchase->getDate()?></b> </h2>
                          </div>
                          <div class="">
                          <h4 class="subtitle-half margin-0" ><b>DETALLES </b></h4>
                          <h4></h4>
                          <?php foreach ($purchase->getPurchaseLines() as $key => $purchaseLine)
                          { ?>
                                  <div class="half purchase">

                                    <p class="mini-box-title margin-0" style="border-bottom: 2px solid black"><b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </b></p>
                                    <p><b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                                    <p><b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                                    <p><b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                                    <p>Tipo: <b><?php echo $purchaseLine->getEventSeat()->getSeatType()?></b></p>
                                    <p>Cantidad: <b><?php echo $purchaseLine->getQuantity()?></b></p>
                                    <p>Precio: $ <b><?php echo $purchaseLine->getPrice()?></b></p>
                                    <p>Subtotal: $ <b><?php echo intval($purchaseLine->getPrice()) * intval($purchaseLine->getQuantity())?></b></p>
                                    <div class= "full">
                                        <a class="secondary-button margin-0" href="<?= BASE ?>ticket/showTicketsByPurchaseLine/<?php echo $purchaseLine->getId()?>">Ver Tickets</a>
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
