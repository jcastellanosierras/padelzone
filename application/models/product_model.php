<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

  public function __construct () {
    parent::__construct();
    $this->load->model('category_model', 'Category');
  }

  public function read_one ($key, $value) {
    $this->db->select()->where($key, $value)->from('productos');
    return $this->db->get()->row();
  }

  public function read ($key, $value, $limit, $offset) {
    $this->db->limit($limit, $offset);
    $this->db->select()->where($key, $value)->from('productos');
    return $this->db->get()->result();
  }

  public function get_products ($key, $value) {
    $this->db->select('id, id_nombre, nombre, imagen1, precio, categoria')->where($key, $value)->from('productos');
    $results = $this->db->get()->result();
    
    // Para cada valor de la respuesta, cambiamos el campo categoría (que es su identificador),
    // por la categoría en texto plano. Hacemos esto para poder representar después las imágenes
    foreach($results as $result) {
      $category = $this->Category->get_category($result->categoria);
      $result->categoria = $category;
    }

    return $results;
  }

  public function get_products_by_category ($category) {
    $id_category = $this->Category->get_id_category($category);

    $this->db->select('id_nombre, nombre, imagen1, precio')->where('categoria', $id_category)->from('productos');
    return $this->db->get()->result();
  }

  public function get_product_by_id ($id) {
    $this->db->select('nombre, imagen1, precio, categoria')->where('id', $id)->from('productos');
    $row =  $this->db->get()->row();
    $row->categoria = $this->Category->get_category($row->categoria);
    return $row;
  }

  public function from_category ($id_nombre, $category) {
    $this->db->select('categoria')->where('id_nombre', $id_nombre)->from('productos');

    $result = $this->db->get()->row();
    if ($this->Category->get_category($result->categoria) == $category) {
      echo "true";
      return true;
    } else {
      echo "false";
      return false;
    }
  }

  public function from_subcategory ($id_nombre, $category, $subcategory) {
    $this->db->select('categoria, subcategoria')->where('id_nombre', $id_nombre)->from('productos');

    $result = $this->db->get()->row();
    if (($this->Category->get_category($result->categoria) == $category) && ($this->Category->get_subcategory($result->categoria, $result->subcategoria) == $subcategory)) {
      return true;
    } else {
      return false;
    }
  }
}

?>