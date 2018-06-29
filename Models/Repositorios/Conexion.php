<?php
class Conexion{
  protected $db_user;
  protected $db_pass;
  protected $dsn;
  protected $opt;
  protected $db;

  function __construct($usuario,$contrasenia){
    try{
      $this->db_user = $usuario;
      $this->db_pass = $contrasenia;
      $this->dsn = 'mysql:host=127.0.0.1';
      $this->opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
      $this->db = new PDO($this->dsn,$this->db_user,$this->db_pass,$this->opt);
    }catch(PDOException $Exception){
      echo $Exception->getMessage();
    }
  }

  public function nueva_db(){
    try{
      $this->db->query('create database IF NOT EXISTS red_social COLLATE utf8_spanish_ci');
      $this->db->query('use red_social');
    }catch(PDOException $Exception){
      echo $Exception->getMessage();
    }
  }

  public function nueva_tabla(){
    try{
      $this->db->query('CREATE TABLE IF NOT EXISTS usuarios (
        id INT primary key auto_increment not null,
        nickname VARCHAR(50) not null,
        email varchar(50) unique not null,
        pass varchar(100) not null,
        creado date,
        avatar varchar(200),
        descripcion text
      )');
    }catch(PDOException $Exception){
      echo $Exception->getMessage();
    }
  }
}
 ?>
