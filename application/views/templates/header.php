<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Padel Zone</title>
  <?php
  foreach ($styles as $style) {
    $href = base_url() . "public/css/" . $style;
    echo <<< EOT
    <link rel="stylesheet" type="text/css" href='$href'>
    EOT;
  }
  ?>
  <link rel="shortcut icon" href="<?= base_url(); ?>public/img/favicon.png" type="image/x-icon">
</head>

<body>
<header>
  <div id="title">
    <h1>
      <a href="<?= base_url(); ?>index.php">
        <img
          id="logo-header"
          src="<?= base_url(); ?>public/img/logo-padelzone.png"
          alt="Padel Zone"
          title="Padel Zone"
       >
      </a>
    </h1>
  </div>

  <nav id="utils-nav" class="header-nav">
    <ul>
      <li>
        <div id="search-bar">
          <!--<input type="text" placeholder="Introduce tu búsqueda...">-->
          <ion-icon name="search"></ion-icon>
        </div>
      </li>
      <li>
        <a href="<?= base_url(); ?>index.php/shopping_cart">
          <ion-icon name="bag-handle-sharp"></ion-icon>
        </a>
      </li>
      <?php
      if (!isset($session['id'])) {
        echo '<li>';
          echo '<a href="' . base_url() . 'index.php/login">';
            echo '<ion-icon name="person-sharp"></ion-icon>';
          echo '</a>';
        echo '</li>';
      } else {
        $logout = base_url() . 'index.php/logout';
        $username = $session['username'];
        echo <<< EOT
        <li id="user-li">
          <div id="user-desplegable">
            <ion-icon name="person-sharp"></ion-icon>
            <ion-icon id="user-row" name="chevron-down-outline"></ion-icon>
          </div>
          <ul id="user-menu">
            <li>$username</li>
            <li><a href="$logout">Cerrar sesión</a></li>
          </ul>
        </li>
        EOT;
      }
      ?>
    </ul>
  </nav>

  <nav id="pages-nav" class="header-nav">
    <ul>
      <li>
        <a href="<?= base_url(); ?>index.php/palas">Palas</a><ion-icon name="chevron-down-outline"></ion-icon>
        <ul>
          <li><a href="<?= base_url(); ?>index.php/palas/diamante">Diamante</a></li>
          <li><a href="<?= base_url(); ?>index.php/palas/redondo">Redondas</a></li>
          <li><a href="<?= base_url(); ?>index.php/palas/lagrima">Lágrima</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= base_url(); ?>index.php/paleteros">Paleteros</a><ion-icon name="chevron-down-outline"></ion-icon>
        <ul>
          <li><a href="<?= base_url(); ?>index.php/paleteros/paleteros">Paleteros</a></li>
          <li><a href="<?= base_url(); ?>index.php/paleteros/mochilas">Mochilas</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= base_url(); ?>index.php/zapatillas">Zapatillas</a><ion-icon name="chevron-down-outline"></ion-icon>
        <ul>
          <li><a href="<?= base_url(); ?>index.php/zapatillas/hombre">Hombre</a></li>
          <li><a href="<?= base_url(); ?>index.php/zapatillas/mujer">Mujer</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= base_url(); ?>index.php/ropa">Ropa</a><ion-icon name="chevron-down-outline"></ion-icon>
        <ul>
          <li><a href="<?= base_url(); ?>index.php/ropa/hombre">Hombre</a></li>
          <li><a href="<?= base_url(); ?>index.php/ropa/mujer">Mujer</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= base_url(); ?>index.php/accesorios">Accesorios</a><ion-icon name="chevron-down-outline"></ion-icon>
        <ul>
          <li><a href="<?= base_url(); ?>index.php/accesorios/bolas">Bolas</a></li>
          <li><a href="<?= base_url(); ?>index.php/accesorios/grips">Grips</a></li>
          <li><a href="<?= base_url(); ?>index.php/accesorios/protectores">Protectores</a></li>
        </ul>
      </li>
    </ul>

    <ion-icon name="menu" id="pages-nav-responsive"></ion-icon>
  </nav>
</header>

<div id="content">
  <main>
    <?php
    if (isset($path)) {
      echo $path;
    }
    ?>