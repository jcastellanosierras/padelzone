<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping_Cart extends CI_Controller {

	private $data;
	private $base_url;
	private $site_url;

	public function __construct() {

		parent::__construct();

    $this->load->model('shopping_cart_model', 'Shopping_Cart');
		$this->load->model('product_model', 'Product');
		$this->load->model('history_model', 'History');

		$this->load->helper(array('get_categoria', 'url', 'form'));

		$this->load->library(array('session', 'form_validation'));

		$this->data = array();
		$this->base_url = base_url();
		$this->site_url = site_url();
		$this->data['base_url'] = $this->base_url;
		$this->data['site_url'] = $this->site_url;
	}

	private function load_history ($id_user, $limit = null) {
		if ($limit == null) {
			// Obtenemos ahora productos del historial
			$history = $this->History->get_history($id_user);
		} else {
			$history = $this->History->get_history($id_user, $limit);
		}
		
		// Ahora obtenemos los datos de los productos
		$history_products = array();
		foreach($history as $product) {
			$history_product = array(
				$this->Product->get_product_by_id($product->id_producto),
				$product->cantidad
			);

			// Revertimos el orden del array para que salgan primero los productos que se han comprado más recientemente
			$history_products[] = $history_product;
		}

		$this->data['history'] = array_reverse($history_products);
	}

	private function load_aux_views () {
		$data_header = array(
			'styles' => array('styles.css', 'pages/shopping_cart.css'),
			'session' => $this->session->userdata(),
      'path' => $this->load->view(
        'templates/path',
				array(),
        TRUE
			)
		);

		$this->data['header'] = $this->load->view('templates/header', $data_header, TRUE);
		$this->data['footer'] = $this->load->view('templates/footer', array(), TRUE);
	}

	public function load_shopping_cart () {

		// Debemos obtener el carrito del cliente
		// Y después obtener los datos de los productos que contiene el carrito
		$id_user = $this->session->userdata('id');
		$cart = $this->Shopping_Cart->get_cart($id_user);
		$products = array();
		foreach($cart as $cart_product) {
			$product = array(
				$this->Product->get_products('id', $cart_product->id_producto)[0],
				$cart_product->cantidad
			);

			$products[] = $product;
		}

		// Ahora pasamos los productos a la view
		$this->data['cart_products'] = $products;

		// Obtenemos ahora productos del historial, 2 productos concretamente
		$this->load_history($id_user, 2);

		// Cargamos las vistas auxiliares y la principal
		$this->load_aux_views();
		$this->load->view('shopping_cart/index', $this->data);
	}

	private function is_user_loged () : bool {
		return $this->session->userdata('id') != NULL;
	}

  public function add () {
    
    if (!$this->is_user_loged()) {
			redirect('/login');
			return;
		}

		$id_user = $this->session->userdata('id');
    $cart = new Shopping_Cart_model();
    $cart->add($id_user, 1, 1);
  }

	public function update_quantity () {
		
		if (!$this->is_user_loged()) {
			redirect('/login');
			return;
		}

		// Comprobamos que venga por post
		if ($this->input->method() != 'post') {
			redirect('/');
			return;
		}

		// Obtenemos los datos pasados por post para obtener el id del producto y la cantidad
		$post = $this->input->post();
		$id_product = key($post);
		// Validamos que la cantidad del producto sea un número válido
    // Establecemos las reglas de validación
    $this->form_validation->set_rules(
      strval($id_product),
      'Cantidad',
      'trim|required|max_length[2]|callback_quantity_validate'
    );

		// Y comprobamos que sea correcta
    if (!$this->form_validation->run()) {
      // Si no lo es volvemos a cargar la página del producto con un error
      $this->data['error'] = 'No se pudo actualizar la cantidad, inténtelo de nuevo';
			redirect('/shopping_cart');
      return;
    }

		// Ahora obtenemos la cantidad, para actualizarla
		$quantity = $post[$id_product];
		// Actualizamos la cantidad del producto
		if (!$this->Shopping_Cart->update_quantity($this->session->userdata('id'), $id_product, $quantity)) {
			$this->data['error'] = 'No se pudo actualizar la cantidad, inténtelo de nuevo';
		}
	
		redirect('/shopping_cart');
	}

	public function quantity_validate ($quantity) {
    if ($quantity < 1) {
      // $this->form_validation->set_message('quantity_validate', 'La cantidad no es válida');
      return false;
    }

    return true;
  }

	public function remove () {

		if (!$this->is_user_loged()) {
			redirect('/login');
			return;
		}

		// Comprobamos que venga por post
		if ($this->input->method() != 'post') {
			redirect('/');
			return;
		}

		// Obtenemos el id del producto
		$id_product = key($this->input->post());
		// Y eliminamos la entrada del carrito del usuario que contiene a ese producto
		if (!$this->Shopping_Cart->remove($this->session->userdata('id'), $id_product)){
			$this->data['error'] = 'No se pudo eliminar el producto, inténtelo de nuevo';
		}

		$this->load_shopping_cart();
	}

	public function clear () {
		if (!$this->is_user_loged()) {
			redirect('/login');
			return;
		}

		// Comprobamos que venga por post
		if ($this->input->method() != 'post') {
			redirect('/');
			return;
		}

		// Y vaciamos el carrito del usuario
		$this->Shopping_Cart->clear($this->session->userdata('id'));

		$this->load_shopping_cart();
	}

	public function history () {
		// Comprobamos que el cliente haya iniciado sesión, si no lo enviamos al login
		if (!$this->is_user_loged()) {
			$_SESSION['shopping_cart'] = true;
			redirect('/login');
			return;
		}

		// Obtenemos el id de usuario
		$id_user = $this->session->userdata('id');

		$this->load_history($id_user);

		// Cargamos las vistas auxiliares y la principal
		$this->load_aux_views();
		$this->load->view('shopping_cart/history', $this->data);
	}

	public function index () {
		// Comprobamos que el cliente haya iniciado sesión, si no lo enviamos al login
		if (!$this->is_user_loged()) {
			$_SESSION['shopping_cart'] = true;
			redirect('/login');
			return;
		}

		$this->load_shopping_cart();
	}
}

?>