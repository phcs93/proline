<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Tipos</div>
        
        <div class="table-responsive">
        
            <table id="tipos" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $tipos = Tipo::findAll(); ?>
                    <?php foreach ($tipos as $tipo) : ?>
                        <tr>
                            <td><?= $tipo->getIdTipo() ?></td>
                            <td><?= $tipo->getNmTipo() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

