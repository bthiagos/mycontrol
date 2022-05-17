<?php 

/* CONEXÃO LOCALHOST */
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "_mycontrol_v4";

$conn= new mysqli($servidor,$usuario,$senha,$banco)or die("Could not connect to mysql".mysqli_error($con));

date_default_timezone_set('America/Sao_Paulo');
//header('Content-Type: text/html; charset=utf-8');
