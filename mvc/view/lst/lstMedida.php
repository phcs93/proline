<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Medidas</div>
        
        <div class="table-responsive">
        
            <table id="medidas" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Medida</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $medidas = Medida::findAll(); ?>
                    <?php foreach ($medidas as $medida) : ?>
                        <tr>
                            <td><?= $medida->getIdMedida() ?></td>
                            <td><?= $medida->getNmMedida() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

