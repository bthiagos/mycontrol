<?php include 'db_connect.php' ?>
<style>

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div class="containe-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <?php
                    echo "<b>Olá, " . $_SESSION['login_nome'] . "! </b><br>";
                    ?>
                </div>
                <div class="card-body">
                    <!-- <div class="jumbotron"> -->
                    <div class="row w-100 mt-3 mb-3">
                        <div class="col-md-3">
                            <div class="card border-info mx-sm-1 p-3">
                                <div class="card border-info shadow text-info p-3 my-card"><span class="fa fa-child" aria-hidden="true"></span></div>
                                <div class="text-info text-center mt-3">
                                    <h4>Alunos</h4>
                                </div>

                                <div class="text-info text-center mt-2">
                                    <?php
                                    $query =  "SELECT id FROM alunos ORDER BY id";
                                    $query_run = mysqli_query($conn, $query);
                                    $row = mysqli_num_rows($query_run);

                                    echo "<h1> " . $row . "</h1>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-success mx-sm-1 p-3">
                                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-users" aria-hidden="true"></span></div>
                                <div class="text-success text-center mt-3">
                                    <h4>Responsáveis</h4>
                                </div>
                                <div class="text-success text-center mt-2">
                                    <?php
                                    $query =  "SELECT id FROM responsavel ORDER BY id";
                                    $query_run = mysqli_query($conn, $query);
                                    $row = mysqli_num_rows($query_run);

                                    echo "<h1> " . $row . "</h1>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger mx-sm-1 p-3">
                                <div class="card border-danger shadow text-danger p-3 my-card"><span class="fa fa-user" aria-hidden="true"></span></div>
                                <div class="text-danger text-center mt-3">
                                    <h4>Usuários</h4>
                                </div>
                                <div class="text-danger text-center mt-2">
                                    <?php
                                    $query =  "SELECT id FROM usuarios ORDER BY id";
                                    $query_run = mysqli_query($conn, $query);
                                    $row = mysqli_num_rows($query_run);

                                    echo "<h1> " . $row . "</h1>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-warning mx-sm-1 p-3">
                                <div class="card border-warning shadow text-warning p-3 my-card"><span class="fa fa-list-alt" aria-hidden="true"></span></div>
                                <div class="text-warning text-center mt-3">
                                    <h4>Registros</h4>
                                </div>
                                <div class="text-warning text-center mt-2">
                                    <?php
                                    $query =  "SELECT * FROM registros";
                                    $query_run = mysqli_query($conn, $query);
                                    $row = mysqli_num_rows($query_run);

                                    echo "<h1> " . $row . "</h1>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <b>Registros do Dia</b>
                </div>
                <div class="card-body">
                    <div class="text-dark text-center mt-2">
                        <?php

                        $query =  "SELECT WEEKDAY(registros.data_criacao) as dia, count(*) as total
                        FROM registros 
                        WHERE DAY(data_criacao) = DAY(NOW())
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
                        <canvas id="myChart" width="400" height="400"></canvas>

                    </div>
                    <script>
                        labelsx = [
                            <?php
                            foreach ($data as $r) {
                                echo "'" . diaSemana($r['dia']) . "',";
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
                                        'rgba(75, 192, 192, 0.2)',
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

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <b>Registros da Semana</b>
                </div>
                <div class="card-body">
                    <div class="text-dark text-center mt-2">
                        <?php
                        function diaSemana($numero)
                        {
                            switch ($numero) {
                                case "0":
                                    $diasemana = "Segunda";
                                    break;
                                case "1":
                                    $diasemana = "Terça";
                                    break;
                                case "2":
                                    $diasemana = "Quarta";
                                    break;
                                case "3":
                                    $diasemana = "Quinta";
                                    break;
                                case "4":
                                    $diasemana = "Sexta";
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
                        WHERE MONTH(data_criacao) = MONTH(NOW())
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
                        <canvas id="myChart2" width="400" height="400"></canvas>
                        <script>
                            labels1 = [
                                <?php
                                foreach ($data as $r) {
                                    echo "'" . diaSemana($r['dia']) . "',";
                                }
                                ?>
                            ]
                            labels2 = [
                                <?php
                                foreach ($data as $r) {
                                    echo "'" . diaSemana($r['dia']) . "'," . $r['total'] . ",";
                                }
                                ?>
                            ]
                            dados1 = [
                                <?php
                                foreach ($data as $r) {
                                    echo "'" . $r['total'] . "',";
                                }
                                ?>
                            ]
                            var ctx = document.getElementById('myChart2');
                            var myChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: labels1,
                                    datasets: [{
                                        label: '# of Votes',
                                        data: dados1,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'RGBA(0,222,0,0.4)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(5, 59, 164, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 240, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(5, 59, 164, 0.2)'

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
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <b>Registro do Mês</b>
                </div>
                <div class="card-body">
                    <div class="text-dark text-center mt-2">
                        <?php

                        $query =  "SELECT MONTH(registros.data_criacao) as mes, count(*) as total
                        FROM registros INNER JOIN alunos 
                        ON registros.idaluno = alunos.id 
                        WHERE MONTH(data_criacao) = MONTH(NOW())
                        AND YEAR(data_criacao) = YEAR(NOW())
                        GROUP BY mes
                        ORDER BY mes";
                        $query_run = mysqli_query($conn, $query);
                        $data = array();
                        foreach ($query_run as $row) {
                            $data[] = $row;
                        }

                        json_encode($data);

                        ?>
                        <canvas id="myChart3" width="400" height="400"></canvas>
                        <script>
                            labels1 = [
                                <?php
                                foreach ($data as $r) {
                                    echo "'" . ano_registro($r['mes']) . "',";
                                }
                                ?>
                            ]
                            labels2 = [
                                <?php
                                foreach ($data as $r) {
                                    echo "'" . ano_registro($r['mes']) . "'," . $r['total'] . ",";
                                }
                                ?>
                            ]
                            dados1 = [
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
                                    labels: labels1,
                                    datasets: [{
                                        label: '# Registro do Mês',
                                        data: dados1,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
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
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <b>Registros por Mês</b>
                </div>
                <div class="card-body">
                    <div class="text-dark text-center mt-2">
                        <?php
                        function ano_registro($numero)
                        {
                            switch ($numero) {
                                case "1":
                                    $mes = "Janeiro";
                                    break;
                                case "2":
                                    $mes = "Fevereiro";
                                    break;
                                case "3":
                                    $mes = "Março";
                                    break;
                                case "4":
                                    $mes = "Abril";
                                    break;
                                case "5":
                                    $mes = "Maio";
                                    break;
                                case "6":
                                    $mes = "Junho";
                                    break;
                                case "7":
                                    $mes = "Julho";
                                    break;
                                case "8":
                                    $mes = "Agosto";
                                    break;
                                case "9":
                                    $mes = "Setembro";
                                    break;
                                case "10":
                                    $mes = "Outubro";
                                    break;
                                case "11":
                                    $mes = "Novembro";
                                    break;
                                case "12":
                                    $mes = "Dezembro";
                                    break;
                            }
                            return "$mes";
                        }

                        $query =  "SELECT MONTH(registros.data_criacao) as mes, count(*) as total
                        FROM registros INNER JOIN alunos 
                        ON registros.idaluno = alunos.id 
                        WHERE YEAR(data_criacao) = YEAR(NOW())
                        GROUP BY mes
                        ORDER BY mes";
                        $query_run = mysqli_query($conn, $query);
                        $data = array();
                        foreach ($query_run as $row) {
                            $data[] = $row;
                        }

                        json_encode($data);
                        ?>
                        <canvas id="myChart4" width="400" height="400"></canvas>

                    </div>
                    <script>
                        labelsx = [
                            <?php
                            foreach ($data as $r) {
                                echo "'" . ano_registro($r['mes']) . "',";
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
                        var ctx = document.getElementById('myChart4');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labelsx,
                                datasets: [{
                                    label: 'Frequencia Mensal',
                                    data: dadosx,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
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
</div>
<script>
    $('#manage-records').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                resp = JSON.parse(resp)
                if (resp.status == 1) {
                    alert_toast("Dados salvos com sucesso!", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 800)

                }

            }
        })
    })
    $('#tracking_id').on('keypress', function(e) {
        if (e.which == 13) {
            get_person()
        }
    })
    $('#check').on('click', function(e) {
        get_person()
    })

    function get_person() {
        start_load()
        $.ajax({
            url: 'ajax.php?action=get_pdetails',
            method: "POST",
            data: {
                tracking_id: $('#tracking_id').val()
            },
            success: function(resp) {
                if (resp) {
                    resp = JSON.parse(resp)
                    if (resp.status == 1) {
                        $('#name').html(resp.name)
                        $('#address').html(resp.address)
                        $('[name="person_id"]').val(resp.id)
                        $('#details').show()
                        end_load()

                    } else if (resp.status == 2) {
                        alert_toast("Unknow tracking id.", 'danger');
                        end_load();
                    }
                }
            }
        })
    }
</script>