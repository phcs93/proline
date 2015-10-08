<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pessoa</h4>
            </div>

            <div class="modal-body">

                <!--formulario-->
                <form id="frmPessoa" action="../mvc/controller/Controller.php?class=Pessoa" role="form" class="form-horizontal frmRegistro">

                    <input type='hidden' name='idPessoa' />

                    <!--nome-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nome *</label>
                        <div class="col-sm-10">
                            <input type="text" name="nmPessoa" class="form-control" placeholder="nome da pessoa..." maxlength="255" required />
                        </div>
                    </div>
                    
                    <!--tipo-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo *</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="tpPessoa" value="C" required/>&nbsp;Cliente
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tpPessoa" value="F" required/>&nbsp;Fornecedor
                            </label>
                        </div>
                    </div>
                    
                    <!--descrição-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Descrição*</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="dsPessoa" value="F" required/>&nbsp;Física
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="dsPessoa" value="J" required/>&nbsp;Jurídica
                            </label>
                        </div>
                    </div>
                    
                    <!--RG / IE-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">RG/IE</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdRGIE" class="form-control" placeholder="rg / ie da pessoa..." maxlength="255" required />
                        </div>
                    </div>
                    
                    <!--CPF / CNPJ-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">CPF/CNPJ</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdCPFCNPJ" class="form-control" placeholder="cpf / cnpj da pessoa..." maxlength="255" required />
                        </div>
                    </div>
                    
                    <!--email-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdEmail" class="form-control" placeholder="email da pessoa..." maxlength="255" required />
                        </div>
                    </div>
                    
                    <!--telefone-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Telefone</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdTelefone" class="form-control" placeholder="telefone da pessoa..." maxlength="255" required />
                        </div>
                    </div>
                    
                    <!--celular-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Celular</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdCelular" class="form-control" placeholder="celular da pessoa..." maxlength="255" required />
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="frmPessoa" >
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                </button>
            </div>

        </div>
    </div>

</div>