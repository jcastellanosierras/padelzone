<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping_Cart_model extends CI_Model {
  public $id_usuario;
  public $id_producto;
  public $cantidad;

  public function __construct() {
    parent::__construct();
  }

  public function get_cart (int $id_usuario) : array {
    $this->db->select('id_producto, cantidad')->where('id_usuario', $id_usuario)->from('carrito');
    return $this->db->get()->result();
  }

  public function add (int $id_usuario, int $id_producto, int $cantidad) : bool {
    // Comprobamos si el producto ya existe, y si existe actualizamos la cantidad
    $this->db->select('cantidad')
              ->where('id_usuario', $id_usuario)
              ->where('id_producto', $id_producto)
              ->from('carrito');

    $result = $this->db->get()->row();
    if ($result != NULL) {
      $this->db->set('cantidad', $result->cantidad + $cantidad);
      $this->db->where('id_usuario', $id_usuario)->where('id_producto', $id_producto);
      return $this->db->update('carrito');
    } else {
      $this->id_usuario = $id_usuario;
      $this->id_producto = $id_producto;
      $this->cantidad = $cantidad;
      return $this->db->insert('carrito', $this);
    }
  }

  public function update_quantity (int $id_usuario, int $id_producto, int $cantidad) : bool {
    $this->db->set('cantidad', $cantidad);
    $this->db->where('id_usuario', $id_usuario)->where('id_producto', $id_producto);
    return $this->db->update('carrito');
  }

  public function remove (int $id_usuario, int $id_producto) : bool {
    $this->db->select()->where('id_usuario', $id_usuario)->where('id_producto', $id_producto)->from('carrito');
    return $this->db->delete();
  }

  public function clear (int $id_usuario = null) : bool {
    if ($id_usuario == null) $id_usuario = $this->id_usuario;
    $this->db->select()->where('id_usuario', $id_usuario)->from('carrito');
    return $this->db->delete();
  }
}

?>