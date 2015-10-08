<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Usuário</h4>
            </div>

            <div class="modal-body">

                <!--formulario-->
                <form id="frmUsuario" action="mvc/controller/Controller.php?class=Usuario" role="form" class="form-horizontal frmRegistro">

                    <input type='hidden' name='idUsuario' />

                    <!--nome-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nome *</label>
                        <div class="col-sm-10">
                            <input type="text" name="nmUsuario" class="form-control" placeholder="nome do usuário..." maxlength="255" required />
                        </div>
                    </div>

                    <!--login-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Login *</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdLogin" class="form-control" placeholder="login do usuário..." maxlength="255" required />
                        </div>
                    </div>

                    <!--senha-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Senha *</label>
                        <div class="col-sm-10">
                            <input type="password" name="cdSenha" class="form-control" placeholder="senha do usuário..." maxlength="255" required />
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="frmUsuario" >
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                </button>
            </div>

        </div>
    </div>

</div>