<?php
class Database{
    
    // LOCALHOST
    private $db_host = 'localhost';
    private $db_name = '_mycontrol_v3';
    private $db_username = 'root';
    private $db_password = ''; 

     // WEB  (LOCAWEB)
     /* private $db_host = '186.202.152.139';
     private $db_name = 'mycontrol_v1';
     private $db_username = 'mycontrol_v1';
     private $db_password = 'Tcc@2020!@#$'; */
    
    public function dbConnection(){
        
        try{
            $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Erro na Conexão com o Banco de Dados: ".$e->getMessage(); 
            exit;
        }
          
    }
}