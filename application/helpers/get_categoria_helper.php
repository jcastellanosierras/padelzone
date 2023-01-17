<?php

function get_categoria ($producto) {
  $categoria = '';
  switch ($producto->categoria) {
    case 1:
      $categoria = 'palas';
      break;

    case 2:
      $categoria = 'paleteros';
      break;

    case 3:
      $categoria = 'zapatillas';
      break;

    case 4:
      $categoria = 'ropa';
      break;

    case 5:
      $categoria = 'accesorios';
      break;

    default:
      break;
  }

  return $categoria;
}
?>