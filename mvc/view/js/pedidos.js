$(document).ready(function(){
	
	// contador de itens (sempre ++)
	var nrItens = 0;
	
	// adicionar plugin de filtro em combo box
	$('#produto').filterByText($('#buscaProduto'), true);
    $('select[name="idPessoa"]').filterByText($('#buscaPessoa'), true);
    
    $('button[form="frmPedido"]').click(function(e){
        if ($('#itens').find('tbody').find('tr').length == 0){
            msg('info', '<span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Nenhum item adicionado no pedido!');
            e.preventDefault();
        }
    });
	
	//-------------------------------------------------------------------------
    // evento de click do botão pagar
    //-------------------------------------------------------------------------
	$('#btnPagar').click(function() {

		var frm = $('#frmPagamento');
		frm[0].reset();
		frm.attr('method', 'POST');

        var idPedido = $(this).closest('.row').data("idpedido");
        var vlRestante = $(this).closest('.row').data("vlrestante");
        
        var nrPagamento = $('#pagamentos').find('tbody').find('tr').length + 1;

		$(frm).find('input[name="idPedido"]').val(idPedido);
		$(frm).find('input[name="vlPagamento"]').val(vlRestante);
		$(frm).find('input[name="nrPagamento"]').val(nrPagamento);

		$('#mdlPagamento').modal('show');

	});
	
	//-------------------------------------------------------------------------
    // evento de click do botão entregar pedido
    //-------------------------------------------------------------------------
	$('#btnEntregarTudo').click(function() {
        if (confirm("Tem certeza que deseja receber/entregar todos os itens deste pedido?")){
            var id = $(this).closest('.row').data('idpedido');
            ajax("POST", "mvc/controller/PedidoController.php?function=EntregarPedido&id=" + id, {}, function(data){
                location.reload();
            });
        }
    });

	//-------------------------------------------------------------------------
    // evento de click em botões entregar
    //-------------------------------------------------------------------------
	$('.btnEntregar').click(function() {

		var frm = $('#frmEntrega');
		frm[0].reset();
		frm.attr('method', 'POST');

		var idItem = $(this).closest('.row').data("iditem");
		var qtRestante = $(this).closest('.row').data("qtrestante");
		var cdUnidadeItem = $(this).closest('.row').data("cdunidadeitem");
		
		var nrEntrega = $(this).closest('.panel-body').find('.entregas').find('tbody').find('tr').length + 1;

		$(frm).find('input[name="idItem"]').val(idItem);
		$(frm).find('input[name="qtEntrega"]').val(qtRestante);
		$(frm).find('input[name="nrEntrega"]').val(nrEntrega);
		
		$(frm).find('.suffixo').text(cdUnidadeItem);

		$('#mdlEntrega').modal('show');

	});
	
	//-------------------------------------------------------------------------
    // adicionar item
    //-------------------------------------------------------------------------
    $('#frmFindProduto').submit(function(e) {
        
        e.preventDefault();

         if ($('#totalItem').val() !== "0,00" && $('#totalItem').val() !== "") {
             
            $('#mdlFindProduto').modal("hide");

            nrItens++;

            $('<tr>').attr('class', 'item').data({
                'nrItem' : nrItens,
                'idProduto' : $('#produto').find('option:selected').val(),
                'cdUnidadeItem' : $('#unidade').find('option:selected').val(),
                'qtItem' : Number($('#qtde').val().replace(',', '.')).toFixed(3),
                'vlUnitario' : $('#unitario').val().replace(',', '.'),
                'vlDescontoItem' : ($('#descontoItem').val() !== "" ? Number($('#descontoItem').val()) / 100 : 0)
            }).append([
	            $('<td>').attr('class', 'nrItem numeric').text(nrItens),
	            $('<td>').attr('class', 'nmProduto').text($('#produto').find('option:selected').text()),
	            $('<td>').attr('class', 'qtItem numeric').text(Number($('#qtde').val().replace(',', '.')).toFixed(3).replace('.', ',') + " " + $('#unidade').find('option:selected').text()),
	            $('<td>').attr('class', 'vlUnitario numeric').text('R$ ' + $('#unitario').val()),
	            $('<td>').attr('class', 'vlDescontoItem numeric').text(($('#descontoItem').val() !== "" ? $('#descontoItem').val() : 0) + '%'),
	            $('<td>').attr('class', 'vlTotalItem numeric').text('R$ ' + $('#totalItem').val()),
	            $('<td>').append(
                    $('<button>').attr('class', 'btn btn-xs btn-danger btnRmvItem pull-right').attr('type', 'button').attr('title', 'Remover').attr('data-placement', 'right').attr('data-toggle', 'tooltip').append(
                        $('<span>').attr('class', 'glyphicon glyphicon-trash')
                    )
                )
            ]).appendTo('#itens').find('tbody');
            
            $('#frmFindProduto')[0].reset();

            totalPedido();

        } else {
            msg('info', '<span class="glyphicon glyphicon-info-sign"></span>&nbsp;O valor total do produto não pode ser 0,00');
        }
        
    });
    
    //-------------------------------------------------------------------------
    // remover item
    //-------------------------------------------------------------------------
    $('#itens').on('click', '.btnRmvItem', function() {
        $(this).parent().parent().fadeOut("slow", function(){
            $(this).remove();
            totalPedido();
        });
    });
    
    //-------------------------------------------------------------------------
    // evento de trocar de tipo de pedido (resetar itens)
    //-------------------------------------------------------------------------
    $('input[name="tpPedido"]').change(function(){
        nrItens = 0;
        $('#itens').find('tbody').find('tr').remove();
        totalPedido();
    });
    
    //-------------------------------------------------------------------------
    // ao trocar qualquer parametro -> recalcular valor do item
    //-------------------------------------------------------------------------
    $('#buscaProduto, #qtde, #descontoItem, #produto, #unidade, input[name="tpPedido"]').on("change keyup", function() {
        change();
    });
    
    //-------------------------------------------------------------------------
    // ao trocar valor do desconto total -> recalcular valor do pedido
    //-------------------------------------------------------------------------
    $('#descontoPedido').keyup(function() {
        totalPedido();
    });
    
    //-------------------------------------------------------------------------
    // fix para o modal stack (mudar no futuro)
    //-------------------------------------------------------------------------
    $('#mdlFindProduto').on('show.bs.modal', function() {
        if ($('.modal-backdrop').length > 1){
            $($('.modal-backdrop')[1]).css('z-index', 2000);
            $(this).css('z-index', 2001);
        }
    });
    
    //-------------------------------------------------------------------------
    // change do filtro por data
    //-------------------------------------------------------------------------
    $('#data').change(function(){
        var data = $(this).val();
        if (data == ""){
            window.location = "?p=pedidos";
        }else{
            window.location = "?p=pedidos&d=" + data;
        }
    });

});

