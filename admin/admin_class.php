<?php

use \PHPMailer\PHPMailer;

require("config.php");
require("PHPMailer/PHPMailer.php");
require("PHPMailer/SMTP.php");

session_start();
ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
		$senha = filter_var($_POST['senha']);

		if (isset($usuario) && isset($senha)) {
			$qry = $this->db->query("SELECT * FROM usuarios where usuario = '{$usuario}' and senha =  md5('{$senha}')  ");
			//$chk_tipo = $this->db->query("SELECT * FROM usuarios where usuario = '{$usuario}' and senha =  md5('{$senha}')  ");
			if ($qry->num_rows > 0) {
				foreach ($qry->fetch_array() as $key => $value) {
					if ($key != 'senha' && !is_numeric($key))
						$_SESSION['login_' . $key] = $value;
				}
				if ($_SESSION['login_tipo'] == 1) {
					return 1;
				}
				if ($_SESSION['login_tipo'] == 2) {
					return 2;
				}
			} else {
				return 3;
			}
		} else {
			return 3;
		}
	}

	function login2()
	{

		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$senha = filter_var($_POST['senha']);
		if (isset($email))
			$username = $email;
		$qry = $this->db->query("SELECT * FROM responsavel where email = '" . $email . "' and senha = '" . md5($senha) . "'");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'senha' && !is_numeric($key))
					$_SESSION['login_resp_' . $key] = $value;
			}
			if ($_SESSION['login_resp_confirmado'] == 0) {
				return 2;
			} else {
				return 1;
			}
		} else {
			return 3;
		}
	}

	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}

		header("location:../index.php");
	}

	function save_user()
	{
		extract($_POST);
		$data = " nome = '$nome' ";
		$data .= ", usuario = '$usuario' ";
		if (!empty($senha))
			$data .= ", senha = '" . md5($senha) . "' ";
		$data .= ", tipo = '$type' ";
		$chk = $this->db->query("Select * from usuarios where usuario = '$usuario' and id !='$id' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO usuarios set " . $data);
		} else {
			$chk = $this->db->query("Select * from usuarios where usuario = '$usuario' and id = '$id' and senha = '$senha' ")->num_rows;
			if ($chk > 0) {
				return 2;
			} else {
				$save = $this->db->query("UPDATE usuarios set " . $data . " where id = " . $id);
			}
		}
		if ($save) {
			return 1;
		}
	}

	function edit_user()
	{
		extract($_POST);
		$data = " nome = '$nome' ";
		$data .= ", usuario = '$usuario' ";
		if (!empty($senha))
			$data .= ", senha = '" . md5($senha) . "' ";
		$chk = $this->db->query("Select * from usuarios where usuario = '$usuario' and id !='$id' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO usuarios set " . $data);
		} else {
			$chk = $this->db->query("Select * from usuarios where usuario = '$usuario' and id = '$id' and senha = '$senha' ")->num_rows;
			if ($chk > 0) {
				return 2;
			} else {
				$save = $this->db->query("UPDATE usuarios set " . $data . " where id = " . $id);
			}
		}
		if ($save) {
			return 1;
		}
	}

	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM usuarios where id = " . $id);
		if ($delete)
			return 1;
	}

	function save_responsavel()
	{
		extract($_POST);
		$data = " nome = '$nome' ";
		$data .= ", sobrenome = '$sobrenome' ";
		$data .= ", email = '$email' ";
		if (!empty($senha))
			$data .= ", senha = '" . md5($senha) . "' ";
		$chk = $this->db->query("Select * from responsavel where email = '$email' and id !='$id' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO responsavel set " . $data);
		} else {
			$chk = $this->db->query("Select * from responsavel where email = '$email' and id = '$id' and senha = '$senha' ")->num_rows;
			if ($chk > 0) {
				return 2;
			} else {
				$save = $this->db->query("UPDATE responsavel set " . $data . " where id = " . $id);
			}
		}
		if ($save) {
			return 1;
		}
	}

	function edit_responsavel()
	{
		extract($_POST);
		$data = " nome = '$nome' ";
		$data .= ", usuario = '$usuario' ";
		if (!empty($senha))
			$data .= ", senha = '" . md5($senha) . "' ";
		$chk = $this->db->query("Select * from usuarios where usuario = '$usuario' and id !='$id' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO usuarios set " . $data);
		} else {
			$chk = $this->db->query("Select * from usuarios where usuario = '$usuario' and id = '$id' and senha = '$senha' ")->num_rows;
			if ($chk > 0) {
				return 2;
			} else {
				$save = $this->db->query("UPDATE usuarios set " . $data . " where id = " . $id);
			}
		}
		if ($save) {
			return 1;
		}
	}


	function delete_responsavel()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM responsavel where id = " . $id);
		if ($delete)
			return 1;
	}

	function save_familia()
	{
		extract($_POST);
		$idaluno = $_POST['idaluno'];
		$idresponsavel = $_POST['idresponsavel'];

		$check = $this->db->query("SELECT * FROM alunoxresponsavel WHERE idaluno = '$idaluno' AND idresponsavel = '$idresponsavel'")->num_rows;
		if ($check > 0) {
			//$save = $this->db->query("UPDATE familia set idaluno='$idaluno',idresponsavel='$idresponsavel'");
			return 2;
			exit;
		} else {
			$save = $this->db->query("INSERT INTO alunoxresponsavel (idaluno,idresponsavel) VALUES ('$idaluno','$idresponsavel')");
		}
		if ($save) {
			return 1;
			exit;
		} else {
			return 2;
			exit;
		}
	}

	function delete_familia()
	{
		$id = $_POST['id'];
		$delete = $this->db->query("DELETE FROM alunoxresponsavel where id = " . $id);
		if ($delete)
			return 1;
	}

	function signup()
	{
		extract($_POST);
		$cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);

		/* $cpf = validaCPF($_POST['$_cpf']); */
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$email_a_enviar = $email;

		//Limpa CPF
		if (strlen($cpf) != 11) {
			print "O CPF Precisa ter 11 números!";
			exit();
		}
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			print "O CPF Inválido!";
			exit();
		}
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				print "O CPF Inválido!";
				exit();
			}
		}

		if (!($cpf) || !($nome) || !($sobrenome) || !($email) || !($senha) || !($confsenha)) {
			print "Preencha todos os campos!";
			exit();
		}
		if (!empty($senha)) {
			$senha = md5($_POST['senha']);
		}

		$chk = $this->db->query("SELECT * FROM responsavel where email = '$email' OR cpf = '$cpf' ");

		if ($chk->num_rows > 0) {
			return 2;
			exit;
		} else {
			//gera hash token
			$token = md5(sprintf('%07X', mt_rand(0, 0xFFFFFFF)));
			//Insere Usuário Responsável no Banco de Dados
			$save = $this->db->query("INSERT INTO responsavel (cpf, nome, sobrenome, email, senha, aceita_email, token, confirmado) VALUES ('$cpf','$nome','$sobrenome','$email','$senha',1, '$token',0) ");
		}
		if ($save) {
			//criar o link para receber a confirmação do e-mail do cadastro
			$link = 'http://localhost/mycontrol/confirma.php?token=' . $token;


			$mail = new PHPMailer();

			try {
				$mail->setLanguage('br');
				$mail->CharSet = 'UTF-8';

				//Server settings
				$mail->isSMTP();
				$mail->Host       = EMAIL_HOST;
				$mail->SMTPAuth   = true;
				$mail->Username   = EMAIL_USER;
				$mail->Password   = EMAIL_PASS;
				$mail->SMTPSecure = 'tls';
				$mail->Port       = EMAIL_PORT;

				//Recipients
				$mail->setFrom(EMAIL_FROM, APP_NAME);
				$mail->addAddress($email_a_enviar);
				/* $mail->addBCC(EMAIL_ADMIN); */

				//Assunto
				$mail->isHTML(true);
				$mail->Subject = APP_NAME . ' - Confirmação de email';

				//Mensagem
				$html = '<p>Seja bem-vindo ao ' . APP_NAME . '.</p>';
				$html .= '<p>Para finalizar o cadastro e acessar o sistema, confirme o seu e-mail no botão abaixo:</p>';
				$html .= '<p><a href="' . $link . '" style="
				background-color: #007bff;
				border: none;
				color: #fff;
				padding: 10px 30px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				font-family: "Raleway", sans-serif;">Confirmar E-mail</a></p>';
				$html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
				$mail->Body    = $html;

				$mail->send();
				return 1;
			} catch (Exception $e) {
				return 4;
			}
		} else {
			return 3;
			exit;
		}
	}

	function redefinir_senha()
	{

		extract($_POST);
		$email_a_enviar = $email;
		if (!($email)) {
			print "Preencha o campo!";
			exit();
		}
		$chk = $this->db->query("SELECT * FROM responsavel where email = '$email'");

		if ($chk->num_rows > 0) {
			$row = $chk->fetch_assoc();
			//gera hash token
			$formato_exp = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
			$data_criacao = date("Y-m-d H:i:s", $formato_exp);
			$chave = md5($row['id'] . $row['email']);
			$save = $this->db->query("INSERT INTO redefine_senha_temp (email,chave,data_criacao) VALUES ('$email','$chave','$data_criacao')");
			
		} else {
			return 2;
			exit;
		}
		if ($save) {
			//criar o link para receber a confirmação do e-mail do cadastro
			$link = 'http://localhost/mycontrol/envia_novasenha.php?chave=' . $chave . '&email=' . $email . '&action=reset';
			
			$mail = new PHPMailer();
			try {
				$mail->setLanguage('br');
				$mail->CharSet = 'UTF-8';

				//Server settings
				$mail->isSMTP();
				$mail->Host       = EMAIL_HOST;
				$mail->SMTPAuth   = true;
				$mail->Username   = EMAIL_USER;
				$mail->Password   = EMAIL_PASS;
				$mail->SMTPSecure = 'tls';
				$mail->Port       = EMAIL_PORT;

				//Recipients
				$mail->setFrom(EMAIL_FROM, APP_NAME);
				$mail->addAddress($email_a_enviar);

				//Assunto
				$mail->isHTML(true);
				$mail->Subject = APP_NAME . ' - Redefinição de Senha';

				//Mensagem
				$html = '<p>' . APP_NAME . '.</p>';
				$html .= '<p>Para redefinir a senha de acesso, clique no link abaixo:</p>';
				$html .= '<p><a href="' . $link . '" style="
				background-color: #007bff;
				border: none;
				color: #fff;
				padding: 10px 30px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				font-family: "Raleway", sans-serif;">Redefinir senha</a></p>';
				$html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
				$mail->Body    = $html;

				$mail->send();
				return 1;
			} catch (Exception $e) {
				return 4;
			}
			/* if (!$mail->Send()) {
				return 4;
			} else {
				return 1;
			} */
		} else {
			return 3;
			exit;
		}
	}

	function set_nova_senha()
	{
		$senha1 = $_POST['senha1'];
		$senha2 = $_POST['senha2'];
		$email = $_POST['email'];
		$curDate = date('Y-m-d H:i:s');

		if ((!empty($senha1) || !empty($senha2)) && ($senha1 == $senha2)) {
			$senha1 = md5($senha1);
			$save = $this->db->query("UPDATE responsavel SET senha = '$senha1' WHERE email = '$email'");
			$deleta_temp_senha = $this->db->query("DELETE FROM redefine_senha_temp WHERE email = '$email'");
			if ($save && $deleta_temp_senha) {
				return 1;
			} else {
				return 3;
			}
		} else {
			return 2;
		}
	}

	function update_account()
	{
		extract($_POST);
		$data = " nome = '$nome' ";
		$data .= ", sobrenome = '$sobrenome' ";
		$data .= ", email = '$email' ";
		if (!empty($senha))
			$data .= ", senha = '" . md5($senha) . "' ";
		$chk = $this->db->query("SELECT * FROM responsavel where email = '$email' and id != '{$_SESSION['login_resp_id']}' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		$save = $this->db->query("UPDATE responsavel set $data where id = '{$_SESSION['login_resp_id']}' ");
		if ($save) {
			$data = '';
			foreach ($_POST as $k => $v) {
				if ($k == 'senha')
					continue;
				if (empty($data) && !is_numeric($k))
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if ($_FILES['img']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
				$data .= ", avatar = '$fname' ";
			}
			/*$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");*/
			if ($data) {
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if ($login)
					return 1;
			}
		}
	}

	function save_settings()
	{
		extract($_POST);
		$data = " nome = '" . str_replace("'", "&#x2019;", $nome) . "' ";
		$data .= ", email = '$email' ";
		$data .= ", contato = '$contato' ";
		$data .= ", sobre = '" . htmlentities(str_replace("'", "&#x2019;", $sobre)) . "' ";
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", img_path = '$fname' ";
		}

		// echo "INSERT INTO config_sistema set ".$data;
		$chk = $this->db->query("SELECT * FROM config_sistema");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE config_sistema set " . $data);
		} else {
			$save = $this->db->query("INSERT INTO config_sistema set " . $data);
		}
		if ($save) {
			$query = $this->db->query("SELECT * FROM config_sistema limit 1")->fetch_array();
			foreach ($query as $key => $value) {
				if (!is_numeric($key))
					$_SESSION['system'][$key] = $value;
			}

			return 1;
		}
	}

	function save_email_settings()
	{
		extract($_POST);
		$data = " host = '$host' ";
		$data .= ", porta = '$porta' ";
		$data .= ", usuario = '$usuario' ";
		$data .= ", senha = '$senha' ";

		$chk = $this->db->query("SELECT * FROM config_email");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE config_email set " . $data);
		} else {
			$save = $this->db->query("INSERT INTO config_email set " . $data);
		}
		if ($save) {
			return 1;
		}
	}

	function save_student()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], './assets/uploads/' . $fname);
			$data .= ", img_path = '$fname' ";
		}
		$check = $this->db->query("SELECT * FROM alunos where matricula ='$matricula' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		$check2 = $this->db->query("SELECT * FROM alunos where matricula ='$matricula' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO alunos set $data");
		} else {
			$save = $this->db->query("UPDATE alunos set $data where id = $id");
		}

		if ($save) {
			return 1;
		} else {
			return 2;
			exit;
		}
	}

	function delete_student()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM alunos where id = " . $id);
		if ($delete) {
			return 1;
		} else {
			return 2;
		}
	}

	function save_log()
	{
		$mail = new PHPMailer();

		extract($_POST);
		$data = array();
		$qtd_registro;
		$qry = $this->db->query("SELECT * from $type where matricula = '$id_code' ");
		$qry2 =  $this->db->query(" SELECT alunos.nome, responsavel.email
									FROM ALUNOS
									LEFT JOIN ALUNOXRESPONSAVEL
									ON ALUNOS.ID = ALUNOXRESPONSAVEL.IDALUNO
									LEFT JOIN RESPONSAVEL
									ON ALUNOXRESPONSAVEL.IDRESPONSAVEL = RESPONSAVEL.ID
									WHERE RESPONSAVEL.ID IS NOT NULL
									AND ALUNOS.MATRICULA = $id_code;");

		if ($qry->num_rows > 0) {
			$res = $qry->fetch_array();
			/* $res2 = $qry2->fetch_array(); */
			while ($res2 = $qry2->fetch_array()) {
				$emails_resps[] = trim($res2['email']);
			}
			$emails_resps = array_unique($emails_resps);

			$id = $res['id'];
			$data['nome'] = ucwords($res['nome']);
			$data['matricula'] = $res['matricula'];
			$data['img_path'] = $res['img_path'];
			$data['email'] = $res['email'];
			/* $email_a_enviar = $res2['email']; */
			$email_a_enviar = array();
			$valida_entrada = $this->db->query("SELECT * FROM registros where idaluno = '$id' and date(data_criacao) = '" . date('Y-m-d') . "'");

			//VALIDA APENAS 1 entrada e 1 saida
			if ($valida_entrada->num_rows > 9) {
				$data['status'] = 3;
				return json_encode($data);
				exit;
			}
		} else {
			$data['status'] = 2;
			return json_encode($data);
			exit;
		}
		$chk = $this->db->query("SELECT * FROM registros  where idaluno = '$id' and date(data_criacao) = '" . date('Y-m-d') . "' and tipo = '$type' order by unix_timestamp(data_criacao) desc limit 1 ");
		$result = $chk->num_rows > 0 ? $chk->fetch_array() : '';
		if (!empty($result)) {
			$ltype = $result['tipo_registro'] == 1 ? 2 : 1;
		} else {
			$ltype = 1;
		}

		$save = $this->db->query("INSERT INTO registros (idaluno, tipo_registro, tipo) VALUES ('$id','$ltype','$type')");
		$leave_me_alone = $this->db->query("SELECT alunos.matricula, alunos.nome, registros.tipo_registro, registros.data_criacao 
		FROM registros 
		JOIN alunos ON
		alunos.id = registros.idaluno
		where idaluno = '$id'
		and date(data_criacao) = '" . date('Y-m-d') . "' 
		and tipo = '$type' order by unix_timestamp(data_criacao) desc limit 1 
		");
		if ($leave_me_alone->num_rows > 0) {
			$result_a_email = $leave_me_alone->fetch_array();
			$aluno_matricula = $result_a_email['matricula'];
			$aluno_nome = $result_a_email['nome'];
			$aluno_data_criacao = $result_a_email['data_criacao'];
			if ($result_a_email['tipo_registro'] == 1) {
				$aluno_tipo_registro = "Entrada";
			} else {
				$aluno_tipo_registro = "Saída";
			}
		}
		if ($save) {
			$data['status'] = 1;
			$data['tipo'] = $ltype;
			try {
				$mail->setLanguage('br');
				$mail->CharSet = 'UTF-8';

				//Server settings
				$mail->isSMTP();
				$mail->Host       = EMAIL_HOST;
				$mail->SMTPAuth   = true;
				$mail->Username   = EMAIL_USER;
				$mail->Password   = EMAIL_PASS;
				$mail->SMTPSecure = 'tls';
				$mail->Port       = EMAIL_PORT;

				//Recipients
				$mail->setFrom(EMAIL_FROM, APP_NAME);
				foreach ($emails_resps as $value) {
					$mail->AddAddress($value); //Adiciona os endereços
				}
				//Assunto
				$mail->isHTML(true);
				$mail->Subject = APP_NAME . ' - Entrada e Saída';


				ob_start();
				$mensagem = "
                <table bgcolor='#1c84e3' width='800' hidden='300' xmlns=\"http://www.w3.org/1999/html\"     border='no'>
                    <tr>
						<p><h3><center>Entrada e Saída Escolar</center></h3></p>
                    </tr>
                    <tr bgcolor='#E0E6F8' height='150'>
                        <p>
                            <b>
                                <h3>                                      
                                    Matrícula: [MATRICULA]
                                </h3>
								<h3>                                      
                                    Nome: [NOME]
                                </h3>
								<h3>                                      
                                    Tipo: [TIPO]
                                </h3>
								<h3>                                      
                                    Registro: [DATACRIACAO]
                                </h3>
                            </b>
                        </p>
                    </tr>                        
                </table>";
				$mensagem = str_replace('[MATRICULA]', $aluno_matricula, $mensagem);
				$mensagem = str_replace('[NOME]', $aluno_nome, $mensagem);
				$mensagem = str_replace('[TIPO]', $aluno_tipo_registro, $mensagem);
				$mensagem = str_replace('[DATACRIACAO]', $aluno_data_criacao, $mensagem);
				ob_end_clean();

				//Mensagem
				$mail->Body = $mensagem;

				$mail->send();
				return json_encode($data);
			} catch (Exception $e) {
				return json_encode($data);
			}
		}
	}


	function chart2()
	{
		$query =  "SELECT COUNT(*) as total, MONTH(NOW()) as mes FROM registros 
		WHERE MONTH(data_criacao) = MONTH(NOW())
		AND YEAR(data_criacao) = YEAR(NOW())";
		$query_run = mysqli_query($this->db, $query);
		$data = array();
		foreach ($query_run as $row) {
			$data[] = $row;
		}
		/* mysqli_close($conn); */

		echo json_encode($data);
	}

	function chart3()
	{
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
					FROM registros INNER JOIN alunos 
					ON registros.idaluno = alunos.id 
					WHERE MONTH(data_criacao) = MONTH(NOW())
					AND YEAR(data_criacao) = YEAR(NOW())
					GROUP BY dia
					ORDER BY dia";
		$query_run = mysqli_query($this->db, $query);
		$data = array();
		foreach ($query_run as $row) {
			$data[] = $row;
		}

		json_encode($data);
	}

	function salvaLog($mensagem, $idpessoa, $tipo)
	{
		$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
		$data_hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)

		// Usamos o mysql_escape_string() para poder inserir a mensagem no banco
		//   sem ter problemas com aspas e outros caracteres
		$mensagem = mysqli_escape_string($this->db, $mensagem);

		// Monta a query para inserir o log no sistema
		$sql = $this->db->query("INSERT INTO `logs_sistema` (data_hora, ip, mensagem, idpessoa, tipo) VALUES ('$data_hora','$ip','$mensagem','$idpessoa','$tipo')");

		if ($sql) {
			return true;
		} else {
			return false;
		}
	}

	function limpaCPF($valor)
	{
		$valor = preg_replace('/[^0-9]/', '', $valor);
		return $valor;
	}

	function validaCPF($cpf)
	{
		// Verifica se um número foi informado
		if (empty($cpf)) {
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
		else if (
			$cpf == '00000000000' ||
			$cpf == '11111111111' ||
			$cpf == '22222222222' ||
			$cpf == '33333333333' ||
			$cpf == '44444444444' ||
			$cpf == '55555555555' ||
			$cpf == '66666666666' ||
			$cpf == '77777777777' ||
			$cpf == '88888888888' ||
			$cpf == '99999999999'
		) {
			return false;
		} else {

			for ($t = 9; $t < 11; $t++) {

				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{
						$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{
					$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	function tirarCaracteresEspeciais($string)
	{
		//Usa a função para padronizar a codificação da página
		$string = utf8_encode($string);
		//Trim retira os espaços vazios no começo e fim da variável
		$string = trim($string);
		//str_replace substitui um carácter por outro, nesse caso espaço por nada
		$string = str_replace(' ', '', $string);
		//Aqui substitui o underline por nada
		$string = str_replace('_', '', $string);
		//Aqui retira a barra
		$string = str_replace('/', '', $string);
		//Nessa linha o traço
		$string = str_replace('-', '', $string);
		//A abertura de parenteses
		$string = str_replace('(', '', $string);
		//O fechamento de parenteses
		$string = str_replace(')', '', $string);
		//O ponto
		$string = str_replace('.', '', $string);
		//No fim é retornado a variável com todas as alterações
		return $string;
	}
}
