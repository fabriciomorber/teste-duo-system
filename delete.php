<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Duo System - Exluir Atividades</title>
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
                <h1>Excluir Atividade</h1>
            </div>
            <?php
            require('./conf/Config.inc');
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($data['SendPostForm'])):
                unset($data['SendPostForm']);
                $cadastra = new Atividades();
                $cadastra->ExeDelete($data);
                if (!$cadastra->getResult()):
                    echo $cadastra->getMsg();
                else:
                    echo $cadastra->getMsg();
                    header("Location: index.php");
                    exit();
                endif;
            endif;

            //var_dump($data);
            ?>

            <form class="form-horizontal" name="PostForm" action="" method="post" enctype="multipart/form-data">
                <p>Você tem certeza que quer excluir essa atividade?</p>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-1">
                        <input type="submit" class="btn btn-success" value="Sim" name="SendPostForm" />
                    </div>
                    <div class=" col-sm-1">
                        <button class="btn btn-danger" id="btnCancel">Não</button>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/funcoes_bases.js"></script>
    </body>
</html>