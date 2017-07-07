<?php

namespace Peteno;

class Produto {

  private $idProduto;
  private $nome;
  private $valor;

  use HydratorPersist;

  protected function getPrimaryKeyName() {
    return 'idProduto';
  }

  public function getId() {
    return $this->getIdProduto ();
  }

  public function getIdProduto() {
    return $this->idProduto;
  }

  public function setIdProduto($idProduto) {
    $this->idProduto = $idProduto;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getValor() {
    return $this->valor;
  }

  public function setValor($valor) {
    $this->valor = $valor;
  }

}
