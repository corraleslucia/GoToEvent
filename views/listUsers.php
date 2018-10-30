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
  <title>Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    <h3>USUARIOS</h3>
    <div class="events-content">
        <?php
            foreach ($users as $key => $value) {

        ?>

        <div class="event">
            <h4> EMAIL: <?php echo$value->getMail()?></h4>
            <h4> NOMBRE: <?php echo $value->getName()?></h4>
            <h4> APELLIDO: <?php echo $value->getLastName()?></h4>
        </div>


    <?php } ?>
    </div>

  </section>
</body>
</html>
