<?php 
    include_once('class/classes.php');

    $Orcamento = new Orcamentos();

    $Cliente = new Clientes();

    $Servico = new Servicos();

    if (isset($_POST['btnEditar'])){
        $Orcamento->editar($_POST);
    }
    if (isset($_POST['btnExcluir'])){
        $Orcamento->excluir($_POST);
        header('location:orcamentos.php');
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

    <title>MonoBloco - Orçamentos</title>

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
            <li class="nav-item active">
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

            <li class="nav-item">
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

                <?php if(isset($_GET['editado'])){ ?>
                    <div class="alert alert-success mt-2" id="successeditado" role="alert">
                        Orçamento editado com Sucesso!!!
                    </div>
                <?php }  ?>

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
                            <h6 class="m-0 font-weight-bold text-danger">Tabela de Orçamentos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Cliente</th>
                                            <th>CPF</th>
                                            <th>Telefone</th>
                                            <th>Email</th>
                                            <th>Veículo</th>
                                            <th>Placa</th>
                                            <!-- <th>Pago</th> -->
                                            <th>Data</th>
                                            <th>Prazo de Entrega</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($Orcamento->listar() as $orcamento){  ?>
                                        <?php $cliente = $Cliente->mostrar($orcamento->id_cliente) ?>
                                        <tr class="text-center">
                                            <td><?php echo $orcamento->id_orcamento ?></td>
                                            <td><?php echo $cliente->nome ?></td>
                                            <td><?php echo $cliente->cpf ?></td>
                                            <td><a target="_blank" href="https://wa.me/55<?php echo $cliente->telefone?>"><?php echo $cliente->telefone ?></a></td>
                                            <td><?php echo $cliente->email ?></td>
                                            <td><?php echo $orcamento->modelo ?></td>
                                            <td><?php echo $orcamento->placa ?></td>
                                            <!-- <td><?php //if($orcamento->pago == 0){ echo 'Não'; }else{ echo 'Sim'; } ?></td> -->
                                            <td><?php $dataFormatada = date('d/m/Y H:i', strtotime($orcamento->criacao)); echo $dataFormatada; ?></td>
                                            <td><?php echo $orcamento->prazo ?></td>
                                            <td>
                                                <a 
                                                href="gerarpdf.php?nome=<?php echo $cliente->nome ?>&telefone=<?php echo $cliente->telefone ?>&rua=<?php echo $cliente->rua ?>&cidade=<?php echo $cliente->cidade ?>&bairro=<?php echo $cliente->bairro ?>
                                                &modelo=<?php echo $orcamento->modelo ?>&ano=<?php echo $orcamento->ano ?>&placa=<?php echo $orcamento->placa ?>&cor=<?php echo $orcamento->cor ?>&idorcamento=<?php echo $orcamento->id_orcamento ?>&vezes=<?php echo $orcamento->vezes ?>&servicos=<?php $servicosJson = json_encode($Servico->listar($orcamento->id_orcamento)); $servicosEncoded = urlencode($servicosJson); echo $servicosEncoded?>" 
                                                class="btn btn-warning"><i class="fa-solid fa-file-pdf"></i></a>
                                                <a href="listar-servicos.php?id=<?php echo $orcamento->id_orcamento ?>" class="btn btn-outline-dark"><i class="fa-solid fa-list"></i></a>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editarorcamento" 
                                                data-idorcamento="<?php echo $orcamento->id_orcamento ?>"
                                                data-idcliente="<?php echo $orcamento->id_cliente ?>"
                                                data-modelo="<?php echo $orcamento->modelo ?>"
                                                data-placa="<?php echo $orcamento->placa ?>"
                                                data-cor="<?php echo $orcamento->cor ?>"
                                                data-ano="<?php echo $orcamento->ano ?>"
                                                data-forma_pgmt="<?php echo $orcamento->forma_pgmt ?>"
                                                data-vezes="<?php echo $orcamento->vezes ?>"
                                                data-pago="<?php echo $orcamento->pago ?>"
                                                data-prazo="<?php echo $orcamento->prazo ?>"
                                                ><i class="fa-solid fa-gear"></i></button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirorcamento" data-idorcamento="<?php echo $orcamento->id_orcamento ?>" data-nome="<?php echo $orcamento->placa ?>"><i class="fa-solid fa-trash"></i></button>
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

            <!-- Modal Editar Orçamento -->
            <div class="modal fade" id="editarorcamento" tabindex="-1" aria-labelledby="editarorcamentoLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarorcamentoLabel">Editar Orçamento: </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_orcamento" id="editar_id_orcamento">
                                <input type="hidden" name="id_cliente" id="editar_id_cliente">
                                <input type="hidden" name="total" id="editar_value">
                                <div class="col-6">
                                    <label for="modelo" class="form-label">Veículo *</label>
                                    <input type="text" name="modelo" id="editar_modelo" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="placa" class="form-label">Placa *</label>
                                    <input type="text" name="placa" id="editar_placa" class="form-control" maxlength="7" required>
                                </div>
                                <div class="col-6">
                                    <label for="cor" class="form-label">Cor</label>
                                    <input type="text" name="cor" id="editar_cor" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="ano" class="form-label">Ano</label>
                                    <input type="text" name="ano" id="editar_ano" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="forma_pgmt" class="form-label">Forma de Pagamento *</label>
                                    <select name="forma_pgmt" id="editar_forma_pgmt" class="form-control" required>
                                        <option value="-1"></option>
                                        <option value="0">Dinheiro</option>
                                        <option value="1">Pix</option>
                                        <option value="2">Cartão</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="vezes" class="form-label">Vezes</label>
                                    <input type="number" name="vezes" id="editar_vezes" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="pago" class="form-label">Pago?</label>
                                    <select name="pago" id="editar_pago" class="form-control" required>
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="prazo" class="form-label">Prazo de Entrega</label>
                                    <input type="text" class="form-control" name="prazo" id="editar_prazo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnEditar" id="btnEditar" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Modal Excluir Orcamento -->
            <div class="modal fade" id="excluirorcamento" tabindex="-1" aria-labelledby="excluirorcamentoLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="excluirorcamentoLabel">Excluir o Orçamento do carro com placa: </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_orcamento" id="exc_id_orcamento">
                            <p>Tem certeza que deseja excluir esse orçamento? Essa ação não tem volta</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-danger">Excluir</button>
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
        $('#cadastrarorcamento').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            $('#telefone').val('11')
            $('#cidade').val('Santo André')
        })
        $('#editarorcamento').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idorcamento = button.data('idorcamento')
            let idcliente = button.data('idcliente')
            let modelo = button.data('modelo')
            let placa = button.data('placa')
            let cor = button.data('cor')
            let ano = button.data('ano')
            let forma_pgmt = button.data('forma_pgmt')
            let vezes = button.data('vezes')
            let pago = button.data('pago')
            let prazo = button.data('prazo')

            $('#editarorcamentoLabel').append(idorcamento)
            $('#editar_id_orcamento').val(idorcamento)
            $('#editar_id_cliente').val(idcliente)
            $('#editar_modelo').val(modelo)
            $('#editar_placa').val(placa)
            $('#editar_cor').val(cor)
            $('#editar_ano').val(ano)
            $('#editar_forma_pgmt').val(forma_pgmt)
            $('#editar_vezes').val(vezes)
            $('#editar_pago').val(pago)
            $('#editar_prazo').val(prazo)
        })
        $('#excluirorcamento').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idorcamento = button.data('idorcamento')
            let nome = button.data('nome')
            $('#excluirorcamentoLabel').append(nome)
            $('#exc_id_orcamento').val(idorcamento)
        })
    </script>

</body>

</html>