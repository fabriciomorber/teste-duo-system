<?php

class Create extends Conn {

    private $Tabela;
    private $Dados;
    
    private $Result;
    private $Create;
    private $Conn;
    
    /**
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array. ( Nome da coluna => Valor ).
     */
    public function ExeCreate($Tabela, array $Dados) {
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
        $this->Create = $this->Conn->prepare($this->Create);        
    }
    
    //Criar a sintaxe da query
    private function getSyntax(){
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));        
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }
    
    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            echo 'Message: ' .$e->getMessage();
        }
    }

}
