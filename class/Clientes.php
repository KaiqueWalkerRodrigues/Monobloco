<?php

class Clientes {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        $this->pdo = Conexao::conexao();               
    }

    /**
     * listar todas os clientes
     * @return array
     * @example $variavel = $Obj->metodo()
     */
    public function listar(){
    	// montar o SELECT ou o SQL        
        $sql = $this->pdo->prepare('SELECT * FROM clientes ORDER BY nome');        
    	// executar a consulta
    	$sql->execute();
    	// Pegar os dados retornados, como Objectos estanciados
        // Como serão retornados vários tabela usamos fetchAll
    	$dados = $sql->fetchAll(PDO::FETCH_OBJ);
        // retornar os dados para um array
    	return $dados;
    }

    /**
     * cadastra um novo Cliente
     * @param Array $dados    
     * @return int
     * @example $Obj->cadastrar($_POST);
     * 
     */
    public function cadastrar(Array $dados)
    {
        $sql = $this->pdo->prepare('INSERT INTO clientes 
                                    (nome, telefone, cpf, email, rua, bairro, cidade, numero)
                                    values
                                    (:nome, :telefone, :cpf, :email, :rua, :bairro, :cidade, :numero)
                                 ');

        // Tratar os dados recebidos do formulário
        // TRIM - remove os espaços antes de depois do texto
        // STRTOLOWER - transforma a STRING (str), para (to), minúsculo (lower)
        // UCFIRST - transforma o primeiro caracter (FIRST) para maiúscuo (UC Upper Case)        
        $nome  = $dados['nome'];
        $telefone  = $dados['telefone'];
        $rua  = $dados['rua'];
        $bairro  = $dados['bairro'];
        $email  = $dados['email'];
        $cpf  = $dados['cpf'];
        $cidade  = $dados['cidade'];
        $numero  = $dados['numero'];
         
        // Mesclar os dados, ou seja, 
        // atribuir os valores armazenados nas variáveis ($alguma_coisa)
        // aos parametros (:alguma_coisa)
        $sql->bindParam(':nome',$nome);                         
        $sql->bindParam(':telefone',$telefone);                         
        $sql->bindParam(':rua',$rua);                         
        $sql->bindParam(':bairro',$bairro);                         
        $sql->bindParam(':email',$email);                         
        $sql->bindParam(':cpf',$cpf);                         
        $sql->bindParam(':cidade',$cidade);                         
        $sql->bindParam(':numero',$numero);                                             


        // Executar o SQL
        $sql->execute();
        // Retorna o ID do ITEM, ou seja, a PK (chave primária) do item
        return $this->pdo->lastInsertId();
    }


    /**
     * Retorna os dados de uma Magia
     * @param int $id_do_item
     * @return object
     * @example $variavel = $Obj->mostrar($id_do_item);
     */
    public function mostrar($id_cliente)
    {
    	// Montar o SELECT ou o SQL
    	$sql = $this->pdo->prepare('SELECT * FROM clientes WHERE id_cliente = :id_cliente LIMIT 1');
        $sql->bindParam(':id_cliente',$id_cliente);
    	// Executar a consulta
    	$sql->execute();
    	// Pega os dados retornados
        // Como será retornado apenas UM tabela usamos fetch. para
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	return $dados;
    }
    /**
     * Atualiza um determinado estado
     *
     * @param array $dados   
     * @return int id - do ITEM
     * @example $Obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE clientes SET
                                    nome = :nome,
                                    telefone = :telefone,
                                    rua = :rua,
                                    bairro = :bairro,
                                    cpf = :cpf,
                                    email = :email,
                                    cidade = :cidade,
                                    numero = :numero       
                                    WHERE id_cliente = :id_cliente
                                  ");
        // tratar os dados
        $nome = trim($dados['nome']);
        $telefone = $dados['telefone'];
        $rua = $dados['rua'];
        $bairro = $dados['bairro'];
        $email = $dados['email'];
        $cpf = $dados['cpf'];
        $cidade = $dados['cidade'];
        $numero = $dados['numero'];
        $id_cliente = $dados['id_cliente'];

        $sql->bindParam('nome',$nome);
        $sql->bindParam('telefone',$telefone);
        $sql->bindParam('rua',$rua);
        $sql->bindParam('bairro',$bairro);
        $sql->bindParam('email',$email);
        $sql->bindParam('cpf',$cpf);
        $sql->bindParam('cidade',$cidade);
        $sql->bindParam('numero',$numero);
        $sql->bindParam('id_cliente',$id_cliente);        
        // Executar o SQL
        $sql->execute();

        $url = 'location:clientes.php';
        header($url);
    }


    /**
     * Excluir ITEM
     *
     * @param integer $id_cliente
     * @return void (esse metodo não retorna nada)
     */
    public function excluir($dados)
    {
        $id_cliente = $dados['id_cliente'];
        $sql = $this->pdo->prepare('DELETE FROM Clientes WHERE id_cliente = :id_cliente');
        $sql->bindParam(':id_cliente',$id_cliente);
        $sql->execute();
    }

 }

?>