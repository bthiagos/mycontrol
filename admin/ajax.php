<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'edit_user'){
	$save = $crud->edit_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_responsavel'){
	$save = $crud->save_responsavel();
	if($save)
		echo $save;
}
if($action == 'edit_responsavel'){
	$save = $crud->edit_responsavel();
	if($save)
		echo $save;
}
if($action == 'delete_responsavel'){
	$save = $crud->delete_responsavel();
	if($save)
		echo $save;
}
if($action == 'save_familia'){
	$save = $crud->save_familia();
	if($save)
		echo $save;
}
if($action == 'delete_familia'){
	$save = $crud->delete_familia();
	if($save)
		echo $save;
}
/* if($action == 'check_student'){
	$save = $crud->check_student();
	if($save)
		echo $save;
} */
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
	echo $save;
}

/* if($action == 'signup2'){
	$save = $crud->signup2();
	if($save)
	echo $save;
} */

if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}

if($action == "save_email_settings"){
	$save = $crud->save_email_settings();
	if($save)
		echo $save;
}

if($action == "save_student"){
	$save = $crud->save_student();
	if($save)
		echo $save;
}

/* if($action == "save_student2"){
	$save = $crud->save_student2();
	if($save)
		echo $save;
} */

if($action == "delete_student"){
	$save = $crud->delete_student();
	if($save)
		echo $save;
}

/* if($action == "recebe_student"){
	$save = $crud->recebe_student();
	if($save)
		echo $save;
} */

if($action == "save_log"){
	$save = $crud->save_log();
	if($save)
		echo $save;
}

if($action == "redefinir_senha"){
	$save = $crud->redefinir_senha();
	if($save)
		echo $save;
}

if($action == "set_nova_senha"){
	$save = $crud->set_nova_senha();
	if($save)
		echo $save;
}

if($action == "chart2"){
	$save = $crud->chart2();
	if($save)
		echo $save;
}


ob_end_flush();
?>
