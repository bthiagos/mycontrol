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
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
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
                    <h5 class="modal-title" id="modalLoginLabel">Acesso</h5>
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
                                    <a href="#" data-toggle="modal" data-target="#resetModal">Esqueci a senha</a>
                                </label>
                            </div>
                            <!-- login btn -->
                            <button class="btn btn-primary">Entrar</button>
                            <br><br>
                            <p class="colaborador">Área do Colaborador:
                                <a href="admin/index.php">
                                    acesse aqui
                                </a>
                            </p>
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
            margin-bottom: 10px;
        }

        .sign-up-container {
            padding: 20px;
        }
    </style>
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroLabel">Cadastro</h5>
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
                            </div> -->
                            <h5>Dados do Responsável</h5>
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

    <header class="masthead text-white " style=" background: url('../img/bg-07.png?auto=compress&cs=tinysrgb&h=650&w=940') no-repeat center center; ">
        <div class="overlay" style="background-color: #fff"></div>
        <div class="container slider-top-text">
            <div class="row">
                <div class="col-md-12 text-center">
                    <!--<h3 class="my-heading">my<span class="bg-main">Control</span></h3>-->
                    <!-- <h3 class="my-heading "><span class="bg-main"><img src="assets/img/logo-atual-v2.png" class="logo-subhead"></span></h3>
                    <p class="mt-2 myp-slider text-center">Sistema de Controle de Acesso Escolar</p>
                    <p class="myp text-center"></p>
                    <p class="myp text-center"></p>         -->

                    <?php
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];

                        require("admin/db_connect.php");

                        $sqlVerificaToken = "SELECT token FROM responsavel WHERE token = '$token'";

                        if ($resultVerificaToken = mysqli_query($conn, $sqlVerificaToken)) {
                            $totalLinhas = mysqli_num_rows($resultVerificaToken);

                            if ($totalLinhas > 0) {
                                $sqlConfirma = "UPDATE responsavel SET confirmado = 1, token='' WHERE token='$token' ";
                            }
                            if (mysqli_query($conn, $sqlConfirma)) {
                                echo "<div class='alert alert-success' role='alert'>
                                            Cadastro ativado com sucesso! 
                                    </div>
                                                <a class='btn btn-primary btn-block btn-register' data-toggle='modal' data-target='#modalLogin'>
                                                    Faça o login para acessar o sistema.
                                                </a>
                                        ";
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>
                                            Erro ao ativar o cadastro: " . mysqli_error($conn) . "
                                        </div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>
                                Código de ativação inválido!
                                </div>
                                <br>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>
                        Esse link de ativição é inválido!
                        </div>
                        <br>";
                    }


                    ?>

                </div>
                <div class="col-md-12 text-center mt-5">
                    <!--  <div class="scroll-down">
                        <a class="btn btn-default btn-scroll floating-arrow" href="#gobottom" id="bottom"><i class="fa fa-angle-down"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </header>

    <!--     <section class="testimonials" id="gobottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 wow bounceInUp" data-wow-duration="1.4s">
                    <div class="big-img">
                        <img src="assets/img/img1.png?auto=compress&cs=tinysrgb&h=650&w=940" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="inner-section wow fadeInUp">
                        <h3>O que <span class="bg-main">Somos</span></h3>
                        <br>
                        <p class="text-justify">Um sistema de identificação e registro de entrada e saída escolar por meio de uma carteirinha com código de barras, catraca ou biometria. 
                            No qual o responsável receba, por meio de e-mail ou redes sociais as informações de entrada e saída de seu/sua filho(a),
                            Com detalhes de data e hora, mostra-se de significativa importância administrativa e pedagógica no âmbito educacional. 
                            Esse sistema online também propiciará aos responsáveis o acesso a relatórios diversos da vida acadêmica de seus filhos, 
                            além de beneficiar toda a estrutura organizacional e administrativa dos gestores da escola.</p>

                        <div class="linear-grid">
                            <div class="row">
                                <div class="col-sm-6 col-md-3 mb-2 wow bounceInUp" data-wow-duration="1.4s">
                                    <figure class="figure">
                                        <img src="https://img.flaticon.com/icons/png/512/1792/1792189.png?auto=compress&cs=tinysrgb&h=350" class="img-thumbnail">
                                        <figcaption class="figure-caption">Notificação por e-mail</figcaption>
                                    </figure>
                                </div>
                                <div class=" col-sm-6 col-md-3 mb-2 wow bounceInUp" data-wow-duration="1.4s">
                                    <figure class="figure">
                                        <img src="https://revistanews.com.br/wp-content/uploads/2019/02/senac-ead_smarphone.jpg?auto=compress&cs=tinysrgb&h=350" class="img-thumbnail">
                                        <figcaption class="figure-caption">Painel Web Acessível</figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm-6 col-md-3 mb-2 wow bounceInUp" data-wow-duration="1.4s">
                                    <figure class="figure">
                                        <img src="https://aix.com.br/wp-content/uploads/2015/07/Capa-01.jpg?auto=compress&cs=tinysrgb&h=350" class="img-thumbnail">
                                        <figcaption class="figure-caption">Relatórios</figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm-6 col-md-3 mb-2 wow bounceInUp" data-wow-duration="1.4s">
                                    <figure class="figure">
                                        <img src="https://vetus.com.br/universidade/wp-content/uploads/2016/12/software-02.png?auto=compress&cs=tinysrgb&h=350" class="img-thumbnail">
                                        <figcaption class="figure-caption">Integração</figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

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