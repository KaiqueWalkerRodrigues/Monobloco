<?php

class Orcamentos {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        $this->pdo = Conexao::conexao();               
    }

    /**
     * listar todas os Orjamentos
     * @return array
     * @example $variavel = $Obj->metodo()
     */
    public function listar(){
    	// montar o SELECT ou o SQL        
        $sql = $this->pdo->prepare('SELECT * FROM orcamentos');        
    	// executar a consulta
    	$sql->execute();
    	// Pegar os dados retornados, como Objectos estanciados
        // Como serão retornados vários tabela usamos fetchAll
    	$dados = $sql->fetchAll(PDO::FETCH_OBJ);
        // retornar os dados para um array
    	return $dados;
    }

    /**
     * cadastra um novo Orçamento
     * @param Array $dados    
     * @return int
     * @example $Obj->cadastrar($_POST);
     * 
     */
    public function cadastrar(Array $dados)
    {
        $sql = $this->pdo->prepare('INSERT INTO orcamentos 
                                    (id_cliente, placa, modelo, cor, ano, forma_pgmt, vezes, pago, criacao, prazo)
                                    values
                                    (:id_cliente, :placa, :modelo, :cor, :ano, :forma_pgmt, :vezes, :pago, :criacao, :prazo)
                                 ');

        // Tratar os dados recebidos do formulário
        // TRIM - remove os espaços antes de depois do texto
        // STRTOLOWER - transforma a STRING (str), para (to), minúsculo (lower)
        // UCFIRST - transforma o primeiro caracter (FIRST) para maiúscuo (UC Upper Case)        
        $id_cliente  = $dados['id_cliente'];
        $placa  = $dados['placa'];
        $modelo  = $dados['modelo'];
        $cor  = $dados['cor'];
        $ano  = $dados['ano'];
        $forma_pgmt  = $dados['forma_pgmt'];
        $vezes  = $dados['vezes'];
        $pago  = $dados['pago'];
        $criacao  = date('Y-m-d H:i:s');
        $prazo  = $dados['prazo'];
         
        // Mesclar os dados, ou seja, 
        // atribuir os valores armazenados nas variáveis ($alguma_coisa)
        // aos parametros (:alguma_coisa)
        $sql->bindParam(':id_cliente',$id_cliente);                  
        $sql->bindParam(':placa',$placa);                          
        $sql->bindParam(':modelo',$modelo);          
        $sql->bindParam(':cor',$cor);                    
        $sql->bindParam(':ano',$ano);                    
        $sql->bindParam(':forma_pgmt',$forma_pgmt);          
        $sql->bindParam(':vezes',$vezes);          
        $sql->bindParam(':pago',$pago);          
        $sql->bindParam(':criacao',$criacao);          
        $sql->bindParam(':prazo',$prazo);          


        // Executar o SQL
        $sql->execute();
        // Retorna o ID do ITEM, ou seja, a PK (chave primária) do item
        $ip = $this->pdo->lastInsertId();
        $url = 'location:listar-servicos.php?id='.$ip;
        header($url);
    }


    /**
     * Retorna os dados de uma Magia
     * @param int $id_do_item
     * @return object
     * @example $variavel = $Obj->mostrar($id_do_item);
     */
    public function mostrar($id_orcamento)
    {
    	// Montar o SELECT ou o SQL
    	$sql = $this->pdo->prepare('SELECT * FROM orcamentos WHERE id_orcamento = :id_orcamento LIMIT 1');
        $sql->bindParam(':id_orcamento',$id_orcamento);
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
        $sql = $this->pdo->prepare("UPDATE orcamentos SET
                                    id_cliente = :id_cliente,
                                    placa = :placa,
                                    modelo = :modelo,
                                    cor = :cor,
                                    forma_pgmt = :forma_pgmt,
                                    ano = :ano,
                                    vezes = :vezes,
                                    pago = :pago,
                                    prazo = :prazo      
                                    WHERE id_orcamento = :id_orcamento
                                  ");
        // tratar os dados
        $id_cliente = $dados['id_cliente'];
        $placa = $dados['placa'];
        $modelo = $dados['modelo'];
        $cor = $dados['cor'];
        $ano = $dados['ano'];
        $forma_pgmt = $dados['forma_pgmt'];
        $vezes = $dados['vezes'];
        $pago = $dados['pago'];
        $prazo = $dados['prazo'];
        $id_orcamento = $dados['id_orcamento'];
        // Mesclar os dados, ou seja, 
        // atribuir os valores armazenados nas variáveis ($alguma_coisa)
        // aos parametros (:alguma_coisa)
        $sql->bindParam('id_cliente',$id_cliente);
        $sql->bindParam('placa',$placa);
        $sql->bindParam('modelo',$modelo);
        $sql->bindParam('cor',$cor);
        $sql->bindParam('ano',$ano);
        $sql->bindParam('forma_pgmt',$forma_pgmt);
        $sql->bindParam('vezes',$vezes);
        $sql->bindParam('pago',$pago);
        $sql->bindParam('prazo',$prazo);
        $sql->bindParam('id_orcamento',$id_orcamento);     
        // Executar o SQL
        $sql->execute();

        $url = 'location:orcamentos.php?editado=t';
        header($url);
    }


    /**
     * Excluir ITEM
     *
     * @param integer $id_Magia
     * @return void (esse metodo não retorna nada)
     */
    public function excluir(array $dados)
    {
        $id_orcamento = $dados['id_orcamento'];
        $sql = $this->pdo->prepare('DELETE FROM orcamentos WHERE id_orcamento = :id_orcamento');
        $sql->bindParam(':id_orcamento',$id_orcamento);
        $sql->execute();
    }

 }

?>