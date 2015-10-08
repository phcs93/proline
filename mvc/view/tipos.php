<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstTipo.php";
    }else{
        $tipo = Tipo::find($_GET['id']);
        if ($tipo){
            include "reg/regTipo.php";
        }else{
            echo "Tipo inexistente!";
        }
    }
    include "frm/frmTipo.php";
?>