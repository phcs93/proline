<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Produto</h4>
            </div>

            <div class="modal-body">

                <!--formulario-->
                <form id="frmProduto" action="../mvc/controller/Controller.php?class=Produto" role="form" class="form-horizontal frmRegistro">

                    <!--id-->
                    <input type='hidden' name='idProduto' />

                    <!--tipo-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="idTipo" class="form-control" tabindex="1" required>
                                    <option value="">Selecione uma opção...</option>
                                    <?php $tipos = Tipo::findAll(); ?>
                                    <?php foreach ($tipos as $tipo) : ?>
                                        <option value="<?= $tipo->getIdTipo(); ?>"><?= $tipo->getNmTipo(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" id="addTipo" class="btn btn-default" title="Adicionar" data-placement="left" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--material-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Material *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="idMaterial" class="form-control" tabindex="2" required>
                                    <option value="">Selecione uma opção...</option>
                                    <?php $materiais = Material::findAll(); ?>
                                    <?php foreach ($materiais as $material) : ?>
                                        <option value="<?= $material->getIdMaterial(); ?>"><?= $material->getNmMaterial(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" id="addMaterial" class="btn btn-default" title="Adicionar" data-placement="left" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--quimica-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Quimica *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="idQuimica" class="form-control" tabindex="3" required>
                                    <option value="">Selecione uma opção...</option>
                                    <?php $quimicas = Quimica::findAll(); ?>
                                    <?php foreach ($quimicas as $quimica) : ?>
                                        <option value="<?= $quimica->getIdQuimica(); ?>"><?= $quimica->getNmQuimica(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" id="addQuimica" class="btn btn-default" title="Adicionar" data-placement="left" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--medida-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Medida *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="idMedida" class="form-control" tabindex="4" required>
                                    <option value="">Selecione uma opção...</option>
                                    <?php $medidas = Medida::findAll(); ?>
                                    <?php foreach ($medidas as $medida) : ?>
                                        <option value="<?= $medida->getIdMedida(); ?>"><?= $medida->getNmMedida(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" id="addMedida" class="btn btn-default" title="Adicionar" data-placement="left" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--polegadas-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Polegadas</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" name="vlPolegadas" class="form-control numeric" placeholder="polegadas..." pattern='^[0-9/,. ]+$' maxlength="25" tabindex="5" />
                                <span class="input-group-addon">&nbsp;"&nbsp;</span>
                            </div>
                        </div>
                    </div>

                    <!--ncm-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">NCM</label>
                        <div class="col-sm-10">
                            <input type="text" name="cdNCM" class="form-control" placeholder="NCM do produto..." data-mask="9999.99.99" tabindex="6" />
                        </div>
                    </div>

                    <!--compra-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Compra *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="vlCompra" class="form-control" placeholder="valor de compra..." pattern="^\d{1,18}(,|,\d{1,2}|.|.\d{1,2})?$" tabindex="7" required />
                            </div>
                        </div>
                    </div>

                    <!--venda-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Venda *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="vlVenda" class="form-control" placeholder="valor de venda..." pattern="^\d{1,18}(,|,\d{1,2}|.|.\d{1,2})?$" tabindex="8" required />
                                <span class="input-group-addon">
                                    <span class="suffixo">
                                        <input type="checkbox" id="pct" checked />&nbsp;47%
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--Kg/m-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kg/m</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" id="btnCalcularKGMT" class="btn btn-default" title="Calcular" data-placement="right" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                    </button>
                                </span>
                                <input type="text" name="vlKGMT" class="form-control numeric" placeholder="quilos por metro..." pattern="^\d{1,17}(,|,\d{1,3}|.|.\d{1,3})?$" tabindex="9" />
                                <span class="input-group-addon"><span class="suffixo">Kg/m</span></span>
                            </div>
                        </div>
                    </div>

                    <!--Kg/Pç-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kg/Pç</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" id="btnCalcularKGPC" class="btn btn-default" title="Calcular" data-placement="right" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                    </button>
                                </span>
                                <input type="text" name="vlKGPC" class="form-control numeric" placeholder="quilos por peça..." pattern="^\d{1,17}(,|,\d{1,3}|.|.\d{1,3})?$" tabindex="10" />
                                <span class="input-group-addon"><span class="suffixo">Kg/Pç</span></span>
                            </div>
                        </div>
                    </div>

                    <!--m/Pç-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">m/Pç</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" id="btnCalcularMTPC" class="btn btn-default" title="Calcular" data-placement="right" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                    </button>
                                </span>
                                <input type="text" name="vlMTPC" class="form-control numeric" placeholder="metros por peça..." pattern="^\d{1,17}(,|,\d{1,3}|.|.\d{1,3})?$" tabindex="11" />
                                <span class="input-group-addon"><span class="suffixo">m/Pç</span></span>
                            </div>
                        </div>
                    </div>

                    <!--minimo e unidade-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Mínimo *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" name="qtMinimo" class="form-control numeric" placeholder="estoque minimo..." pattern="^\d{1,17}(,|,\d{1,3}|.|.\d{1,3})?$" tabindex="12" required />
                                <span class="input-group-btn">
                                    <select name="cdUnidade" class="btn" tabindex="13" required>
                                        <option value="">...</option>
                                        <option value="KG">Kg</option>
                                        <option value="MT">m</option>
                                        <option value="PÇ">Pç</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--meses parado-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Parado</label>
                        <div class="col-sm-10">
                            <input type="text" name="mmParado" class="form-control numeric" placeholder="máximo de meses parado..." pattern='^[0-9]+$' maxlength="25" tabindex="14" />
                        </div>
                    </div>

                    <!--fornecedor-->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Fornecedor</label>
                        <div class="col-sm-10">
                            <select name="idPessoa" class="form-control" tabindex="15">
                                <option value="">Selecione uma opção...</option>
                                <?php $pesssoas = Pessoa::findAll(); ?>
                                <?php foreach ($pesssoas as $pesssoa) : ?>
                                    <option value="<?= $pesssoa->getIdPessoa(); ?>"><?= $pesssoa->getNmPessoa(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="frmProduto" tabindex="14">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="15">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar
                </button>
            </div>

        </div>

    </div>

</div>