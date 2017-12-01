<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Duo System - Inserir Atividades</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>   
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Duo System</a>
                </div>
                <div id="navbar" class="">
                    <p class="navbar-text navbar-right">Create by: <a href="https://fabriciobertrand.com.br/" target="_blank">Fabricio Bertrand</a></p>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container theme-showcase" role="main">
            <div class="page-header">
                <h1>Cadastrar Atividade</h1>
            </div>
            <?php
            require('./conf/Config.inc');
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($data['SendPostForm'])):
                unset($data['SendPostForm']);
                $cadastra = new Atividades();
                $cadastra->ExeCreate($data);
                if (!$cadastra->getResult()):
                    echo $cadastra->getMsg();
                else:
                    echo $cadastra->getMsg();
                    ?>
                    <meta http-equiv="refresh" content="3; url=index.php">
                    <?php
                endif;
            endif;

            //var_dump($data);
            ?>

            <form class="form-horizontal" name="PostForm" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="nome">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php if (isset($data)) echo $data['nome']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="descricao">Descrição</label>
                    <div class="col-sm-10">
                        <textarea name="descricao" id="descricao" class="form-control" cols="30" rows="10" required><?php if (isset($data)) echo $data['descricao']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="dataInicio">Data de Início</label>
                    <div class="col-sm-10">
                        <input type="date" name="dataInicio" id="dataInicio" class="form-control" required value="<?php if (isset($data)) echo $data['dataInicio']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="dataFim">Data de Fim</label>
                    <div class="col-sm-10">
                        <input type="date" name="dataFim" id="dataFim" class="form-control" value="<?php if (isset($data)) echo $data['dataFim']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="status">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" required id="status">
                            <option value="1">Pré Cadastrado</option>
                            <option value="2">Pendente</option>
                            <option value="3">Em Desenvolvimento</option>
                            <option value="4">Em Teste</option>
                            <option value="5">Concluído</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="situacao">Situação</label>
                    <div class="col-sm-10">
                        <select name="situacao" class="form-control" required id="situacao">
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-success" value="Salvar" name="SendPostForm" />
                    </div>
                </div>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>