<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstPessoa.php";
    }else{
        $pessoa = Pessoa::find($_GET['id']);
        if ($pessoa){
            include "reg/regPessoa.php";
        }else{
            echo "Pessoa inexistente!";
        }
    }
    include "frm/frmPessoa.php";
?>