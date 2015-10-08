<?php
    if (!isset($_GET['imprimir'])){
        if (!isset($_GET['id'])){
            include "html/idxCRUD.php";
            include "lst/lstPedido.php"; 
            include "frm/frmFindProduto.php";
            include "frm/frmPedido.php"; 
        }else{
            $pedido = Pedido::find($_GET['id']);
            include "reg/regPedido.php";
            include "frm/frmPagamento.php";
            include "frm/frmEntrega.php"; 
        }
    }else{
        $pedido = Pedido::find($_GET['imprimir']);
        include "html/imprimirPedido.php";
    }
?>