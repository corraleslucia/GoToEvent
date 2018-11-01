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
    <nav class="nav-bar-admin">
        <ul class="nav">
            <li><a href="<?= BASE ?>home/index">Eventos</a>
                <ul>
                    <li><a href="<?= BASE ?>event/list">Ver Eventos</a></li>
                    <li><a href="<?= BASE ?>event/add">Agregar Eventos</a></li>
                    <li><a href="<?= BASE ?>event/selectEvent">Agregar Fecha a Evento</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Artistas</a>
                <ul>
                    <li><a href="<?= BASE ?>artist/list">Ver Artistas</a></li>
                    <li><a href="<?= BASE ?>artist/add">Agregar Artistas</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Tipos de plaza</a>
                <ul>
                    <li><a href="<?= BASE ?>seatType/list">Ver Tipos de plaza</a></li>
                    <li><a href="<?= BASE ?>seatType/add">Agregar Tipos de plaza</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Categorias</a>
                <ul>
                    <li><a href="<?= BASE ?>category/list">Ver Categorias</a></li>
                    <li><a href="<?= BASE ?>category/add">Agregar Categorias</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Lugares</a>
                <ul>
                    <li><a href="<?= BASE ?>location/list">Ver Lugares</a></li>
                    <li><a href="<?= BASE ?>location/add">Agregar Lugares</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Usuarios</a>
                <ul>
                    <li><a href="<?= BASE ?>user/list">Ver Usuarios</a></li>
                    <li><a href="<?= BASE ?>user/add">Agregar Usuarios</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE ?>home/index">Informes</a>
                <ul>
                    <li><a href="">Ver Informes</a></li>
                    <li><a href="">Agregar Informes</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</body>
</html>
