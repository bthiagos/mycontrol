<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * from config_email limit 1");
if ($qry->num_rows > 0) {
	foreach ($qry->fetch_array() as $k => $val) {
		$meta[$k] = $val;
	}
}
?>
<div class="container-fluid">
	<br>
	<div class="col-lg-12">

		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Configurações de E-mail</b>
					</div>
					<div class="card-body">
						<form action="" id="manage-email-settings">
							<div class="form-group">
								<label for="host" class="control-label">Host</label>
								<input type="text" class="form-control" id="host" name="host" value="<?php echo isset($meta['host']) ? $meta['host'] : '' ?>" required>
							</div>
							<div class="form-group">
								<label for="Porta" class="control-label">Porta</label>
								<input type="text" class="form-control" id="porta" name="porta" value="<?php echo isset($meta['porta']) ? $meta['porta'] : '' ?>" required>
							</div>
							<div class="form-group">
								<label for="Usuário" class="control-label">Usuário</label>
								<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo isset($meta['usuario']) ? $meta['usuario'] : '' ?>" required>
							</div>
							<div class="form-group">
								<label for="Senha" class="control-label">Senha</label>
								<input type="password" class="form-control" id="senha" name="senha" value="<?php echo isset($meta['senha']) ? $meta['senha'] : '' ?>" required>
							</div>
							<center>
								<button class="btn btn-info btn-primary btn-block col-md-2">Salvar</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
		img#cimg {
			max-height: 10vh;
			max-width: 6vw;
		}
	</style>

	<script>
		function displayImg(input, _this) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#cimg').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
		$('.text-jqte').jqte();

		$('#manage-email-settings').submit(function(e) {
			e.preventDefault()
			start_load()
			$.ajax({
				url: 'ajax.php?action=save_email_settings',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				success: function(resp) {
					if (resp == 1) {
						alert_toast('Dados salvos com sucesso!', 'success')
						setTimeout(function() {
							location.reload()
						}, 1000)
					}
					else {
						alert_toast('Ocorreu um erro!', 'danger')
						setTimeout(function() {
							location.reload()
						}, 1000)
					}
				}
			})

		})
	</script>
	<style>

	</style>
</div>