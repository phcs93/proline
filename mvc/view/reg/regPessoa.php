<div class="panel panel-default">
    
    <div class="panel-heading">
        <h4 class="panel-title"><?= $pessoa->getIdPessoa(); ?> - <?= $pessoa->getNmPessoa(); ?></h4>
    </div>

    <div class="panel-body">

        <div class="row">

            <div class="col-xs-12 col-md-4">
                
                <ul class="list-group">
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getTpPessoa() == 'C' ? 'Cliente' : 'Fornecedor'; ?></span>Tipo</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getDsPessoa() == 'F' ? 'Física' : 'Jurídica'; ?></span>Pessoa</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getCdRGIE(); ?></span>RG / IE</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getCdCPFCNPJ(); ?></span>CPF / CNPJ</li>
                </ul>
                
            </div>
            
            <div class="col-xs-12 col-md-4">
                
                <ul class="list-group">
                    <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($pessoa->getVlDividaCompra()); ?></span>Devendo para a pessoa</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= toBRL($pessoa->getVlDividaVenda()); ?></span>Pessoa devendo</li>
                </ul>
                
            </div>
            
            <div class="col-xs-12 col-md-4">
                
                <ul class="list-group">
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getCdEmail(); ?></span>Email</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getCdTelefone(); ?></span>Telefone</li>
                    <li class="list-group-item"><span class="badge badge-primary"><?= $pessoa->getCdCelular(); ?></span>Celular</li>
                </ul>
                
            </div>

        </div>
        
        <?php 
            $pedidos = $pessoa->getPedidos();
            include("mvc/view/lst/lstPedido.php");
        ?>

        <div class="row" <?= $pessoa->getHtmlData(); ?>>
            
            <div class='col-xs-12 col-md-4'>

                <div class="btn-group btn-group-justified">

                    <div class="btn-group">
                        <button id="btnQuitarCompras" type="button" class='btn btn-success' <?= $pessoa->getVlDividaCompra() == 0 ? "disabled" : "" ?>>
                            <span class='glyphicon glyphicon-usd'></span>&nbsp;Quitar Compras
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="btnQuitarVendas" type="button" class='btn btn-success' <?= $pessoa->getVlDividaVenda() == 0 ? "disabled" : "" ?>>
                            <span class='glyphicon glyphicon-usd'></span>&nbsp;Quitar Vendas
                        </button>
                    </div>

                </div>
                    
                <div class="visible-xs" style="height: 20px;"></div>

            </div>
            
            <div class='col-xs-12 col-md-4'>

                <div class="btn-group btn-group-justified">

                    <div class="btn-group">
                        <button id="btnReceberCompras" type="button" class='btn btn-info' <?= $pessoa->isDevendoEntregarCompras() ? "" : "disabled" ?>>
                            <span class='glyphicon glyphicon-road'></span>&nbsp;Receber Compras
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="btnEntregarVendas" type="button" class='btn btn-info' <?= $pessoa->isDevendoEntregarVendas() ? "" : "disabled" ?>>
                            <span class='glyphicon glyphicon-road'></span>&nbsp;Entregar Vendas
                        </button>
                    </div>

                </div>
                    
                <div class="visible-xs" style="height: 20px;"></div>

            </div>

            <div class='col-xs-12 col-md-4'>

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