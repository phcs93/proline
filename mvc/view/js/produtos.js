$(document).ready(function() {

    //-------------------------------------------------------------------------
    // evento de click no botão porcetagem
    //-------------------------------------------------------------------------
    $('input[name="vlVenda"]').focusin(function() {
        if ($('#pct').is(':checked')) {
            var compra = $('input[name="vlCompra"').val().replace(',', '.');
            var venda = (compra * 1.47).toFixed(2).replace('.', ',');
            $('input[name="vlVenda"').val(venda);
        }
    });

    //-------------------------------------------------------------------------
    // calcular unidades de conversão
    //-------------------------------------------------------------------------
    $('#btnCalcularKGMT, #btnCalcularKGPC, #btnCalcularMTPC').click(function() {

        var kgmt = $('input[name="vlKGMT"]').val().replace(",", ".");
        var kgpc = $('input[name="vlKGPC"]').val().replace(",", ".");
        var mtpc = $('input[name="vlMTPC"]').val().replace(",", ".");

        var btn = $(this).attr('id');
        
        switch (btn) {
            case 'btnCalcularKGMT':
            if (kgpc !== "" && mtpc !== "") {
                kgmt = kgpc / mtpc;
                $('input[name="vlKGMT"]').val(kgmt.toFixed(3).replace('.', ','));
            }
            break;
            case 'btnCalcularKGPC':
            if (kgmt !== "" && mtpc !== "") {
                kgpc = mtpc * kgmt;
                $('input[name="vlKGPC"]').val(kgpc.toFixed(3).replace('.', ','));
            }
            break;
            case 'btnCalcularMTPC':
            if (kgmt !== "" && kgpc !== "") {
                mtpc = kgpc / kgmt;
                $('input[name="vlMTPC"]').val(mtpc.toFixed(3).replace('.', ','));
            }
            break;
        }

    });

    //-----------------------------------------------------------------------------
    // adicionar tipo, material, quimica ou medida
    //-----------------------------------------------------------------------------
    $('#addTipo, #addMaterial, #addQuimica, #addMedida').click(function() {

        // obter a classe
        var classe = $(this).attr('id').substring(3);

        // loop de tratamento
        do {

            // pedir o nome ao usuario
            var nm = prompt("Digite o nome do(a) novo(a) " + classe);

            // verificar se esta em branco
            if (nm === "") {
                // exibir alerta de erro
                alert("Nenhum valor digitado!");
            }

        } while (nm === "");

        // se o usuário não cancelou
        if (nm !== null) {

            // criar parametros ajax
            var type = "POST";
            var url = "../mvc/controller/Controller.php?class=" + classe;
            var data = [{name: "nm" + classe, value: nm}];

            // chamada ajax e definição da função success
            ajax(type, url, data, function(json) {

                // reposta ajax
                var id = json['id'];
                var reg = json['string'];

                // exibir mensagem de sucesso
                msg('success', '<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;' + classe + ' cadastrado com sucesso!');

                var option = $('<option>').val(id).text(reg);

                // criar o registro novo na listagem
                $(option).appendTo('select[name="id' + classe + '"]');

                // selecionar o registro novo
                $('select[name="id' + classe + '"]').val(id);

            });

        }

    });
    
    $('#btnReporProduto').click(function(){
        if (confirm("Tem certeza que deseja repor este produto? (qtde minima * 2)")){
            var id = $(this).closest('.row').data('idproduto');
            ajax("POST", "mvc/controller/ProdutoController.php?function=ReporProduto&id=" + id, {}, function(data){
                location.reload();
            });
        }
    });

});