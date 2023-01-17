<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {
  public $id_usuario;
  public $id_producto;
  public $nombre_producto;
  public $precio;
  public $cantidad;
  public $direccion;
  public $codigo_postal;
  public $ciudad;
  public $telefono;
  public $cartID;

  public function __construct () {
    parent::__construct();
  }

  public function create (
    string $id_usuario,
    string $id_producto,
    string $nombre_producto,
    string $precio,
    string $cantidad,
    string $direccion,
    string $codigo_postal,
    string $ciudad,
    string $telefono,
    string $cartID
  ) : bool {

    $this->id_usuario = $id_usuario;
    $this->id_producto = $id_producto;
    $this->nombre_producto = $nombre_producto;
    $this->precio = $precio;
    $this->cantidad = $cantidad;
    $this->direccion = $direccion;
    $this->codigo_postal = $codigo_postal;
    $this->ciudad = $ciudad;
    $this->telefono = $telefono;
    $this->cartID = $cartID;

    return $this->db->insert('historial', $this);
  }

  // Devuelve los últimos dos pedidos del usuario
  public function get_history (string $id_user) {
    $this->db->select()->where('id_usuario', $id_user)->from('historial');
    $num_pedidos = $this->db->get()->num_rows();

    $this->db->select('id_producto, cantidad')
             ->where('id_usuario', $id_user)
             ->limit(2, $num_pedidos - 2)
             ->from('historial');

    return $this->db->get()->result();
  }

  public function get_data_to_autocomplete (string $id_user) : mixed {
    $this->db->select('direccion, codigo_postal, ciudad, telefono')
             ->where('id_usuario', $id_user)
             ->from('historial');

    return $this->db->get()->row();
  }

  public function remove_buy (string $cartID) : bool {
    $this->db->select()->where('cartID', $cartID)->from('historial');
    return $this->db->delete();
  }
}