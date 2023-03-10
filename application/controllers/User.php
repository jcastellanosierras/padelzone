<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  private $data;
  private $site_url;
  private $base_url;

  public function __construct () {

    parent::__construct ();

    $this->load->helper(array('url', 'form'));
    $this->load->library(array('form_validation', 'session'));
    $this->load->model('user_model', 'User'); // Carga el modelo user_model con el nombre User

    $this->site_url = site_url();
    $this->base_url = base_url();

    $this->data['base_url'] = $this->base_url;
    $this->data['site_url'] = $this->site_url;
  }

  public function logout () {
    $this->session->sess_destroy();
    redirect($this->site_url);
  }

  public function userdata () {
    var_dump($this->session->all_userdata());
  }

  private function load_register ($error = '') {

    $data_header = array(
      'styles' => array('styles.css', 'pages/user/register.css'),
      'session' => $this->session->userdata(),
      'path' => $this->load->view(
        'templates/path',
        array(),
        TRUE
      )
    );

    if (isset($error)) {
      $this->data['error'] = $error;
    }
    $this->data['header'] = $this->load->view('templates/header', $data_header, TRUE);
    $this->data['footer'] = $this->load->view('templates/footer', array(), TRUE);
    
    $this->load->view('user/register', $this->data);
  }

  private function validate () {

    $config = array(
      array(
        'field' => 'register-fname',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[256]',
        'errors' => array(
          'required' => 'El nombre es obligatorio.',
          'max_length[256]' => 'El nombre es demasiado largo.'
        )
      ),
      array(
        'field' => 'register-lname',
        'label' => 'Apellidos',
        'rules' => 'trim|required|max_length[256]',
        'errors' => array(
          'required' => 'Los apellidos son obligatorios.',
          'max_length[256]' => 'Los apellidos son demasiado largos.'
        ),
      ),
      array(
        'field' => 'register-email',
        'label' => 'Direcci??n de correo electr??nico',
        'rules' => 'trim|required|valid_email|max_length[256]',
        'errors' => array(
          'required' => 'El email es obligatorio.',
          'valid_email' => 'El email no es v??lido',
          'max_length[256]' => 'El email es demasiado largo.'
        ),
      ),
      array(
        'field' => 'register-password',
        'label' => 'Contrase??a',
        'rules' => 'trim|required|min_length[8]',
        'errors' => array(
          'required' => 'La contrase??a es obligatoria.',
          'min_length' => 'La contrase??a tiene que tener 8 car??cteres como m??nimo'
        ),
      ),
      array(
        'field' => 'register-gender',
        'label' => 'G??nero',
        'rules' => 'required|in_list[hombre,mujer]',
        'errors' => array(
          'required' => 'Elige un g??nero.',
          'in_list[hombre,mujer]' => 'El gen??ro es incorrecto.'
        ),
      ),
      array(
        'field' => 'register-birthday',
        'label' => 'Fecha de nacimiento',
        'rules' => 'required',
        'errors' => array(
          'required' => 'La fecha de nacimiento es obligatoria.',
        ),
      ),
      array(
        'field' => 'register-accept-terms',
        'label' => 'Aceptar t??rminos y condiciones y la pol??tica de privacidad',
        'rules' => 'required',
        'errors' => array(
          'required' => 'Debe aceptar este campo.',
        )
      )
    );

    $this->form_validation->set_rules($config);
  }

  private function guardar () {

    $sexo =  $this->input->post('register-gender');
    $nombre = $this->input->post('register-fname');
    $apellidos = $this->input->post('register-lname');
    $email = $this->input->post('register-email');
    $password = $this->input->post('register-password');
    $nacimiento = $this->input->post('register-birthday');
    $ofertas = $this->input->post('register-receive-offers') == 'accept' ? 1 : 0;
    $terms = $this->input->post('register-accept-terms') == 'accept' ? 1 : 0;
    
    // Validamos los datos
    $this->validate();

    // Comprobamos si la validaci??n es correcta
    if ($this->form_validation->run()) {
      // Creamos al usuario en la base de datos
      $new_user = new User();
      $id = null;
      try {
        $id = $new_user->register(
          $nombre,
          $apellidos,
          $email,
          $password,
          $sexo,
          $nacimiento,
          $ofertas
        );
      } catch (Exception $e) {
        $this->load_register($e->getMessage());
      }

      // Si el id es v??lido y no es null significa que se ha podido 
      // crear el usuario correctamente, luego creamos su sesi??n de usuario
      if ($id != null) {
        $data_session = array(
          'id' => $id,
          'username' => $nombre,
          'email' => $email
        );

        $this->session->set_userdata($data_session);

        // Y despu??s de crear la sesi??n de usuario redirigimos a la p??gina principal
        redirect('/');
      }
    } else { // Si la validaci??n no es v??lida

      // Cargamos los datos para que el usuario no tenga que escribir de nuevo todos
      $this->data['values_form'] = array(
        'fname' => $nombre,
        'lname' => $apellidos,
        'email' => $email,
        'password' => $password,
        'gender' => $sexo,
        'birthday' => $nacimiento,
        'ofertas' => $ofertas,
        'terms' => $terms
      );

      // Cargamos la vista indicando el error
      $this->load_register('Formulario no v??lido');
    }
  }

  public function register () {
    // Comprobamos si hay activa una sesi??n
    // Si la hay redirigimos a la p??gina principal
    if ($this->session->userdata('id')) {
      redirect('/');
      return;
    }
    
    // Si el m??todo es get solo se muestra la p??gina
    if ($this->input->method() == 'get') {
      $this->load_register();  
    }
    
    // Si el m??todo es post se procesan los datos
    if ($this->input->method() == 'post') {
      $this->guardar();
    }
  }

  private function load_login ($error = '') {

    $data_header = array(
      'base_url' => $this->base_url,
      'site_url' => $this->site_url,
      'styles' => array('styles.css', 'pages/user/login.css'),
      'session' => $this->session->userdata(),
      'path' => $this->load->view(
        'templates/path',
        array(
          'base_url' => $this->base_url,
          'site_url' => $this->site_url
        ),
        TRUE)
    );

    $data_footer = array(
      'base_url' => $this->base_url
    );

    if (isset($error)) {
      $this->data['error'] = $error;
    }
    $this->data['header'] = $this->load->view('templates/header', $data_header, TRUE);
    $this->data['footer'] = $this->load->view('templates/footer', $data_footer, TRUE);

    $this->load->view('user/login', $this->data);
  }

  private function iniciar () {
    $email = $this->input->post('login-email');
    $password = $this->input->post('login-password');

    // Validamos los datos
    $this->form_validation->set_rules(
      'login-email',
      'Direcci??n de correo electr??nico',
      'trim|required|valid_email|max_length[256]',
      array(
        'required' => 'Introduce el email',
        'valid_email' => 'El email no es v??lido',
        'max_length[256]' => 'El email es demasiado largo'
      )
    );

    $this->form_validation->set_rules(
      'login-password',
      'Contrase??a',
      'trim|required',
      array(
        'required' => 'Introduce la contrase??a'
      )
    );

    // Si la valicaci??n es correcta obtenemos los datos y procedemos con el inicio de sesi??n
    if ($this->form_validation->run()) {
      // Comprobamos si existe el email recibido
      try {
        $user = $this->User->login($email, $password);
        if ($user != 0) {
          // Sesi??n iniciada correctamente
          // Creamos la cookie de sesi??n con los datos correspondientes
          $data_session = array(
            'id' => $user['id'],
            'username' => $user['nombre'],
            'email' => $email
          );
  
          $this->session->set_userdata($data_session);
  
          // Comprobamos si viene de la p??gina del carrito, para enviarlo ah?? cuando se inicie sesi??n
          // Si no se env??a a la p??gina principal
          if ($this->session->userdata('shopping_cart')) {
            // Eliminamos el valor del array de sesi??n
            $this->session->unset_userdata('shopping_cart');
            redirect('shopping_cart');
          } else {
            redirect('/');
          }
        }
      } catch (Exception $e) {
        $this->load_login($e->getMessage());
      }
    } else {
      // Cargamos los datos para que el usuario no tenga que escribir de nuevo todos
      $this->data['value_email'] = $email;

      // Cargamos la vista con los errores correspondientes
      $this->load_login('Inicio de sesi??n no v??lido.');
    }
  }

  public function login () {
    // Comprobamos si hay activa una sesi??n
    // Si la hay redirigimos a la p??gina principal
    if ($this->session->userdata('id')) {
      redirect('/');
      return;
    }

    // Comprobamos el m??todo de la petici??n
    if ($this->input->method() == 'get') {
      $this->load_login();
    }

    if ($this->input->method() == 'post') {
      $this->iniciar();
    }

    // Elimina el dato que indica que se viene de la p??gina del carrito de compra
    // Por si no se ha borrado anteriormente
    if ($this->session->userdata('shopping_cart')) {
      // Eliminamos el valor del array de sesi??n
      $this->session->unset_userdata('shopping_cart');
    }
  }
}
?>