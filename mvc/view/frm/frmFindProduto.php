<div class="modal fade" id="mdlFindProduto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Produto</h4>
            </div>

            <div class="modal-body">

                <form id="frmFindProduto" role="form" class="form-horizontal">
                    
                    <!--pesquisar produtos-->
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <div class="has-feedback">
                                <input type="search" id="buscaProduto" class="form-control" placeholder="digite o nome de um produto..." />
                                <span class="glyphicon glyphicon-search form-control-feedback search-icon-form"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!--produto-->
                    <div class="form-group">            
                        <label class="control-label col-sm-2">Produto</label>
                        <div class="col-sm-10">
                            <select id="produto" class="form-control">
                                <option value="">selecione um produto...</option>
                                <?php $produtos = Produto::findAll(); ?>
                                <?php foreach ($produtos as $produto): ?>
                                    <option value="<?= $produto->getIdProduto() ?>"
                                        data-C-KG="<?= $produto->getVlUnitario('compra', 'KG') ?>"
                                        data-C-MT="<?= $produto->getVlUnitario('compra', 'MT') ?>"
                                        data-C-PÇ="<?= $produto->getVlUnitario('compra', 'PC') ?>"
                                        data-V-KG="<?= $produto->getVlUnitario('venda', 'KG') ?>"
                                        data-V-MT="<?= $produto->getVlUnitario('venda', 'MT') ?>"
                                        data-V-PÇ="<?= $produto->getVlUnitario('venda', 'PC') ?>"
                                        ><?= $produto->getNmProduto() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <!--quantidade-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Qtde.</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" id="qtde" class="form-control numeric" placeholder="quantidade do produto..." pattern="^\d{1,17}(,|,\d{1,3})?$"/>
                                <span class="input-group-btn">
                                    <select id="unidade" class="btn">
                                        <option value="">...</option>
                                        <option value="KG">Kg</option>
                                        <option value="MT">m</option>
                                        <option value="PÇ">Pç</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!--unitario-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Unitário</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" id="unitario" class="form-control" placeholder="valor unitario do produto..." pattern="^\d{1,12}(,|,\d{1,2})?$" readonly/>
                            </div>
                        </div>
                    </div>
                    
                    <!--total-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Total</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" id="totalItem" class="form-control" placeholder="valor total do item..." pattern="^\d{1,12}(,|,\d{1,2})?$" readonly/>
                            </div>
                        </div>
                    </div>
                    
                    <!--desconto-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Desconto</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" id="descontoItem" class="form-control numeric" placeholder="desconto..." pattern="^\d{1,2}?$" />
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary" form="frmFindProduto">
                        <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                    </button>
                </div>
            </div>

        </div>
        
    </div>

</div>