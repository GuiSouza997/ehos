<?php //include_once '../Application/views/templates/header.php' ?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
				<h3 class="text-center mt-3 text-center"><a href="/user/login"><i class="material-icons" style="font-size: 42px ;float:left;color:black">arrow_back</i></a>Criando sua conta</h3>
			</div>
		</div>
		<div class="error-exibition mt-3"></div>
		<div class="mt-3">
			<p class='message_success text-center'> <?php echo $data ;?></p>
		</div>
		<form action="/user/create" method="POST">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-3">
						<input type="text" class="form-control"name="nome" id="nome" placeholder="Nome" required>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
					</div>
					<div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 mt-3">
						<select class="form-control" id="tipos_pessoas" name="tipo_pessoa" required>
							<option value="#">Selecione o tipo de pessoa</option>
							<option value="pf">Pessoa Física</option>
							<option value="pj">Pessoa Jurídica</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder="Confirmar sua senha" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" required>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<select class="form-control" id="estado" name="estado" required>
							<option value="#">Selecione seu estado</option>
							<!-- <option value="">2</option> -->
						</select>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<select class="form-control" id="cidade" name="cidade" required>
							<option value="#">Selecione sua cidade</option>
							<!-- <option value="">2</option> -->
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="text" class="form-control" name="rua" id="rua" placeholder="Rua / Avenida" required>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-3">
						<input type="text" class="form-control" name="numero_casa" id="numero_casa" placeholder="Número / Apartamento">
					</div>
				</div>
				<div class="row">
					<button type="button" class="btn btn-secondary btn-lg btn-block m-3" id="btn-salvar">Salvar</button>
				</div>
			</div>
		</form>
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Cadastro de usuário</h3>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
	<?php //include_once "../Application/views/templates/jquery_bootstrap.php"; ?>
