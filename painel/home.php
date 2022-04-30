<?php include '../admin/db_connect.php' ?>
<style>
	img {
		max-width: 100px;
		max-height: 150px;
	}

	img#cimg,
	.cimg {
		max-height: 10vh;
		max-width: 6vw;
	}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
$login_resp_id = $_SESSION['login_resp_id'];

?>
<!-- ENTRADA DO DIA-->
<?php
/* ENTRADA */
$query =  "SELECT WEEKDAY(registros.data_criacao) as dia, 
count(registros.tipo_registro) as entrada, 
count(*) as total
FROM registros
INNER JOIN alunos
ON alunos.id = registros.idaluno
JOIN alunoxresponsavel
ON alunoxresponsavel.idaluno = alunos.id
LEFT JOIN responsavel
ON alunoxresponsavel.idresponsavel = responsavel.id
WHERE registros.tipo_registro = 1
AND responsavel.id IS NOT NULL
AND responsavel.id = '$login_resp_id'
AND alunos.id is not null
AND DAY(data_criacao) = DAY(NOW())
AND MONTH(data_criacao) = MONTH(NOW())
AND YEAR(data_criacao) = YEAR(NOW())
GROUP BY dia
ORDER BY dia";
$query_result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query_result);

/* SAIDA */
$query2 =  "SELECT WEEKDAY(registros.data_criacao) as dia, 
count(registros.tipo_registro) as saida, 
count(*) as total
FROM registros
INNER JOIN alunos
ON alunos.id = registros.idaluno
JOIN alunoxresponsavel
ON alunoxresponsavel.idaluno = alunos.id
LEFT JOIN responsavel
ON alunoxresponsavel.idresponsavel = responsavel.id
WHERE registros.tipo_registro = 2
AND responsavel.id IS NOT NULL
AND responsavel.id = '$login_resp_id'
AND alunos.id is not null
AND DAY(data_criacao) = DAY(NOW())
AND MONTH(data_criacao) = MONTH(NOW())
AND YEAR(data_criacao) = YEAR(NOW())
GROUP BY dia
ORDER BY dia";
$query_result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($query_result2);

?>

