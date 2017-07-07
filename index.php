<?php

require 'vendor/autoload.php';

$config = json_decode(file_get_contents('config.json'));

$dsn = 'mysql:dbname=aula;host=localhost';
$db = new \PDO($dsn, $config->user, $config->pass);

try {
  $db->beginTransaction();

  $produto = new Peteno\Produto();
  $produto->hydrate(array(
//       'idProduto' => 60,
      'nome' => 'Feijao '. time(),
      'valor' => '52.5'

  ));
  $produto->save($db);

  $usuario = new Peteno\Usuario();
  $usuario->hydrate(array(
      'email' => 'teste@teste.com.br'. time(),
      'senha' => '123456'
  ));
  $usuario->save($db);

  $db->commit();

  echo 'Produto/Usuario salvo com sucesso';
} catch (Exception $e) {
  $db->rollBack();

  echo 'Erro na gravação: ' . $e->getMessage();
}
