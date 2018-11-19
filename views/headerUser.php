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

        <div class="column2 avatar">
            <img src="<?= IMG_UPLOADS . '/avatar/' . $_SESSION['userLogged']->getAvatar() ?>"  />
        </div>

        <?php
        if(count($_SESSION['cart'])!=0){  ?>
        <div class="column2 column2-cart-add">
            <a href="<?php echo BASE ?>ticket/viewCart"><img src="<?= BASE ?>media/carrito.png" alt=""> </a>
        </div>
        <?php
        }else { ?>
        <div class="column2">
            <a href="<?php echo BASE ?>ticket/viewCart"><img src="<?= BASE ?>media/carrito.png" alt=""> </a>
        </div>
        <?php
        } ?>

        <div class="column3">
            <h3>
                Logueado como: <?php echo $_SESSION['userLogged']->getLastName() .",". $_SESSION['userLogged']->getName() ?>
            </h3>
            <div class="column3-half">
                <a href="" >Mi cuenta</a>
            </div>
            <div class="column3-half">
                <a href="<?php echo BASE?>user/logOut" >Cerrar sesion</a>
            </div>

        </div>
    </header>
</body>
</html>
