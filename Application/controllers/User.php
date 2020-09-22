<?php

use Application\core\Controller;
use Application\models\UsersModel;
use Application\models\TipoPessoaModel;
use Application\models\EnderecoModel;
use Application\models\EstadoModel;
use Application\models\CidadeModel;
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
    $eu = true;
    if (isset($eu)) {
      
      echo "<pre>"; 
      print_r($this->data_create());
      echo "</pre>";
      // $users = $this->model('Users');
      // $data = $users::findUsersByAuth('guilherme26497@gmail.com', null);
      $this->view('user/create', ['user' => 'dados']);
    } else {
      $this->pageNotFound();
    }
  }

  public function data_create()
  {
      $data = null;
      $user_id = null;
      $users = $this->model('UsersModel');
      $tipopessoa_user = $this->model('TipoPessoaModel');
      $endereco_user = $this->model('EnderecoModel');
      $estado_user = $this->model('EstadoModel');
      $cidade_user = $this->model('CidadeModel');
      $user = new UsersModel;
      $tipo_pessoa = new TipoPessoaModel;
      $endereco = new EnderecoModel;
      $endereco = new EstadoModel;
      $endereco = new CidadeModel;
      if(isset($_POST) && !empty($_POST)){
          $user->email = isset($_POST['email']) ? $_POST['email'] : '';
          $user->senha = isset($_POST['senha']) ? md5($_POST['senha']) : '';
          $user->nivel = 50;
          $user->status = 'A';
          $tipo_pessoa->id = $tipopessoa_user->findByTypePessoa($_POST['tipo_pessoa']); // TIPO PESSOA SELECIONADO 
          // $user_inserted = $users->InsertUsers($user->email, $user->senha, $user->nivel, $user->status) ? true : false;
          // if($user_inserted){
          //   $res = "Usuario inserido com sucesso";
          // $user_id = $users->searchUserByEmail($user->email);
            // findByTypePessoa($_POST['tipos_pessoa']);
          // }else{
          //   $res = "Não foi possível inserir o usuário :(";
          // }
        


    // [sobrenome] => DE SOUZA
    // [tipos_pessoas] => pf
    // [email] => guilherme26497@gmail.com
    // [senha] => 123
    // [estado] => São Paulo
    // [cidade] => Bebedouro
    // [confirmarSenha] => 123
    // [cep] => 14709-192
    // [bairro] => Residencial Doutor Pedro Paschoal
    // [rua] => Rua Júlio César Staconi
    // [numero_casa]

        // $users = !empty(strtolower($_POST['email'])) ? strtolower($_POST['email']) : null;
        // $users->senha = !empty(strtolower($_POST['password'])) ? strtolower($_POST['password']) : null;
        // if(!is_null($users->email) && !is_null($users->senha)){
        //   // $data = $users::findUsersByAuth($email);
        //   $data = "Email: ".$users->email." Senha: ".$users->senha;
        // }
        $data = $tipo_pessoa->id;
      }
      //$this->view('user/create', ['user' => $data]);
    // } else {
    //   $this->pageNotFound();
    // }
    return $data;
  }

}
