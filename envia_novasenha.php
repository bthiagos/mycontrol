<html lang="pt-br">

<?php session_start(); ?>
<?php
if (isset($_SESSION['login_resp_id']) and ($_SESSION['login_resp_confirmado']) == 1)
    header("location:painel/index.php?page=home");

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : 'myControl - Controle Escolar' ?></title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>

<body>
    <div id="preloader"></div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <!--<h3 class="my-heading ">my<span class="bg-main">Control</span></h3>-->
                <h3 class="my-heading "><span class="bg-main"><img src="assets/img/logo-atual-v2.png" class="logo-head"></span></h3>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars mfa-white"></span>
            </button>

            <div id="main">
                <a href="javascript:void(0)" class="openNav"><span class="fa fa-bars" onclick="openNav()"></span></a>
            </div>

            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <ul class="mob-ul">
                    <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#modalLogin">Acesso</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#modalCadastro">Cadastro</a></li>
                </ul>
            </div>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-link">
                        <a class="btn btn-primary btn-block btn-login" data-toggle="modal" data-target="#modalLogin">Acesso</a>
                    </li>
                    <li class="nav-link">
                        <a class="btn btn-primary btn-block btn-register" data-toggle="modal" data-target="#modalCadastro">Cadastro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Modal Login -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modalLoginLabel">Acesso do Responsável</h4>
                    <div id="msg"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- **************  login form ********* -->
                    <div class="logincontain" id="loginforn">
                        <form action="#" id="login-form">
                            <div class="form-group">
                                <!-- user name -->
                                <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <!-- password -->
                                <input type="password" class="form-control" placeholder="Digite sua senha" name="senha" id="senha" required>
                            </div>
                            <div class="form-group form-check">
                                <label class="formResetPass">
                                    <!-- Reset password -->
                                    <a href="#" data-toggle="modal" data-target="#modalEsqueciSenha">Esqueci a senha</a>
                                </label>
                            </div>
                            <!-- login btn -->
                            <button class="btn btn-primary">Entrar</button>
                            <br>
                            <span class="d-block text-center my-4 text-muted">&mdash; Área do Colaborador: <a href="admin/index.php">acesse aqui</a> &mdash;</span>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastro  -->
    <style>
        input {
            margin-bottom: 8px;
        }

        .sign-up-container {
            padding: 20px;
        }
    </style>
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCadastroLabel">Cadastro do Responsável</h4>
                    <div id="msg"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- **************  login form ********* -->
                    <div class="form-container sign-up-container">

                        <form action="#" id="signup-frm" method="POST">
                            <!-- <h5>Dados do Aluno</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="id_no" id="id_no" placeholder="Matrícula do Aluno" required />
                                    <input type="text" class="form-control" name="cpf_aluno" id="cpf_aluno" placeholder="CPF do Aluno" class="mb-4" required />
                                </div>
                            </div>
                            <h5>Dados do Responsável</h5> -->
                            <div id="cadastrov1" class="form-group">
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Seu CPF" data-mask="000.000.000-00" autofocus required />
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" required />
                                <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" required />
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required />
                                <input type="password" class="form-control" name="senha" id="password" placeholder="Senha" required />
                                <input type="password" class="form-control" name="confsenha" id="confsenha" placeholder="Confirmar Senha" required />
                                <br>
                                <button class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Esqueci a Senha -->
    <div class="modal fade" id="modalEsqueciSenha" tabindex="-1" role="dialog" aria-labelledby="modalEsqueciSenhaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modalEsqueciSenhaLabel">Redefinição de Senha</h4>
                    <div id="msg"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- **************  redefinir form ********* -->
                    <div class="esquecisenhacontain" id="esquecisenha-form">
                        <form action="#" id="esquecisenhaform">
                            <h5>Informe o e-mail para redefinir</h5>
                            <div class="form-group">
                                <!-- email name -->
                                <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email" id="email" required>
                            </div>
                            <!-- Redefinir btn -->
                            <button class="btn btn-primary">Redefinir</button>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        #set_senhanova {
            padding-left: 40px;
            padding-right: 40px;
            color: #398DDB;
        }
    </style>
    <header class="masthead text-white " style=" background: url('../img/bg-07.png?auto=compress&cs=tinysrgb&h=650&w=940') no-repeat center center; ">
        <!--  <div class="overlay" style="background-color: #fff"></div> -->
        <div class="overlay"></div>
        <div class="container slider-top-text">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    /* if (isset($_GET['chave'])) {
                        $chave = $_GET['chave']; */
                    if (isset($_GET['chave']) && isset($_GET['email']) && isset($_GET['action']) && ($_GET['action'] == "reset")) {
                        $chave = $_GET['chave'];
                        $email = $_GET['email'];
                        $curDate = date('Y-m-d H:i:s');

                        require("admin/db_connect.php");

                        $query = mysqli_query($conn, "SELECT * FROM redefine_senha_temp WHERE chave='$chave' and email='$email'");
                        $row = mysqli_num_rows($query);
                        if ($row == "") {
                            echo "<div class='alert alert-danger' role='alert'>
                                    Link inválido!
                                </div>";
                        } else {
                            $row = mysqli_fetch_assoc($query);
                            $expDate = $row['data_criacao'];
                            if ($expDate >= $curDate) {
                    ?>
                                <div class="container-fluid">
                                    <div class="row mt-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6 text-primary novasenha">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    <h2>Cadastro de Nova Senha</h2>
                                                </div>
                                                <div class="card-body">
                                                    <form action="#" id="set_senhanova">

                                                        <div class="form-group">
                                                            <label><strong>Nova Senha</strong></label>
                                                            <input type="password" name="senha1" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label><strong>Confirma Nova Senha</strong></label>
                                                            <input type="password" name="senha2" class="form-control" />
                                                        </div>
                                                        <input type="hidden" name="email" value="<?php echo $email; ?>" />
                                                        <div class="form-group">
                                                            <button class="btn btn-primary">Redefinir senha</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                <?php
                            } else {
                                $error .= "<h2>Link Expired</h2>>";
                            }
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>
                        Chave não encontrada!
                        </div>
                        <br>";
                    }


                                ?>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </header>
    <footer class="footer bg-dark">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 text-center text-lg-left my-auto  wow zoomIn">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item">
                            <a href="#">Sobre</a>
                        </li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item">
                            <a href="#">Contato</a>
                        </li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item">
                            <a href="#">Termos de Uso</a>
                        </li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item">
                            <a href="#">Politica de Privacidade</a>
                        </li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">© TCC Thiago 2021. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 text-center text-lg-right my-auto  wow zoomIn">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mr-3">
                            <a href="#">
                                <i class="fa fa-facebook fa-2x fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="#">
                                <i class="fa fa-twitter fa-2x fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-instagram fa-2x fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('#preloader').fadeOut('fast', function() {
                $(this).remove();
            })
        })
    </script>
</body>

</html>