<?php

    $root = __DIR__;

    session_start();
    
    include "src/$.php"; // funções globais
    include "src/DB.php"; // banco de dados
    
    if (isset($_GET['p'])){
        if ($_GET['p'] == "sair"){
            unset($_SESSION['usuario']);
        }
    }
    
    if (isset($_POST['cdLogin']) && isset($_POST['cdSenha'])){
        $usuario = Usuario::findByLoginSenha($_POST['cdLogin'], $_POST['cdSenha']);
        if ($usuario){
            $_SESSION['usuario'] = $usuario->toArray();
        }else{
            $error = true;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="pt">

    <head>
        <title>Proline</title>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="icon" type="image/png" href="src/img/favicon.png" />
        <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="src/css/$.css">
        <script src="src/js/jQuery.js"></script>
        <script src="src/bootstrap/js/bootstrap.min.js"></script>
        <script src="src/js/ajax.js"></script>
        <script src="src/js/$.js"></script>
        <script src="src/js/CRUD.js"></script>
        
        <?php if (isset($_GET['p'])): ?>
            <?php if ($_GET['p'] != "sair"): ?>
                <script src="mvc/view/js/<?= $_GET['p'] ?>.js"></script>
            <?php endif; ?>
        <?php endif; ?>
            
        <?php if (isset($error)): ?>
            <script>
                $(document).ready(function(){
                    msg('danger', '<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;Login ou senha incorretos!');
                });
            </script>
        <?php endif; ?>
        
    </head>

    <body>

        <div id="msg" class="alert alert-fixed-top" style="display: none;"></div>
        
        <?php if (isset($_SESSION['usuario'])): ?>

            <?php include 'nav.php'; ?>
    
            <div class="container">
                
                <?php if (isset($_GET['p']) && $_GET['p'] != "sair"): ?>
                
                    <?php include("mvc/view/".$_GET['p'].".php"); ?>
                
                <?php else: ?>
                
                    <div class="jumbotron">
                        <h1>
                            <?php
                                $h = date('H', time());
                                switch(true){
                                    case ($h >= 0 && $h < 6):echo "Boa noite";break;
                                    case ($h >= 6 && $h < 12):echo "Bom dia"; break;
                                    case ($h >= 12 && $h < 18):echo "Boa tarde"; break;
                                    case ($h >= 18 && $h <= 23):echo "Boa noite"; break;
                                }
                                echo " " . $_SESSION['usuario']['nmUsuario'] . "!";
                            ?>
                        </h1>
                        <h1>Bem vindo ao <span style="border-bottom: 2px solid red;">Proline!</span></h1>
                        <h2>O programa lider de negócios.</h2>
                        <h3>Em desenvolvimento.</h3>
                    </div>
                    
                <?php endif; ?>

            </div>
                    
        <?php else: ?>
            
            <div class="container">
    
                <img src="../src/img/logo.png" class="img-responsive center-block" alt="PROLINE"/>
                <img src="../src/img/proline.png" class="img-responsive center-block" alt="PROLINE"/>
    
                <div class="row">
    
                    <form role="form" method="POST" class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                        <div class="form-group">
                            <input type="text" name="cdLogin" class="form-control" maxlength="255" placeholder="login..." required />
                        </div>
                        <div class="form-group">
                            <input type="password" name="cdSenha" class="form-control" maxlength="255" placeholder="senha..." required />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-block">Entrar</button>
                        </div>
                    </form>

                </div>
                
            </div>
            
        <?php endif; ?>
            
    </body>

</html>