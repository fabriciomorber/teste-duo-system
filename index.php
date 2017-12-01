<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Duo System - Listagem de Atividades</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.min.css">
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
                <h1>Bem vindo ao Sistema de Atividades</h1>
            </div>
            
            <?php
            require('./conf/Config.inc');
            $read = new Read;
            if (isset($_REQUEST['fStatus']) and isset($_REQUEST['fSituacao'])){
                $read->ExeRead('atividades', 'WHERE status = :status AND situacao = :situacao ORDER BY id ASC', 'status='.$_REQUEST['fStatus'].'&situacao='.$_REQUEST['fSituacao']);
            }
            else if(isset($_REQUEST['fStatus'])){
                $read->ExeRead('atividades', 'WHERE status = :status ORDER BY id ASC', 'status='.$_REQUEST['fStatus']);
            }
            else if(isset($_REQUEST['fSituacao'])){
                $read->ExeRead('atividades', 'WHERE situacao = :situacao ORDER BY id ASC', 'situacao='.$_REQUEST['fSituacao']);
            }
            else{
                $read->ExeRead('atividades', 'ORDER BY id ASC');
            }
            
            View::Load('conf/view/atividades');
            ?>

            <div class="row">
                <div class="pull-right col-sm-6">
                    <form action="">
                        <div class="form-group col-sm-6">
                            <label for="filterStatus" class="control-label col-sm-3">Status</label>
                            <div class="status col-sm-9">
                                <select name="filterStatus" id="filterStatus" class="filterStatus form-control">
                                <?php
                                    $t=@$_REQUEST['fStatus'];
                                    $arrayStatus = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '');
                                    for ($i=1; $i < 6; $i++):
                                        if($t == $i):
                                            $arrayStatus[$i] = 'selected';
                                            break;
                                        endif;
                                    endfor;
                                ?>
                                    <option value=""></option>
                                    <option value="1" <?php echo $arrayStatus[1] ?>>Pré Cadastrado</option>
                                    <option value="2" <?php echo $arrayStatus[2] ?>>Pendente</option>
                                    <option value="3" <?php echo $arrayStatus[3] ?>>Em Desenvolvimento</option>
                                    <option value="4" <?php echo $arrayStatus[4] ?>>Em Teste</option>
                                    <option value="5" <?php echo $arrayStatus[5] ?>>Concluído</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="filterSituacao" class="control-label col-sm-3">Situação</label>
                            <div class="situacao col-sm-9">
                                <select name="filterSituacao" id="filterSituacao" class="filterSituacao form-control">
                                <?php
                                    $s=@$_REQUEST['fSituacao'];
                                    $arraySituacao = array(1 => '', 2 => '');
                                    for ($i=1; $i < 3; $i++):
                                        if($s == $i):
                                            $arraySituacao[$i] = 'selected';
                                            break;
                                        endif;
                                    endfor;
                                ?>
                                    <option value=""></option>
                                    <option value="1" <?php echo $arraySituacao[1] ?>>Ativo</option>
                                    <option value="2" <?php echo $arraySituacao[2] ?>>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-responsive table-hover">
                <tr>
                    <th width="10%">ID</th>
                    <th width="50%">Nome</th>
                    <th width="15%">Status</th>
                    <th width="15%">Situação</th>
                    <th width="10%">Ações</th>
                </tr>
                <?php
                foreach ($read->getResult() as $user):
                    $user['situacao'] = ($user['situacao'] == 1) ? "<span style='color:green'>Ativo</span>":"<span style='color:red'>Inativo</span>";
                    
                    switch ($user['status']) {
                        case 1:
                            $user['status'] = "Pré Cadastrado";
                        break;
                        case 2:
                            $user['status'] = "Pendente";
                        break;
                        case 3:
                            $user['status'] = "Em Desenvolvimento";
                        break;
                        case 4:
                            $user['status'] = "Em Teste";
                        break;
                        default:
                            $user['status'] = "Concluído";
                        break;
                    }

                    extract($user);
                    View::Show($user);
                endforeach;
                ?>
            </table>
            <button class="btn btn-success" id="btnCadastro"><i class="fa fa-plus-circle"></i> Cadastrar</button>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/funcoes_bases.js"></script>
    </body>
</html>