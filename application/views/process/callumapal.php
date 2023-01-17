<html>
<head>
<title>Conectandose a UMAPal</title>
</head>
<body onload="document.umapal.submit()">
<!-- <body onload="document.forms['member_signup'].submit()"> -->

<h3>Conectandose a UMAPal, espere unos instantes...</h3>

<!-- Ver https://developer.paypal.com/api/nvp-soap/paypal-payments-standard/integration-guide/formbasics/ -->
<form name="umapal" action="<?php echo base_url(); ?>umapal/procesar.php" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="josecastellano@padelzone.es">

  <!-- Hacer por cada producto -->
  <?php
  $n_product = '0';
  foreach($products as $product) {
    $n_product++;
    echo '<input type="hidden" name="item_name_' . $n_product .'" value="' . $product['nombre'] . '">';
    echo '<input type="hidden" name="item_number_' . $n_product .'" value="' . $product['id'] . '">';
    echo '<input type="hidden" name="amount_' . $n_product .'" value="' . $product['precio'] . '">';
    echo '<input type="hidden" name="quantity_' . $n_product .'" value="' . $product['cantidad'] . '">';
  }
  ?>
  <input type="hidden" name="currency_code" value="EUR">

  <!-- Indicamos que la direccion viene dada por la web -->
  <input type="hidden" name="address_override" value="1">
  <input type="hidden" name="first_name" value="<?= $user->nombre; ?>">
  <input type="hidden" name="last_name" value="<?= $user->apellidos; ?>">
  <input type="hidden" name="address1" value="<?php echo set_value('direccion'); ?>">
  <input type="hidden" name="city" value="<?php echo set_value('ciudad'); ?>">
  <input type="hidden" name="zip" value="<?php echo set_value('codigopostal'); ?>">
  <input type="hidden" name="country" value="ES">
  <input type="hidden" name="return" value="<?php echo base_url(); ?>index.php/process/successBuy">
  <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>index.php/process/cancelledBuy">
  <!-- Este valor no existe en paypal, pero nos ayudara a la hora de simular peticiones unicas -->
  <input type="hidden" name="cartID" value="<?php echo $PeticionActual; ?>">
  <input type="submit" value="Enviar a UMAPal" />
</form>

</body>
</html>