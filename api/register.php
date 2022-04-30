<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ], $extra);
}

function validaCPF($cpf = null) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
		return false;
	}

	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}

// DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Página Não Encontrada!');

elseif (
    !isset($data->cpf)
    || !isset($data->nome)
    || !isset($data->sobrenome)
    || !isset($data->email)
    || !isset($data->senha)
    || !isset($data->aceita_email)
    || !isset($data->token)
    || !isset($data->confirmado)
    || empty(trim($data->cpf))
    || empty(trim($data->nome))
    || empty(trim($data->sobrenome))
    || empty(trim($data->email))
    || empty(trim($data->senha))
    || empty(trim($data->aceita_email))
    || empty(trim($data->token))
    || empty(trim($data->confirmado))
) :

    $fields = ['fields' => ['cpf','nome', 'sobrenome', 'email', 'senha', 'aceita_email', 'token', 'confirmado']];
    $returnData = msg(0, 422, 'Por favor, Preencha Todos os Campos Requisitados!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $cpf = trim($data->cpf);
    $nome = trim($data->nome);
    $sobrenome = trim($data->sobrenome);
    $email = trim($data->email);
    $senha = trim($data->senha);
    $aceita_email = trim($data->aceita_email);
    $token = trim($data->token);
    $confirmado = trim($data->confirmado);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        $returnData = msg(0, 422, 'Endereço de Email Invalido!');

    elseif (strlen($senha) < 8) :
        $returnData = msg(0, 422, 'Sua senha deve ter pelo menos 8 caracteres!');

    elseif (strlen($sobrenome) < 3) :
        $returnData = msg(0, 422, 'Seu sobrenome deve ter pelo menos 3 caracteres!');

    elseif (strlen($nome) < 3) :
        $returnData = msg(0, 422, 'Seu nome deve ter pelo menos 3 caracteres!');

    elseif (!validaCPF($cpf)):
        $returnData = msg(0, 422, 'CPF inválido!');
    else :
        try {

            $check_email = "SELECT `email` FROM `responsavel` WHERE `email`=:email";
            $check_email_stmt = $conn->prepare($check_email);
            $check_email_stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $check_email_stmt->execute();

            if ($check_email_stmt->rowCount()) :
                $returnData = msg(0, 422, 'Este e-mail já está em uso!');

            else :
                $insert_query = "INSERT INTO `responsavel`(`cpf`,`nome`,`sobrenome`,`email`,`senha`,`aceita_email`,`token`,`confirmado`) VALUES(:cpf,:nome,:sobrenome,:email,:senha,:aceita_email,:token,:confirmado)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                $insert_stmt->bindValue(':cpf', $cpf, PDO::PARAM_STR);
                $insert_stmt->bindValue(':nome', htmlspecialchars(strip_tags($nome)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':sobrenome', htmlspecialchars(strip_tags($sobrenome)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $insert_stmt->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT), PDO::PARAM_STR);
                $insert_stmt->bindValue(':aceita_email', $aceita_email, PDO::PARAM_INT);
                $insert_stmt->bindValue(':token', $token, PDO::PARAM_STR);
                $insert_stmt->bindValue(':confirmado', $confirmado, PDO::PARAM_INT);

                $insert_stmt->execute();

                $returnData = msg(1, 201, 'Você se Cadastrou com Sucesso!');

            endif;
        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);
