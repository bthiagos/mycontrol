<style>
	.collapse a {
		text-indent: 10px;
	}

	/*nav#sidebar {
		background: url(assets/uploads/<?php echo $_SESSION['system']['img_path'] ?>) !important
	}*/
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark'>

	<div class="sidebar-list">
		<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span>&nbsp; Dashboard</a>

		<?php if ($_SESSION['login_tipo'] == 1): ?>
			<a href="index.php?page=students" class="nav-item nav-students"><span class='icon-field'><i class="fa fa-child "></i></span>&nbsp; Alunos</a>
		<?php endif; ?>
		<?php if ($_SESSION['login_tipo'] == 1): ?>
			<a href="index.php?page=responsavel" class="nav-item nav-responsavel nav-filhos"><span class='icon-field'><i class="fa fa-users"></i></span>&nbsp; Responsáveis</a>
		<?php endif; ?>
		<?php if ($_SESSION['login_tipo'] == 1): ?>
			<a href="index.php?page=familia" class="nav-item nav-familia"><span class='icon-field'><i class="fa fa-sitemap"></i></span>&nbsp; Família</a>
		<?php endif; ?>
		<?php if ($_SESSION['login_tipo'] == 3) : ?>
			<a href="index.php?page=filhos" class="nav-item nav-students"><span class='icon-field'><i class="fa fa-users "></i></span>&nbsp; Meus Filhos</a>
		<?php endif; ?>
		<a href="index.php?page=painel_registros" class="nav-item nav-painel_registros nav-painel_registros_todos"><span class='icon-field'><i class="fa fa-list-alt "></i></span>&nbsp; Registros</a>
		<?php if ($_SESSION['login_tipo'] == 1) : ?>
			<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-user "></i></span>&nbsp; Usuários</a>
			<a href="index.php?page=email_settings" class="nav-item nav-email_settings"><span class='icon-field'><i class="fa fa-envelope-square "></i></span>&nbsp; Config de E-mail</a>
			<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs "></i></span>&nbsp; Config de Sistema</a>
		<?php endif; ?>
		<?php if (($_SESSION['login_tipo'] == 1) || ($_SESSION['login_tipo'] == 2)) : ?>
			<a href="../control/index.php" class="nav-item nav-control" target="_blank"><span class='icon-field'><i class="fa fa-barcode text-danger"></i></span>&nbsp; SISTEMA DE PORTARIA</a>
		<?php endif; ?>
	</div>

</nav>
<script>
	$('.nav_collapse').click(function() {
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>