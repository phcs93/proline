<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstProduto.php";
    }else{
        $produto = Produto::find($_GET['id']);
        if ($produto){
            include "reg/regProduto.php";
        }else{
            echo "Produto inexistente!";
        }
    }
    include "frm/frmProduto.php";
?>