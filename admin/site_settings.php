<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * from config_sistema limit 1");
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
						<b>Configurações do Sistema</b>
					</div>
					<div class="card-body">
						<form action="" id="manage-settings">
							<div class="form-group">
								<label for="nome" class="control-label">Nome do Sistema</label>
								<input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($meta['nome']) ? $meta['nome'] : '' ?>" required>
							</div>
							<div class="form-group">
								<label for="email" class="control-label">E-mail</label>
								<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required>
							</div>
							<div class="form-group">
								<label for="contato" class="control-label">Telefone</label>
								<input type="text" class="form-control" id="contato" name="contato" value="<?php echo isset($meta['contato']) ? $meta['contato'] : '' ?>" required>
							</div>
							<div class="form-group">
								<label for="sobre" class="control-label">Sobre</label>
								<textarea name="sobre" class="text-jqte"><?php echo isset($meta['sobre']) ? $meta['sobre'] : '' ?></textarea>

							</div>
							<div class="form-group">
								<label for="" class="control-label">Imagem</label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>
							<div class="form-group">
								<img src="<?php echo isset($meta['img_path']) ? 'assets/uploads/' . $meta['img_path'] : '' ?>" alt="" id="cimg">
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

		$('#manage-settings').submit(function(e) {
			e.preventDefault()
			start_load()
			$.ajax({
				url: 'ajax.php?action=save_settings',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				error: err => {
					console.log(err)
				},
				success: function(resp) {
					if (resp == 1) {
						alert_toast('Dados salvos com sucesso!', 'success')
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