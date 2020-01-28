<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ejemplo MVC</title>
  <!-- Bootstrap 4.4.1 --->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Font Awesome --->
  <script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>
  <!--  JQuery --->
  <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="container-fluid bg-light">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">LOGO</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- $_GET[variable]: variables que se pasan como parámetros vía URL (También conocido como cadena de consulta a través de la URL)
            Cuando es la primera variable se separa con un ?
            las que siguen a continuanción se separan con un &
          -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <?php if (isset($_GET['url'])): ?>
                <?php if($_GET['url'] == 'register'): ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="register">Registro <span class="sr-only">(current)</span></a>
                  </li>
                <?php else: ?>
                  <li class="nav-item">
                    <a class="nav-link" href="register">Registro <span class="sr-only">(current)</span></a>
                  </li>
                <?php endif ?>
                <?php if($_GET['url'] == 'login'): ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="login">Ingreso</a>
                  </li>
                <?php else: ?>
                  <li class="nav-item">
                  <a class="nav-link" href="login">Ingreso</a>
                </li>
                <?php endif ?>
                <?php if($_GET['url'] == 'home'): ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="home">Inicio</a>
                  </li>
                <?php else: ?>
                  <li class="nav-item">
                    <a class="nav-link" href="home">Inicio</a>
                  </li>
                <?php endif ?>
                <?php if($_GET['url'] == 'exit'): ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="exit">Salir</a>
                  </li>
                <?php else: ?>
                  <li class="nav-item">
                    <a class="nav-link" href="exit">Salir</a>
                  </li>
                <?php endif ?>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="register">Registro <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login">Ingreso</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="home">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="exit">Salir</a>
                </li>
              <?php endif ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div><!-- End .container-fluid -->
  .<div class="container-fluid">
    <div class="container">
      <?php
        #ISSET: isset() Determina si una variable está definida y no es NULL
        if (isset($_GET['url'])) {
          if ($_GET['url'] == 'register' ||
              $_GET['url'] == 'login' ||
              $_GET['url'] == 'home' ||
              $_GET['url'] == 'edit' ||
              $_GET['url'] == 'exit') {
            include 'pages/' . $_GET['url'] . '.php';
          } else {
            include 'pages/error/404.php';
          }
        } else {
          include 'pages/login.php';
        }
      ?>
    </div>
  </div>
  <script src="views/js/index.js"></script>
</body>
</html>