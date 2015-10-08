<div class="panel panel-default">
  
    <div class="panel-heading">
        <h4 class="panel-title"><?= $usuario->getIdUsuario(); ?> - <?= $usuario->getNmUsuario(); ?></h4>
    </div>

    <div class="panel-body">
        
        <div class="row">

            <div class="col-xs-12 col-md-4">
                <ul class="list-group">
                    <li class="list-group-item"><span class="badge badge-primary"><?= $usuario->getCdLogin(); ?></span>Login</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= $usuario->getCdSenha(); ?></span>Senha</li>
                </ul>
            </div>

        </div>
        
        <div class="row" <?= $usuario->getHtmlData(); ?>>

            <div class='col-xs-12 col-md-4 col-md-offset-8'>

                <div class="btn-group btn-group-justified">

                    <div class="btn-group">
                        <button id="btnAlterar" type="button" class='btn btn-primary'>
                            <span class='glyphicon glyphicon-pencil'></span>&nbsp;Alterar
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="btnRemover" type="button" class='btn btn-danger'>
                            <span class='glyphicon glyphicon-trash'></span>&nbsp;Remover
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>