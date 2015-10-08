$(document).ready(function() {
    
    $('#btnQuitarCompras').click(function(){
        if (confirm("Tem certeza que deseja quitar todas as compras com esta pessoa?")){
            
            var tpPagamento = "";
            
            do{
                tpPagamento = prompt("Qual a forma de pagamento?\nDN = dinheiro\nDB = débito\nCR = crédito\nCH = cheque\nX = cancelar");
                if (tpPagamento != "DN" && tpPagamento != "DB" && tpPagamento != "CR" && tpPagamento != "CH" && tpPagamento != "X"){
                    tpPagamento = "";
                }
            }while(tpPagamento == "")
            
            if (tpPagamento != 'X'){
                var id = $(this).closest('.row').data('idpessoa');
                ajax("POST", "mvc/controller/PessoaController.php?function=QuitarCompras&id=" + id + "&tp=" + tpPagamento, {}, function(data){
                    location.reload();
                });
            }
            
        }
    });
    
    $('#btnQuitarVendas').click(function(){
        if (confirm("Tem certeza que deseja quitar todas as vendas com esta pessoa?")){
            
            var tpPagamento = "";
            
            do{
                tpPagamento = prompt("Qual a forma de pagamento?\nDN = dinheiro\nDB = débito\nCR = crédito\nCH = cheque\nX = cancelar");
                if (tpPagamento != "DN" && tpPagamento != "DB" && tpPagamento != "CR" && tpPagamento != "CH" && tpPagamento != "X"){
                    tpPagamento = "";
                }
            }while(tpPagamento == "")
            
            if (tpPagamento != 'X'){
                var id = $(this).closest('.row').data('idpessoa');
                ajax("POST", "mvc/controller/PessoaController.php?function=QuitarVendas&id=" + id + "&tp=" + tpPagamento, {}, function(data){
                    location.reload();
                });
            }
            
        }
    });
    
    $('#btnReceberCompras').click(function(){
        if (confirm("Tem certeza que deseja receber todas as compras feitos com esta pessoa?")){
            var id = $(this).closest('.row').data('idpessoa');
            ajax("POST", "mvc/controller/PessoaController.php?function=ReceberCompras&id=" + id, {}, function(data){
                location.reload();
            });
        }
    });
    
    $('#btnEntregarVendas').click(function(){
        if (confirm("Tem certeza que deseja entregar todas as vendas feitas para esta pessoa?")){
            var id = $(this).closest('.row').data('idpessoa');
            ajax("POST", "mvc/controller/PessoaController.php?function=EntregarVendas&id=" + id, {}, function(data){
                location.reload();
            });
        }
    });
    
});