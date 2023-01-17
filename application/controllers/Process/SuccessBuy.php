<?php

class SuccessBuy extends CI_Controller {

  public function __construct () {
    parent::__construct();

    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('shopping_cart_model', 'Cart');
  }

  public function index()
  {
    // Como se ha completado la compra se vacía el carrito
    $this->Cart->clear($this->session->userdata('id'));
      
    $data["PeticionActual"] = $this->input->post('cartID');
    $this->load->view('process/success_buy', $data);
  }
        
}

?>