function change() {

    var p = $('#produto').find('option:selected');
    var u = $('#unidade').find('option:selected').val();
    var t = $('input[name="tpPedido"]:checked').length > 0 ? $('input[name="tpPedido"]:checked').val() : "";

    if (p.val() !== '' && u !== '' && t !== '' && typeof p.val() !== 'undefined') {
        var v = p.attr('data-' + t + '-' + u);
        $('#unitario').val(Number(v).toFixed(2).replace('.', ','));
        totalItem();
    } else {
        $('#unitario').val('');
        $('#totalItem').val('');
    }
    
}

function totalItem() {
    var qtde = $('#qtde').val();
    if (qtde !== '') {
        var unitario = Number($('#unitario').val().replace(',', '.'));
        var desconto = (100 - Number($('#descontoItem').val().replace(',', '.'))) / 100;
        var total = (qtde.replace(',', '.') * unitario) * desconto;
        $('#totalItem').val(total.toFixed(2).replace('.', ','));
    } else {
        $('#totalItem').val('');
    }
}

function totalPedido() {
    var total = 0;
    var desconto = (100 - Number($('#descontoPedido').val().replace(',', '.'))) / 100;
    $('#itens').find('tbody').find('td.vlTotalItem').each(function() {
        total += Number($(this).text().replace('R$', '').replace(',', '.').trim());
    });
    $('#vlTotalPedido').text("R$ " + ((total * desconto).toFixed(2)).replace('.', ','));
}