<div class="modal fade" id="mdlPagamento" tabindex="-1" role="dialog" aria-labelledby="mdlPagamentoLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="mdlPagamentoLabel">Pagamento</h4>
            </div>

            <div class="modal-body">

                <!--formulario-->
                <form id="frmPagamento" action="mvc/controller/Controller.php?class=Pagamento" role="form" class="form-horizontal frmRegistro">

                    <!--pagamento-->
                    <input type='hidden' name='idPagamento' />

                    <!--pedido-->
                    <input type='hidden' name='idPedido' />

                    <!--numero-->
                    <input type='hidden' name='nrPagamento' />
                    
                    <!--data-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Data</label>
                        <div class="col-sm-10">
                            <input type="date" name="dtPagamento" class="form-control" value="<?= date('Y-m-d'); ?>" required />
                        </div>
                    </div>

                    <!--valor-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Valor</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="vlPagamento" class="form-control" placeholder="valor do pagamento..." pattern="^\d{1,18}(,|,\d{1,2}|.|.\d{1,2})?$" tabindex="1" required />
                            </div>
                        </div>
                    </div>
                    
                    <!--tipo-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo</label>
                        <div class="col-sm-10">
                            <select name="tpPagamento" class="form-control" required>
                                <option value="">Selecione um tipo de pagamento...</option>
                                <option value="DN">Dinheiro</option>
                                <option value="CH">Cheque</option>
                                <option value="CR">Crédito</option>
                                <option value="DB">Débito</option>
                                <option value="BL">Boleto</option>
                            </select>
                        </div>
                    </div>
                    
                    <!--periodo-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Periodo</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" name="qtPeriodo" class="form-control" placeholder="valor do pagamento..." value="0" pattern="^[0-9]+" tabindex="1" required />
                                <span class="input-group-addon">Dias</span>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="frmPagamento" >
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                </button>
            </div>

        </div>
    </div>

</div>