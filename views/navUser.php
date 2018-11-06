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
            <li><a href="<?= BASE ?>home/index">Ver Eventos</a>
                <ul>
                    <li><a href="<?= BASE ?>event/_list">Ver ordenados por Fecha</a></li>
                    <li><a href="<?= BASE ?>event/_list">Ver ordenados por Artista</a></li>
                    <li><a href="<?= BASE ?>event/_list">Ver ordenados por Categoria</a></li>
                    <li><a href="<?= BASE ?>event/_list">Ver ordenados por Ubicación</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Buscar eventos</a>
                <ul>
                    <!-- <li><a href="<?= BASE ?>artist/_list">buscar x</a></li>
                    <li><a href="<?= BASE ?>artist/add">buscar x</a></li> -->
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Ver Artistas</a>
                <ul>
                    <!-- <li><a href="<?= BASE ?>seatType/_list">Ver tal cosa</a></li>
                    <li><a href="<?= BASE ?>seatType/add">Ver tal otra</a></li> -->
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Mis Tickets</a>
                <ul>
                    <!-- <li><a href="<?= BASE ?>category/_list">tickets</a></li>
                    <li><a href="<?= BASE ?>category/add">mas tickets</a></li> -->
                </ul>
            </li>
            
        </ul>
    </nav>
</body>
</html>
