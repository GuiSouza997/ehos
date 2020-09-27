<?php

use Application\core\Controller;
use Application\models\UsersModel;
use Application\models\PessoaModel;
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
    $data = $users->findAll();
    $this->view('user/index', ['user' => $data]);
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
    //if (is_numeric($id)) {
      if(true){
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
    if (true) {
      $data = $this->data_create();
      $this->view('user/create', $data);
    } else {
      $this->pageNotFound();
    }
  }

  public function data_create()
  {
      $data = null;
      $res  = null;
      $user_id = null;
    if(isset($_POST) && !empty($_POST)){
      $users = $this->model('UsersModel');
      $pessoa_user = $this->model('PessoaModel');
      $tipopessoa_user = $this->model('TipoPessoaModel');
      $endereco_user = $this->model('EnderecoModel');
      $estado_user = $this->model('EstadoModel');
      $cidade_user = $this->model('CidadeModel');
      $user = new UsersModel;
      $pessoa = new PessoaModel;
      $tipo_pessoa = new TipoPessoaModel;
      $endereco = new EnderecoModel;
      $estado = new EstadoModel;
      $cidade = new CidadeModel;
      if(isset($_POST) && !empty($_POST)){
        $user->email = isset($_POST['email']) ? $_POST['email'] : '';
        $user->senha = isset($_POST['senha']) ? md5($_POST['senha']) : '';
        $user->nivel = 50;
        $user->status = 'A';
        if((isset($_POST['tipo_pessoa']) && !empty($_POST['tipo_pessoa'])) && (isset($_POST['estado']) && !empty($_POST['estado'])) && (isset($_POST['cidade']) && !is_null($_POST['cidade']))){
          $tipo_pessoa->id = $tipopessoa_user->findByTypePessoa($_POST['tipo_pessoa']); // TIPO PESSOA SELECIONADO 
          $cidade_estado = $cidade_user->findByCidadeFromSiglaEstado($_POST['estado'], $_POST['cidade']);
          $estado->id = $cidade_estado['estado_id'];
          $cidade->id = $cidade_estado['cidade_id'];
        }
        $endereco->bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
        $endereco->rua = isset($_POST['rua']) ? $_POST['rua'] : null;
        $endereco->numero = isset($_POST['numero_casa']) ? $_POST['numero_casa'] : null;
        if((isset($endereco->bairro) && !is_null($endereco->bairro)) && (isset($endereco->rua) && !is_null($endereco->rua)) && (isset($endereco->numero) && !is_null($endereco->numero))){
          $endereco_inserted = $endereco_user->InsertEndereco($estado->id, $cidade->id, $endereco->bairro, $endereco->rua, $endereco->numero ) ? true : false;        
        }
        $user_inserted = $users->InsertUsers($user->email, $user->senha, $user->nivel, $user->status) ? true : false;
        if($user_inserted && $endereco_inserted && (isset($tipo_pessoa->id) && !empty($tipo_pessoa->id))){
          $user_id = $users->searchUserByEmail($user->email);
          $user->id = $user_id;
          $endereco_data = null;
          $endereco_data = $endereco_user->findByLastEnderecoCreated();
          $endereco->id = $endereco_data[0]['endereco_id'];
          //$endereco->id = $endereco_id;
          if((isset($user->id) && !empty($user->id)) && (isset($endereco->id) && !empty($endereco->id)) && (isset($tipo_pessoa->id) && !empty($tipo_pessoa->id))){
              $pessoa->nome = $_POST['nome'];
              $pessoa->sobrenome = $_POST['sobrenome'];
              $pessoa_inserted = $pessoa_user->InsertPessoa($pessoa->nome, $pessoa->sobrenome, $tipo_pessoa->id, $endereco->id, $user->id) ? true : false;
              if($pessoa_inserted){
                $res = "Usuário cadastrado com sucesso";
              }else{
                $res = "Não foi possível cadastrar o usuário :(";
              }
          }
        }else{
          $res = "Não foi possível cadastrar o usuário :(";
        }
        // $users = !empty(strtolower($_POST['email'])) ? strtolower($_POST['email']) : null;
        // $users->senha = !empty(strtolower($_POST['password'])) ? strtolower($_POST['password']) : null;
        // if(!is_null($users->email) && !is_null($users->senha)){
        //   // $data = $users::findUsersByAuth($email);
        //   $data = "Email: ".$users->email." Senha: ".$users->senha;
        // }
      $data = $res;
      }
      return $data;
    }
  }

  public function painel($user_id, $level){

    if (true) {
      // $users = $this->model('UsersModel');
      // $data = $users::findUsersByAuth('guilherme26497@gmail.com',null);
      $data = 'Painel Administrativo!';
      $this->view('painel/admin', ['user' => $data]);
    } else {
      $this->pageNotFound();
    }
  }
}
