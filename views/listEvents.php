<?php
namespace views;
include(ROOT.'views/header.php');
include(ROOT.'views/navAdmin.php');
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eventos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    <h3>PROXIMOS EVENTOS</h3>
    <div class="events-content">
        <?php
        /* aca va un forEach con los divs "event" que sean necesarios*/
        ?>

        <div class="event">
            <h4>Ricky Martin vuelve con todo</h4>
            <div class="p-listev-art"><p>Artista: Ricky Martin</p></div>
            <div class="p-listev-plc"><p>Lugar: Polideportivo Mar del Plata</p></div>
            <div class="p-listev-date"><p>10/12/2018</p></div>
        </div>
        <div class="event">
            <h4>Lollapalooza</h4>
            <div class="p-listev-art"><p>Artista: Lali Esposito, Daddy Yankee, The Beatles, Bob Marley, No te va gustar</p></div>
            <div class="p-listev-plc"><p>Lugar: Tecnopolis</p></div>
            <div class="p-listev-date"><p>17/05/2019</p></div>
        </div>
        <div class="event">
            <h4>Arjona en Gran Rex</h4>
            <div class="p-listev-art"><p>Artista: Ricardo Arjona</p></div>
            <div class="p-listev-plc"><p>Lugar: Teatro Gran Rex</p></div>
            <div class="p-listev-date"><p>1/11/2018</p></div>
        </div>
    </div>

  </section>
</body>
</html>
