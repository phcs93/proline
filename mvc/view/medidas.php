<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstMedida.php";
    }else{
        $medida = Medida::find($_GET['id']);
        if ($medida){
            include "reg/regMedida.php";
        }else{
            echo "Medida inexistente!";
        }
    }
    include "frm/frmMedida.php";
?>