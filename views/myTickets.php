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
                <?php foreach ($tickets as $key => $ticket)
                  { ?>
                      <div class="element event-elem">
                          <div style="text-align: center">
                          <h2>Evento: <?php echo $ticket->getCalendar()->getIdEvent()?> </h2>
                          <p>Fecha: <b><?php echo $ticket->getCalendar()->getDate() ?></b></p>
                          <p>Hora: <b><?php echo $ticket->getCalendar()->getTime()?></b></p>
                          <p>Lugar: <b><?php echo $ticket->getCalendar()->getLocation()?></b></p>
                          <p><b>Artistas: </b></p>
                          <span style="font-size:18px">
                          <?php
                          foreach  ($ticket->getCalendar()->getArtists() as $_key => $_value)
                          {
                              echo $_value->getIdArtist() ?> <br>

                          <?php
                          }
                          ?></span>
                          </div>
                          <div class="element event-elem">
                              <div style="text-align: center">
                                  <div class= "full">
                                  <p><?php echo $ticket->getSeatType()->getName() . " - Cantidad: " . $ticket->getQuantity() . " - $ " . $ticket->getPrice() . " - Total: $" . $ticket->getTotal() ?>
                                  </p>
                                  </div>
                              </div>
                          </div>
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
