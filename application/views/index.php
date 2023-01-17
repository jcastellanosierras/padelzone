<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?= $header; ?>

  <section>
    <article id="offers-section" class="article-section">
      <h2>Ofertas</h2>
      <p>
        Aprovecha la oportunidad y compra nuestros productos en oferta, solo
        durante un tiempo limitado.
      </p>
      <div class="products">
        <!-- EJEMPLO PRODUCTO EN OFERTA
        <a class="link-product" href="./palas/nox-at10-genius-18k-agustin-tapia-2022.html">
          <div class="product">
            <img
              class="product-img"
              src="./img/palas/nox-at10-genius-18k-agustin-tapia-2022.png"
              alt="product"
            >
            <p class="product-name">Nox At10 Genius 18K Agustin Tapia 2022</p>
            <p class="product-price">199,99 €</p>
          </div>
        </a>
        -->

        <?php
        foreach ($ofertas as $oferta) {
          $categoria = get_categoria($oferta);

          $url_imagen = $base_url . 'public/img/' . $categoria . '/' . $oferta->imagen1;
          $url_producto = $site_url . '/' . $oferta->id_nombre;
          echo <<< EOT
          <a class="link-product" href='$url_producto'>
            <div class="product">
              <img
                class="product-img"
                src='$url_imagen'
                alt="product"
              >
              <p class="product-name">$oferta->nombre</p>
              <p class="product-price">$oferta->precio €</p>
            </div>
          </a>
          EOT;
        }
        ?>
      </div>

      <div class="btn-see-all">
        <a href="<?= $base_url; ?>index.php/oferta">Ver todo</a>
      </div>
    </article>

    <article id="news-section" class="article-section">
      <h2>Novedades</h2>
      <p>
        Estas son las novedades de nuestra tienda, si quieres ir a la última
        este es tu lugar.
      </p>
      <div class="products">
        <!-- EJEMPLO PRODUCTO NOVEDAD
        <a class="link-product" href="./palas/nox-at10-genius-18k-agustin-tapia-2022.html">
          <div class="product">
            <img
              class="product-img"
              src="./img/palas/nox-at10-genius-18k-agustin-tapia-2022.png"
              alt="product"
            >
            <p class="product-name">Nox At10 Genius 18K Agustin Tapia 2022</p>
            <p class="product-price">199,99 €</p>
          </div>
        </a>
        -->

        <?php
        foreach ($novedades as $novedad) {
          $categoria = get_categoria($novedad);

          $url_imagen = $base_url . 'public/img/' . $categoria . '/' . $novedad->imagen1;
          $url_producto = $site_url . '/' . $novedad->id_nombre;
          echo <<< EOT
          <a class="link-product" href='$url_producto'>
            <div class="product">
              <img
                class="product-img"
                src='$url_imagen'
                alt="product"
              >
              <p class="product-name">$novedad->nombre</p>
              <p class="product-price">$novedad->precio €</p>
            </div>
          </a>
          EOT;
        }
        ?>
    </div>

      <div class="btn-see-all">
        <a href="<?= $base_url; ?>index.php/novedad">Ver todo</a>
      </div>
    </article>

    <article id="recomendations-section" class="article-section">
      <h2>Recomendaciones</h2>
      <p>Estos son nuestros productos mejor valorados.</p>
      <div class="products">
        <!-- EJEMPLO DE RECOMENDADOS 
        <a class="link-product" href="./palas/nox-at10-genius-18k-agustin-tapia-2022.html">
          <div class="product">
            <img
              class="product-img"
              src="./img/palas/nox-at10-genius-18k-agustin-tapia-2022.png"
              alt="product"
            >
            <p class="product-name">Nox At10 Genius 18K Agustin Tapia 2022</p>
            <p class="product-price">199,99 €</p>
          </div>
        </a>
        -->

        <?php
        foreach ($recomendados as $recomendado) {
          $categoria = get_categoria($recomendado);

          $url_imagen = $base_url . 'public/img/' . $categoria . '/' . $recomendado->imagen1;
          $url_producto = $site_url . '/' . $recomendado->id_nombre;
          echo <<< EOT
          <a class="link-product" href='$url_producto'>
            <div class="product">
              <img
                class="product-img"
                src='$url_imagen'
                alt="product"
              >
              <p class="product-name">$recomendado->nombre</p>
              <p class="product-price">$recomendado->precio €</p>
            </div>
          </a>
          EOT;
        }
        ?>
      </div>

      <div class="btn-see-all">
        <a href="<?= $base_url; ?>index.php/recomendado">Ver todo</a>
      </div>
    </article>
  </section>
</main>

<?= $footer; ?>
