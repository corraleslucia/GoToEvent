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
        <h3>CARRITO</h3>

        <?php if ($val)
        {?>
            <p class="alert"> <?php echo $val; ?>  </p>

        <?php }
        ?>
        <br>
        <br>
        <br>
        <div class="container">
        <?php if (count($_SESSION['cart'])===0)
        { ?>
            <h2> Carrito vacio </h2>
            <div class= "full">
            <a class="secondary-button" href="<?= BASE ?>event/listForUser/byArtist">Ver Eventos</a>
            </div>
    <?php
        }
        else
        { ?>
                <?php foreach ($_SESSION['cart'] as $key => $purchaseLine)
                  { ?>
                    <div class="element event-elem">
                        <div style="text-align: center">
                        <h2>Evento: <?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getIdEvent()?> </h2>
                        <p>Fecha: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getDate() ?></b></p>
                        <p>Hora: <b><?php echo $purchaseLine->getEventSeat()->getIdCalendar()->getTime()?></b></p>
                        <p>Lugar: <b><?php echo$purchaseLine->getEventSeat()->getIdCalendar()->getLocation()?></b></p>
                        <p><b>Artistas: </b></p>
                        <span style="font-size:18px">
                        <?php
                        foreach  ($purchaseLine->getEventSeat()->getIdCalendar()->getArtists() as $_key => $_value)
                        {
                            echo $_value->getName() ?> <br>

                        <?php
                        }
                        ?></span>
                        </div>
                        <div class="element event-elem">
                            <div style="text-align: center">
                                <div class= "full">
                                <p><?php echo $purchaseLine->getEventSeat()->getSeatType()->getName() . " - Cantidad: " . $purchaseLine->getQuantity() . " - $ " . $purchaseLine->getPrice() . " - Total: $" . intval($purchaseLine->getPrice()) * intval($purchaseLine->getQuantity()) ?>
                                </p>
                                    <a class="secondary-button" href="<?= BASE ?>purchaseline/deleteFromCart/<?php echo $key?>">Borrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php
                  } ?>

                  <div class= "full">
                  <a class="secondary-button" href="<?= BASE ?>purchase/buyTickets">COMPRAR</a>
                  </div>
    <?php
        } ?>
        </div>

        <div style="text-align: center">
            <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
            <br>
        </div>
        <br>
    </section>
</body>
</html>
