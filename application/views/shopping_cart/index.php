<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?= $header; ?>

  <section>
    <h2>Carrito</h2>
    <article id="products-cart">
      <div id="shopping-cart">
        <?php
        if (isset($error)) {
          echo '<span class="error">' . $error . '</span>';
        }
        ?>
        <hr>

        <?php
        foreach ($cart_products as $product) {
          $quantity = $product[1];
          $product = $product[0];
          $url_imagen = $base_url . 'public/img/' . $product->categoria . '/' . $product->imagen1;
          echo <<< EOT
          <div class="product-cart">
            <img class="img-product-cart" src="$url_imagen" alt="$product->nombre">
            <div class="title-product-cart">$product->nombre</div>

            <div class="actions-product-cart">
          EOT;
              
              echo form_open('shopping_cart/update_quantity');
                $quantity_data = array(
                  'name' => strval($product->id),
                  'class' => 'quantity-product-cart',
                  'type' => 'number',
                  'value' => $quantity
                );

                echo form_input($quantity_data);

                $update_data = array(
                  'name' => 'update',
                  'class' => 'button-add-car update-product-cart',
                  'value' => 'Actualizar cantidad'
                );

                echo form_submit($update_data);
              echo form_close();

              echo form_open('shopping_cart/remove');

                $data = array(
                  'name' => strval($product->id),
                  'class' => 'button-add-car remove-product-cart',
                  'value' => 'Eliminar'
                );

                echo form_submit($data);
              echo form_close();
          
          $precio = str_replace(',', '.', $product->precio);
          $precio_total = floatval($precio) * $quantity;
          $precio_total = strval($precio_total);
          $precio_total = str_replace('.', ',', $precio_total);
          echo <<< EOT
            </div>

            <div class="price-product-cart">$precio_total €</div>
          </div>
          <hr>
          EOT;
        }
        ?>
      </div>
    </article>

    <article id="process">
      <div class="total-price">
        <?php
        $total = 0.0;
        foreach($cart_products as $product) {
          $quantity = $product[1];
          $product = $product[0];
          // Cambiamos la coma por un punto para poder hacer la operación
          $precio = str_replace(',', '.', $product->precio);
          $total += floatval($precio) * $quantity;
        }
        // Ahora cambiamos el punto por coma para representarlo
        $total = strval($total);
        $total = str_replace('.', ',', $total);
        echo "Total: <strong>$total €</strong>";
        ?>
      </div>

      <?php echo form_open('process/process');
        $n_products = '0';
        foreach($cart_products as $product) {
          $n_products++;
          $quantity = $product[1];
          $product = $product[0];
  
          $product_data = array(
            'name' => 'product-' . $n_products,
            'type' => 'hidden',
            'value' => $product->id
          );
  
          echo form_input($product_data);

          $name_data = array(
            'name' => 'name-product-' . $n_products,
            'type' => 'hidden',
            'value' => $product->nombre
          );
  
          echo form_input($name_data);
  
          $price_data = array(
            'name' => 'price-product-' . $n_products,
            'type' => 'hidden',
            'value' => $product->precio
          );
  
          echo form_input($price_data);
  
          $quantity_data = array(
            'name' => 'quantity-product-' . $n_products,
            'type' => 'hidden',
            'value' => $quantity
          );
  
          echo form_input($quantity_data);
        }
  
        $n_products_data = array(
          'name' => 'n-products',
          'type' => 'hidden',
          'value' => $n_products
        );
  
        echo form_input($n_products_data);

        echo '<div id="buttons-section">';
        $data = array(
          'type' => 'submit',
          'class' => 'button-add-car button-process',
          'value' => 'Tramitar pedido'
        );
      
        echo form_input($data);
      echo form_close();?>

      <?php echo form_open('shopping_cart/clear');
        $data = array(
          'type' => 'submit',
          'class' => 'button-add-car button-process',
          'value' => 'Vaciar carrito'
        );
      
        echo form_input($data);

        echo '</div>';
      echo form_close(); ?>
    </article>
  </section>
</main>

<aside>
    <div class="total-price">
      <?php
      $total = 0.0;
      foreach($cart_products as $product) {
        $quantity = $product[1];
        $product = $product[0];
        // Cambiamos la coma por un punto para poder hacer la operación
        $precio = str_replace(',', '.', $product->precio);
        $total += floatval($precio) * $quantity;
      }
      // Ahora cambiamos el punto por coma para representarlo
      $total = strval($total);
      $total = str_replace('.', ',', $total);
      echo "Total: <strong>$total €</strong>";
      ?>
    </div>
    <?php echo form_open('process/process');
      $n_products = '0';
      foreach($cart_products as $product) {
        $n_products++;
        $quantity = $product[1];
        $product = $product[0];

        $product_data = array(
          'name' => 'product-' . $n_products,
          'type' => 'hidden',
          'value' => $product->id
        );

        echo form_input($product_data);

        $name_data = array(
          'name' => 'name-product-' . $n_products,
          'type' => 'hidden',
          'value' => $product->nombre
        );

        echo form_input($name_data);

        $price_data = array(
          'name' => 'price-product-' . $n_products,
          'type' => 'hidden',
          'value' => $product->precio
        );

        echo form_input($price_data);

        $quantity_data = array(
          'name' => 'quantity-product-' . $n_products,
          'type' => 'hidden',
          'value' => $quantity
        );

        echo form_input($quantity_data);
      }

      $n_products_data = array(
        'name' => 'n-products',
        'type' => 'hidden',
        'value' => $n_products
      );

      echo form_input($n_products_data);

      echo '<div id="buttons-aside">';
        $data = array(
          'type' => 'submit',
          'class' => 'button-add-car button-process',
          'value' => 'Tramitar pedido'
        );
      
      echo form_input($data);
    echo form_close();?>

    <?php echo form_open('shopping_cart/clear');
      $data = array(
        'type' => 'submit',
        'class' => 'button-add-car button-process',
        'value' => 'Vaciar carrito'
      );
    
      echo form_input($data);

      echo '</div>';
    echo form_close(); ?>

    <?php
    if (isset($history)) {
      echo <<< EOT
      <h3>Últimos pedidos</h3>
      <div id="history-products">
      EOT;

      foreach($history as $product) {
        $cantidad = $product[1];
        $product = $product[0];

        // Cambiamos la coma por un punto para poder hacer la operación
        $precio = str_replace(',', '.', $product->precio);
        $total = (floatval($precio) * floatval($cantidad));
        // Ahora cambiamos el punto por coma para representarlo
        $total = strval($total);
        $total = str_replace('.', ',', $total);

        $url = base_url() . '/public/img/' . $product->categoria . '/' . $product->imagen1;
        echo <<< EOT
        <div class="history-product">
          <img src="$url" alt="$product->nombre">
          <h4>$product->nombre</h4>
          <div>Cantidad: <strong>$cantidad</strong></div>
          <div><strong>$total €</strong></div>
        </div>
        EOT;
      }
      echo '</div>';
    }
    ?>

    <a href="<?= base_url(); ?>index.php/history" id="history-link" class="btn-see-all">Ver historial</a>
</aside>

<?= $footer; ?>
