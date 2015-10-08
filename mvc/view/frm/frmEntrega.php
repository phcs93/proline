<div class="modal fade" id="mdlEntrega" tabindex="-1" role="dialog" aria-labelledby="mdlEntregaLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="mdlEntregaLabel">Entrega</h4>
            </div>

            <div class="modal-body">

                <!--formulario-->
                <form id="frmEntrega" action="../mvc/controller/Controller.php?class=Entrega" role="form" class="form-horizontal frmRegistro">

                    <!-- entrega -->
                    <input type='hidden' name='idEntrega' />

                    <!--item-->
                    <input type='hidden' name='idItem' />

                    <!--numero-->
                    <input type='hidden' name='nrEntrega' />

                    <!--qtde-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Qtde.</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" name="qtEntrega" class="form-control numeric" placeholder="quantidade..." pattern="^\d{1,18}(,|,\d{1,2}|.|.\d{1,2})?$" tabindex="1" required />
                                <span class="input-group-addon">
                                    <span class="suffixo"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--data-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Data</label>
                        <div class="col-sm-10">
                            <input type="date" name="dtEntrega" class="form-control" value="<?= date('Y-m-d'); ?>" required />
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="frmEntrega">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                </button>
            </div>

        </div>
    </div>

</div>