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
  public static function findByCidadeFromSiglaEstado(string $sigla, string $nome_cidade)
  {
    $res = [];
    $conn = new Database();
    $result = $conn->executeQuery('SELECT ci.cidade_id, es.estado_id FROM cidade as ci JOIN estado as es ON (ci.sigla_estado = es.sigla) WHERE sigla_estado = :sigla and ci.nome = :cidade_nome', array(
      ':sigla' => strtoupper($sigla),
      ':cidade_nome' => $nome_cidade
    ));
    foreach ( $result->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $res['estado_id'] = $row['estado_id'];
      $res['cidade_id'] = $row['cidade_id'];
    }
    return $res;
  }

}
