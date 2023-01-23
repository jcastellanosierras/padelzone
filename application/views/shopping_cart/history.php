<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?= $header; ?>

  <section>
    <h2>Historial</h2>
    <article id="products-cart">
      <div id="shopping-cart">
        <?php
        if (isset($error)) {
          echo '<span class="error">' . $error . '</span>';
        }
        ?>
        <hr>

        <?php
        foreach ($history as $product) {
          $quantity = $product[1];
          $product = $product[0];
          $url_imagen = $base_url . 'public/img/' . $product->categoria . '/' . $product->imagen1;
          echo <<< EOT
          <div class="product-cart">
            <img class="img-product-cart" src="$url_imagen" alt="$product->nombre">
            <div class="title-product-cart">$product->nombre</div>

            <div class="actions-product-cart">
          EOT;
          
          $precio = str_replace(',', '.', $product->precio);
          $precio_total = floatval($precio) * $quantity;
          $precio_total = strval($precio_total);
          $precio_total = str_replace('.', ',', $precio_total);
          echo <<< EOT
            </div>

            <div class="quantity-product-cart quantity-product-history">
              <p>
                Cantidad: <strong>$quantity</strong>
              </p>
            </div>

            <div class="price-product-cart">$precio_total €</div>
          </div>
          <hr>
          EOT;
        }
        ?>
      </div>
    </article>
  </section>
</main>

<?= $footer; ?>
