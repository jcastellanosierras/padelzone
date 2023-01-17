<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

  private $data;
  private $site_url;
  private $base_url;
  private $product;
  private $relacionados;
  private $routes;

  public function __construct () {
    parent::__construct ();

    $this->load->library(array('form_validation', 'session'));

    $this->load->helper(array('url', 'form', 'get_categoria', 'get_referrer_segments'));

    $this->site_url = site_url();
    $this->base_url = base_url();

    $this->data['base_url'] = $this->base_url;
    $this->data['site_url'] = $this->site_url;

    // Carga el modelo Product con el nombre Product
    $this->load->model('Product_model', 'Product');
    $this->load->model('shopping_cart_model', 'Shopping_Cart');
  }

  private function get_product ($id_nombre) {
    $this->product = $this->Product->read_one('id_nombre', $id_nombre);
  }

  private function get_relacionados ($categoria) {
    $this->relacionados = $this->Product->read('categoria', $categoria, 4, 0);
  }

  private function load_product ($id_nombre, $routes=null) {
    $this->get_product($id_nombre);
    if ($this->product == null) {
      $this->load->view('error_404');
    }

    $this->get_relacionados($this->product->categoria);

    if ($routes == null) {
      $this->routes = get_referrer_segments();
    } else {
      $this->routes = get_referrer_segments($routes);
      $this->data['referer'] = $routes;
    }
    
    $stylesheet = 'pages/products/' . get_categoria($this->product) . '.css';
    $data_header = array(
      'styles' => array('styles.css', $stylesheet),
      'session' => $this->session->userdata(),
      'path' => $this->load->view(
        'templates/path',
        array(
          'routes' => $this->routes
        ),
        TRUE)
    );

    $data_footer = array(
      'scripts' => array('changeDescription.js', 'changeProductImg.js')
    );

    $this->data['product'] = $this->product;
    $this->data['relacionados'] = $this->relacionados;

    $this->data['header'] = $this->load->view('templates/header', $data_header, TRUE);
    $this->data['footer'] = $this->load->view('templates/footer', $data_footer, TRUE);

    $this->load->view('product', $this->data);
  }

  public function add_to_cart () {
    // Si el método no es post redirigimos al inicio
    if ($this->input->method() != 'post') {
      redirect('/');
      return;
    }

    // Si el usuario no está logueado se le dice que debe estar registrado
    $id_user = $this->session->userdata('id');
    if ($id_user == null) {
      $this->data['error'] = 'Para comprar debe iniciar sesión antes';

      // Si hay una ruta anterior se le pasa
      $referer = $this->input->post('referer');
      if ($referer != null) {
        $this->load_product($this->input->post('product-nombre-id'), $this->input->post('referer'));
      } else {
        $this->load_product($this->input->post('product-nombre-id'));
      }

      return;
    }

    // Validamos que la cantidad del producto sea un número válido
    // Establecemos las reglas de validación
    $this->form_validation->set_rules(
      'product-number',
      'Cantidad',
      'trim|required|max_length[2]|callback_quantity_validate'
    );

    // Y comprobamos que sea correcta
    if (!$this->form_validation->run()) {
      // Si no lo es volvemos a cargar la página del producto con un error
      $this->data['error'] = 'No se pudo añadir al carrito, inténtelo de nuevo';
      
      // Si hay una ruta anterior se le pasa
      $referer = $this->input->post('referer');
      if ($referer != null) {
        $this->load_product($this->input->post('product-nombre-id'), $this->input->post('referer'));
      } else {
        $this->load_product($this->input->post('product-nombre-id'));
      }

      return;
    }

    // Llega aquí si se puede añadir al carrito
    // Obtenemos por post el producto y la cantidad
    $id_product = $this->input->post('product-id');
    $quantity = $this->input->post('product-number');
    
    // Ahora con todos los datos necesarios agregamos el producto al carrito
    $this->Shopping_Cart->add($id_user, $id_product, $quantity);

    // Volvemos a cargar la vista del producto
    // Si hay una ruta anterior se le pasa
    $referer = $this->input->post('referer');
    if ($referer != null) {
      $this->load_product($this->input->post('product-nombre-id'), $this->input->post('referer'));
    } else {
      $this->load_product($this->input->post('product-nombre-id'));
    }
  }

  public function quantity_validate ($quantity) {
    if ($quantity < 1) {
      $this->form_validation->set_message('quantity_validate', 'La cantidad no es válida');
      return false;
    }

    return true;
  }

  public function index ($id_nombre) {
    $this->load_product($id_nombre);
  }
}

?>