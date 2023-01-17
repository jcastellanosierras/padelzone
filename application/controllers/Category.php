<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

  private $data;
  private $site_url;
  private $base_url;
  private $routes;

  public function __construct () {
    parent::__construct ();

    $this->load->library('session');

    $this->load->helper(array('url', 'form'));

    $this->site_url = site_url();
    $this->base_url = base_url();

    $this->data['base_url'] = $this->base_url;
    $this->data['site_url'] = $this->site_url;

    // Carga el modelo category_model con el nombre Category_model
    $this->load->model('category_model', 'Category');
    $this->load->model('product_model', 'Product');
  }

  private function load_category () {

    $data_header = array(
      'styles' => array('styles.css'),
      'session' => $this->session->userdata(),
      'path' => $this->load->view('templates/path',
        array(
          'routes' => $this->routes,
        ), TRUE)
    );

    $this->data['header'] = $this->load->view('templates/header', $data_header, TRUE);
    $this->data['footer'] = $this->load->view('templates/footer', array(), TRUE);

    $this->load->view('category', $this->data);
  }

  public function index ($category, $subcategory=null) {

    $products = null;
    // Si recibimos un parámetro, debe ser la subcaterogía
    // Comprobamos si la categoría palas tiene una subcategoría con el nombre recibido
    if ($subcategory != null) {
      if ($this->Category->exist_subcategory($category, $subcategory) == 0) {
        $this->load->view('error_404');
        return;
      }

      $this->routes[] = $category;

      // Si continúa es porque existe una categoría que contiene a la subcategoría recibida
      // Ahora pedimos los productos pertenecientes a dichas categoría y subcategoría
      $products = $this->Category->get_products_by_category_and_subcategory ($category, $subcategory);

      switch ($category) {
        case 'palas':
          // Le ponemos la tilde a lágrima
          if ($subcategory == 'lagrima') $subcategory = 'lágrima';
          $this->data['h2'] = 'Palas formato ' . $subcategory;
          break;

        case 'paleteros':
          if ($subcategory == 'paleteros') {
            $this->data['h2'] = 'Paleteros';
          } else {
            $this->data['h2'] = 'Mochilas';
          }
          break;

        case 'zapatillas':
          $this->data['h2'] = 'Zapatillas de ' . $subcategory;
          break;

        case 'ropa':
          $this->data['h2'] = 'Ropa de ' . $subcategory;
          break;

        case 'accesorios':
          $this->data['h2'] = ucfirst($subcategory);
          break;
      }

    } else { // Si no se pasa ninguna subcategoría
      $products = $this->Product->get_products_by_category($category);
      $this->data['h2'] = ucfirst($category);
    }

    // Y aquí cargamos las palas en el array data que se le pasa a la vista
    // Si no existen se le pasará un valor null
    // Mediante el cual controlaremos en la vista si se le ha pasado algún producto
    $this->data['products'] = $products;
    $this->data['category'] = $category;
    
    // Y cargamos la vista
    $this->load_category();
  }

  public function opportunity ($param) {
    $products = $this->Product->get_products ($param, 1);

    $this->data['h2'] = ucfirst($param);

    $this->data['products'] = $products;
    
    // Y cargamos la vista
    $this->load_category();
  }
}

// $this->url->previous_url();

?>