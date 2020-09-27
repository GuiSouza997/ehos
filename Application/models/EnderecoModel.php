<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class EnderecoModel
{
  public int $id;
  public string $bairro;
  public string $rua;
  public int $numero;
  public int $estado_id;
  public int $cidade_id;
  
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
  public function InsertEndereco($estado_id, $cidade_id, $bairro, $rua, $numero = null){
    $conn = new Database();
    $stmt = $conn->conn->prepare('INSERT INTO endereco (estado_id, cidade_id, bairro, rua, numero ) VALUES(:estado_id, :cidade_id, :bairro, :rua, :numero)');
    $result = $stmt->execute(array(
      ':estado_id' => $estado_id,
      ':cidade_id' => $cidade_id,
      ':bairro' => $bairro,
      ':rua' => $rua,
      ':numero' => is_null($numero) ? '': $numero,
    ));
    if($result){
      $registered = true;
    }else{
      $registered = false;
    }
    return $registered;   
  }

  public static function findByLastEnderecoCreated()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT endereco_id FROM endereco ORDER BY endereco_id DESC LIMIT 1');

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }
}
