$(document).ready(function() {
    
    $('#btnReporEstoque').click(function(){
        if (confirm("Tem certeza que deseja repor todos os produtos em falta no estoque?")){
            ajax("POST", "mvc/controller/ProdutoController.php?function=ReporEstoque", {}, function(data){
                msg("success", "<span class='glyphicon glyphicon-ok'></span>&nbsp;&nbsp;Pedidos de reposição realizados com sucesso!");
            });
        }
    });
    
});