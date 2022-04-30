<style>
	.collapse a {
		text-indent: 10px;
	}

	/* nav#sidebar {
		background: url(assets/uploads/<?php echo $_SESSION['system']['img_path'] ?>) !important
	} */
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark'>
	<div class="sidebar-list navbar-nav">
		<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span>&nbsp; Dashboard</a>
		<a href="index.php?page=filhos" class="nav-item nav-filhos"><span class='icon-field'><i class="fa fa-users "></i></span>&nbsp; Meus Filhos</a>
		<a href="index.php?page=painel_registros_todos" class="nav-item nav-painel_registros nav-painel_registros_todos"><span class='icon-field'><i class="fa fa-list-alt "></i></span>&nbsp; Registros</a>
	</div>
</nav>
<script>
	$('.nav_collapse').click(function() {
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>