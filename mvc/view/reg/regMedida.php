<div class="panel panel-default registro">

    <div class="panel-heading">
        <h4 class="panel-title"><?= $medida->getIdMedida(); ?> - <?= $medida->getNmMedida(); ?></h4>
    </div>

    <div class="panel-body">
        
        <div class="row">

            <div class="col-xs-12 col-md-4">
                <ul class="list-group">

                </ul>
            </div>

        </div>
        
        <div class="row" <?= $medida->getHtmlData(); ?>>

            <div class='col-xs-12 col-md-4 col-md-offset-8'>

                <div class="btn-group btn-group-justified">

                    <div class="btn-group">
                        <button type="button" id="btnAlterar" class='btn btn-primary'>
                            <span class='glyphicon glyphicon-pencil'></span>&nbsp;Alterar
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" id="btnRemover" class='btn btn-danger'>
                            <span class='glyphicon glyphicon-trash'></span>&nbsp;Remover
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>