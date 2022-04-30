<?php
session_start();
?>
<html lang="pt-br">
<?php
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {
	$system = $conn->query("SELECT * FROM config_sistema limit 1")->fetch_array();
	foreach ($system as $k => $v) {
		$_SESSION['system'][$k] = $v;
	}
}
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets/login/fonts/icomoon/style.css">
	<link rel="stylesheet" href="assets/login/css/owl.carousel.min.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/login/css/bootstrap.min.css">
	<!-- Style -->
	<link rel="stylesheet" href="assets/login/css/style.css">
	<title><?php echo $_SESSION['system']['nome'] ?></title>

	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	?>

</head>

<body>
	<div id="preloader"></div>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="assets/login/images/bg-admin-3.png" alt="Image" class="img-head">
				</div>
				<div class="col-md-6 contents">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mb-4 text-center">
								<h3>Acesso do Colaborador</h3>
							</div>
							<form id="login-form">
								<div class="form-group first">
									<label for="usuario">Usuário</label>
									<input type="text" class="form-control" id="usuario" name="usuario">
								</div>
								<div class="form-group last mb-4">
									<label for="senha">Senha</label>
									<input type="password" class="form-control" id="senha" name="senha">
								</div>

								<!-- <div class="d-flex mb-5 align-items-center">
									<label class="control control--checkbox mb-0"><span class="caption">Lembrar-me</span>
										<input type="checkbox" checked="checked" />
										<div class="control__indicator"></div>
									</label>
								</div> -->
								<input type="submit" value="Entrar" class="btn btn-block btn-primary">
								<span class="d-block text-center my-4 h6" style="font-family: 'Raleway', sans-serif;">&mdash; Área do Responsável: <a href="../index.php">acesse aqui</a> &mdash;</span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="assets/login/js/jquery-3.3.1.min.js"></script>
	<script src="assets/login/js/popper.min.js"></script>
	<script src="assets/login/js/bootstrap.min.js"></script>
	<script src="assets/login/js/main.js"></script>
	<script>
		$(document).ready(function() {
			$('#preloader').fadeOut('fast', function() {
				$(this).remove();
			})
		})
	</script>

</html>