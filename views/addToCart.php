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
        <h3>SELECCIONAR ENTRADA</h3>

        <div class="container">
            <h2>Evento: <?php echo $event['0']->getDescription()?> </h2>
            <p>Categoria: <b><?php echo $event['0']->getCategory()?></b> </p>
            <p>Fecha: <b><?php echo $calendar['0']->getDate() ?></b></p>
            <p>Hora: <b><?php echo $calendar['0']->getTime()?></b></p>
            <p>Lugar: <b><?php echo $calendar['0']->getLocation()?></b></p>
            <p><b>Artistas: </b></p>
                <span style="font-size:18px">
                    <?php
                    foreach ($calendar['0']->getArtists() as $_key => $_value)
                    {
                         echo $_value->getIdArtist() ?> <br>

                <?php }
                ?></span>
                <div class="element event-elem">
                    <form class="form-cart" action="<?php echo BASE ?>cart/addToCart" method="POST" >
                        <input class="input" type="hidden" name="id_calendar" value="<?php $calendar['0']->getId() ?>" >
                        <input class="input" type="hidden" name="seatType" value="<?php $eventSeat['0']->getSeatType()?>" >
                        <input class="input" type="hidden" name="price" value="<?php $eventSeat['0']->getPrice()?>" >
                        <p><?php echo $eventSeat['0']->getSeatType()?>
                            <label class="label" >Cantidad: </label>
                            <input id="input-cant" class="input-xs" type="number" name="cant" required>
                            <?php echo '$' . $eventSeat['0']->getPrice() . '  -  ' ?>
                            <span id="totalprice">Total: $0</span>
                            <button class="form-secondary-button" type="button" onClick="getTotal()">Calcular total</button>
                        </p>
                        <div style="text-align: center">
                            <button class="secondary-button" type="submit" >Agregar al carrito</button>
                            <a class="secondary-button" href="<?= BASE ?>event/showEventDetailsForUser/<?php echo $event['0']->getId()?>">Volver</a>
                        </div>

                    </form>
                </div>
        </div>

    </section>

    <script>
        function getTotal() {
            console.log("script");
            let price = <?php echo $eventSeat['0']->getPrice()?>;
            let cant = document.getElementById("input-cant").value;
            let total = document.getElementById("totalprice");
            total.innerHTML = "Total: $" + price * cant;
        }
    </script>
</body>
</html>
