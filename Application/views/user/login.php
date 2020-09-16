
<?php include_once '../Application/views/templates/header.php' ?>
<body>
<div class="container h-150">
	<div class="d-flex justify-content-center h-100">
		<div class="user_card">
			<div class="d-flex justify-content-center">
				<div class="">
					<img src="../Application/views/templates/img/logo_principal.png" alt="Logo" height="250" width="300">
				</div>
			</div>
			<div id="error-exibition" class='ml-5 mr-5'></div>
			<div class="d-flex justify-content-center form_container">
				<form action="" method="post" name="form_login">
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="email" class="form-control input_user" id="email" placeholder="Email">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control input_pass" id="password" placeholder="Senha">
					</div>
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customControlInline">
							<label class="custom-control-label" for="customControlInline">Remember me</label>
						</div>
					</div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="button" name="button" class="btn login_btn" id="btn-login">Login</button>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            Não possui uma conta? <a href="./new_user.php" class="ml-2">Criar Conta</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                            <a href="#">Esqueceu sua senha?</a>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include_once "../Application/views/templates/jquery_bootstrap.php"; ?>
</body>
</html>
<script>
    $('document').ready(function(){
        function validateEmail(email) 
        {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
        
        $("#btn-login").click(function(){
            var email = $('#email').val();
            var password = $('#password').val();
            //var errors = array(0 => 'O campo senha não pode estar vazio!', 1 => 'O campo email não pode estar vazio!', 3 => 'O campo email deve conter um email válido!', 4 => 'A senha deve conter no mínimo 2 números, 1 letra maiuscula e 4 minuscula');
            if(email == ''){
                $('#error-exibition').html("<div class='alert alert-danger' role='alert'>O campo email não pode estar vazio!</div>")
            }
            if(!validateEmail(email)){
                $('#error-exibition').html("<div class='alert alert-danger' role='alert'>O campo email deve conter um email válido</div>")
            }else{
                $('#error-exibition').html("");
            }
            // $.post("./views/users/validateAcesso.php",{email: email, password: password}, function( data ) {
            // 	console.log(data);
            // });
        })
    })
    
</script>