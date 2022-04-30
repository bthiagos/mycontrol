<?php
include('../admin/db_connect.php');
session_start();
if (isset($_GET['id'])) {
	$user = $conn->query("SELECT * FROM responsavel where id =" . $_GET['id']);
	foreach ($user->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
}
?>
<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-responsavel">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" value="<?php echo isset($meta['nome']) ? $meta['nome'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="sobrenome">Sobrenome</label>
			<input type="text" name="sobrenome" id="sobrenome" class="form-control" value="<?php echo isset($meta['sobrenome']) ? $meta['sobrenome'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required autocomplete="off">
		</div>
		<div class="form-group">
			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha" class="form-control" value="<?php echo isset($meta['senha']) ? '' : '' ?>" required>
			<a href="#" class="font-weight-bold" id="olho">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
				Mostrar senha
			</a>
		</div>
		<!--<div class="form-group">
			<label for="aceita_email">Aceita receber e-mail e notificações?</label>
			<select name="aceita_email" id="aceita_email" class="custom-select">
				<option value="1" <?php echo isset($meta['aceita_email']) && $meta['aceita_email'] == 1 ? 'selected' : '' ?>>Sim</option>
				<option value="0" <?php echo isset($meta['aceita_email']) && $meta['aceita_email'] == 0 ? 'selected' : '' ?>>Não</option>
			</select>
		</div>-->
	</form>
</div>
<script>
	/* $('#manage-user').submit(function(e) {
		e.preventDefault();
		start_load()
		$.ajax({
			url: '../admin/ajax.php?action=save_responsavel',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Dados salvos com sucesso", 'success')
					setTimeout(function() {
						location.reload()
					})
				}
			}
		})
	}) */

	$('#manage-responsavel').on('reset', function() {
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('#manage-responsavel').submit(function(e) {
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url: '../admin/ajax.php?action=save_responsavel',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Dados salvos com sucesso.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1000)
				} else if (resp == 2) {
					$('#msg').html('<div class="alert alert-danger mx-2">Usuário Responsável já existe!</div>')
					end_load()
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