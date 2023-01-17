</div>

<footer>
  <div id="wrapper-logo-footer">
    <a href="<?= base_url(); ?>">
      <img
        id="logo-footer"
        src="<?= base_url(); ?>public/img/logo-padelzone.png"
        alt="Padel Zone"
     >
    </a>
  </div>

  <div id="nav-footer">
    <nav>
      <ul>
        <li><a href="<?= base_url(); ?>index.php/palas">Palas</a></li>
        <li><a href="<?= base_url(); ?>index.php/ropa">Ropa</a></li>
        <li><a href="<?= base_url(); ?>index.php/zapatillas">Zapatillas</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>
    </nav>
  </div>

  <div id="info">
    <div id="social-networks">
      <h3>Redes sociales</h3>
      <ion-icon name="logo-facebook"></ion-icon>
      <ion-icon name="logo-twitter"></ion-icon>
      <ion-icon name="logo-instagram"></ion-icon>
      <ion-icon name="logo-linkedin"></ion-icon>
    </div>

    <div id="paid-methods">
      <h3>Métodos de pago</h3>
      <img height="20px" src="<?= base_url(); ?>public/img/mastercard.png" alt="mastercard">
      <img height="20px" src="<?= base_url(); ?>public/img/paypal.png" alt="paypal">
      <img height="20px" src="<?= base_url(); ?>public/img/visa.png" alt="visa">
    </div>
  </div>

  <div id="subscribe">
    <h3>Únete a nosotros</h3>
    <p>
      Suscríbete para recibir ofertas especiales para miembros y para
      conocer las últimas novedades
    </p>
    <form action="">
      <input type="email" placeholder="Introduce tu email">
      <br>
      <input
        type="checkbox"
        name="accept-terms-and-conditions"
        id="accept-terms-and-conditions"
     >
      <label for="accept-terms-and-conditions">
        Acepta los términos y condiciones
      </label>
    </form>
  </div>

  <div id="wrapper-policies">
    <nav id="policies">
      <ul>
        <li><a href="#">Política de Cookies</a></li>
        <li><a href="#">Política de Privacidad</a></li>
        <li><a href="#">Preguntas Frecuentes</a></li>
        <li><a href="#">Garantías, devoluciones, cambios y pagos</a></li>
      </ul>
    </nav>
  </div>
</footer>

<?php
// Si scripts está definida es que hay que introducir scripts
if (isset($scripts)) {
  // Entonces recorremos $scripts y los añadimos
  foreach($scripts as $script) {
    $src = base_url() . 'public/js/' . $script;
    echo "<script src='$src'></script>";
  }
}
?>
<script src="<?= base_url(); ?>public/js/userMenu.js"></script>
<script
  type="module"
  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
></script>
<script
  nomodule
  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
></script>
</body>
</html>