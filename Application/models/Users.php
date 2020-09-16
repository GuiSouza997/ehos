<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Users
{
  /** Poderiamos ter atributos aqui */

  /**
  * Este método busca todos os usuários armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuarios');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca um usuário armazenados na base de dados com um
  * determinado ID
  * @param    int     $id   Identificador único do usuário
  *
  * @return   array
  */
  public static function findById(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuarios WHERE id = :ID LIMIT 1', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findUsersByAuth(string $email, string $senha = null)
  {
    if((isset($email) && isset($senha)) || isset($senha)){
      $conn = new Database();
      if(isset($email) && $senha == null){
        $dados_pesquisar = array(
          ':email' => '%'.$email.'%'
        );
      $result = $conn->executeQuery('SELECT * FROM usuarios WHERE email ILIKE :email LIMIT 1', $dados_pesquisar );
      }else if(isset($email) && isset($senha)){
        $dados_pesquisar = array(
          ':email' => '%'.$email.'%',
          ':senha' => $senha
        );
      $result = $conn->executeQuery('SELECT * FROM usuarios WHERE email ILIKE :email AND senha = :senha LIMIT 1', $dados_pesquisar );
      }
      $result->fetchAll(PDO::FETCH_ASSOC);
    }else{
      $result = null;
    }

    return $result;
  }
}
