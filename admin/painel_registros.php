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
	<?php
	$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
	$datenow = date("d-m-Y - H:i:s");
	?>
	<div class="col-lg-12">
		<br>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header fw-bold">
						<b>Registros de Entrada e Saída do Aluno(a) - <?= $date ?></b>
						<button class="btn btn-info btn-block btn-sm col-sm-2 float-right mr-2 mt-0" type="button" id="print_record">
							<i class="fa fa-print"></i> Imprimir</button>
						<button class="btn btn-success btn-block btn-sm col-sm-2 float-right mr-2 mt-0" type="button" id="excel_record">
							<i class="fa fa-file-excel"></i> Excel</button>
					</div>
					<div class="card-body">
						<div class="row justify-content-center">
							<label for="" class="mt-2">Data </label>
							<div class="col-sm-3">
								<input type="date" name="date" id="date" value="<?php echo date('Y-m-d', strtotime($date)) ?>" class="form-control">
							</div>
							<input class="btn btn-primary" type="button" value="Todos os Registros" id="todos_registros">

						</div>
						<hr>
						<table class="table table-condensed table-striped table-bordered table-hover" id="log-records">
							<thead class="thead-dark">
								<tr>
									<th class="text-center">#</th>
									<th class="">Data</th>
									<th class="">Hora</th>
									<th class="">Matrícula</th>
									<th class="">Nome</th>
									<!-- <th class="">Tipo</th> -->
									<th class="">Registro</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								/* $log = $conn->query("SELECT alunos.matricula, alunos.nome, registros.tipo, registros.tipo_registro, registros.data_criacao FROM registros INNER JOIN alunos ON registros.idaluno = alunos.id INNER JOIN usuarios ON usuarios.id_aluno = alunos.id where date(data_criacao) = '$date' and usuarios.id_aluno = '$login_id_aluno' order by unix_timestamp(data_criacao) desc"); */
								$log_admin = $conn->query("SELECT alunos.matricula, alunos.nome, registros.tipo, registros.tipo_registro, registros.data_criacao FROM registros INNER JOIN alunos ON registros.idaluno = alunos.id where date(data_criacao) = '$date' order by unix_timestamp(data_criacao) desc");
								/* if ((($_SESSION['login_tipo'] == 1) || ($_SESSION['login_tipo'] == 2)) && ($_SESSION['login_id_aluno'] == NULL)) {
									$result = $log_admin;
								} else {
									$result = $log;
								} */
								$result = $log_admin;

								if ($result->num_rows > 0) :
									while ($row = $result->fetch_assoc()) :
										if ($row['tipo'] == 'aluno' || $row['tipo'] == 'students' || $row['tipo'] == 'alunos')
											$type = 'Aluno';
										//     else
										//        $type = ucwords($row['type']);
								?>
										<tr>
											<td class="text-center"><?php echo $i++ ?></td>
											<td>
												<p> <b><?php echo date("d/m/Y", strtotime($row['data_criacao'])) ?></b></p>
											</td>
											<td>
												<p> <b><?php echo date("H:i", strtotime($row['data_criacao'])) ?></b></p>
											</td>
											<td class="text-center">
												<p><b><?php echo $row['matricula'] ?></b></p>
											</td>
											<td>
												<p> <b><?php echo $row['nome'] ?></b></p>
											</td>
											<!-- <td class="text-center">
													<p><b><?php echo $type ?></b></p>
												</td> -->
											<td class="text-center">
												<p><b><?php echo $row['tipo_registro'] == 1 ? '<span style="color:green">ENTRADA</span>' : '<span style="color:red">SAÍDA</span>' ?></b></p>
											</td>
										</tr>
									<?php endwhile; ?>
								<?php else : ?>
									<tr>
										<th colspan="6">
											<center>Não há registros.</center>
										</th>
									</tr>
								<?php
								endif;
								?>
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

	img {
		max-width: 100px;
		max-height: 150px;
	}
</style>
<noscript>
	<style>
		table {
			width: 100%;
			border-collapse: collapse
		}

		table thead {
			background-color: #0275d8;
		}

		tr,
		td,
		th {
			border: 1px solid
		}

		td p {
			margin: unset
		}

		.text-center {
			text-align: center
		}
	</style>
	<p class="text-center"><b>Registros escolares a partir de <?php echo date('F d,Y', strtotime($date)) ?><b></p>
</noscript>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
	$('#resp_back').click(function() {
		location.replace('index.php?page=filhos')
	})
	$('#date').change(function() {

		location.replace('index.php?page=painel_registros&date=' + $(this).val())
	})
	$('#todos_registros').click(function() {
		location.replace('index.php?page=painel_registros_todos')
	})
	$('.table').DataTable({
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json'
		},
		rowReorder: {
			selector: 'td:nth-child(2)'
		},
		responsive: true
	})
	$('#log-records').dataTable()
	$('#print_record').click(function() {
		$('#log-records').dataTable().fnDestroy()

		var ns = $('noscript').clone()
		var data = $('#log-records').clone()
		ns.append(data)
		var nw = window.open("", "_blank", "width=900,height=800")
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
			$('#log-records').dataTable()
		}, 500);
	})

	$(function() {
		$("#excel_record").click(function() {
			var data = "<?php echo $datenow; ?>";
			$("#log-records").table2excel({
				exclude: ".excludeThisClass",
				name: "Worksheet Name",
				filename: "Registros-" + data + ".xls", // do include extension
				preserveColors: false
			});
		});
	});
</script>