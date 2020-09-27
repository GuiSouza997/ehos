<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h2>Usuários</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Email</th>
              <th scope="col">Nível</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                 	$line=0;
                  foreach ($data['user'] as $user) { ?>
                    <tr>
                        <td><?php echo $data['user'][$line]['usuario_id'];?></td>
                        <td><?php echo  strtoupper($data['user'][$line]['email']) ?></td>
                        <?php
                          $level = null;
                          if($data['user'][$line]['nivel'] == 50){
                            $level = "Cliente";
                          }else if($data['user'][$line]['nivel'] == 40){
                            $level = "Operador";
                          }else if($data['user'][$line]['nivel'] == 30){
                            $level = "Administrador";
                          }
                        ?>
                        <td><?php echo $level  ?></td>
                      <?php
                          $status = null;
                          if($data['user'][$line]['status'] == 'A'){
                            $status = "Ativo";
                          }else if($data['user'][$line]['status'] == 'I'){
                            $status = "Inativo";
                          }
                        ?>
                        <td><?php echo $status  ?></td>
                    </tr>
                  <?php $line++;?>
                <?php }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
