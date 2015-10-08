<div class="row">
    <div class='col-xs-12 col-md-4'>
        <div class="input-group">
            <input id="data" type="<?= isset($_GET['t']) ? $_GET['t'] : 'date' ?>" class="form-control" value="<?= isset($_GET['d']) ? $_GET['d'] : '' ?>" />
            <span class="input-group-btn">
                <select id="dateType" class="btn">
                    <option value="date">Dia</option>
                    <option value="month" <?= $_GET['t'] == "month" ? "selected" : "" ?>>Mês</option>
                </select>
            </span>
        </div>
    </div>
    <div class='col-xs-12 col-md-6 col-md-offset-2'>
        <div class="has-feedback">
            <input id="busca" type="search" class="form-control" placeholder="digite algo para pesquisar..." />
            <span class="glyphicon glyphicon-search form-control-feedback search-icon"></span>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading table-title">Movimentação de Caixa</div>
            <div class="table-responsive">

                <table id="caixa" class="table table-condensed table-hover table-bordered tblRegistro">

                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                        </tr>
                    </thead>

                    <?php 
                        if (!isset($_GET['d'])){
                            $pagamentos = Pagamento::findAll();
                        }else{
                            if ($_GET['t'] == 'date'){
                                $pagamentos = Pagamento::findBy(array("dtPagamento" => $_GET['d']));
                            }else{
                                $data = $_GET['d'];
                                $plusMonth = explode("-", $data)[0] . "-" . sprintf("%02d", explode("-", $data)[1] + 1);
                                $qb = $GLOBALS['orm']->createQueryBuilder();
                                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento > '$data'")->andWhere("p.dtPagamento < '$plusMonth'")->getQuery()->getResult();
                            }
                        } 
                    ?>
                    
                    <tbody>
                        <?php foreach($pagamentos as $pagamento): ?>
                            <tr>
                                <td>
                                <?php 
                                    echo $pagamento->getPedido()->getDsPedido(); 
                                    switch($pagamento->getTpPagamento()) {
                                        case 'DN': echo "Dinheiro"; break;
                                        case 'DB': echo "Débito"; break;
                                        case 'CR': echo "Crédito"; break;
                                        case 'CH': echo "Cheque"; break;
                                        case 'BL': echo "Boleto"; break;
                                        default: break;
                                    }
                                ?>
                                </td>
                                <td class="numeric"><strong><?= $pagamento->getPedido()->getTpPedido() == 'V' ? toBRL($pagamento->getVlPagamento()) : "" ?></strong></td>
                                <td class="numeric"><strong><?= $pagamento->getPedido()->getTpPedido() == 'C' ? toBRL($pagamento->getVlPagamento()) : "" ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot class="panel-footer">
                        <tr>
                            <td class="text-right"><strong>Total <?= isset($_GET['t']) ? ($_GET['t'] == "date" ? "do dia" : "do mês") : '' ?></strong></td>
                            <td class="text-right"><?= toBRL(Pagamento::entradaDia(isset($_GET['d']) ? $_GET['d'] : '')); ?></td>
                            <td class="text-right"><?= toBRL(Pagamento::saidaDia(isset($_GET['d']) ? $_GET['d'] : '')); ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Total acumulado</strong></td>
                            <td class="text-right"><?= toBRL(Pagamento::entradaAcumulada(isset($_GET['d']) ? $_GET['d'] : '')); ?></td>
                            <td class="text-right"><?= toBRL(Pagamento::saidaAcumulada(isset($_GET['d']) ? $_GET['d'] : '')); ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Total em caixa</strong></td>
                            <td colspan="2" class="text-center"><?= toBRL(Pagamento::totalDia(isset($_GET['d']) ? $_GET['d'] : '')); ?></td>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </div>
    </div>
</div>