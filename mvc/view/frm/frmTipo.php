<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tipo</h4>
            </div>

            <div class="modal-body">

                <!--formulario-->
                <form id="frmTipo" action="../mvc/controller/Controller.php?class=Tipo" role="form" class="form-horizontal frmRegistro">

                    <input type='hidden' name='idTipo' />

                    <!--nome-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nome *</label>
                        <div class="col-sm-10">
                            <input type="text" name="nmTipo" class="form-control" placeholder="nome do tipo..." maxlength="255" required />
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="frmTipo" >
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                </button>
            </div>

        </div>
    </div>

</div>