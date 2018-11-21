<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GoToEvent</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />
    <script src="main.js"></script>
</head>
<body>
    <nav class="nav-bar-user">
        <ul class="nav">
            <li><a href="<?= BASE ?>event/listForUser/byArtist">Ver Eventos</a>
                <ul>
                    <li><a href="<?= BASE ?>event/listForUser/byDate">Por Fecha</a></li>
                    <li><a href="<?= BASE ?>event/listForUser/byArtist">Por Artista</a></li>
                    <li><a href="<?= BASE ?>event/listForUser/byCategory">Por Categoria</a></li>
                    <li><a href="<?= BASE ?>event/listForUser/byLocation">Por Ubicación</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/inProgress">Buscar eventos</a>
                <ul>
                    <!-- <li><a href="<?= BASE ?>artist/_list">buscar x</a></li>
                    <li><a href="<?= BASE ?>artist/add">buscar x</a></li> -->
                </ul>
            </li>
            <li><a href="<?= BASE ?>artist/_list">Ver Artistas</a>
            </li>
            <li><a href="<?= BASE ?>purchase/listPurchasesByUser">Mis Compras</a>
            </li>

        </ul>
    </nav>
</body>
</html>