</body>
</html>
<script>
    window.onload = function (){
		<?php if(isset($data) || !empty($data)){ ?>
			$('.message_success').attr('class', 'alert alert-success');
		<?php } ?>
		// var requestURL = "../estado/searchEstadosFull/";
		// $.get(requestURL, function(data, status){
		// 	var json = JSON.parse(data);
		// 	console.log(json);
		// })
		// $("#estado").html("<option value='"+estadosigla+"' selected>"+estadosigla+"</option>");
		// $("#cidade").html("<option value='"+data.localidade+"' selected>"+data.localidade+"</option>");
        function validateEmail(email) 
        {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
		function validateSenhasIguais(first_pass, second_pass){
			if(first_pass === second_pass){
				return true;
			}else{
				return false;
			}
		}
		function limpa_formulário_cep() {
			// Limpa valores do formulário de cep.
			$("#rua").val("");
			$("#bairro").val("");
			$("#cidade").val("");
			$("#estado").val("");
		}
		function recuperarEstadoSigla(uf){
			var array_uf_estados = [];
			array_uf_estados["AC"] = "Acre";
			array_uf_estados["AL"] = "Alagoas";
			array_uf_estados["AP"] ="Amapá";
			array_uf_estados["AM"] = "Amazonas";
			array_uf_estados["BA"] = "Bahia";
			array_uf_estados["CE"] = "Ceará";
			array_uf_estados["DF"] = "Distrito Federal";
			array_uf_estados["ES"] = "Espirito Santo";
			array_uf_estados["GO"] = "Goiás";
			array_uf_estados["MA"] = "Maranhão";
			array_uf_estados["MS"] = "Mato Grosso do Sul";			
			array_uf_estados["MT"] = "Mato Grosso";
			array_uf_estados["MG"] = "Minas Gerais";
			array_uf_estados["PA"] = "Pará";			
			array_uf_estados["PB"] = "Paraíba";			
			array_uf_estados["PR"] = "Paraná";			
			array_uf_estados["PE"] = "Pernambuco";			
			array_uf_estados["PI"] = "Piauí";			
			array_uf_estados["RJ"] = "Rio de Janeiro";			
			array_uf_estados["RN"] = "Rio Grande do Norte";			
			array_uf_estados["RS"] = "Rio Grande do Sul";			
			array_uf_estados["RO"] = "Rondônia";			
			array_uf_estados["RR"] = "Roraima";	
			array_uf_estados["SC"] = "Santa Catarina";			
			array_uf_estados["SP"] = "São Paulo";			
			array_uf_estados["SE"] = "Sergipe";			
			array_uf_estados["TO"] = "Tocantins";

			var estado = array_uf_estados[uf];
			return estado;
		}
		//Quando o campo cep perde o foco.
		$("#cep").blur(function() {

			//Nova variável "cep" somente com dígitos.
			var cep = $(this).val().replace(/\D/g, '');

			//Verifica se campo cep possui valor informado.
			if (cep != "") {

				//Expressão regular para validar o CEP.
				var validacep = /^[0-9]{8}$/;

				//Valida o formato do CEP.
				if(validacep.test(cep)) {

					//Preenche os campos com "..." enquanto consulta webservice.
					// $("#rua").val("...");
					// $("#bairro").val("...");
					// $("#cidade").val("...");
					// $("#estado").val("...");
					// $("#numero_casa").val("...");

					//Consulta o webservice viacep.com.br/
					var url = "https://viacep.com.br/ws/"+ cep +"/json/";
					$.getJSON(url).done(function(data){
						var estadosigla = recuperarEstadoSigla(data.uf);
						$("#estado").html("<option value='"+data.uf+"' selected>"+estadosigla+"</option>");
						$("#cidade").html("<option value='"+data.localidade+"' selected>"+data.localidade+"</option>");
						$("#bairro").val(data.bairro);
						$("#rua").val(data.logradouro);
						$("#cep").val(data.cep);
					})
				} //end if.
				else {
					//cep é inválido.
					limpa_formulário_cep();
					alert("Formato de CEP inválido.");
				}
			} //end if.
			else {
				//cep sem valor, limpa formulário.
				limpa_formulário_cep();
			}
		});
        $("#btn-salvar").click(function(){
			$('.error-exibition').hide();
			var tipos_pessoas = $('#tipos_pessoas').val();	
			var estado = $('#estado').val();	
			var cidade = $('#cidade').val();	
            var email = $('#email').val();
            var senha = $('#senha').val();
			var confirmarSenha = $('#confirmarSenha').val();
			var cep = $('#cep').val();
			var message_error= [];
			var control_error = false;
            //var errors = array(0 = 'O campo senha não pode estar vazio!', 1 = 'O campo email não pode estar vazio!', 3 = 'O campo email deve conter um email válido!', 4 = 'A senha deve conter no mínimo 2 números, 1 letra maiuscula e 4 minuscula');
            if(tipos_pessoas == "#"){
                message_error[1] = "<div class='alert alert-danger' role='alert'>* É necessário selecionar um tipo de pessoa</div>";
				control_error = true;
            }else if(estado == "#"){	
                message_error[2] = "<div class='alert alert-danger' role='alert'>* É necessário selecionar um estado </div>";
				control_error = true;
            }else if(cidade == "#"){	
                message_error[3] = "<div class='alert alert-danger' role='alert'>* É necessário selecionar um cidade </div>";
				control_error = true;
            }else if(!$('#nome').val()){
			    message_error[5] = "<div class='alert alert-danger' role='alert'>* O campo nome não pode estar vazio </div>";
				control_error = true;
			}else if($('#nome').val().length < 3){
			    message_error[6] = "<div class='alert alert-danger' role='alert'>* O campo nome deve conter no mínimo 3 letras</div>";
				control_error = true;
			}else if(!email){
                message_error[7] = "<div class='alert alert-danger' role='alert'>* O campo email não pode estar vazio</div>";
				control_error = true;
            }else if(!validateEmail(email)){
                message_error[8] = "<div class='alert alert-danger' role='alert'>* O campo email deve conter um email válido</div>";
				control_error = true;
            }else if(!senha){
				message_error[9] = "<div class='alert alert-danger' role='alert'>* O campo senha não pode estar vazio </div>";	
				control_error = true;
			}else if(!confirmarSenha){
				message_error[10] = "<div class='alert alert-danger' role='alert'>* O campo confirmar senha não pode estar vazio </div>";
				control_error = true;
			}else if(!senha && !confirmarSenha){
				message_error[11] = "<div class='alert alert-danger' role='alert'>* O campo senha não pode estar vazio </div>";	
				message_error[12] = "<div class='alert alert-danger' role='alert'>* O campo confirmar senha não pode estar vazio </div>";	
				control_error = true;
			}else if(validateSenhasIguais(senha, confirmarSenha) == false){
				message_error[13] = "<div class='alert alert-danger' role='alert'>* Para prosseguir o cadastro, as senhas deverão serem iguais</div>";
				control_error = true;
			}else if(!$('#cep').val()){
			    message_error[14] = "<div class='alert alert-danger' role='alert'>* O campo CEP não pode estar vazio </div>";
				control_error = true;
			}else if($('#cep').val().length < 8){
			   message_error[15] = "<div class='alert alert-danger' role='alert'>* O campo CEP deve conter no mínimo 8 números</div>";
			   control_error = true;
			}else{	
			   message_error = [];
			   control_error = false;
			}	

			if(control_error){
				$('.error-exibition').show();
				if(message_error.length > 0){
					for(var i = 0; i < message_error.length; i++){
						$('.error-exibition').html(message_error[i]);
					}
				}
			}else{
				$('#btn-salvar').attr('type', 'submit');
				$('#btn-salvar').submit();
				// var val_nome = $('#nome').val();
				// var val_sobrenome = $('#sobrenome').val();
				// var val_tipo_pessoa = $('#tipos_pessoas').val();
				// var val_email = btoa($('#email').val());
				// var val_senha = btoa($('#senha').val());
				// var val_estado = $('#estado').val();
				// var val_cidade = $('#cidade').val();
				// var val_cep = $('#cep').val();
				// var val_bairro = $('#bairro').val();
				// var val_rua = $('#rua').val();
				// var val_numero = $('#numero_casa').val();

				// $.ajax ({
                //     type: "POST",
                //     url: "/user/data_create",
                //     data: {
				// 	nome: val_nome,
				// 	sobrenome: val_sobrenome,
				// 	tipo_pessoa: val_tipo_pessoa,
				// 	email: val_email,
				// 	senha: val_senha,
				// 	estado: val_estado,
				// 	cidade: val_cidade,
				// 	cep: val_cep,
				// 	bairro: val_bairro,
				// 	rua: val_rua,
				// 	numero: val_numero
				// 	},
                //     cache: false,
                //     success: function(result) {
						
                //  	}
              	// });
			}
        //     //if(errors == false){

        //         // $('#btn-salvar').attr('disable', true);
        //     //}
        //     // $.post("./views/users/validateAcesso.php",{email= email, password= password}, function( data ) {
        //     // 	console.log(data);
        //     // });
        })
    };
    
</script>