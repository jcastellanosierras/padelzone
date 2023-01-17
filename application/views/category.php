<?= $header; ?>

  <section>
    <article id="offers-section" class="article-section">
      <h2><?= $h2; ?></h2>
      <p>
        Estas son nuestros productos disponibles para la sección de: <strong><?= $h2; ?></strong>. Esperamos que sean de su agrado.
      </p>
      <div class="products">
        <?php
        if (empty($products)) {
          echo '<h3>Actualmente no disponemos de ' . $h2 . '. Por favor, inténtelo de nuevo más adelante. Perdone las molestias.';
        } else {
          foreach ($products as $product) {
            if (isset($category)) {
              $url_imagen = $base_url . 'public/img/' . $category . '/' . $product->imagen1;
            } else {
              $url_imagen = $base_url . 'public/img/' . $product->categoria . '/' . $product->imagen1;
            }
            
            $url_producto = $site_url . '/' . $product->id_nombre;
            echo <<< EOT
            <a class="link-product" href='$url_producto'>
              <div class="product">
                <img
                  class="product-img"
                  src='$url_imagen'
                  alt="product"
                >
                <p class="product-name">$product->nombre</p>
                <p class="product-price">$product->precio €</p>
              </div>
            </a>
            EOT;
          }
        }
        ?>
      </div>
    </article>
  </section>
</main>

<?= $footer; ?>