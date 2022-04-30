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
<style>
</style>

<div class="container-fluid">
	<br>
	<div class="col-lg-12">
		<div class="card ">
			<div class="card-header">
				<b>Lista de Familiares</b>
				<button class="btn btn-primary float-right btn-sm" id="new_familia"><i class="fa fa-plus"></i> Nova Familia</button>
			</div>

			<div class="card-body">
				<table class="table table-condensed table-striped table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="text-center">#</th>
							<!-- <th class="text-center">Familia ID</th> -->
							<!-- <th class="text-center">ID</th> -->
							<th class="text-center">Aluno</th>
							<!-- <th class="text-center">ID</th> -->
							<th class="text-center">Responsável</th>
							<?php if ($_SESSION['login_tipo'] == 1) : ?>
								<th class="text-center">Ação</th>
							<?php endif ?>

						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$query = $conn->query("SELECT 
						alunoxresponsavel.id,
						alunos.id as a_id,  
						alunos.nome as a_nome, 
						responsavel.id as r_id,
						responsavel.nome as r_nome,
						responsavel.sobrenome as r_sobrenome					
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

						while ($row = $query->fetch_assoc()) :

						?>
							<tr>
								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<!-- <td>
									<?php echo ($row['id']) ?>
								</td> -->
								<!-- <td>
									<?php echo ($row['a_id']) ?>
								</td> -->
								<td>
									<?php echo ucwords($row['a_nome']) ?>
								</td>
								<!-- <td>
									<?php echo ($row['r_id']) ?>
								</td> -->
								<td>
									<?php echo $row['r_nome']  . " " . $row['r_sobrenome'] ?>
								</td>

								<?php if ($_SESSION['login_tipo'] == 1) : ?>
									<td>
										<center>
											<div class="btn-group">
												<button type="button" class="btn btn-primary btn-sm">&nbsp;Ações</button>
												<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<div class="dropdown-menu">
													<!--<a class="dropdown-item edit_familia" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Editar</a>
													<div class="dropdown-divider"></div>-->
													<a class="dropdown-item delete_familia" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Deletar</a>
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

	$('#new_familia').click(function() {
		uni_modal('Novo Familiar', 'manage_familia.php')
	})
	$('.edit_familia').click(function() {
		uni_modal('Editar Familiar', 'manage_familia.php?id=' + $(this).attr('data-id'))
	})
	$('.delete_familia').click(function() {
		_conf("Tem certeza que deseja excluir este familiar?", "delete_familia", [$(this).attr('data-id')])
	})

	function delete_familia($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_familia',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Familiar excluído com sucesso!", 'success')
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