<?php
require __DIR__ . '/classes/JwtHandler.php';

class Auth extends JwtHandler
{
    protected $db;
    protected $headers;
    protected $token;

    public function __construct($db, $headers)
    {
        parent::__construct();
        $this->db = $db;
        $this->headers = $headers;
    }

    public function isValid()
    {

        if (array_key_exists('Authorization', $this->headers) && preg_match('/Bearer\s(\S+)/', $this->headers['Authorization'], $matches)) {

            $data = $this->jwtDecodeData($matches[1]);

            if (
                isset($data['data']->user_id) &&
                $user = $this->fetchUser($data['data']->user_id)
            ) :
                return [
                    "success" => 1,
                    "user" => $user
                ];
            else :
                return [
                    "success" => 0,
                    "message" => $data['message'],
                ];
            endif;
        } else {
            return [
                "success" => 0,
                "message" => "Token não encontrado na solicitação."
            ];
        }
    }

    public function isValidRegistros()
    {

        if (array_key_exists('Authorization', $this->headers) && preg_match('/Bearer\s(\S+)/', $this->headers['Authorization'], $matches)) {

            $data = $this->jwtDecodeData($matches[1]);

            if (
                isset($data['data']->user_id) &&
                $user = $this->fetchRegistros($data['data']->user_id)
            ) :
                return [
                    "success" => 1,
                    "register" => $user
                ];
            else :
                return [
                    "success" => 0,
                    "message" => $data['message'],
                ];
            endif;
        } else {
            return [
                "success" => 0,
                "message" => "Token não encontrado na solicitação."
            ];
        }
    }

    protected function fetchRegistros($user_id)
    {
        try {
            $fetch_registros_by_id = "SELECT  alunos.matricula, alunos.nome as a_nome, registros.data_criacao, registros.tipo_registro
                                FROM registros
                                INNER JOIN alunos
                                ON alunos.id = registros.idaluno
                                JOIN alunoxresponsavel
                                ON alunoxresponsavel.idaluno = alunos.id
                                left join responsavel
                                ON alunoxresponsavel.idresponsavel = responsavel.id
                                WHERE responsavel.id IS NOT NULL
                                AND responsavel.id = :id
                                AND alunos.id is not null
                                order by unix_timestamp(data_criacao) desc";
            $query_stmt = $this->db->prepare($fetch_registros_by_id);
            $query_stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
            $query_stmt->execute();

            if ($query_stmt->rowCount()) :
                return $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            else :
                return false;
            endif;
        } catch (PDOException $e) {
            return null;
        }
    }

    protected function fetchUser($user_id)
    {
        try {
            $fetch_user_by_id = "SELECT `id`,`nome`,`sobrenome`,`email` FROM `responsavel` WHERE `id`=:id";
          /*   $fetch_user_by_id = "SELECT responsavel.nome, responsavel.email, alunos.matricula, alunos.nome as a_nome, registros.data_criacao, registros.tipo_registro
            FROM registros
            INNER JOIN alunos
            ON alunos.id = registros.idaluno
            JOIN alunoxresponsavel
            ON alunoxresponsavel.idaluno = alunos.id
            left join responsavel
            ON alunoxresponsavel.idresponsavel = responsavel.id
            WHERE responsavel.id = :id
            AND responsavel.id IS NOT NULL
            AND alunos.id is not null
            order by unix_timestamp(data_criacao) desc ";*/
            $query_stmt = $this->db->prepare($fetch_user_by_id);
            $query_stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
            $query_stmt->execute();

            if ($query_stmt->rowCount()) :
                return $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            else :
                return false;
            endif;
        } catch (PDOException $e) {
            return null;
        }
    }
}

/* SELECT  alunos.matricula, alunos.nome as a_nome, registros.data_criacao, registros.data_criacao, registros.tipo_registro 
FROM `registros` 
INNER JOIN alunos
ON alunos.id = registros.idaluno
JOIN alunoxresponsavel
ON alunoxresponsavel.idaluno = alunos.id
left join responsavel
ON alunoxresponsavel.idresponsavel = responsavel.id
WHERE responsavel.id IS NOT NULL
AND responsavel.id = 1
AND alunos.id is not null
order by unix_timestamp(data_criacao) desc */