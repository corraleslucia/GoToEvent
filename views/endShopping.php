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
        <h3>COMPRA</h3>

        <div class="container">
        <?php if (count($_SESSION['discardTickets'])===0)
        { ?>
            <h2> Compra finalizada con exito </h2>
    <?php
        }
        else
        { ?>
            <h2> Compra finalizada </h2>
            <div class="element event-elem">
                <div style="text-align: center">
                    <p> Estos tickets no han podido ser adquieridos por falta de disponibilidad. </p>
                    <?php foreach ($_SESSION['discardTickets'] as $key => $disPurchaseLine)
                      { ?>
                          <div class="element event-elem">
                              <div style="text-align: center">
                              <h2>Evento: <?php echo $disPurchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </h2>
                              <p>Fecha: <b><?php echo $disPurchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                              <p>Hora: <b><?php echo $disPurchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                              <p>Lugar: <b><?php echo $disPurchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                              <p><b>Artistas: </b></p>
                              <span style="font-size:18px">
                              <?php
                              foreach  ($disPurchaseLine->getEventSeat()->getIdCalendar()->getArtists() as $_key => $_value)
                              {
                                  echo $_value->getIdArtist() ?> <br>

                              <?php
                              }
                              ?></span>
                              </div>
                              <div class="element event-elem">
                                  <div style="text-align: center">
                                      <div class= "full">
                                      <p><?php echo $disPurchaseLine->getEventSeat()->getSeatType()->getName() . " - Cantidad: " . $disPurchaseLine->getQuantity() . " - $ " . $disPurchaseLine->getPrice() . " - Total: $" . intval($disPurchaseLine->getQuantity()) * intval($disPurchaseLine->getPrice())?>
                                      </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    <?php
                      } ?>
                </div>
            </div>
    <?php
        } ?>
            <div class= "full">
            <a class="secondary-button" href="<?= BASE ?>event/listForUser/byArtist">Ver Mas Eventos</a>
            <a class="secondary-button" href="<?= BASE ?>purchase/listPurchasesByUser">Ver Mis Compras</a>
            </div>
        </div>

    </section>
</body>
</html>
