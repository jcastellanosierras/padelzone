<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {


	private $data;
	private $base_url;
	private $site_url;

	public function __construct() {

		parent::__construct();

		$this->load->model('product_model', 'Product');

		$this->load->helper(array('get_categoria', 'url'));

		$this->load->library('session');

		$this->data = array();
		$this->base_url = base_url();
		$this->site_url = site_url();

		$this->data['base_url'] = $this->base_url;
		$this->data['site_url'] = $this->site_url;
	}

	private function get_ofertas () { 
		$this->data['ofertas'] = $this->Product->read('oferta', 1, 3, 0);
	}

	private function get_novedades () {
		$this->data['novedades'] = $this->Product->read('novedad', 1, 3, 0);
	}

	private function get_recomendados () {
		$this->data['recomendados'] = $this->Product->read('recomendado', 1, 3, 0);
	}

	public function index () {
    $this->get_ofertas();
		$this->get_novedades();
		$this->get_recomendados();

		$data_header = array(
			'styles' => array('styles.css'),
			'session' => $this->session->userdata()
		);

		$this->data['header'] = $this->load->view('templates/header', $data_header, TRUE);
		$this->data['footer'] = $this->load->view('templates/footer', array(), TRUE);
		
		$this->load->view('index', $this->data);
	}
}

?>