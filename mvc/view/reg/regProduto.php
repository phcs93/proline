<div class="panel panel-default">
    
    <div class="panel-heading">
        <h4 class="panel-title"><?= $produto->getIdProduto(); ?> - <?= $produto->getNmProduto(); ?></h4>
    </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">

                        <li class="list-group-item"><span class="badge badge-primary"><?= $produto->getCdNCM(); ?></span>NCM</li>

                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($produto->getVlUnitario('compra', 'KG')); ?></span>Compra (Kg)</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($produto->getVlUnitario('venda', 'KG')); ?></span>Venda (Kg)</li>

                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($produto->getVlUnitario('compra', 'MT')); ?></span>Compra (m)</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($produto->getVlUnitario('venda', 'MT')); ?></span>Venda (m)</li>

                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($produto->getVlUnitario('compra', 'PC')); ?></span>Compra (Pç)</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($produto->getVlUnitario('venda', 'PC')); ?></span>Venda (Pç)</li>

                    </ul>
                </div>

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge badge-primary"><?= $produto->getCdUnidade(); ?></span>Unidade cadastrada</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toKG($produto->getVlKGMT()); ?></span>Kg/m</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toKG($produto->getVlKGPC()); ?></span>Kg/Pç</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toMT($produto->getVlMTPC()); ?></span>m/Pç</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toKG($produto->getQtEstoque('KG')); ?></span>Estoque (Kg)</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toMT($produto->getQtEstoque('MT')); ?></span>Estoque (m)</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toPC($produto->getQtEstoque('PC')); ?></span>Estoque (Pç)</li>
                    </ul>
                </div>

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?php switch ($produto->getCdUnidade()) {
                                    case 'KG':
                                    echo toKG($produto->getQtMinimo());
                                    break;
    
                                    case 'MT':
                                    echo toMT($produto->getQtMinimo());
                                    break;
    
                                    case 'PÇ':
                                    echo toPC($produto->getQtMinimo());
                                    break;
                                } ?>
                            </span>Estoque mínimo
                        </li>
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?= $produto->getMmParado(); ?>&nbsp;mêses
                            </span>
                            Limite parado
                        </li>
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?= $produto->getPessoa() != null ? $produto->getPessoa()->getNmPessoa() : "nenhum" ?>
                            </span>
                            Fornecedor
                        </li>
                    </ul>
                </div>

            </div>

            <div class="row" <?= $produto->getHtmlData() ?>>
                
                <div class='col-xs-12 col-md-4'>

                    <button id="btnReporProduto" type="button" class='btn btn-info btn-block'>
                        <span class='glyphicon glyphicon-repeat'></span>&nbsp;Repor Produto
                    </button>

                </div>

                <div class='col-xs-12 col-md-4 col-md-offset-4'>

                    <div class="btn-group btn-group-justified">

                        <div class="btn-group">
                            <button id="btnAlterar" type="button" class='btn btn-primary'>
                                <span class='glyphicon glyphicon-edit'></span>&nbsp;Alterar
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