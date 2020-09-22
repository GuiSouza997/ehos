<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class CidadeModel
{
  public int $id;
  public int $nome;
  public int $sigla;

  /**
  * Este método busca todos os estados armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM cidade');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca um tipo pessoa armazenada na base de dados com uma
  * determinada sigla
  * @param    string     $id   Identificador único do usuário
  *
  * @return   int
  */
  public static function findByCidadeFromSiglaEstado(string $type)
  {
    $tipo_pessoa_id = null;
    $conn = new Database();
    $result = $conn->executeQuery('SELECT cidade_id FROM cidade WHERE sigla_estado = :type', array(
      ':type' => strtoupper($type)
    ));
    foreach ( $result->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $estado_id = $row['cidade_id'];
    }
    return $estado_id;
  }

}
