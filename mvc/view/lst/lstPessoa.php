<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Pessoas</div>
        
        <div class="table-responsive">
        
            <table id="pessoas" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Pessoa</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $pessoas = Pessoa::findAll(); ?>
                    <?php foreach ($pessoas as $pessoa) : ?>
                        <tr>
                            <td><?= $pessoa->getIdPessoa() ?></td>
                            <td><?= $pessoa->getNmPessoa() ?></td>
                            <td><?= $pessoa->getTpPessoa() == 'C' ? 'Cliente' : 'Fornecedor'; ?></td>
                            <td><?= $pessoa->getDsPessoa() == 'F' ? 'Física' : 'Jurídica';?></td>
                            <td >
                                <?php if ($pessoa->isDevendo()): ?>
                                    <span class="badge alert-warning">Com dividas</span>
                                <?php else: ?>
                                    <span class="badge alert-success">Sem dividas</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

