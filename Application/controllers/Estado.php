<?php

use Application\core\Controller;
use Application\models\EstadoModel;
use Application\models\CidadeModel;
class Estado extends Controller
{
  /**
  * chama a view index.php da seguinte forma /user/index   ou somente   /user
  * e retorna para a view todos os usuários no banco de dados.
  */
  public function index()
  {
    $users = $this->model('EstadoModel'); // é retornado o model Users()
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
      $this->view('estado/show', ['estado' => $data]);
    } else {
      $this->pageNotFound();
    }
  }

  public function searchEstadosFull()
  {
    $data = null;
    $user_id = null;
    $estado_exec = $this->model('EstadoModel');
    $estados = $estado_exec->findAll(); 
    return $estados;
  }

}
