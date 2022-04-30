<?php
extract($_POST);

?>

<div class="container-fluid">
	<div class="col-lg-12 ">
		<form id="registros_presenca" enctype="multipart/form-data">
			<input type="hidden" name="type" value="<?php echo $type ?>">
			<div id="msg"></div>
			<div class="h-40 w-100">
				<div class="form-group">
					<input type="text" class="form-control" name="id_code" id="id_code" autofocus>
				</div>
			</div>
		</form>
	</div>
</div>
<style>
	img.foto {
		max-width: 130px;
		max-height: 150px;
	}

	img#cimg,
	.cimg {
		max-height: 10vh;
		max-width: 6vw;
	}
</style>
<script>
	$(document).ready(function() {
		$('button,input').blur()
		setTimeout(function() {
			$("[name='id_code']").get(0).focus()
		}, 300)
	})
	$('#registros_presenca').submit(function(e) {
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url: '../admin/ajax.php?action=save_log',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				resp = JSON.parse(resp)
				if (resp.status == 1) {
					alert_toast("Dados registrados com sucesso!", 'success')
					if (resp.tipo == 1) {

						const userphoto = resp.img_path ? resp.img_path : "default.png";
						let matricula = resp.matricula;
						let nome = resp.nome;
						let email = resp.email;
						let novaHora = new Date();
						let hora = novaHora.getHours();
						let minuto = novaHora.getMinutes();
						minuto = minuto > 9 ? minuto : '0' + minuto;
						const profile = `<div class="row">
											<div class="col-sm-6 col-md-4">
												<img class="foto "src="../admin/assets/uploads/${userphoto}" class="rounded responsive" />
											</div>
											<div class="col-sm-6 col-md-8 text-center">
												<h2 class="text-success border"><b>ENTRADA</b></h2><br />
												<b>Horário</b><br />
												<h1 class="border"><b>${hora}:${minuto}</b></h1><br />
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-12">
												<b>Aluno(a)</b><br />
												<h2 class=""><b>${resp.nome}</b></h2>
											</div>
										</div>
										<br/>`;

						$('#msg').html(profile);
						$("#log-records").load(location.href + " #log-records");
						$("[name='id_code']").val('').focus()
						end_load()
					} else {
						const userphoto = resp.img_path ? resp.img_path : "default.png";
						let matricula = resp.matricula;
						let name = resp.nome;
						let email = resp.email;
						let novaHora = new Date();
						let hora = novaHora.getHours();
						let minuto = novaHora.getMinutes();
						minuto = minuto > 9 ? minuto : '0' + minuto;
						const profile = `<div class="row">
											<div class="col-sm-6 col-md-4">
												<img class="foto "src="../admin/assets/uploads/${userphoto}" class="rounded responsive" />
											</div>
											<div class="col-sm-6 col-md-8 text-center">
												<h2 class="text-danger border"><b>SAÍDA</b></h2><br />
												<b>Horário</b><br />
												<h1 class="border"><b>${hora}:${minuto}</b></h1><br />
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-12">
												<b>Aluno(a)</b><br />
												<h2 class=""><b>${resp.nome}</b></h2>
											</div>
										</div>
										<br/>`;

						$('#msg').html(profile);
						$("#log-records").load(location.href + " #log-records");
						$("[name='id_code']").val('').focus()
						end_load()
					}

				} else if (resp.status == 2) {
					const userphoto = resp.img_path ? resp.img_path : "error.png";
					let matricula = resp.matricula;
					let nome = resp.nome;
					let email = resp.email;
					let novaHora = new Date();
					let hora = novaHora.getHours();
					let minuto = novaHora.getMinutes();
					minuto = minuto > 9 ? minuto : '0' + minuto;
					const profile = `<div class="row">
											<div class="col-sm-6 col-md-4">
												<img class="foto "src="../admin/assets/uploads/${userphoto}" class="rounded responsive" />
											</div>
											<div class="col-sm-6 col-md-8 text-center">
												<h2 class="text-danger border"><b>ATENÇÃO!!!</b></h2><br />
												<b>Horário</b><br />
												<h1 class="border text-danger"><b>${hora}:${minuto}</b></h1><br />
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-12">
												<b>Aluno(a)</b><br />
												<h2 class="text-danger"><b>MATRÍCULA INEXTISTENTE!</b></h2>
											</div>
										</div>
										<br/>`;

					$('#msg').html(profile);
					$("[name='id_code']").val('').focus()
					end_load()
				} else if (resp.status == 3) {
					const userphoto = resp.img_path ? resp.img_path : "error.png";
					let matricula = resp.matricula;
					let nome = resp.nome;
					let email = resp.email;
					let novaHora = new Date();
					let hora = novaHora.getHours();
					let minuto = novaHora.getMinutes();
					minuto = minuto > 9 ? minuto : '0' + minuto;
					const profile = `<div class="row">
											<div class="col-sm-6 col-md-4">
												<img class="foto "src="../admin/assets/uploads/error.png" class="rounded responsive" />
											</div>
											<div class="col-sm-6 col-md-8 text-center">
												<h2 class="text-danger border"><b>ATENÇÃO!!!</b></h2><br />
												<b>Horário</b><br />
												<h1 class="border text-danger"><b>${hora}:${minuto}</b></h1><br />
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-12">
												<b>Aluno(a)</b><br />
												<h2 class="text-danger"><b>Limite Ultrapassado!</</b></h2>
											</div>
										</div>
										<br/>`;

					$('#msg').html(profile);
					$("[name='id_code']").val('').focus()
					end_load()
				}
			}

		})
	})
</script>