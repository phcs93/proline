<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Quimicas</div>
        
        <div class="table-responsive">
        
            <table id="quimicas" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Quimica</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $quimicas = Quimica::findAll(); ?>
                    <?php foreach ($quimicas as $quimica) : ?>
                        <tr>
                            <td><?= $quimica->getIdQuimica() ?></td>
                            <td><?= $quimica->getNmQuimica() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

