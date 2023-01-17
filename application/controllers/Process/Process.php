<?php

class Process extends CI_Controller {

  public function __construct () {
    parent::__construct();

    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->load->library('session');

    $this->load->model('user_model', 'User');
    $this->load->model('history_model', 'History');
  }

  private function get_products () : array {
    $products = array();
    for ($i = 1; $i <= $this->input->post('n-products'); $i++) {
      $product = array(
        'id' => $this->input->post('product-' . $i),
        'nombre' => $this->input->post('name-product-' . $i),
        'precio' => $this->input->post('price-product-' . $i),
        'cantidad' => $this->input->post('quantity-product-' . $i)
      );

      $products[] = $product;
    }

    return $products;
  }

  public function index () {
    // A esta página se puede acceder mediante el enlace de tramitar pedido desde el carrito
    // o de esta misma
    // Si la página anterior es shopping_cart solo se carga la vista para introducir los datos del formulario

    // Si no existe esta variable se ha accedido mediante la barra de navegación directamente
    // luego enviamos al usuario a la página del carrito
    if (!isset($_SERVER['HTTP_REFERER'])) {
      redirect('/shopping_cart');
      return;
    }

    $data_header = array(
      'styles' => array(
        'styles.css',
        'pages/process.css'
      )
    );

    $data = array();
    $data['header'] = $this->load->view('templates/header', $data_header, TRUE);
    $data['footer'] = $this->load->view('templates/footer', array(), TRUE);

    // Guardamos el id de usuario, que lo vamos a usar varias veces
    $id_user = $this->session->userdata('id');

    // Entra aquí si la página anterior es la del carrito
    if ($_SERVER['HTTP_REFERER'] == (site_url() . '/shopping_cart')) {
      $products = $this->get_products();

      // Si no se envían productos se le redirige a la página
      if (count($products) == 0) {
        $_POST['redirect'] = "hola";
        redirect('/shopping_cart');
        return;
      }

      // Miramos el historial de compra, y si el usuario ha comprado algo
      // autocompletamos con los últimos datos
      $data['user_data'] = $this->History->get_data_to_autocomplete($id_user);
      $data['products'] = $products;
      
      $this->load->view('process/details_buy', $data);
      
    } else {
      $this->form_validation->set_rules('direccion', 'Direccion', 'required'); // htmlspecialchars
      $this->form_validation->set_rules('codigopostal', 'Codigo Postal', 'trim|required|numeric|exact_length[5]');
      $this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required');
      $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required');
  
      if ($this->form_validation->run() == FALSE) {
        // FALTAN CAMPOS QUE ARREGLAR        
        $this->load->view('process/details_buy', $data);
      } else {
        // CARGAR INFORMACION DEL PRODUCTO
        // Esto puede acerse cargando de la base de datos, o recuperando informacion
        // del formulario en caso de tener campos hidden en el POST
        $products = $this->get_products();

        // Obtenemos de la tabla de usuarios el nombre y los apellidos del usuario con sesión iniciada
        $user = $this->User->get_user_by_id($id_user);

        // Obtenemos un valor aleatorio que será el cartID
        $cartID = bin2hex(random_bytes(16));

        // GUARDAR LA INFORMACION DEL PRODUCTO Y OTROS EN EL CAMPO $data
        // Las de este formulario no son necesarias ya que son accesibles usando set_value
        $data['user'] = $user;
        $data['products'] = $products;
        $data["PeticionActual"] = $cartID;

        // Guardamos todos los productos en el historial de usuario
        foreach($products as $product) {
          $this->History->create(
            $id_user,
            $product['id'],
            $product['nombre'],
            $product['precio'],
            $product['cantidad'],
            $this->input->post('direccion'),
            $this->input->post('codigopostal'),
            $this->input->post('ciudad'),
            $this->input->post('telefono'),
            $cartID
          );
        }  
  
        // LLAMAR A UN FORMULARIO QUE AUTOENVIA UN POST A LA PAGINA DE UMAPAL
        $this->load->view('process/callumapal', $data);
      }
    }
    
  }
}

?>