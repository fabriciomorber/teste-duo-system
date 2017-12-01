<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Celke - Crud Create</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body> 
        <div class="container theme-showcase" role="main">
            
            <?php
            require('./conf/Config.inc');
            $read = new Read;
            $read->ExeRead('usuarios');
            
            foreach ($read->getResult() as $user):
                extract($user);
                echo "<h1 class='text-danger'>{$name}</h1>"
                ."<p class='text-danger'>{$email}</p>";
            endforeach;
            
            $read->ExeRead('usuarios');
            
            $read->ExeRead('usuarios', 'WHERE name = :name AND email = :email LIMIT :limit', 'name=Cesar&email=cesar@celke.com.br&limit=3');
                    
            foreach ($read->getResult() as $user):
                extract($user);
                echo "<h1 class='text-success'>{$name}</h1>"
                ."<p class='text-success'>{$email}</p>";
            endforeach;
            ?>
            
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>