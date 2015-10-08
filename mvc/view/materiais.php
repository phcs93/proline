<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstMaterial.php";
    }else{
        $material = Material::find($_GET['id']);
        if ($material){
            include "reg/regMaterial.php";
        }else{
            echo "Material inexistente!";
        }
    }
    include "frm/frmMaterial.php";
?>