<?php

class Atividades {

    private $Data;
    private $Msg;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'atividades';

    /**
     * <b>Cadastrar Categoria:</b> Envelopa nome, email em um array atribuitivo.
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->checkData();
        if ($this->Result):
            $this->Create();
        endif;
    }
    
    public function ExeAlter(array $Data) {
        $this->Data = $Data;
        $this->checkData();
        if ($this->Result):
            $this->Alter();
        endif;
    }

    public function ExeDelete(array $Data) {
        $this->Data = $Data;
        $this->checkData();
        if ($this->Result):
            $this->Delete();
        endif;
    }

       /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro for efetuado ou FALSE se não. Para verificar
     * erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }
    
    /**
     * <b>Obter Erro:</b> Retorna o tipo de erro!
     */
    public function getMsg() {
        return $this->Msg;
    }
    
    //Valida e cria os dados para realizar o cadastro
    private function checkData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Msg =  "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar a atividade, preencha todos os campos!</div>";
        else:
            $this->Result = true;
        endif;
    }

    //Cadastra a usuário no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Msg = "<div class='alert alert-success'><b>Sucesso: </b>A atividade {$this->Data['nome']} foi cadastrada no sistema!</div>";
        endif;
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, $this->Data);
        if ($Delete->getResult()):
            $this->Result = $Delete->getResult();
            $this->Msg = "<div class='alert alert-success'><b>Sucesso: </b>A atividade {$this->Data['nome']} foi excluida do sistema</div>";
        endif;
    }

    private function Alter() {
        $Alter = new Alter;
        $Alter->ExeAlter(self::Entity, $this->Data);
        if ($Alter->getResult()):
            $this->Result = $Alter->getResult();
            $this->Msg = "<div class='alert alert-success'><b>Sucesso: </b>A atividade {$this->Data['nome']} foi altada no sistema</div>";
        endif;
    }

}
