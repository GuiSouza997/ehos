<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class TipoPessoaModel
{
  public int $id;
  public int $tipo_pessoa;
  public int $sigla;

  /**
  * Este método busca todos os tipos pessoas armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM tipo_pessoa');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca um tipo pessoa armazenada na base de dados com um
  * determinado ID
  * @param    int     $id   Identificador único do usuário
  *
  * @return   array
  */
  public static function findByTypePessoa(string $type)
  {
    $tipo_pessoa_id = null;
    $conn = new Database();
    $result = $conn->executeQuery('SELECT tipo_pessoa_id FROM tipo_pessoa WHERE sigla = :type', array(
      ':type' => $type
    ));
    foreach ( $result->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $tipo_pessoa_id = $row['tipo_pessoa_id'];
    }
    return $tipo_pessoa_id;
  }

}
