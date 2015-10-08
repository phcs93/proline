<div class="row">
    <div class="col-xs-12 col-md-4">
        <button id="btnReporEstoque" class="btn btn-info btn-block">
            <span class='glyphicon glyphicon-repeat'></span>&nbsp;Repor Estoque
        </button>
    </div>
</div>

<br />

<div class="panel panel-default">

    <div class="panel-heading table-title">Estoque</div>

    <div class="table-responsive">

        <table id="estoque" class="table table-condensed table-hover">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Quilos</th>
                    <th>Métros</th>
                    <th>Péças</th>
                </tr>
            </thead>

            <tbody>
                <?php $produtos = Produto::findAll(); ?>
                <?php foreach($produtos as $produto): ?>
                    <tr>
                        <td><?= $produto->getIdProduto() ?></td>
                        <td><?= $produto->getNmProduto() ?></td>
                        <td><?= toKG($produto->getQtEstoque('KG')); ?></td>
                        <td><?= toMT($produto->getQtEstoque('MT')); ?></td>
                        <td><?= toPC($produto->getQtEstoque('PC')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>

</div>