<?php
    include_once('class/Conexao.php');
    include_once('class/Helper.php');
    include_once('class/Orcamentos.php');
    include_once('class/Clientes.php');
    include_once('class/Servicos.php');
    include_once('class/Pecas.php');
    include_once('class/Usuarios.php');

    session_start();
    Helper::logado();
?>