<?php

class Alter extends Conn {

    private $Tabela;
    private $Dados;
    
    private $Result;
    private $Alter;
    private $Conn;
    
    /**
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array. ( Nome da coluna => Valor ).
     */
    public function ExeAlter($Tabela, array $Dados) {
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
        $this->Alter = $this->Conn->prepare($this->Alter);
    }
    
    //Criar a sintaxe da query
    private function getSyntax(){
        $Fileds = implode(', ', array_keys($this->Dados));
        $ID     = ':' . implode(', :', array_keys($this->Dados));
        $value = explode(',', $ID);
        $this->Alter = "UPDATE {$this->Tabela} SET nome = $value[0], descricao = $value[1], dataInicio = $value[2], dataFim = $value[3], status = $value[4], situacao = $value[5] WHERE id = $_REQUEST[id]";
    }
    
    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Alter->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            echo 'Message: ' .$e->getMessage();
        }
    }

}
