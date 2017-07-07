<?php

namespace Peteno;

class Usuario {

  private $id;
  private $email;
  private $senha;

  use HydratorPersist;

  protected function getPrimaryKeyName() {
    return 'id';
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getSenha() {
    return $this->senha;
  }

  public function setSenha($senha) {
    $this->senha = $senha;
  }

}


