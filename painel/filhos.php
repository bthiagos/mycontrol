<?php include '../admin/db_connect.php' ?>
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

	th {
		font-size: 14;
	}

	td {
		font-size: 11;
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<br>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header fw-bold">
						<b>Meus Filhos</b>
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
									<th class="text-center">Registros</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$login_resp_id = $_SESSION['login_resp_id'];
								$i = 1;
								$student = $conn->query("SELECT *
														FROM RESPONSAVEL
														LEFT JOIN ALUNOXRESPONSAVEL
														ON RESPONSAVEL.ID = ALUNOXRESPONSAVEL.IDRESPONSAVEL
														LEFT JOIN ALUNOS
														ON ALUNOS.ID = ALUNOXRESPONSAVEL.IDALUNO
														WHERE ALUNOS.ID IS NOT NULL
														AND RESPONSAVEL.ID = '$login_resp_id';");
								$result = $student;
								if ($result->num_rows > 0) :
									while ($row = $student->fetch_assoc()) :
								?>
										<tr>
											<td class="text-center"><?php echo $i++ ?></td>
											<td>
												<p> <b><?php echo $row['matricula'] ?></b></p>
											</td>
											<td>
												<p> <b><?php echo ucwords($row['nome']) ?></b></p>
											</td>
											<td>
												<img src="<?php echo isset($row['img_path']) ? '../admin/assets/uploads/' . $row['img_path'] : '' ?>" alt="" id="cimg">
											</td>
											<td class="text-center">
												<a class="btn btn-sm btn-primary" type="button" href="index.php?page=painel_registros&id=<?php echo $row['id'] ?>">Visualizar</a>
											</td>
										</tr>
									<?php endwhile; ?>
								<?php else : ?>
									<tr>
										<th colspan="6">
											<center>Não há relacionamento.<br><br> Entre em contato com a instituição de ensino.</center>
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
</script>