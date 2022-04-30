<?php include('db_connect.php'); ?>
<?php
if (isset($_GET['id'])) {
	$idresp = isset($_GET['id']);
	$resp = $conn->query("SELECT * FROM responsavel where id= '{$_GET['id']}'");
	foreach ($resp->fetch_array() as $kpl => $valw) {
		//$kpl = $valw;
		$metal[$kpl] = $valw;
	}
}
?>

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

	.card-body-btn-head {
		-ms-flex: 1 1 auto;
		flex: 1 1 auto;
		min-height: 1px;
		padding: 0.50rem 0.25rem 0px 1.25rem;
	}

	th {
		font-size: 14;
	}

	td {
		font-size: 11;
	}
</style>

<div class="container-fluid">
	<br>
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<?php
			$resp = $conn->query("SELECT responsavel.id, responsavel.nome, responsavel.sobrenome
									FROM RESPONSAVEL
									LEFT JOIN ALUNOXRESPONSAVEL
									ON RESPONSAVEL.ID = ALUNOXRESPONSAVEL.IDRESPONSAVEL
									LEFT JOIN ALUNOS
									ON ALUNOS.ID = ALUNOXRESPONSAVEL.IDALUNO
									WHERE RESPONSAVEL.ID = '{$metal['id']}';");
			$result_resp = $resp;
			$dados = $result_resp->fetch_assoc();
			?>
			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<span class="font-weight-bold">Alunos / Filhos / Tutelados </span>
						<span class="float-right"><strong>Responsável:</strong> <?php echo $dados['nome']; ?> <?php echo $dados['sobrenome']; ?> </span>
					</div>
					<div class="card-body-btn-head">
						<button class="btn btn-primary btn-sm" id="resp_back"><i class="fa fa-arrow-left"></i> Voltar</button>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-striped table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									</th>
									<th class="text-center">Ord</th>
									<th class="">Matrícula</th>
									<th class="">Nome</th>
									<th class="">Foto</th>
									<!--<th class="text-center">Ação</th>-->
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$query_alunos = $conn->query("SELECT *
														FROM RESPONSAVEL
														LEFT JOIN ALUNOXRESPONSAVEL
														ON RESPONSAVEL.ID = ALUNOXRESPONSAVEL.IDRESPONSAVEL
														LEFT JOIN ALUNOS
														ON ALUNOS.ID = ALUNOXRESPONSAVEL.IDALUNO
														WHERE ALUNOS.ID IS NOT NULL
														AND RESPONSAVEL.ID = '{$metal['id']}';");
								$result = $query_alunos;
								if ($result->num_rows > 0) :
									while ($aluno = $query_alunos->fetch_assoc()) :
								?>
										<tr>
											<td class="text-center"><?php echo $i++ ?></td>
											<td>
												<p> <b><?php echo $aluno['matricula'] ?></b></p>
											</td>
											<td>
												<p> <b><?php echo ucwords($aluno['nome']) ?></b></p>
											</td>
											<td class="text-center">
												<img src="<?php echo isset($aluno['img_path']) ? './assets/uploads/' . $aluno['img_path'] : '' ?>" alt="" id="cimg">
											</td>
										</tr>
									<?php endwhile; ?>
								<?php else : ?>
									<tr>
										<th colspan="6">
											<center>Não há relacionamento.</center>
										</th>
									</tr>
								<?php endif; ?>
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

	img#cimg,
	.cimg {
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
	$('#resp_back').click(function() {
		location.replace('index.php?page=responsavel')
	})
</script>