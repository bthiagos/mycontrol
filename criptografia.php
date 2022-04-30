<?php

$senha = "123456";
$senha_db = '$2y$10$lElgxOYkaQ6hkSoDaP1VhONt8MLR4BWYnbFP.7OIiHdeqghB/xVny';
/* $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

echo $senhaSegura; */

if(password_verify($senha, $senha_db)){
    echo "Senha válida!";
}
else{
    echo "Senha Inválida!";
}