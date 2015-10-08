<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pedido</h4>
            </div>

            <div class="modal-body">

                <form id="frmPedido" action="../mvc/controller/Controller.php?class=Pedido" role="form" class="form-horizontal frmRegistro">

                    <input type='hidden' name='idPedido' />
                    
                    <!--tipo-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo *</label>
                        <div class="col-sm-10">

                            <label class="radio-inline">
                                <input type="radio" name="tpPedido" value="C" required/>&nbsp;Compra
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tpPedido" value="V" required/>&nbsp;Venda
                            </label>
                            
                        </div>
                    </div>
                    
                    <!--data-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Data *</label>
                        <div class="col-sm-10">
                            <input type="date" name="dtPedido" class="form-control" value="<?= date('Y-m-d'); ?>" required />
                        </div>
                    </div>
                    
                    <!--descrição-->
                    <div class="form-group">            
                        <label class="control-label col-sm-2">Descrição</label>
                        <div class="col-sm-10">
                            <div class="has-feedback">
                                <input type="text" name="dsPedido" class="form-control" placeholder="digite uma descrição para o pedido..." maxlength="255" />
                            </div>
                        </div>
                    </div>
                    
                    <!--endereço de entrega-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Endereço</label>
                        <div class="col-sm-10">
                            <input type="text" name="dsEndereco" class="form-control" placeholder="digite o endereço..." />
                        </div>
                    </div>
                    
                    <!--pesquisar pessoas-->
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <div class="has-feedback">
                                <input type="search" id="buscaPessoa" class="form-control" placeholder="digite o nome de uma pessoa..." />
                                <span class="glyphicon glyphicon-search form-control-feedback search-icon-form"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!--pessoa-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Pessoa</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="idPessoa" class="form-control" required>
                                    <option value="">selecione uma pessoa...</option>
                                    <?php $pessoas = Pessoa::findAll(); ?>
                                    <?php foreach ($pessoas as $pessoa): ?>
                                        <option value="<?= $pessoa->getIdPessoa(); ?>"><?= $pessoa->getNmPessoa(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" id="addPessoa" class="btn btn-default" title="Adicionar" data-placement="left" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!--tabela de itens-->
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Itens</h3>
                        </div>
                        
                        <div class="table-responsive">
                            
                            <table id="itens" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th class="numeric">#</th>
                                        <th>Produto</th>
                                        <th class="numeric">Quantidade</th>
                                        <th class="numeric">Unitario</th>
                                        <th class="numeric">Desconto</th>
                                        <th class="numeric">Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <button type="button" id="btnMdlProduto" class="btn btn-info btn-block" data-toggle="modal" data-target="#mdlFindProduto">Adicionar Item</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                        
                    </div>
                    
                    <!--desconto-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Desconto</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" id="descontoPedido" name="vlDesconto" class="form-control numeric" placeholder="desconto total..." pattern="^\d{1,2}?$" />
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <h2 class="pull-left text-success" style="margin: 0px;" id="vlTotalPedido">R$ 0,00</h2>

                <div class="pull-right">
                    <button type="submit" class="btn btn-primary" form="frmPedido">
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