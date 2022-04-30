<?php
include('db_connect.php');
session_start();
if (isset($_GET['id'])) {
	$user = $conn->query("SELECT * FROM usuarios where id =" . $_GET['id']);
	foreach ($user->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
}
?>
<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" value="<?php echo isset($meta['nome']) ? $meta['nome'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="usuario">Usuário</label>
			<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo isset($meta['usuario']) ? $meta['usuario'] : '' ?>" required autocomplete="off">
		</div>
		<div class="form-group">

			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha" class="form-control" value="<?php echo isset($meta['senha']) ? '' : '' ?>" required>
			<a href="#" class="font-weight-bold" id="olho">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
				Mostrar senha
			</a>
		</div>
	</form>
</div>
<script>
	$('#manage-user').submit(function(e) {
		e.preventDefault();
		start_load()
		$.ajax({
			url: 'ajax.php?action=edit_user',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Dados salvos com sucesso", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				}
			}
		})
	})

	var senha = $('#senha');
	var olho = $("#olho");

	olho.mousedown(function() {
		senha.attr("type", "text");
	});

	olho.mouseup(function() {
		senha.attr("type", "password");
	});
	// para evitar o problema de arrastar a imagem e a senha continuar exposta, 
	//citada pelo nosso amigo nos comentários
	$("#olho").mouseout(function() {
		$("#senha").attr("type", "password");
	});
</script>