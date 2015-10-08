<div class="panel panel-default">

    <div class="panel-heading">
        <h4 class="panel-title"><?= $pedido->getIdPedido(); ?> - <?= $pedido->getDsPedido(); ?></h4>
    </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge badge-primary"><?= ($pedido->getTpPedido() === "V") ? "Venda" : "Compra"; ?></span>Tipo</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getNmPessoa() : "nenhum" ?></span>Pessoa</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= $pedido->getUsuario()->getNmUsuario(); ?></span>Usuário</li>
                    </ul>
                </div>

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge badge-primary"><?= toDMY($pedido->getDtPedido()); ?></span>Data</li>
                        <?php if ($pedido->getStPagamento() == 'PN'): ?>
                            <li class="list-group-item"><span class="badge alert-warning">Pendente</span>Pagamento</li>
                        <?php else: ?>
                            <li class="list-group-item"><span class="badge alert-success">Pago</span>Pagamento</li>
                        <?php endif; ?>
                        <?php if ($pedido->getStEntrega() == 'PN'): ?>
                            <li class="list-group-item"><span class="badge alert-warning">Pendente</span>Entrega</li>
                        <?php else: ?>
                            <li class="list-group-item"><span class="badge alert-success">Entregue</span>Entrega</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="col-xs-12 col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge badge-primary">
                                <?= toBRL($pedido->getVlPedido()); ?> (<?= $pedido->getVlDesconto() * 100; ?>%)
                            </span>Valor <span class="hidden-xs">(com desconto)</span>
                        </li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($pedido->getVlPago()); ?></span>Valor Pago</li>
                        <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($pedido->getVlRestante()); ?></span>Valor Restante</li>
                    </ul>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 hidden-xs">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge badge-primary"><?= $pedido->getDsEndereco() ?></span>Endereço
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 visible-xs">
                    <ul class="list-group">
                        <li class="list-group-item">Endereço</li>
                        <li class="list-group-item"><?= $pedido->getDsEndereco() ?></li>
                    </ul>
                </div>
            </div>

            <div class="row">

                <div class="col-xs-12">

                    <div id="itens<?= $pedido->getIdPedido(); ?>" class="panel-group">
                        <?php foreach($pedido->getItens() as $item): ?>
                            <?php include "regItem.php"; ?>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xs-12">

                    <div class="panel panel-default">

                        <div class="panel-heading table-title">Pagamentos</div>

                        <div class="table-responsive">

                            <table id="pagamentos" class="table table-condensed table-hover">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($pedido->getPagamentos() as $pagamento): ?>
                                        <tr>
                                            <td><?= $pagamento->getNrPagamento(); ?></td>
                                            <td><?= toDMY($pagamento->getDtPagamento()); ?></td>
                                            <td>
                                                <?php 
                                                    switch($pagamento->getTpPagamento()){
                                                        case "DN": echo "Dinheiro"; break;
                                                        case "CH"; echo "Cheque"; break;
                                                        case "CR": echo "Crédito"; break;
                                                        case "DB": echo "Débito"; break;
                                                        case "BL": echo "Boleto"; break;
                                                    }
                                                ?>
                                            </td>
                                            <td><?= toBRL($pagamento->getVlPagamento()); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

            <br />

            <div class="row" <?= $pedido->getHtmlData(); ?>>

                <div class='col-xs-12 col-md-4'>
                    
                    <div class="btn-group btn-group-justified">

                        <div class="btn-group">
                            <button id="btnPagar" type="button" class='btn btn-success btn-block' <?= $pedido->getStPagamento() == 'PG' ? "disabled" : "" ?>>
                        <span class='glyphicon glyphicon-usd'></span>&nbsp;Pagar
                    </button>
                        </div>

                        <div class="btn-group">
                            <button id="btnEntregarTudo" type="button" class='btn btn-info btn-block' <?= $pedido->getStEntrega() == 'PN' ? "" : "disabled" ?>>
                        <span class='glyphicon glyphicon-road'></span>&nbsp;Entregar Pedido
                    </button>
                        </div>

                    </div>

                    <div class="visible-xs" style="height: 20px;"></div>

                </div>

                <div class='col-xs-12 col-md-4'>

                    <a class='btn btn-default btn-block btnImprimir' href="?p=pedidos&imprimir=<?= $pedido->getIdPedido(); ?>">
                        <span class='glyphicon glyphicon-print'></span>&nbsp;Imprimir
                    </a>

                    <div class="visible-xs" style="height: 20px;"></div>

                </div>

                <div class='col-xs-12 col-md-4 col'>

                    <!--<div class="btn-group btn-group-justified">-->

                    <!--    <div class="btn-group">-->
                    <!--        <button type="button" class='btn btn-primary btnAlterarEMCONSTRUCAO' onclick="alert('EM CONSTRUÇÃO');">-->
                    <!--            <span class='glyphicon glyphicon-pencil'></span>&nbsp;Alterar-->
                    <!--        </button>-->
                    <!--    </div>-->

                    <!--    <div class="btn-group">-->
                    <!--        <button id="btnRemover" type="button" class='btn btn-danger'>-->
                    <!--            <span class='glyphicon glyphicon-trash'></span>&nbsp;Remover-->
                    <!--        </button>-->
                    <!--    </div>-->

                    <!--</div>-->

                </div>

            </div>

        </div>

</div>