<?= $header; ?>

<div id="container">
  <h1>Tramitar pedido</h1>
  
  <h2>Paso final - Direccion de envio</h2>
    
  <?php echo form_open('process/process'); ?>
  
  <h5>Direccion</h5>
  <?php echo form_error('direccion', '<div class="error" style="color:red;">', '</div>'); ?>
  <?php
  $direccion = set_value('direccion');
  if (isset($user_data)) {
    $direccion = $user_data->direccion;
  }
  
  echo '<input type="text" name="direccion" value="' . $direccion . '" size="50" />';
  ?>
  
  <h5>Codigo Postal</h5>
  <?php echo form_error('codigopostal', '<div class="error" style="color:red;">', '</div>'); ?>
  <?php
  $postal = set_value('codigopostal');
  if (isset($user_data)) {
    $postal = $user_data->codigo_postal;
  }

  echo '<input type="text" name="codigopostal" value="' . $postal . '" size="50" />';
  ?>
  
  <h5>Ciudad</h5>
  <?php echo form_error('ciudad', '<div class="error" style="color:red;">', '</div>'); ?>
  <?php
  $ciudad = set_value('ciudad');
  if (isset($user_data)) {
    $ciudad = $user_data->ciudad;
  }

  echo '<input type="text" name="ciudad" value="' . $ciudad . '" size="50" />';
  ?>
  
  <h5>Telefono</h5>
  <?php echo form_error('telefono', '<div class="error" style="color:red;">', '</div>'); ?>
  <?php
  $telefono = set_value('telefono');
  if (isset($user_data)) {
    $telefono = $user_data->telefono;
  }
  
  echo '<input type="text" name="telefono" value="' . $telefono . '" size="50" />';
  ?>
  
  <?php
  if (isset($products)) {
    $n_products = '0';
    foreach($products as $product) {
      $n_products++;
  
      $product_data = array(
        'name' => 'product-' . $n_products,
        'type' => 'hidden',
        'value' => $product['id']
      );
  
      echo form_input($product_data);
  
      $name_data = array(
        'name' => 'name-product-' . $n_products,
        'type' => 'hidden',
        'value' => $product['nombre']
      );
  
      echo form_input($name_data);
  
      $price_data = array(
        'name' => 'price-product-' . $n_products,
        'type' => 'hidden',
        'value' => $product['precio']
      );
  
      echo form_input($price_data);
  
      $quantity_data = array(
        'name' => 'quantity-product-' . $n_products,
        'type' => 'hidden',
        'value' => $product['cantidad']
      );
  
      echo form_input($quantity_data);
    }
  
    $n_products_data = array(
      'name' => 'n-products',
      'type' => 'hidden',
      'value' => $n_products
    );
  
    echo form_input($n_products_data);
  }
  ?>
  
  <div><input type="submit" value="Submit" /></div>
  
  </form>
</div>

<?= $footer; ?>