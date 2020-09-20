<?php

use Application\core\Controller;
use Application\models\UsersModel;
class User extends Controller
{
  /**
  * chama a view index.php da seguinte forma /user/index   ou somente   /user
  * e retorna para a view todos os usuários no banco de dados.
  */
  public function index()
  {
    $users = $this->model('UsersModel'); // é retornado o model Users()
    $data = $users::findAll();
    $this->view('user/index', ['users' => $data]);
  }

  /**
  * chama a view show.php da seguinte forma /user/show passando um parâmetro 
  * via URL /user/show/id e é retornado um array contendo (ou não) um determinado
  * usuário. Além disso é verificado se foi passado ou não um id pela url, caso
  * não seja informado, é chamado a view de página não encontrada.
  * @param  int   $id   Identificado do usuário.
  */
  public function show($id = null)
  {
    if (is_numeric($id)) {
      $users = $this->model('UsersModel');
      $data = $users::findById($id);
      $this->view('user/show', ['user' => $data]);
    } else {
      $this->pageNotFound();
    }
  }

  public function login($email='guilherme26497@gmail.com', $senha= null)
  {
    if (isset($email)) {
      $users = $this->model('UsersModel');
      $data = $users::findUsersByAuth('guilherme26497@gmail.com',null);
      $this->view('user/login', ['user' => $data]);
    } else {
      $this->pageNotFound();
    }
  }

  public function create()
  {
    if ($this->create_user()) {
      
      echo "<pre>"; 
      print_r($this->create_user());
      echo "</pre>";
      die();
      // $users = $this->model('Users');
      // $data = $users::findUsersByAuth('guilherme26497@gmail.com', null);
      $this->view('user/create', ['user' => 'dados']);
    } else {
      $this->pageNotFound();
    }
  }

  public function create_user()
  {
      $users = $this->model('UsersModel');
      if(isset($_POST)){
        // $users = !empty(strtolower($_POST['email'])) ? strtolower($_POST['email']) : null;
        // $users->senha = !empty(strtolower($_POST['password'])) ? strtolower($_POST['password']) : null;
        // if(!is_null($users->email) && !is_null($users->senha)){
        //   // $data = $users::findUsersByAuth($email);
        //   $data = "Email: ".$users->email." Senha: ".$users->senha;
        // }
        $data = "EUU";
      }
      //$this->view('user/create', ['user' => $data]);
    // } else {
    //   $this->pageNotFound();
    // }
    return $data;
  }

}
