<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

  public function __construct () {
    parent::__construct();
  }

  public function get_categorys () {
    $this->db->select('categoria')->from('categorias');
    return $this->db->get()->result();
  }

  public function get_category ($id_category) {
    $this->db->select('categoria')->where('id_categoria', $id_category)->from('categorias');
    $result = $this->db->get()->row();

    return $result->categoria;
  }

  public function get_subcategory ($id_category, $id_subcategory) {
    $this->db->select('subcategoria')->where('id_categoria', $id_category)->where('id_subcategoria', $id_subcategory)->from('categorias');
    $id = $this->db->get()->row();

    if ($id != null) {
      return $id->id_subcategoria;
    }

    return null;
  }

  public function get_id_category ($category) {
    $this->db->select('id_categoria')->where('categoria', $category)->from('categorias');
    $id = $this->db->get()->row();

    if ($id != null) {
      return $id->id_categoria;
    }

    return null;
  }

  public function get_id_subcategory ($category, $subcategory) {
    $this->db->select('id_subcategoria')->where('categoria', $category)->where('subcategoria', $subcategory)->from('categorias');
    $id = $this->db->get()->row();

    if ($id != null) {
      return $id->id_subcategoria;
    }

    return null;
  }

  public function exist_subcategory ($category, $subcategory) {
    $this->db->select()->where('categoria', $category)->where('subcategoria', $subcategory)->from('categorias');
    return $this->db->get()->num_rows() != 0;
  }

  public function get_products_by_category_and_subcategory ($category, $subcategory) {
    $id_category = $this->get_id_category($category);
    $id_subcategory = $this->get_id_subcategory($category, $subcategory);

    $this->db->select('id_nombre, nombre, imagen1, precio')->where('categoria', $id_category)->where('subcategoria', $id_subcategory)->from('productos');
    return $this->db->get()->result();
  }
}

?>