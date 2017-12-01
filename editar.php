<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Duo System - Editar Atividades</title>
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

            <?php
                require('./conf/Config.inc');
                $edit = new Read;
                $idEdita = $_REQUEST['id'];
                $edit->ExeRead('atividades', 'WHERE id = :id', 'id='.$idEdita);
                ?>
                
            <div class="page-header">
                <h1>Editando Atividade</h1>
            </div>
            <?php
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($data['SendPostForm'])):
                unset($data['SendPostForm']);
                $cadastra = new Atividades();
                $cadastra->ExeAlter($data);
                if (!$cadastra->getResult()):
                    echo $cadastra->getMsg();
                else:
                    echo $cadastra->getMsg();
                    ?>
                    <meta http-equiv="refresh" content="2; url=index.php">
                    <?php
                endif;
            endif;

            //var_dump($data);
            ?>
            <form class="form-horizontal" name="PostForm" action="" method="post" enctype="multipart/form-data">

                <?php
                foreach ($edit->getResult() as $user):
                    extract($user);?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nome">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $nome; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="descricao">Descrição</label>
                        <div class="col-sm-10">
                            <textarea name="descricao" id="descricao" class="form-control" cols="30" rows="10" required><?php echo $descricao; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="dataInicio">Data de Início</label>
                        <div class="col-sm-10">
                            <input type="date" name="dataInicio" id="dataInicio" class="form-control" required value="<?php echo $dataInicio; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="dataFim">Data de Fim</label>
                        <div class="col-sm-10">
                            <input type="date" name="dataFim" id="dataFim" class="form-control" value="<?php echo $dataFim; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="status">Status</label>
                        <?php 
                            $arrayStatus = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '');
                            for ($i=1; $i < 6; $i++):
                                if($status == $i):
                                    $arrayStatus[$i] = 'selected';
                                    break;
                                endif;
                            endfor;
                        ?>
                        <div class="col-sm-10">
                            <select name="status" class="form-control" required id="status">
                                <option value="1" <?php echo $arrayStatus[1] ?>>Pré Cadastrado</option>
                                <option value="2" <?php echo $arrayStatus[2] ?>>Pendente</option>
                                <option value="3" <?php echo $arrayStatus[3] ?>>Em Desenvolvimento</option>
                                <option value="4" <?php echo $arrayStatus[4] ?>>Em Teste</option>
                                <option value="5" <?php echo $arrayStatus[5] ?>>Concluído</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="situacao">Situação</label>
                        <?php 
                            $arraySituacao = array(1 => '', 2 => '');
                            for ($i=1; $i < 3; $i++):
                                if($situacao == $i):
                                    $arrayStatus[$i] = 'selected';
                                    break;
                                endif;
                            endfor;
                        ?>
                        <div class="col-sm-10">
                            <select name="situacao" class="form-control" required id="situacao">
                                <option value="1" <?php echo $arrayStatus[1] ?>>Ativo</option>
                                <option value="2" <?php echo $arrayStatus[2] ?>>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-success" value="Salvar" name="SendPostForm" />
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>