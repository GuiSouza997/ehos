<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Users
{

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

  public static function findUsersByAuth(string $email= null, string $senha = null)
  {
    // $conn = new Database();
    // if((isset($email) && isset($senha)) || isset($email)){

    //   if(isset($email) && $senha == null){

    //     $result = $conn->prepare('SELECT email, senha FROM usuarios WHERE email ILIKE :email');
    //     $result->bindParam(':email', strtolower($email), PDO::PARAM_STR);
    //     if($result->execute()){
    //       $result->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return $result;     
    //   }else if(isset($email) && isset($senha)){
    //       $dados_pesquisar = array(
    //         ':email' => strtolower($email),
    //         ':senha' => $senha
    //       );
    //     $result = $conn->prepare('SELECT * FROM usuarios WHERE email = :email AND senha = :senha');
    //     $result->bindParam(':email', strtolower($email), PDO::PARAM_STR);
    //     $result->bindParam(':senha', strtolower($senha), PDO::PARAM_STR);
    //     if($result->execute()){
    //       $result->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return $result; 
    //   }else{
    //     return null;
    //   }
    // }
  }
}
