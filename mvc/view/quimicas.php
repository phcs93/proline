<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstQuimica.php";
    }else{
        $quimica = Quimica::find($_GET['id']);
        if ($quimica){
            include "reg/regQuimica.php";
        }else{
            echo "Quimica inexistente!";
        }
    }
    include "frm/frmQuimica.php";
?>