<?php 
    if (!isset($_GET['id'])){
        include "html/idxCRUD.php"; 
        include "lst/lstUsuario.php";
    }else{
        $usuario = Usuario::find($_GET['id']);
        if ($usuario){
            include "reg/regUsuario.php";
        }else{
            echo "Usuário inexistente!";
        }
    }
    include "frm/frmUsuario.php";
?>