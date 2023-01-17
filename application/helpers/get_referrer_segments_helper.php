<?php

function get_referrer_segments ($referer=null) : array {

  $CI =& get_instance();
  $CI->load->model('category_model', 'Category');

  $url = null;
  if ($referer == null) {
    if (!isset($_SERVER['HTTP_REFERER'])) {
      return array();
    }
  
    // Obtenemos la url anterior
    $url = $_SERVER['HTTP_REFERER'];
  } else {
    $url = $referer;
  }
  
  // Obtenemos los parámetros cortando la cadena a partir del nombre del sitio web
  $url_params = substr($url, strlen(site_url())+1);

  // Ahora separamos ese string por el carácter '/'
  $params = explode('/', $url_params);

  // Comprobamos que se ha devuelto un valor válido
  if (count($params) == 1) {
    // Si $params contiene un string vacío devolvemos un array vacío
    if ($params[0] == "") {
      return array();
    }
  }

  // Si hay parámetros comprobamos que sean válidos
  $found = false;
  $categorys = $CI->Category->get_categorys();
  // Vamos a comprobar si alguna categoría aparece en la URL
  foreach($categorys as $category) {
    if (!strcasecmp($params[0], $category->categoria)) {
      $found = true;
      break;
    }
  }

  // Si no se ha encontrado ninguna categoría vemos si es oferta, recomendado, o novedad
  if (!$found) {
    $dict = array('oferta', 'recomendado', 'novedad');
    foreach($dict as $page) {
      if (!strcasecmp($params[0], $page)) {
        $found = true;
        break;
      }
    }    

    if (!$found) {
      return array();
    }
  }

  return $params;
}

?>