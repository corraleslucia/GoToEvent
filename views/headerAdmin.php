<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css">
</head>
<body>
    <header class="general">
        <div class="column1">
            <h2>GoToEvent</h2>
            <img src="" alt="">
        </div>
        <div class="column2 admin">
            <img src="<?= BASE ?>media/admin.png" alt="">
        </div>
        <div class="column3 admin">
            <h3>Administrador:  <?php echo $_SESSION['userLogged']->getLastName() .",". $_SESSION['userLogged']->getName() ?></h3>

            <div class="column3-bot">
                <a href="<?php echo BASE?>user/logOut" >Cerrar sesion</a>
            </div>

        </div>
    </header>
</body>
</html>
