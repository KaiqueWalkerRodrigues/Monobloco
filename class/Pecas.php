<?php

class Pecas {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        $this->pdo = Conexao::conexao();               
    }

    /**
     * listar todas os Serviços
     * @return array
     * @example $variavel = $Obj->metodo()
     */
    public function listar($id_orcamento){
    	// montar o SELECT ou o SQL        
        $sql = $this->pdo->prepare('SELECT * FROM pecas WHERE id_orcamento = :id_orcamento');        
    	// executar a consulta
        $sql->bindParam(':id_orcamento',$id_orcamento);
    	$sql->execute();
    	// Pegar os dados retornados, como Objectos estanciados
        // Como serão retornados vários tabela usamos fetchAll
    	$dados = $sql->fetchAll(PDO::FETCH_OBJ);
        // retornar os dados para um array
    	return $dados;
    }

    /**
     * cadastra um novo Serviço
     * @param Array $dados    
     * @return int
     * @example $Obj->cadastrar($_POST);
     * 
     */
    public function cadastrar(Array $dados)
    {
        $sql = $this->pdo->prepare('INSERT INTO pecas 
                                    (id_orcamento, peca, qntd, garantia, valor)
                                    values
                                    (:id_orcamento, :peca, :qntd, :garantia, :valor)
                                 ');

        // Tratar os dados recebidos do formulário
        // TRIM - remove os espaços antes de depois do texto
        // STRTOLOWER - transforma a STRING (str), para (to), minúsculo (lower)
        // UCFIRST - transforma o primeiro caracter (FIRST) para maiúscuo (UC Upper Case)        
        $id_orcamento  = $dados['id_orcamento'];
        $peca  = $dados['peca'];
        $qntd  = $dados['qntd'];
        $garantia  = $dados['garantia'];
        $valor  = $dados['valor'];
         
        // Mesclar os dados, ou seja, 
        // atribuir os valores armazenados nas variáveis ($alguma_coisa)
        // aos parametros (:alguma_coisa)
        $sql->bindParam(':id_orcamento',$id_orcamento);                  
        $sql->bindParam(':peca',$peca);                                                                  
        $sql->bindParam(':qntd',$qntd);                                  
        $sql->bindParam(':garantia',$garantia);                                  
        $sql->bindParam(':valor',$valor);                                  

        // Executar o SQL
        $sql->execute();    
    }


    /**
     * Retorna os dados de uma Magia
     * @param int $id_do_item
     * @return object
     * @example $variavel = $Obj->mostrar($id_do_item);
     */
    public function mostrar($id_peca)
    {
    	// Montar o SELECT ou o SQL
    	$sql = $this->pdo->prepare('SELECT * FROM pecas WHERE id_peca = :id_peca LIMIT 1');
        $sql->bindParam(':id_peca',$id_peca);
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
        $sql = $this->pdo->prepare("UPDATE pecas SET
                                    id_orcamento = :id_orcamento,
                                    peca = :peca,
                                    qntd = :qntd,
                                    garantia = :garantia,
                                    valor = :valor       
                                    WHERE id_peca = :id_peca
                                  ");
        // tratar os dados
        $id_peca = $dados['id_peca'];
        $id_orcamento = $dados['id_orcamento'];
        $peca = $dados['peca'];
        $qntd = $dados['qntd'];
        $garantia = $dados['garantia'];
        $valor = $dados['valor'];

        $sql->bindParam(':id_peca',$id_peca);
        $sql->bindParam(':id_orcamento',$id_orcamento);
        $sql->bindParam(':peca',$peca);
        $sql->bindParam(':qntd',$qntd);
        $sql->bindParam(':garantia',$garantia);
        $sql->bindParam(':valor',$valor);           
        // Executar o SQL
        $sql->execute();
    }


    /**
     * Excluir ITEM
     *
     * @param integer $id_Magia
     * @return void (esse metodo não retorna nada)
     */
    public function excluir(array $dados)
    {        
        $id_peca = $dados['id_peca'];

        $sql = $this->pdo->prepare('DELETE FROM pecas WHERE id_peca = :id_peca');
        $sql->bindParam(':id_peca',$id_peca);
        $sql->execute();
    }

 }

?>