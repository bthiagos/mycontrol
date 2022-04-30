<?php 

/* CONEXÃO INTERNET DB 1*/
//$conn= new mysqli('187.45.196.191','mycontrol','Tcc@2020!@#$','mycontrol')or die("Could not connect to mysql".mysqli_error($con));

/* CONEXÃO INTERNET DB 2*/
/* $conn= new mysqli('186.202.152.139','mycontrol_v1','Tcc@2020!@#$','mycontrol_v1')or die("Could not connect to mysql".mysqli_error($con)); */


 /* CONEXÃO EDEMNET DB 3*/
/* $conn= new mysqli('201.76.183.12','root','','_mycontrol_v3')or die("Could not connect to mysql".mysqli_error($con)); */

/* CONEXÃO LOCALHOST */
$conn= new mysqli('localhost','root','','_mycontrol_v3')or die("Could not connect to mysql".mysqli_error($con)); 

/* CONEXÃO LOCALHOST */
//$conn= new mysqli('162.240.20.18','wwedem_mycontrol','-+MB9UH(tmf;AJ@','wwedem_mycontrol')or die("Could not connect to mysql".mysqli_error($con));

//$conn= new mysqli('localhost','root','','mydb')or die("Could not connect to mysql".mysqli_error($con));

date_default_timezone_set('America/Sao_Paulo');
//header('Content-Type: text/html; charset=utf-8');
/*
$user = 'root'; # Usuário do banco de dados
$pswd = '';  # Senha

# Tentativa de conexão
try {
    $conn = new PDO('mysql:host=localhost; dbname=slms_db', $user, $pswd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo 'ERROR: ' . $e->getMessage();
}


$servidor = "187.45.196.191";
$usuario = "mycontrol";
$senha = "Tcc@2020!@#$";
$banco = "mycontrol";

################################# FINAL #################################

define("MYSQL_CONN_ERROR", "Não foi possível conectar ao Banco de Dados.");

// Ensure reporting is setup correctly
mysqli_report(MYSQLI_REPORT_STRICT);

# Tentativa de conexão

// Função de Conexão ao Banco de Dados
function conn($usr,$pw,$db,$host) {
   try {
      $mysqli = new mysqli($host,$usr,$pw,$db);
      $connected = true;
   } catch (mysqli_sql_exception $e) {
      throw $e;
   }
}

try {
  conn('mycontrol','Tcc@2020!@#$','mycontrol','187.45.196.191');
  echo 'Conectado ao Banco de Dados';
} catch (Exception $e) {
  echo $e->errorMessage();
}

*/