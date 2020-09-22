<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class EstadoModel
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
    $res = null;
    $estados['estados'] = [];
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM estado');
    $row = $result->fetchAll(PDO::FETCH_OBJ);
    $estados['count'] = count($row);
    for ($i=0; $i < count($row); $i++) { 
        $estados['estados'] = $row;
        $i++;
    }
    // echo json_encode($estados, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES);
    return $estados;
  }

  /**
  * Este método busca um tipo pessoa armazenada na base de dados com uma
  * determinada sigla
  * @param    string     $id   Identificador único do usuário
  *
  * @return   int
  */
  public static function findByEstadoFromSigla(string $type)
  {
    $tipo_pessoa_id = null;
    $conn = new Database();
    $result = $conn->executeQuery('SELECT estado_id FROM estado WHERE sigla = :type', array(
      ':type' => strtoupper($type)
    ));
    foreach ( $result->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $estado_id = $row['estado_id'];
    }
    return $estado_id;
  }

}
