<div id="pdf" class="container">

    <div class="row">
        <div class="col-xs-2">
            <span id="pdf-logo" class="glyphicon glyphicon-home"></span>
        </div>
        <div class="col-xs-8">
            <p class="text-center"><strong>SANTA ROSA METAIS LDTA.</strong></p>
            <p class="text-center">Rua Azuil Loureiro, 775 - Santa Rosa - Guarujá - SP</p>
            <p class="text-center">Tel: (13) 3333-3333</p>
            <p class="text-center">www.santarosa.com.br - santa@rosa.com.br</p>
        </div>
        <div class="col-xs-2">
            <p class="text-center"><strong>Pedido de <?= ($pedido->getTpPedido() === "V") ? "Venda" : "Compra"; ?></strong></p>
            <p class="text-center"><strong><?= $pedido->getIdPedido(); ?></strong></p>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Cliente:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getNmPessoa() : '---'; ?></p></div>
        <div class="col-xs-2"><p class="text-right"><strong>E-mail:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getCdEmail() : '---'; ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Telefone:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getCdTelefone() : '---'; ?></p></div>
        <div class="col-xs-2"><p class="text-right"><strong>Celular:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getCdCelular() : '---'; ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>RG/IE:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getCdRGIE() : '---'; ?></p></div>
        <div class="col-xs-2"><p class="text-right"><strong>CPF/CNPJ:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getPessoa() != null ? $pedido->getPessoa()->getCdCPFCNPJ() : '---'; ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Endereço:</strong></p></div>
        <div class="col-xs-10"><p class="text-left"><?= $pedido->getDsEndereco(); ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Entrega:</strong></p></div>
        <div class="col-xs-10"><p class="text-left"><?= $pedido->getDsEndereco(); ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Representante:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= $pedido->getUsuario()->getNmUsuario() ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Data:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= toDMY($pedido->getDtPedido()) ?></p></div>
        <div class="col-xs-2"><p class="text-right"><strong>Emissão:</strong></p></div>
        <div class="col-xs-4"><p class="text-left"><?= data() ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <hr style="margin-bottom: 5px;" />
            <p class="text-center" style="margin: 0px;"><strong>ITENS</strong></p>
            <hr style="margin-top: 5px;" />
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Qtde.</th>
                        <th>Unitário</th>
                        <th>Desconto</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedido->getItens() as $item): ?>
                        <tr>
                            <td><?= $item->getNrItem(); ?></td>
                            <td><?= $item->getProduto()->getNmProduto(); ?></td>
                            <td><?= $item->getQtItem(); ?></td>
                            <td><?= toBRL($item->getVlUnitario()); ?></td>
                            <td><?= $item->getVlDescontoItem() * 100; ?>%</td>
                            <td><?= toBRL($item->getVlItem()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12"><hr style="margin-bottom: 5px;" /></div>
        <div class="col-xs-2"><p class="text-right" style="margin: 0px;"><strong></strong></p></div>
        <div class="col-xs-2"><p class="text-left" style="margin: 0px;"></p></div>
        <div class="col-xs-2"><p class="text-right" style="margin: 0px;"><strong>Desconto:</strong></p></div>
        <div class="col-xs-2"><p class="text-left" style="margin: 0px;"><?= $pedido->getVlDesconto() * 100 ?>%</p></div>
        <div class="col-xs-2"><p class="text-right" style="margin: 0px;"><strong>Total:</strong></p></div>
        <div class="col-xs-2"><p class="text-left" style="margin: 0px;"><?= toBRL($pedido->getVlPedido()) ?></p></div>
        <div class="col-xs-12"><hr style="margin-top: 5px;" /></div>
    </div>

    <div class="row">
        <div class="col-xs-2"><p class="text-right"><strong>Descrição:</strong></p></div>
        <div class="col-xs-10"><p class="text-left"><?= $pedido->getDsPedido() ?></p></div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <span class="assinatura pull-left">Assinatura do representante</span>
            <span class="assinatura pull-right">Assinatura do cliente</span>
        </div>
    </div>

</div>