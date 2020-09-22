<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class PessoaModel
{
  public int $id;
  public string $nome;
  public string $sobrenome;
  public int $endereco_id;
  public int $tipo_pessoa_id;
  public int $usuario_id;
  /**
  * Este método busca todos as pessoas armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM pessoa');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca uma pessoa armazenada na base de dados com um
  * determinado ID
  * @param    int     $id   Identificador único do usuário
  *
  * @return   array
  */
  public static function findById(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM pessoa WHERE id = :ID LIMIT 1', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

}