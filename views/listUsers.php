<?php
namespace views;
include(ROOT.'views/headerAdmin.php');
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
    <div class="container">
        <?php
            foreach ($users as $key => $value) {

        ?>

        <div class="element">
            <p class="list-users" style="font-size: 20px"><b> EMAIL: </b><?php echo$value->getMail()?></p>
            <p class="list-users" style="font-size: 20px"><b> NOMBRE: </b><?php echo $value->getName()?></p>
            <p class="list-users" style="font-size: 20px"><b> APELLIDO: </b><?php echo $value->getLastName()?></p>
        </div>


    <?php } ?>
    </div>
    <div style="text-align: center">
        <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
        <br>
    </div>
    <br>

  </section>
</body>
</html>
