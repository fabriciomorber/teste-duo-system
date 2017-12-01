<?php

class Delete extends Conn {

    private $Tabela;
    private $Dados;
    
    private $Result;
    private $Delete;
    private $Conn;
    
    /**
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array. ( Nome da coluna => Valor ).
     */
    public function ExeDelete($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $this->getSyntax();
        $this->Execute();
    }
    
    //Retorna o ID do registro inserido
    public function getResult() {
        return $this->Result;
    }
    
    //Obtem o PDO e prepara a query
    public function Connect() {
        $this->Conn = parent::getConn();
        $this->Delete = $this->Conn->prepare($this->Delete);
    }
    
    //Criar a sintaxe da query
    private function getSyntax(){
        $Fileds = implode(', ', array_keys($this->Dados));
        $ID     = ':' . implode(', :', array_keys($this->Dados));
        //$Refer = $this->Dados['id'];
        $this->Delete = "DELETE FROM {$this->Tabela} WHERE id = {$ID}";
    }
    
    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Delete->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            echo 'Message: ' .$e->getMessage();
        }
    }

}
