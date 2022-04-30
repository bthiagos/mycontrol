<?php include('db_connect.php'); ?>
<style>
	input[type=checkbox] {
		/* Double-sized Checkboxes */
		-ms-transform: scale(1.3);
		/* IE */
		-moz-transform: scale(1.3);
		/* FF */
		-webkit-transform: scale(1.3);
		/* Safari and Chrome */
		-o-transform: scale(1.3);
		/* Opera */
		transform: scale(1.3);
		padding: 10px;
		cursor: pointer;
	}
</style>
<div class="container-fluid">
	<br>
	<div class="col-lg-12">

		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Alunos</b>
						<?php if ($_SESSION['login_tipo'] == 1) : ?>
							<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_student">
									<i class="fa fa-plus"></i> Novo Aluno
								</a></span>
						<?php endif ?>
						<!--<button class="btn btn-success btn-block btn-sm col-sm-2 float-right mr-2 mt-0" type="button" id="print_selected">
							<i class="fa fa-print"></i> Imprimir Código</button>-->
					</div>
					<div class="card-body">
						<table class="table table-condensed table-striped table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th class="text-center" width="5%">
										<div class="form-check">
											<input class="form-check-input position-static" type="checkbox" id="check_all" aria-label="...">
										</div>
									</th>
									<th class="text-center">Ord</th>
									<th class="">Matrícula</th>
									<th class="">Nome</th>
									<th class="">Responsáveis</th>
									<th class="">Foto</th>
									<?php if ($_SESSION['login_tipo'] == 1) : ?>
										<th class="text-center">Ação</th>
									<?php endif ?>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$alunos = $conn->query("SELECT * FROM alunos order by nome asc ");

								while ($row = $alunos->fetch_assoc()) :
								?>
									<tr>
										<td class="text-center">
											<div class="form-check">
												<input class="form-check-input position-static input-lg" type="checkbox" name="checked[]" value="<?php echo $row['id'] ?>">
											</div>
										</td>
										<td class="text-center"><?php echo $i++ ?></td>
										<td>
											<p> <b><?php echo $row['matricula'] ?></b></p>
										</td>
										<td>
											<p> <b><?php echo ucwords($row['nome']) ?></b></p>
										</td>
										<td class="">
											<?php
											$responsaveis = $conn->query("SELECT *
											FROM alunos
											LEFT JOIN ALUNOXRESPONSAVEL
											ON alunos.ID = ALUNOXRESPONSAVEL.IDALUNO
											LEFT JOIN RESPONSAVEL
											ON ALUNOXRESPONSAVEL.IDRESPONSAVEL = RESPONSAVEL.ID
											WHERE RESPONSAVEL.ID IS NOT NULL
											AND alunos.id = '{$row['id']}';
											");
											?>
											<?php
											$j = 1;
											if ($responsaveis->num_rows > 0) :
												while ($dados = $responsaveis->fetch_assoc()) : ?>
													<p class="text-bold"><b><?= $j++ ?> - <?php echo $dados['nome'] ?></b></p>
												<?php endwhile ?>
											<?php else : ?>
												<p class="text-danger">Nenhum responsável associado.</p>
											<?php endif; ?>
										</td>
										<td>
											<img class="foto" src="<?php echo isset($row['img_path']) ? './assets/uploads/' . $row['img_path'] : '' ?>" alt="" id="cimg">
										</td>
										<?php if ($_SESSION['login_tipo'] == 1) : ?>
											<!--<td class="text-center">
												<button class="btn btn-sm btn-primary edit_student" type="button" data-id="<?php echo $row['id'] ?>">Editar</button>
												<button class="btn btn-sm btn-danger delete_student" type="button" data-id="<?php echo $row['id'] ?>">Deletar</button>
											</td>-->
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-primary btn-sm">&nbsp;Ações</button>
													<button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<div class="dropdown-menu">
														<a class="dropdown-item edit_student" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Editar</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item delete_student" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Deletar</a>
													</div>
												</div>
											</td>
										<?php endif ?>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}

	img.foto {
		display: block;
		margin-left: auto;
		margin-right: auto;
		align-items: center;
		max-width: 354px;
		max-height: 472px;

	}

	img#cimg,
	.cimg {
		max-height: 10vh;
		max-width: 6vw;
	}
</style>



<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.js"></script>
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
	$('.table').DataTable({
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json'
		}
	})
	$(document).ready(function() {
		$('table').dataTable()
	})
	$('#new_student').click(function() {
		uni_modal("Novo Aluno", "manage_student.php", "")

	})

	$('.edit_student').click(function() {
		uni_modal("Gerenciar Detalhes do Aluno", "manage_student.php?id=" + $(this).attr('data-id'), "mid-large")

	})
	$('.delete_student').click(function() {
		_conf("Tem certeza de que deseja excluir este aluno?", "delete_student", [$(this).attr('data-id')])
	})
	$('#check_all').click(function() {
		if ($(this).prop('checked') == true)
			$('[name="checked[]"]').prop('checked', true)
		else
			$('[name="checked[]"]').prop('checked', false)
	})
	$('[name="checked[]"]').click(function() {
		var count = $('[name="checked[]"]').length
		var checked = $('[name="checked[]"]:checked').length
		if (count == checked)
			$('#check_all').prop('checked', true)
		else
			$('#check_all').prop('checked', false)
	})
	$('#print_selected').click(function() {
		start_load()
		if ($('[name="checked[]"]:checked').length <= 0) {
			alert_toast("Selecione pelo menos um aluno primeiro.", 'warning')
			end_load()
			return false;
		}
		var chk = [];
		$('[name="checked[]"]:checked').each(function() {
			chk.push($(this).val())
		})
		chk = chk.join(',')
		$.ajax({
			url: 'print_barcode.php',
			method: 'POST',
			data: {
				tbl: 'alunos',
				ids: chk
			},
			success: function(resp) {
				if (resp) {
					var nw = window.open("", "_blank", "height=800,width=900")
					nw.document.write(resp)
					nw.document.close()
					nw.print()

					setTimeout(function() {
						nw.close()
						end_load()
					}, 500)

				}
			}
		})
	})

	function delete_student($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_student',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Aluno excluído com sucesso!", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
				else{
					alert_toast("Não foi possível excluir o aluno!", 'danger')
					setTimeout(function() {
						location.reload()
					}, 1500)
				}
			}
		})
	}
</script>