<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  public $nombre;
  public $apellidos;
  public $email;
  public $password;
  public $sexo;
  public $nacimiento;
  public $ofertas;

  public function __construct () {
    parent::__construct();
  }

  private function get_id ($email) {
    $this->db->select('id')->where('email', $email)->from('usuarios');
    return $this->db->get()->row();
  }

  public function get_user_by_id ($id) {
    $this->db->select('nombre, apellidos')->where('id', $id)->from('usuarios');
    return $this->db->get()->row();
  }

  public function exist ($email) {
    $this->db->select()->where('email', $email)->from('usuarios');
    if ($this->db->get()->num_rows() != 0) {
      return true;
    }

    return false;
  }

  public function register ($nombre, $apellidos, $email, $password, $sexo, $nacimiento, $ofertas) {
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;
    $this->email = $email;
    $this->password = hash('sha256', $password);
    $this->sexo = $sexo;
    $this->nacimiento = $nacimiento;
    $this->ofertas = $ofertas;

    $id = null;
    if (!$this->exist($this->email)) {
      // Si no hay ningún usuario con dicho email se crea el usuario
      if (!$this->db->insert('usuarios', $this)) {
        throw new Exception('No se pudo crear el usuario.');
      }
    } else {
      throw new Exception('El email ya existe.');
    }

    // Obtenemos el id del usuario para crear la cookie de sesión
    $id = $this->get_id($this->email);
    if ($id != null) {
      return $id->id;
    }

    return $id;
  }

  private function check_password ($email, $password) {
    $this->db->select('id, nombre, password')->where('email', $email)->from('usuarios');
    $pass_db = $this->db->get()->row();

    // Si es igual devuelve el id
    if ($pass_db->password == $password) {
      return array('id' => $pass_db->id, 'nombre' => $pass_db->nombre);
    }

    // Si no es igual devuelve null
    return null;
  }

  public function login ($email, $password) {
    $password = hash('sha256', $password);

    // Comprobamos que existe tal usuario
    if ($this->exist($email) == 0) {
      throw new Exception('El correo introducido no existe');
      return false;
    }

    // Si existe el correo comprobamos que su contraseña es la indicada
    $user = $this->check_password($email, $password);
    if ($user == null) {
      throw new Exception('La contraseña no es correcta.');
      return false;
    }

    // Si llega hasta aquí es que el usuario existe y devolvemos sus datos
    return $user;
  }
}

?>