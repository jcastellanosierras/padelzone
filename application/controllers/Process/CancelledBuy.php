<?php

class CancelledBuy extends CI_Controller {

  public function __construct () {
    parent::__construct();

    $this->load->helper('url');
    $this->load->library('session');

    $this->load->model('history_model', 'History');
  }

  public function index() {
    $cartID = $this->input->post('cartID');

    $this->History->remove_buy($cartID);
    
    $data["PeticionActual"] = $cartID;
    $this->load->view('process/cancel_buy', $data);
  }
        
}

?>