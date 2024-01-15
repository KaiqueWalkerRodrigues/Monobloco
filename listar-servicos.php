<?php 
    include_once('class/classes.php');

    $Servicos = new Servicos();
    $Pecas = new Pecas();

    $id_orcamento = $_GET['id'];

    if (isset($_POST['btnAdicionar'])){
        $Servicos->cadastrar($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    if (isset($_POST['btnEditarServicos'])){
        $Servicos->editar($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    if (isset($_POST['btnExcluirServico'])){
        $Servicos->excluir($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    if (isset($_POST['btnCadastrarPeca'])){
        $Pecas->cadastrar($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    if (isset($_POST['btnEditarPecas'])){
        $Pecas->editar($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    if (isset($_POST['btnExcluirPeca'])){
        $Pecas->excluir($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
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

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Inicio -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Início</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarservicos" data-idorcamento="<?php echo $id_orcamento ?>"><i class="fa-regular fa-file"></i></button>

                <br><br>

                    <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Quantidade</th>
                                    <th>Serviço</th>
                                    <th>Garantia</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php $total_servicos = 0; foreach($Servicos->listar($id_orcamento) as $servico){ ?>
                                <tr class="text-center">
                                    <td><?php echo $servico->qntd ?></td>
                                    <td><?php echo $servico->servico; ?></td>
                                    <td><?php echo $servico->garantia ?></td>
                                    <td><?php echo $servico->valor ?></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#mostrardescricao" data-descricao="<?php echo $servico->descricao ?>" data-servico="<?php echo $servico->servico ?>"><i class="fa-solid fa-newspaper"></i></button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editarservico" 
                                        data-idservico="<?php echo $servico->id_servico ?>" 
                                        data-idorcamento="<?php echo $id_orcamento ?>"
                                        data-servico="<?php echo $servico->servico ?>" 
                                        data-quantidade="<?php echo $servico->qntd ?>"
                                        data-garantia="<?php echo $servico->garantia ?>"
                                        data-valor="<?php echo $servico->valor ?>"
                                        data-descricao="<?php echo $servico->descricao ?>"
                                        ><i class="fa-solid fa-gear"></i></button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirservico" data-idservico="<?php echo $servico->id_servico ?>" data-servico="<?php echo $servico->servico ?>" data-idorcamento="<?php echo $id_orcamento ?>"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                    <?php $total_servicos += $servico->valor ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                    </table>

                    Total: <?php echo $total_servicos ?>

                    <hr>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrarpeca" data-idorcamento="<?php echo $id_orcamento ?>"><i class="fa-solid fa-screwdriver-wrench"></i></button>

                    <br><br>

                    <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Quantidade</th>
                                    <th>Peça</th>
                                    <th>Garantia</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php $total_pecas = 0; foreach($Pecas->listar($id_orcamento) as $peca){ ?>
                                <tr class="text-center">
                                    <td><?php echo $peca->qntd ?></td>
                                    <td><?php echo $peca->peca; ?></td>
                                    <td><?php echo $peca->garantia ?></td>
                                    <td><?php echo $peca->valor ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editarpeca" 
                                        data-idpeca="<?php echo $peca->id_peca ?>" 
                                        data-idorcamento="<?php echo $id_orcamento ?>"
                                        data-peca="<?php echo $peca->peca ?>" 
                                        data-quantidade="<?php echo $peca->qntd ?>"
                                        data-garantia="<?php echo $peca->garantia ?>"
                                        data-valor="<?php echo $peca->valor ?>"
                                        ><i class="fa-solid fa-gear"></i></button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirpeca" data-idpeca="<?php echo $peca->id_peca ?>" data-peca="<?php echo $peca->peca ?>" data-idorcamento="<?php echo $id_orcamento ?>"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                    <?php $total_pecas += $peca->valor ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                    </table>

                    Total: <?php echo $total_pecas ?>
                    <hr>
                    Total Geral: R$ <?php echo $total_pecas+$total_servicos ?>
                    <br><br>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal Mostrar descrição -->
            <div class="modal fade" id="mostrardescricao" tabindex="-1" aria-labelledby="mostrardescricaoLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="mostrardescricaoLabel">Servico: <span id="servico"></span></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <p id="descricao"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Adicionar Serviços -->
            <div class="modal fade" id="adicionarservicos" tabindex="-1" aria-labelledby="adicionarservicosLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="adicionarservicosLabel">Adicionar Serviços</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_orcamento" id="adds_id_orcamento">
                                <div class="col-2 text-center">
                                    <label class="form-label">Quantidade</label>
                                </div>
                                <div class="col-6 text-center">
                                    <label class="form-label">Serviço</label>
                                </div>
                                <div class="col-2 text-center">
                                    <label class="form-label">Garantia</label>
                                </div>
                                <div class="col-2 text-center">
                                    <label class="form-label">Valor</label>
                                </div>
                                <div class="col-2">
                                    <input type="number" name="qntd" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="servico" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="garantia" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" name="valor" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnAdicionar" id="btnAdicionar" class="btn btn-primary">Adicionar</button>
                        </div>
                        </form>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Serviço -->
            <div class="modal fade" id="editarservico" tabindex="-1" aria-labelledby="editarservicoLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarservicoLabel">Editar Servico: </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_servico" id="editar_servico_id_servico">
                                <input type="hidden" name="id_orcamento" id="editar_servico_id_orcamento">
                                <input type="hidden" name="valor_anterior" id="editar_servico_valor_anterior">
                                <div class="col-6">
                                    <label for="servico" class="form-label">Nome do Servico *</label>
                                    <input type="text" name="servico" id="editar_servico_servico" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="qntd" class="form-label">Quantidade</label>
                                    <input type="text" name="qntd" id="editar_servico_quantidade" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="garantia" class="form-label">Garantia</label>
                                    <input type="text" name="garantia" id="editar_servico_garantia" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="valor" class="form-label">Valor</label>
                                    <input type="number" step="0.01" name="valor" id="editar_servico_valor" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="editar_servico_descricao" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnEditarServicos" id="btnEditarServicos" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Modal Excluir Servico -->
            <div class="modal fade" id="excluirservico" tabindex="-1" aria-labelledby="excluirservicoLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="excluirservicoLabel">Excluir o Serviço: </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_servico" id="exc_id_servico">
                            <input type="hidden" name="id_orcamento" id="exc_id_orcamento">
                            <p>Tem certeza que deseja excluir esse serviço? Essa ação não tem volta</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnExcluirServico" id="btnExcluirServico" class="btn btn-danger">Excluir</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Modal Cadastrar Peça -->
            <div class="modal fade" id="cadastrarpeca" tabindex="-1" aria-labelledby="cadastrarpecaLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadastrarpecaLabel">Cadastrar Peça</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_orcamento" id="criarpeca_id_orcamento">
                                <div class="col-2 text-center">
                                    <label class="form-label">Quantidade</label>
                                </div>
                                <div class="col-6 text-center">
                                    <label class="form-label">Peça</label>
                                </div>
                                <div class="col-2 text-center">
                                    <label class="form-label">Garantia</label>
                                </div>
                                <div class="col-2 text-center">
                                    <label class="form-label">Valor</label>
                                </div>
                                <div class="col-2">
                                    <input type="number" name="qntd" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="peca" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="garantia" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" name="valor" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnCadastrarPeca" id="btnCadastrarPeca" class="btn btn-primary">Cadastrar</button>
                        </div>
                        </form>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Peça -->
            <div class="modal fade" id="editarpeca" tabindex="-1" aria-labelledby="editarpecaLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarpecaLabel">Editar Peça: </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id_peca" id="editar_peca_id_peca">
                                <input type="hidden" name="id_orcamento" id="editar_peca_id_orcamento">
                                <input type="hidden" name="valor_anterior" id="editar_peca_valor_anterior">
                                <div class="col-6">
                                    <label for="peca" class="form-label">Nome da Peça *</label>
                                    <input type="text" name="peca" id="editar_peca_peca" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="qntd" class="form-label">Quantidade</label>
                                    <input type="text" name="qntd" id="editar_peca_quantidade" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="garantia" class="form-label">Garantia</label>
                                    <input type="text" name="garantia" id="editar_peca_garantia" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="valor" class="form-label">Valor</label>
                                    <input type="number" step="0.01" name="valor" id="editar_peca_valor" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnEditarPecas" id="btnEditarPecas" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Modal Excluir Peça -->
            <div class="modal fade" id="excluirpeca" tabindex="-1" aria-labelledby="excluirpecaLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="excluirpecaLabel">Excluir a Peça: </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_peca" id="exc_id_peca">
                            <input type="hidden" name="id_orcamento" id="exc_id_orcamento">
                            <p>Tem certeza que deseja excluir essa peça? Essa ação não tem volta</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btnExcluirPeca" id="btnExcluirPeca" class="btn btn-danger">Excluir</button>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $('#adicionarservicos').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idorcamento = button.data('idorcamento')
            $('#adds_id_orcamento').val(idorcamento)
        })
        $('#mostrardescricao').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let servico = button.data('servico')
            let descricao = button.data('descricao')
            $('#descricao').text(descricao)
            $('#servico').text(servico)
        })
        $('#editarservico').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idservico = button.data('idservico')
            let idorcamento = button.data('idorcamento')
            let servico = button.data('servico')
            let quantidade = button.data('quantidade')
            let garantia = button.data('garantia')
            let valor = button.data('valor')
            let descricao = button.data('descricao')

            $('#editarservicoLabel').append(servico)
            $('#editar_servico_id_servico').val(idservico)
            $('#editar_servico_id_orcamento').val(idorcamento)
            $('#editar_servico_servico').val(servico)
            $('#editar_servico_quantidade').val(quantidade)
            $('#editar_servico_garantia').val(garantia)
            $('#editar_servico_valor_anterior').val(valor)
            $('#editar_servico_valor').val(valor)
            $('#editar_servico_descricao').val(descricao)
        })
        $('#excluirservico').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idservico = button.data('idservico')
            let idorcamento = button.data('idorcamento')
            let servico = button.data('servico')
            $('#excluirservicoLabel').append(servico)
            $('#exc_id_servico').val(idservico)
            $('#exc_id_orcamento').val(idorcamento)
        })
        $('#cadastrarpeca').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idorcamento = button.data('idorcamento')
            $('#criarpeca_id_orcamento').val(idorcamento) 
        })
        $('#editarpeca').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idpeca = button.data('idpeca')
            let idorcamento = button.data('idorcamento')
            let peca = button.data('peca')
            let quantidade = button.data('quantidade')
            let garantia = button.data('garantia')
            let valor = button.data('valor')

            $('#editarpecaLabel').append(peca)
            $('#editar_peca_id_peca').val(idpeca)
            $('#editar_peca_id_orcamento').val(idorcamento)
            $('#editar_peca_peca').val(peca)
            $('#editar_peca_quantidade').val(quantidade)
            $('#editar_peca_garantia').val(garantia)
            $('#editar_peca_valor_anterior').val(valor)
            $('#editar_peca_valor').val(valor)
        })
        $('#excluirpeca').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let idpeca = button.data('idpeca')
            let idorcamento = button.data('idorcamento')
            let peca = button.data('peca')
            $('#excluirpecaLabel').append(peca)
            $('#exc_id_peca').val(idpeca)
            $('#exc_id_orcamento').val(idorcamento)
        })
    </script>

    

</body>

</html>