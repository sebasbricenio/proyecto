<?php

namespace Proyecto\Models\Repositorios;

use PDO;
use Proyecto\Models\Usuario;

class RepositorioMySql {

  protected $db_user;
  protected $db_pass;
  protected $dsn;
  protected $opt;
  protected $db;

  public function __construct(){
    try{
      $this->db_user = 'root';
      $this->db_pass = '';
      $this->dsn = 'mysql:host=127.0.0.1;dbname=red_social';
      $this->opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
      $this->db = new PDO($this->dsn,$this->db_user,$this->db_pass,$this->opt);
    }catch(PDOException $Exception){
      echo $Exception->getMessage();
    }
  }

  public function guardarUsuario($usuario) {

    //$pass = $usuario->hashearPassword();
    $this->db->query('use red_social');
    $sql="insert into usuarios (nickname,email,pass) values ( :nombre, :email, :pass)";
    $stmt = $this->db->prepare( $sql );
    $stmt->bindValue(':nombre', $usuario['nombre']);
    $stmt->bindValue(':email', $usuario['email']);
    $stmt->bindValue(':pass', $usuario['pass']);
    $stmt->execute();
    return "se guardo exitosamente";
    // deberia ser un insert. Las validaciones de duplicidad ya deberian haber sido ejecutadas


  }

  public function traerPorId($id) {
    $this->db->query('use red_social');
    $sql="select * FROM usuarios WHERE id = :id";
    $stmt = $this->db->prepare( $sql );
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch();
    return $usuario;
    // el objeto a devolver esuno de la clase Usaurio, o null, throw not found
  }

  public function traerPorEmail($email) {
    //$this->db->query('use red_social');
    $sql= "select * from usuarios where email = :email";
    $stmt = $this->db->prepare( $sql );
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch();
    return $usuario;
    // Si lo encuentra, tienen que crear un usuario
  }


  public function traerTodos() {
    //$this->db->query('use red_social');
    $sql= "select * from usuarios";
    $stmt = $this->db->prepare( $sql );
    $stmt->execute();
    $usuario = $stmt->fetch();
    return $usuario;
  }
}


 ?>
