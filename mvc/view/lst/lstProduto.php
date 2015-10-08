<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Produtos</div>
        
        <div class="table-responsive">
        
            <table id="produtos" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NCM</th>
                        <th>Produto</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $produtos = Produto::findAll(); ?>
                    <?php foreach ($produtos as $produto) : ?>
                        <tr>
                            <td><?= $produto->getIdProduto() ?></td>
                            <td><?= $produto->getCdNCM() ?></td>
                            <td><?= $produto->getNmProduto() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

