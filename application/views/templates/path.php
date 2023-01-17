<div id="path">
  <?php
  $n_routes = 0;
  $build_route = '';
  echo '<a href="' . site_url() . '">Inicio</a>';
  if (isset($routes)) {
    if (count($routes) > 0) {
      echo ' > ';
      foreach($routes as $route) {
        $build_route .= $route;
        echo '<a href="' . base_url() . 'index.php/' . $build_route . '">' . $route . '</a>';
        $n_routes++;
        if ($n_routes != count($routes)) {
          $build_route .= '/';
          echo ' > ';
        }
      }
    }
  }
  ?>
</div>