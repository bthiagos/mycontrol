<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
	$query = $conn->query("SELECT *
						FROM alunos
						INNER JOIN alunoxresponsavel
						ON alunos.id = alunoxresponsavel.idaluno
						INNER JOIN responsavel
						ON responsavel.id = alunoxresponsavel.idresponsavel
						WHERE responsavel.id IS NOT NULL
						AND alunos.id IS NOT NULL
						ORDER BY alunos.id desc
						");

	
	$i = 1;

	$familia = $query->fetch_assoc();
}
?>
<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-familia">
		<input type="hidden" name="id" value="<?php echo $familia['id'] ?>">
		<div class="form-group">
			<label for="" class="control-label">Aluno</label>
			<select class="form-control select2" name="idaluno">
				<option class="form-control"></option>
				<?php
				$alunos = $conn->query("SELECT * FROM alunos where id IS NOT NULL");
				/* $alunos = $conn->query("SELECT alunos.id, alunos.nome
						FROM alunos
						INNER JOIN familia
						ON alunos.id = familia.idaluno
						INNER JOIN responsavel
						ON responsavel.id = familia.idresponsavel
						WHERE responsavel.id IS NOT NULL
						AND alunos.id IS NOT NULL
						AND familia.id = '{$_GET['id']}'
						
						"); */
				while ($row = mysqli_fetch_array($alunos)) { ?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['nome'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="sobrenome">Responsavel</label>

			<select class="form-control select2" name="idresponsavel">
				<option class="form-control"></option>
				<?php
				$resp = $conn->query("SELECT * FROM responsavel where id IS NOT NULL");
				while ($row = mysqli_fetch_array($resp)) { ?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['nome']." ". $row['sobrenome']?></option>
				<?php } ?>
			</select>
		</div>
	</form>
</div>

<script>
	$('#manage-familia').on('reset', function() {
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('#manage-familia').submit(function(e) {
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url: 'ajax.php?action=save_familia',
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
				} else {
					$('#msg').html('<div class="alert alert-danger mx-2">Ocorreu um erro, tente novamente!</div>')
					end_load()
				}
			}
		})
	})

	$('.select2').select2({
		placeholder: "Selecione aqui",
		width: '100%'
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