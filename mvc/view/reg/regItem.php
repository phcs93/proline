<div id="sub-registro<?= $item->getIdItem(); ?>" class="panel panel-<?= $item->getStEntregaitem() == "PN" ? "warning" : "success" ?> sub-registro">

    <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#itens<?= $pedido->getIdPedido(); ?>" data-target="#sub-collapse<?= $item->getIdItem(); ?>">

        <h4 class="panel-title accordion-toggle">
            <?= $item->getNrItem(); ?> - <?= $item->getProduto()->getNmProduto(); ?>
        </h4>

    </div>

    <div id="sub-collapse<?= $item->getIdItem(); ?>" class="panel-collapse collapse sub-collapse">

        <div class="panel-body">

            <div class="row">

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?php

                                switch ($item->getCdUnidadeItem()) {
                                    case 'KG': echo toKG($item->getQtItem());
                                    break;
                                    case 'MT': echo toMT($item->getQtItem());
                                    break;
                                    case 'PÇ': echo toPC($item->getQtItem());
                                    break;
                                }

                                ?>
                            </span>Qtde.
                        </li>
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?php

                                switch ($item->getCdUnidadeItem()) {
                                    case 'KG': echo toKG($item->getQtEntregue());
                                    break;
                                    case 'MT': echo toMT($item->getQtEntregue());
                                    break;
                                    case 'PÇ': echo toPC($item->getQtEntregue());
                                    break;
                                }

                                ?>
                            </span>Entregue
                        </li>
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?php

                                switch ($item->getCdUnidadeItem()) {
                                    case 'KG': echo toKG($item->getQtRestante());
                                    break;
                                    case 'MT': echo toMT($item->getQtRestante());
                                    break;
                                    case 'PÇ': echo toPC($item->getQtRestante());
                                    break;
                                }

                                ?>
                            </span>Restante
                        </li>
                    </ul>
                </div>

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($item->getVlUnitario()); ?></span>Unitario</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= $item->getVlDescontoItem() * 100; ?>%</span>Desconto</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($item->getVlItem()); ?></span>Valor</li>
                    </ul>
                </div>

            </div>

            <div class="row">

                <div class="col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading table-title">Entregas</div>
                        <div class="table-responsive">
                            <table class="table table-condensed entregas">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Qtde.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($item->getEntregas() as $entrega): ?>
                                        <tr>
                                            <td><?= $entrega->getNrEntrega(); ?></td>
                                            <td><?= toDMY($entrega->getDtEntrega()); ?></td>
                                            <td>
                                                <?php
                                                switch ($item->getCdUnidadeItem()) {
                                                    case 'KG': echo toKG($entrega->getQtEntrega());
                                                    break;
                                                    case 'MT': echo toMT($entrega->getQtEntrega());
                                                    break;
                                                    case 'PÇ': echo toPC($entrega->getQtEntrega());
                                                    break;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            
            <br />

            <div class="row" <?= $item->getHtmlData() ?>>

                <div class='col-xs-12 col-md-4'>

                    <button type="button" class='btn btn-info btn-block btnEntregar' <?= $item->getStEntregaItem() == 'EN' ? "disabled" : "" ?>>
                        <span class='glyphicon glyphicon-road'></span>&nbsp;Entregar
                    </button>

                    <div class="visible-xs" style="height: 20px;"></div>

                </div>

            </div>

        </div>

    </div>

</div>