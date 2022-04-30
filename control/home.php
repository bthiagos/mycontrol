<?php include '../admin/db_connect.php' ?>
<?php
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
/* $login_id_aluno = $_SESSION['login_id_aluno']; */
?>
<link href="https://allfont.net/allfont.css?fonts=ds-digital" rel="stylesheet" type="text/css" />
<div class="containe-fluid">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header text-center text-uppercase">
                    <h5>CONTROLE DE ENTRADA E SAÍDA</h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card controle-estudante bg-gradient-primary text-white mx-2 mb-2">
                                    <div class="card-body text-center">
                                        <svg xmlns="assets/img/upc-scan.svg" width="16" height="16" fill="currentColor" class="bi bi-upc-scan logo-scan" viewBox="0 0 16 16">
                                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                        </svg>
                                    </div>
                                    <div class="card-footer p-0 pt-1 text-center">
                                        <div class="mx-o mt-0 mb-0 text-center">
                                            <button type="button" class="btn btn-primary-gradient text-white font-weight-bold mt-0 mx-0 btn-log" data-type='alunos' data-log="1">Abrir Leitor de Cartão</button>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0 pt-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header text-center text-uppercase">
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card bg-gradient-primary text-white mx-2 mb-2">
                                    <div class="card-body text-center">
                                        <div id="hora" class="relogio" style="font-family: 'Orbitron', sans-serif;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 controle-resultados">
            <div class="card">
                <div class="card-header text-center text-uppercase">
                    <h5>Registros do Dia - <span><?= date('d/m/Y', strtotime($date)) ?></span>
                        <h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div id="msgx">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-condensed table-striped table-bordered table-hover" id="log-records">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
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
                                            //$log = $conn->query("SELECT alunos.matricula, alunos.nome, registros.tipo, registros.tipo_registro, registros.data_criacao FROM registros INNER JOIN alunos ON registros.idaluno = alunos.id INNER JOIN users ON users.id_aluno = alunos.id where users.id_aluno = '$login_id_aluno' AND WHERE registros.data_criacao = CURRENT_DATE() order by unix_timestamp(data_criacao) desc");
                                            $log_admin = $conn->query("SELECT alunos.matricula, alunos.nome, registros.tipo, registros.tipo_registro, registros.data_criacao FROM registros INNER JOIN alunos ON registros.idaluno = alunos.id  WHERE date(data_criacao) = '$date' order by unix_timestamp(data_criacao) desc");
                                            //if ((($_SESSION['login_type'] == 1) || ($_SESSION['login_type'] == 2)) && ($_SESSION['login_id_aluno'] == NULL)) {
                                            $result = $log_admin;
                                            // } else {
                                            //   $result = $log;
                                            //}


                                            if ($result->num_rows > 0) :
                                                while ($row = $result->fetch_assoc()) :
                                                    if ($row['tipo'] == 'aluno' || $row['tipo'] == 'students' || $row['tipo'] == 'alunos')
                                                        $type = 'Aluno';
                                                    //     else
                                                    //        $typo = ucwords($row['tipo']);
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i++ ?></td>
                                                        <td>
                                                            <p> <b><?php echo date("H:i:s", strtotime($row['data_criacao'])) ?></b></p>
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
    </div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#log-records').DataTable({
            "lengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            // "searching": false,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json'
            }
        });

    });

    setInterval(function() {

        let novaHora = new Date();
        let hora = novaHora.getHours();
        let minuto = novaHora.getMinutes();
        let segundo = novaHora.getSeconds();

        minuto = zero(minuto);
        segundo = zero(segundo);

        document.getElementById('hora').textContent = hora + ':' + minuto + ':' + segundo;
    }, 1000)

    function zero(x) {
        if (x < 10) {
            x = '0' + x;
        }
        return x;
    }
</script>