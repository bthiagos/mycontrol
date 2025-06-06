<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Página Não Encontrada!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->email) 
    || !isset($data->senha)
    || empty(trim($data->email))
    || empty(trim($data->senha))
    ):

    $fields = ['fields' => ['email','senha']];
    $returnData = msg(0,422,'Por favor, preencha todos os campos requisitados!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    $email = trim($data->email);
    $senha = trim($data->senha);

    // CHECKING THE EMAIL FORMAT (IF INVALID FORMAT)
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        $returnData = msg(0,422,'Endereço de email invalido!');
    
    // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
    elseif(strlen($senha) < 8):
        $returnData = msg(0,422,'Sua senha deve ter pelo menos 8 caracteres!');

    // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    else:
        try{
            
            $fetch_user_by_email = "SELECT * FROM `responsavel` WHERE `email`=:email";
            $query_stmt = $conn->prepare($fetch_user_by_email);
            $query_stmt->bindValue(':email', $email,PDO::PARAM_STR);
            $query_stmt->execute();

            // IF THE USER IS FOUNDED BY EMAIL
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
                $check_password = password_verify($senha, $row['senha']);

                // VERIFYING THE PASSWORD (IS CORRECT OR NOT?)
                // IF PASSWORD IS CORRECT THEN SEND THE LOGIN TOKEN
                if($check_password):

                    $jwt = new JwtHandler();
                    $token = $jwt->jwtEncodeData(
                        'http://localhost/mycontrol/php_auth_api/',
                        array("user_id"=> $row['id'])
                    );
                    
                    $returnData = [
                        'success' => 1,
                        'message' => 'Você realizou login com sucesso.',
                        'token' => $token
                    ];

                // IF INVALID PASSWORD
                else:
                    $returnData = msg(0,422,'Senha Incorreta!');
                endif;

            // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
            else:
                $returnData = msg(0,422,'Endereço de email invalido!');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);