<?php

class Usuario {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        $this->pdo = Conexao::conexao();       
    }

    /**
     * Verifica se existe um usuario com os dados passados
     *
     * @param Type|null $var
     * @return void
     */
    public function logar($login, $senha)
    {
        $sql = $this->pdo->prepare('SELECT id_usuario, nome, senha FROM usuarios WHERE login = :login');
        $sql->bindParam(':login', $login);
        $sql->execute();

        $user = $sql->fetch(PDO::FETCH_OBJ);

        if ($user && crypt($senha, 'monoel') === $user->senha) {
            // Iniciar a sessão
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['nome'] = $user->nome;

        } else {
            header('location:index.php?falha');
        }
    }




 }

?>