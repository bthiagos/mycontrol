<?php
// Verifica se não há a variável da sessão que identifica o usuário
if (($_SESSION['login_tipo'] != 1)) {
	// Destrói a sessão por segurança
	//session_destroy();
	// Redireciona o visitante de volta pro login
	//echo "<meta name='refresh' content='0;url=index.php?page=404' />";
	echo "<script>document.location='index.php?page=404'</script>";
	exit;
}
?>

<div class="container-fluid">
	<br>
	<div class="col-lg-12">
		<div class="card ">
			<!-- <div class="card-header">
				<b>Lista de Responsáveis</b>
				<button class="btn btn-primary float-right btn-sm" id="new_resp"><i class="fa fa-plus"></i> Novo Responsável</button>
			</div> -->
			<div class="card-header">
				<b>Alunos</b>
				<?php if ($_SESSION['login_tipo'] == 1) : ?>
					<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_resp">
							<i class="fa fa-plus"></i> Novo Responsável
						</a></span>
				<?php endif ?>
				<!--<button class="btn btn-success btn-block btn-sm col-sm-2 float-right mr-2 mt-0" type="button" id="print_selected">
							<i class="fa fa-print"></i> Imprimir Código</button>-->
			</div>
			<div class="card-body">
				<table class="table table-condensed table-striped table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="text-center">Ord</th>
							<th class="text-center">Nome</th>
							<th class="text-center">E-mail</th>
							<th class="text-center">Filhos</th>
							<?php if ($_SESSION['login_tipo'] == 1) : ?>
								<th class="text-center">Ação</th>
							<?php endif ?>

						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						//$type = array("", "Admin", "Staff", "Colaborador");
						$resps = $conn->query("SELECT * FROM responsavel order by nome asc");
						$i = 1;

						while ($row = $resps->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<td>
									<?php echo ucwords($row['nome']) .' '. $row['sobrenome'] ?>
								</td>

								<!-- <td>
									<?php echo $row['sobrenome'] ?>
								</td> -->
								<td>
									<?php echo $row['email'] ?>
								</td>
								<td>
									<center>
										<div class="btn-group center">
											<a class="dropdown-item respxfilhos" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; Vizualizar</button></a>
											<!--<a class="dropdown-item respxfilhos" href="index.php?page=filhos&id=<?php echo $row['id'] ?>">Filhos href</a>-->
										</div>
									</center>
								</td>
								<?php if ($_SESSION['login_tipo'] == 1) : ?>
									<td>
										<center>
											<div class="btn-group">
												<button type="button" class="btn btn-primary btn-sm">&nbsp;Ações</button>
												<button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item edit_resp" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Editar</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item delete_resp" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Deletar</a>
												</div>
											</div>
										</center>
									</td>
								<?php endif; ?>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('table').dataTable({
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json'
		}
	})

	$('#new_resp').click(function() {
		uni_modal('Novo Responsável', 'manage_responsavel.php')
	})
	$('.edit_resp').click(function() {
		uni_modal('Editar Responsável', 'manage_responsavel.php?id=' + $(this).attr('data-id'))
	})
	$('.delete_resp').click(function() {
		_conf("Tem certeza que deseja excluir este responsável?", "delete_responsavel", [$(this).attr('data-id')])
	})

	function delete_responsavel($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_responsavel',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Dados excluídos com sucesso", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
	$('.respxfilhos').click(function() {
		location.replace('index.php?page=filhos&id=' + $(this).attr('data-id'))
	})
</script>