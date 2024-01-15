<!DOCTYPE html>
<html lang="en">

<?php 

include_once('class/Conexao.php');
include_once('class/Usuarios.php');

include_once('link.php'); 

$Usuario = new Usuario();

if (isset($_POST['btnLogar'])){
        $Usuario->logar($_POST['login'],$_POST['senha']);
    }

if(isset($_SESSION['logado']) ){
    header('location:orcamentos.php');
    }

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MB - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for centering content vertically -->
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .card {
            max-width: 100%;
        }
    </style>

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"
                                style="background: url('img/logo.png'); background-size: cover;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <?php if (isset($_GET['an'])) {?>
                                    <span class="alert alert-danger d-flex">
                                        <b>Acesso Negado! Logue</b>
                                    </span>
                                    <?php }elseif(isset($_GET['falha'])){?>
                                    <span class="alert alert-warning d-flex">
                                        <b>Usuário e/ou Senha Incorreto(s)!</b>
                                    </span>
                                    <?php } ?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bem-Vindo de Volta !</h1>
                                    </div>

                                    <form method="post" action="?" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Usuário" name="login">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Senha" name="senha">
                                        </div>
                                        <button type="submit" name="btnLogar" id="btnLogar"
                                            class="btn btn-danger btn-user btn-block">
                                            Entrar
                                        </button>
                                        <hr>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
