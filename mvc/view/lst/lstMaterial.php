<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Materiais</div>
        
        <div class="table-responsive">
        
            <table id="materiais" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Material</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $materiais = Material::findAll(); ?>
                    <?php foreach ($materiais as $material) : ?>
                        <tr>
                            <td><?= $material->getIdMaterial() ?></td>
                            <td><?= $material->getNmMaterial() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

