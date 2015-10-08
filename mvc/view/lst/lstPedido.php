<div class="panel-group">
    
    <div class="panel panel-default">
        
        <div class="panel-heading table-title">Pedidos</div>
        
        <div class="table-responsive">
        
            <table id="pedidos" class='table table-condensed table-hover tblRegistro'>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Pagamento</th>
                        <th>Entrega</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    <?php 
                        if (!isset($pedidos)){
                            if (!isset($_GET['d'])){
                                $pedidos = Pedido::findAll();
                            }else{
                                $pedidos = Pedido::findBy(array("dtPedido" => $_GET['d']));
                            }
                        } 
                    ?>
                    
                    <?php foreach ($pedidos as $pedido) : ?>
                        <tr>
                            <td><?= $pedido->getIdPedido() ?></td>
                            <td><?= toDMY($pedido->getDtPedido()) ?></td>
                            <td><?= $pedido->getTpPedido() == "C" ? "Compra" : "Venda" ?></td>
                            
                            <td>
                                <?php if ($pedido->getStPagamento() == 'PN'): ?>
                                    <span class="badge alert-warning">Pendente</span>
                                <?php else: ?>
                                    <span class="badge alert-success">Concluido</span>
                                <?php endif; ?>
                            </td>
                            
                            <td>
                                <?php if ($pedido->getStEntrega() == 'PN'): ?>
                                    <span class="badge alert-warning">Pendente</span>
                                <?php else: ?>
                                    <span class="badge alert-success">Concluido</span>
                                <?php endif; ?>
                            </td>
                            
                            <td><?= $pedido->getDsPedido() ?></td>
                            <td><?= toBRL($pedido->getVlPedido()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
                
            </table>
        
        </div>
        
    </div>
    
</div>