<!-- FIM GRAFICO DO DIA -->
<div class="containe-fluid">
	<!-- <div class="row mt-3 ml-3 mr-1"> -->
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header fw-bold">
				<b><?php echo "Bem-vindo, " . $_SESSION['login_resp_nome'] . "!"; ?></b>
			</div>
			<!-- INICIO PAINEL COM RELACIONAMENTO PAIS E FILHOS -->
			<?php
			//TOTAL DE FILHOS 

			$student = $conn->query("SELECT COUNT(alunos.id) AS totala
												FROM RESPONSAVEL
												LEFT JOIN ALUNOXRESPONSAVEL
												ON RESPONSAVEL.ID = ALUNOXRESPONSAVEL.IDRESPONSAVEL
												LEFT JOIN alunos
												ON alunos.ID = ALUNOXRESPONSAVEL.IDALUNO
												WHERE RESPONSAVEL.ID = '$login_resp_id';");
			$rowhome = $student->fetch_assoc();
			$totalzao = $rowhome['totala'];
			if ($rowhome['totala'] > 0) :
			?>
				<div class="card-body">

					<div class="containe-fluid">
						<div class="row mt-3 ml-3 mr-1">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-header fw-bold">
										<b>Registros do Dia</b>
									</div>
									<div class="card-body">
										<?php
										function diaSemana($numero)
										{
											switch ($numero) {
												case "0":
													$diasemana = "Segunda-feira";
													break;
												case "1":
													$diasemana = "Terça-feira";
													break;
												case "2":
													$diasemana = "Quarta-feira";
													break;
												case "3":
													$diasemana = "Quinta-feira";
													break;
												case "4":
													$diasemana = "Sexta-feira";
													break;
												case "5":
													$diasemana = "Sábado";
													break;
												case "6":
													$diasemana = "Domingo";
													break;
											}
											return "$diasemana";
										}
										$query =  "SELECT WEEKDAY(registros.data_criacao) as dia, count(*) as total
																	FROM registros 
																	INNER JOIN alunos
																	ON alunos.id = registros.idaluno
																	JOIN alunoxresponsavel
																	ON alunoxresponsavel.idaluno = alunos.id
																	LEFT JOIN responsavel
																	ON alunoxresponsavel.idresponsavel = responsavel.id
																	WHERE responsavel.id IS NOT NULL
																	AND responsavel.id = '$login_resp_id'
																	AND alunos.id is not null
																	AND DAY(data_criacao) = DAY(NOW())
																	AND MONTH(data_criacao) = MONTH(NOW())
																	AND YEAR(data_criacao) = YEAR(NOW())
																	GROUP BY dia
																	ORDER BY dia";
										$query_run = mysqli_query($conn, $query);
										$data = array();
										foreach ($query_run as $row) {
											$data[] = $row;
										}

										json_encode($data);
										?>
										<canvas id="myChart" width="400" height="300"></canvas>
										<script>
											labelsx = [
												<?php
												foreach ($data as $r) {
													echo "'" . diaSemana($r['dia']) . "',";
													/* echo "'" . $r['dia'] . "',"; */
												}
												?>
											]
											dadosx = [
												<?php
												foreach ($data as $r) {
													echo "'" . $r['total'] . "',";
												}
												?>
											]
											var ctx = document.getElementById('myChart');
											var myChart = new Chart(ctx, {
												type: 'bar',
												data: {
													labels: labelsx,
													datasets: [{
														label: 'Registros do Dia',
														data: dadosx,
														backgroundColor: [
															'rgba(54, 162, 235, 0.2)',
														],
														borderColor: [
															'rgba(54, 162, 235, 1)',
														],
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														y: {
															beginAtZero: true
														}
													}
												}
											});
											/* } */
										</script>
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="card">
									<div class="card-header fw-bold">
										<b>Registros de Entrada do Dia</b>
									</div>
									<div class="card-body">
										<?php
										function tipoEntrada($numero)
										{
											/* switch ($numero) {
												case "1":
													$tipoentrada = "Entrada";
													break;
												case "2":
													$tipoentrada = "Saída";
													break;
											} */
											if ($numero > 0 || $numero != null) {
												$tipoentrada = "Entrada";
											} else {
												$tipoentrada = "Não há registros!";
											}
											return "$tipoentrada";
										}
										$query =  "SELECT WEEKDAY(registros.data_criacao) as dia, 
																	count(registros.tipo_registro=1) as entrada, 
																	count(*) as total
																	FROM registros
																	INNER JOIN alunos
																	ON alunos.id = registros.idaluno
																	JOIN alunoxresponsavel
																	ON alunoxresponsavel.idaluno = alunos.id
																	LEFT JOIN responsavel
																	ON alunoxresponsavel.idresponsavel = responsavel.id
																	WHERE registros.tipo_registro = 1
																	AND responsavel.id IS NOT NULL
																	AND responsavel.id = '$login_resp_id'
																	AND alunos.id is not null
																	AND DAY(data_criacao) = DAY(NOW())
																	AND MONTH(data_criacao) = MONTH(NOW())
																	AND YEAR(data_criacao) = YEAR(NOW())
																	GROUP BY dia
																	ORDER BY dia";
										$query_run = mysqli_query($conn, $query);
										$data = array();
										foreach ($query_run as $row) {
											$data[] = $row;
										}

										json_encode($data);
										?>
										<canvas id="myChart2" width="400" height="300"></canvas>
										<script>
											labelsx = [
												<?php
												foreach ($data as $r) {
													echo "'" . tipoEntrada($r['entrada']) . "',";
													/* echo "'" . $r['dia'] . "',"; */
												}
												?>
											]
											dadosx = [
												<?php
												foreach ($data as $r) {
													echo "'" . $r['total'] . "',";
												}
												?>
											]
											var ctx = document.getElementById('myChart2');
											var myChart = new Chart(ctx, {
												type: 'bar',
												data: {
													labels: labelsx,
													datasets: [{
														label: 'Registros de Entrada',
														data: dadosx,
														backgroundColor: [
															'rgba(10, 255, 10, 0.2)',
														],
														borderColor: [
															'rgba(10, 255, 10, 1)',
														],
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														y: {
															beginAtZero: true
														}
													}
												}
											});
											/* } */
										</script>

									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="card">
									<div class="card-header fw-bold">
										<b>Registros de Saída de Hoje</b>
									</div>
									<div class="card-body">
										<?php
										function tipoSaida($numero)
										{
											if ($numero > 0 || $numero != null) {
												$tiposaida = "Saída";
											} else {
												$tiposaida = "Não há registros!";
											}
											return "$tiposaida";
										}
										$query =  "SELECT WEEKDAY(registros.data_criacao) as dia, 
																count(registros.tipo_registro=1) as saida, 
																count(*) as total
																FROM registros
																INNER JOIN alunos
																ON alunos.id = registros.idaluno
																JOIN alunoxresponsavel
																ON alunoxresponsavel.idaluno = alunos.id
																LEFT JOIN responsavel
																ON alunoxresponsavel.idresponsavel = responsavel.id
																WHERE registros.tipo_registro = 2
																AND responsavel.id IS NOT NULL
																AND responsavel.id = '$login_resp_id'
																AND alunos.id is not null
																AND DAY(data_criacao) = DAY(NOW())
																AND MONTH(data_criacao) = MONTH(NOW())
																AND YEAR(data_criacao) = YEAR(NOW())
																GROUP BY dia
																ORDER BY dia";
										$query_run = mysqli_query($conn, $query);
										$data = array();
										foreach ($query_run as $row) {
											$data[] = $row;
										}

										json_encode($data);
										?>
										<canvas id="myChart3" width="400" height="300"></canvas>
										<script>
											labelsx = [
												<?php
												foreach ($data as $r) {
													echo "'" . tipoSaida($r['saida']) . "',";
													/* echo "'" . $r['dia'] . "',"; */
												}
												?>
											]
											dadosx = [
												<?php
												foreach ($data as $r) {
													echo "'" . $r['total'] . "',";
												}
												?>
											]
											var ctx = document.getElementById('myChart3');
											var myChart = new Chart(ctx, {
												type: 'bar',
												data: {
													labels: labelsx,
													datasets: [{
														label: 'Registros de Saída',
														data: dadosx,
														backgroundColor: [
															'rgba(255, 99, 132, 0.2)',
														],
														borderColor: [
															'rgba(255, 99, 132, 1)',
														],
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														y: {
															beginAtZero: true
														}
													}
												}
											});
											/* } */
										</script>

									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3 ml-3 mr-1">
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header fw-bold">
										<b>Dados Variários</b>
									</div>
									<div class="card-body">
										<div class="container bootstrap snippet" style="height: 300px;">
											<div class="row">
												<div class="col-lg-12 col-sm-12">
													<div class="form-group form-control-label">
														<label for="nome sobrenome">Nome Completo</label>
														<input type="text" class="form-control-2 mb-2" value="<?php echo $_SESSION['login_resp_nome'] . " " . $_SESSION['login_resp_sobrenome']; ?>" disabled></b>
														<label for="email">E-mail</label>
														<input type="text" class="form-control-2" value="<?php echo $_SESSION['login_resp_email']; ?>" disabled></b>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-sm-12">
													<div class="circle-tile ">
														<div class="circle-tile-content mycontrol">
															<div class="circle-tile-description text-faded"><b>Total de Filhos</b></div>
															<div class="circle-tile-number text-faded "><?php echo $rowhome['totala'] ?></div>
															<a class="circle-tile-footer" href="#"></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>

							<div class="col-lg-6">
								<div class="card">
									<div class="card-header fw-bold">
										<b>Registros de Hoje</b>
									</div>
									<div class="card-body">
										<div class="container bootstrap snippet" style="height: 300px;">
											<div class="row">
												<!-- DATA TABLES -->
												<table class="table table-condensed table-striped table-bordered table-hover" id="log-records">
													<thead class="thead-dark">
														<tr>
															<th class="text-center">#</th>
															<th class="">Data</th>
															<th class="">Hora</th>
															<th class="">Nome</th>
															<th class="">Registro</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$i = 1;
														$log = $conn->query("SELECT DISTINCT alunos.matricula, alunos.nome, registros.tipo, registros.tipo_registro, registros.data_criacao
															FROM `registros` 
															INNER JOIN alunos
															on alunos.id = registros.idaluno
															JOIN alunoxresponsavel
															ON alunoxresponsavel.idaluno = alunos.id
															left join responsavel
															ON alunoxresponsavel.idresponsavel = responsavel.id
															WHERE responsavel.id IS NOT NULL
															AND responsavel.id = '$login_resp_id'
															AND alunos.id is not null
															AND date(data_criacao) = date(CURRENT_DATE)
															order by unix_timestamp(data_criacao) desc
															;");
														$result = $log;
														if ($result->num_rows > 0) :
															while ($row = $result->fetch_assoc()) :
																if ($row['tipo'] == 'aluno' || $row['tipo'] == 'alunos' || $row['tipo'] == 'aluno' || $row['tipo'] == 'students')
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
																	<td>
																		<p> <b><?php echo $row['nome'] ?></b></p>
																	</td>
																	<td class="text-center">
																		<p><b><?php echo $row['tipo_registro'] == 1 ? '<span style="color:green">ENTRADA</span>' : '<span style="color:red">SAÍDA</span>' ?></b></p>
																	</td>
																</tr>
															<?php endwhile; ?>
														<?php else : ?>
															<tr>
																<th colspan="6">
																	<center>Não há registros no dia de hoje.</center>
																</th>
															</tr>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php else : ?>
					<div class="containe-fluid">
						<div class="row mt-3 ml-3 mr-1">
							<div class="col-lg-3"></div>
							<div class="col-lg-6 alert alert-danger">
								<h3 class="m-3 text-center">Atenção!</h3>
								<hr>
								<h4 class="m-3 text-center">Por favor, entre em contato com a instituição de ensino urgente.</h4>
							</div>
							<div class="col-lg-3"></div>
						</div>
					</div>
				<?php endif ?>
				</div>
		</div>
	</div>
	<!-- </div> -->
</div>

<script>
	 $(document).ready(function() {
        var table = $('#log-records').DataTable({
            "lengthMenu": [
                [4, 8, 12, -1],
                [4, 8, 12, "All"]
            ],
            // "searching": false,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json'
            }
        });

    });
</script>