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
			<div class="card-header">
				<b>Usuários</b>
				<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> Novo Usuário</button>
			</div>

			<div class="card-body">
				<table class="table table-condensed table-striped table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Nome</th>
							<th class="text-center">Usuário</th>
							<th class="text-center">Tipo</th>
							<?php if ($_SESSION['login_tipo'] == 1) : ?>
								<th class="text-center">Ação</th>
							<?php endif ?>

						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$type = array("", "Admin", "Staff", "Colaborador");
						$usuarios = $conn->query("SELECT * FROM usuarios order by nome asc");
						$i = 1;
						while ($row = $usuarios->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<td class="text-center">
									<?php echo ucwords($row['nome']) ?>
								</td>

								<td class="text-center">
									<?php echo $row['usuario'] ?>
								</td>
								<td class="text-center">
									<?php echo $type[$row['tipo']] ?>
								</td>
								<?php if ($_SESSION['login_tipo'] == 1) : ?>
									<td class="text-center">
										<center>
											<div class="btn-group">
												<button type="button" class="btn btn-primary btn-sm">Ações</button>
												<button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Editar</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Deletar</a>
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
	$('#new_user').click(function() {
		uni_modal('Novo Usuário', 'manage_user.php')
	})
	$('.edit_user').click(function() {
		uni_modal('Editar Usuário', 'manage_user.php?id=' + $(this).attr('data-id'))
	})
	$('.delete_user').click(function() {
		_conf("Tem certeza que deseja excluir este usuário?", "delete_user", [$(this).attr('data-id')])
	})

	function delete_user($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_user',
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
</script>