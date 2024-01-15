<?php 
    include_once('class/classes.php');

    $Clientes = new Clientes();

    $Orcamento = new Orcamentos();

    if (isset($_POST['btnCadastrar'])){
        $Clientes->cadastrar($_POST);
        header('location:clientes.php');
    }
    if (isset($_POST['btnEditar'])){
        $Clientes->editar($_POST);
    }
    if (isset($_POST['btnExcluir'])){
        $Clientes->excluir($_POST);
    }
    if (isset($_POST['btnCadastrarOrcamento'])){
        $Orcamento->cadastrar($_POST);
    }
    if (isset($_POST['btnSair'])){
        Helper::deslogar();
    }   
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MonoBloco - Clientes</title>

    <?php include_once('link.php'); ?>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/a71781511a.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-cubes"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MONOBLOCO</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Paineis
            </div>

            <!-- Nav Item - Orçamentos -->
            <li class="nav-item">
                <a class="nav-link" href="orcamentos.php">
                    <i class="fa-solid fa-clipboard"></i>
                    <span>Orçamentos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

             <!-- Heading -->
             <div class="sidebar-heading">
                Cadastros
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="clientes.php">
                    <i class="fa-solid fa-clipboard"></i>
                    <span>Clientes</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nome'] ?></span>
                                <img class="img-profile rounded-circle" 
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Tabela de Clientes | <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cadastrarcliente"><i class="fa-solid fa-plus"></i></button></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>CPF</th>
                                            <th>Email</th>
                                            <th>Rua</th>
                                            <th>Bairro</th>
                                            <th>Cidade</th>
                                            <th>Numero</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($Clientes->listar() as $cliente){ ?>
                                        <?php $cpf = substr($cliente->cpf, 0, 3) . '.' . substr($cliente->cpf, 3, 3) . '.' . substr($cliente->cpf, 6, 3) . '-' . substr($cliente->cpf, 9, 2) ?>
                                        <tr class="text-center">
                                            <td><?php echo $cliente->id_cliente ?></td>
                                            <td><?php echo $cliente->nome ?></td>
                                            <td><a href="https://wa.me/55<?php echo $cliente->telefone?>"><?php echo $cliente->telefone ?></a></td>
                                            <td><?php echo $cpf ?></td>
                                            <td><?php echo $cliente->email ?></td>
                                            <td><?php echo $cliente->rua ?></td>
                                            <td><?php echo $cliente->bairro ?></td>
                                            <td><?php echo $cliente->cidade ?></td>
                                            <td><?php echo $cliente->numero ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrarorcamento" data-idcliente="<?php echo $cliente->id_cliente ?>"><i class="fa-solid fa-car"></i></button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editarcliente"  
                                                data-idcliente="<?php echo $cliente->id_cliente ?>"
                                                data-nome="<?php echo $cliente->nome ?>"
                                                data-telefone="<?php echo $cliente->telefone ?>"
                                                data-cpf="<?php echo $cliente->cpf ?>"
                                                data-email="<?php echo $cliente->email ?>"
                                                data-rua="<?php echo $cliente->rua ?>"
                                                data-bairro="<?php echo $cliente->bairro ?>"
                                                data-cidade="<?php echo $cliente->cidade ?>"
                                                data-numero="<?php echo $cliente->numero ?>"
                                                ><i class="fa-solid fa-gear"></i></button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluircliente" data-idcliente="<?php echo $cliente->id_cliente ?>" data-nome="<?php echo $cliente->nome ?>"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal Cadastrar Cliente -->
            <div class="modal fade" id="cadastrarcliente" tabindex="-1" aria-labelledby="cadastrarclienteLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadastrarclienteLabel">Cadastro de Novo Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="nome" class="form-label">Nome do Cliente</label>
                                    <input type="text" name="nome" id="nome" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="telefone" class="form-label">Telefone *</label>
                                    <input type="text" name="telefone" id="telefone" class="form-control" maxlength="11" required>
                                </div>
                                <div class="col-4">
                                    <label for="cpf" class="form-label">CPF *</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="11" required>
                                </div>
                                <div class="col-4">
                                    <label for="email" class="form-label">Email: *</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="rua" class="form-label">Rua</label>
                                    <input type="text" name="rua" id="rua" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="numero" class="form-label">Numero</label>
                                    <input type="number" name="numero" id="numero" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="btnCadastrar" id="btnCadastrar">Cadastrar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            
            <!-- Editar Cliente -->
            <div class="modal fade" id="editarcliente" tabindex="-1" aria-labelledby="editarclienteLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editarclienteLabel">Editar Cliente: </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="?" method="post">
                            <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_cliente" id="editar_id_cliente">
                                <div class="col-4">
                                    <label for="nome" class="form-label">Nome do Cliente</label>
                                    <input type="text" name="nome" id="editar_nome" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="telefone" class="form-label">Telefone *</label>
                                    <input type="text" name="telefone" id="editar_telefone" class="form-control" maxlength="11" required>
                                </div>
                                <div class="col-4">
                                    <label for="cpf" class="form-label">CPF *</label>
                                    <input type="text" name="cpf" id="editar_cpf" class="form-control" maxlength="11" required>
                                </div>
                                <div class="col-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="editar_email" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="rua" class="form-label">Rua</label>
                                    <input type="text" name="rua" id="editar_rua" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="numero" class="form-label">Numero</label>
                                    <input type="number" name="numero" id="editar_numero" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" name="bairro" id="editar_bairro" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" name="cidade" id="editar_cidade" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="btnEditar" id="btnEditar">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
            <!-- Modal Excluir Cliente -->
            <div class="modal fade" id="excluircliente" tabindex="-1" aria-labelledby="excluirclienteLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="excluirclienteLabel">Excluir o Cliente: </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="?" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id_cliente" id="exc_id_cliente">
                                <p>Tem certeza que deseja excluir esse usuário? Essa ação não tem volta</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-danger">Excluir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Cadastrar Orçamento -->
            <div class="modal fade" id="cadastrarorcamento" tabindex="-1" aria-labelledby="cadastrarorcamentoLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadastrarorcamentoLabel">Cadastro de Novo Orçamento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_cliente" id="id_cliente">
                                <input type="hidden" name="total" value="0">
                                <div class="col-6">
                                    <label for="modelo" class="form-label">Veículo *</label>
                                    <input type="text" name="modelo" id="modelo" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="placa" class="form-label">Placa *</label>
                                    <input type="text" name="placa" id="placa" class="form-control" maxlength="7" required>
                                </div>
                                <div class="col-6">
                                    <label for="cor" class="form-label">Cor</label>
                                    <input type="text" name="cor" id="cor" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="ano" class="form-label">Ano</label>
                                    <input type="text" name="ano" id="ano" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="forma_pgmt" class="form-label">Forma de Pagamento *</label>
                                    <select name="forma_pgmt" id="forma_pgmt" class="form-control" required>
                                        <option value="-1"></option>
                                        <option value="0">Dinheiro</option>
                                        <option value="1">Pix</option>
                                        <option value="2">Cartão</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="vezes" class="form-label">Vezes</label>
                                    <input type="number" name="vezes" id="vezes" class="form-control" value="1">
                                </div>
                                <div class="col-6">
                                    <label for="pago" class="form-label">Pago?</label>
                                    <select name="pago" id="pago" class="form-control" required>
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="prazo" class="form-label">Prazo de Entrega</label>
                                    <input type="text" class="form-control" name="prazo" id="prazo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnCadastrarOrcamento" id="btnCadastrarOrcamento" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Monobloco 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="?" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja Mesmo Sair??</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Você tera que logar novamente no proximo Login!</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" name="btnSair" type="submit" >Sair</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $('#cadastrarcliente').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
        })
        $('#editarcliente').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idcliente = button.data('idcliente')
            let nome = button.data('nome')
            let telefone = button.data('telefone')
            let cpf = button.data('cpf')
            let email = button.data('email')
            let rua = button.data('rua')
            let bairro = button.data('bairro')
            let cidade = button.data('cidade')
            let numero = button.data('numero')
            
            $('#editar_id_cliente').val(idcliente)
            $('#editar_nome').val(nome)
            $('#editar_telefone').val(telefone)
            $('#editar_cpf').val(cpf)
            $('#editar_email').val(email)
            $('#editar_rua').val(rua)
            $('#editar_bairro').val(bairro)
            $('#editar_cidade').val(cidade)
            $('#editar_numero').val(numero)
        })
        $('#excluircliente').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idcliente = button.data('idcliente')
            let nome = button.data('nome')
            $('#excluirclienteLabel').append(nome)
            $('#exc_id_cliente').val(idcliente)
        })
        $('#cadastrarorcamento').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idcliente = button.data('idcliente')
            $('#id_cliente').val(idcliente)
        })
    </script>

</body>

</html>