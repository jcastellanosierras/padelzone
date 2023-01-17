<?= $header; ?>

  <section class="product-page">
    <article class="container-product">
      <div class="main-info">
        <div id="main-info-img">
          <img id="main-product-img" src='<?= $base_url ?>public/img/<?= get_categoria($product) ?>/<?= $product->imagen1 ?>'
            alt='<?= $product->nombre; ?>'>
        </div>

        <div class="main-info-buy">
          <h2 class="product-name"><?= $product->nombre ?></h2>
          <div class="product-price-and-button">
            <p class="product-price"><?= $product->precio ?> €</p>
            <?php
            if (isset($error)) {
              echo '<span class="error">' . $error . '</span><br>';
            }
            ?>
            <?= form_open('add_to_cart'); ?>
              <?php
              $data_id_nombre = array(
                'name' => 'product-nombre-id',
                'type' => 'hidden',
                'value' => $product->id_nombre
              );

              echo form_input($data_id_nombre);

              $data_id = array(
                'name' => 'product-id',
                'type' => 'hidden',
                'value' => $product->id
              );

              echo form_input($data_id);
              ?>

              <?= form_error('product-number', '<span class="error">', '</span>'); ?>
              <?php
              $data = array(
                'type' => 'number',
                'name' => 'product-number',
                'value' => 1
              );
              echo form_input($data);

              if (isset($_SERVER['HTTP_REFERER'])) {
                if (!isset($referer)) {
                  $referer = $_SERVER['HTTP_REFERER'];
                }
                $referer_data = array(
                  'name' => 'referer',
                  'type' => 'hidden',
                  'value' => $referer
                );
        
                echo form_input($referer_data);
              }
              ?>
              <!-- <input type="number" name="product-number" placeholder="1"> -->
              &nbsp;
              <div class="button-add-car">
                <div>
                  <ion-icon name="bag-handle-sharp"></ion-icon>
                  &nbsp;
                  <span>Añadir al carrito</span>
                </div>
                <?php
                $data = array(
                  'type' => 'submit',
                  'class' => 'button-add-car'
                );
                
                echo form_input($data);
                ?>
              </div>
            <?= form_close(); ?>
          </div>

          <div id="img-gallery">
            <img src='<?= $base_url ?>public/img/<?= get_categoria($product) ?>/<?= $product->imagen1 ?>'
              alt='<?= $product->nombre; ?> vista desde arriba'>
            <img src='<?= $base_url ?>public/img/<?= get_categoria($product) ?>/<?= $product->imagen2 ?>'
              alt='<?= $product->nombre; ?> girada'>
            <img src='<?= $base_url ?>public/img/<?= get_categoria($product) ?>/<?= $product->imagen3 ?>'
              alt='<?= $product->nombre; ?> mango'>
            <img src='<?= $base_url ?>public/img/<?= get_categoria($product) ?>/<?= $product->imagen4 ?>'
              alt='<?= $product->nombre; ?> perfil'>
          </div>
        </div>
      </div>

      <div class="product-descriptions">
        <nav>
          <ul>
            <li>
              <h2 id="h2-description" class="underline-h2-descriptions">Descripción</h2>
            </li>
            <li>
              <h2 id="h2-details">Detalles</h2>
            </li>
          </ul>
        </nav>
        <div id="description">
          <?= $product->descripcion; ?>
        </div>

        <div id="details" class="hide">
          <div>
            <span class="details-left"><strong>Forma</strong></span>
            <span class="details-right"><?= $product->forma; ?></span>
          </div>
          <hr>
          <div>
            <span class="details-left"><strong>Núcleo</strong></span>
            <span class="details-right"><?= $product->nucleo; ?></span>
          </div>
          <hr>
          <div>
            <span class="details-left"><strong>Tubular</strong></span>
            <span class="details-right"><?= $product->tubular; ?></span>
          </div>
          <hr>
          <div>
            <span class="details-left"><strong>Cara</strong></span>
            <span class="details-right"><?= $product->cara; ?></span>
          </div>
          <hr>
        </div>
      </div>
    </article>

    <article class="more-products">
      <h3>Productos relacionados</h3>
      <div class="products">
        <!-- EJEMPLO 
        <a class="link-product" href="../palas/nox-at10-genius-18k-agustin-tapia-2022.html">
          <div class="product">
            <img class="product-img" src="../img/palas/nox-at10-genius-18k-agustin-tapia-2022.png" alt="product">
            <p class="product-name">Nox At10 Genius 18K Agustin Tapia 2022</p>
            <p class="product-price">199,99 €</p>
          </div>
        </a>
      -->
      
      <?php 
      foreach($relacionados as $relacionado) {
        $categoria = get_categoria($relacionado);

        $url_imagen = $base_url . 'public/img/' . $categoria . '/' . $relacionado->imagen1;
        $url_producto = $site_url . '/' . $relacionado->id_nombre;
        echo <<< EOT
        <a class="link-product" href='$url_producto'>
          <div class="product">
            <img
              class="product-img"
              src='$url_imagen'
              alt="product"
            >
            <p class="product-name">$relacionado->nombre</p>
            <p class="product-price">$relacionado->precio €</p>
          </div>
        </a>
        EOT;
      }
      ?>

      </div>
    </article>
  </section>
</main>

<?= $footer; ?>