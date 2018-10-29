<?php
namespace views;

include('header.php');
include('navAdmin.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Categoria</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>

</head>
<body>
  <section class="content">
    <h2 class="form-title">Alta de categoria:</h2>
    <form action="Category/store" method="POST" class="form-admin">
      <div class="form-group">
        <label>Descripcion: </label>
        <input type="text" name="cat-name" required>
      </div>

      <button type="submit" class ="category-button">Agregar categoria</button>
    </form>

  </section>
</body>
</html>
