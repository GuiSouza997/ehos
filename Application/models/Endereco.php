<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Endereco
{

  /**
  * Este método busca todos os enderecos armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM endereco');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca um endereco armazenado na base de dados com um
  * determinado ID
  * @param    int     $id   Identificador único do usuário
  *
  * @return   array
  */
  public static function findById(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM endereco WHERE id = :ID', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }
}
