<?php
require("db_connect.php");

$query =  "SELECT alunos.matricula, alunos.nome, registros.tipo, registros.tipo_registro, registros.data_criacao FROM registros INNER JOIN alunos ON registros.idaluno = alunos.id order by unix_timestamp(date_created) desc";
$query_run = mysqli_query($conn, $query);
$data = array();
foreach ($query_run as $row) {
    $data[] = $row;
}
/* mysqli_close($conn); */

echo json_encode($data);
                        /*  echo "<h1> " . $row . "</h1>"; */
