<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Usuários</div>
        
        <div class="table-responsive">
        
            <table id="usuarios" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $usuarios = Usuario::findAll(); ?>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?= $usuario->getIdUsuario() ?></td>
                            <td><?= $usuario->getNmUsuario() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

