$(document).ready(function() {
    
    $('#busca').keyup(function() {
        
        $('.tblRegistro').find('thead').find('select').each(function(){
            $(this).val("");
        });

        var busca = $(this).val();

        if (busca !== '') {
            
            var palavras = busca.split(' ');
            
            $('.tblRegistro').find('tbody').find('tr').each(function() {
                
                for (var i = palavras.length; i--; ) {
                    var palavra = palavras[i];
                    
                    if (!$(this).text().match(new RegExp(palavra, 'gi'))) {
                        $(this).hide();
                        return;
                    }
                }
                
                $(this).show();
                
            });
            
        } else {
            $('.tblRegistro').find('tbody').find('tr').show();
        }

    });
    
    $('.tblRegistro').on('click', 'th', function() {

        if ($(this).text() != ""){

            var index = $(this).closest('thead').find('th').index($(this));
    
            var lista = $(this).closest('table').find('tbody').find('tr');
            
            $(this).closest("thead").find('th').each(function(){
                if ($(this).closest('thead').find('th').index($(this)) != index){
                    $(this).removeClass("order-desc").removeClass("order-asc");
                }
            });
            
            if ($(this).hasClass("order-asc")){
                
                $(this).removeClass("order-asc");
                $(this).addClass("order-desc");
                
                lista.sort(function(a, b) {
                    
                    if (isNaN($(a).children().eq(index).text())){
                        return $(b).children().eq(index).text().toUpperCase().localeCompare($(a).children().eq(index).text().toUpperCase());
                    }else{
                        return $(b).children().eq(index).text().localeCompare($(a).children().eq(index).text(), 'kn', {numeric: true});
                    }
                    
                });
                
            }else{
                
                $(this).removeClass("order-desc");
                $(this).addClass("order-asc");
                
                lista.sort(function(a, b) {
                    
                    if (isNaN($(a).children().eq(index).text())){
                        return $(a).children().eq(index).text().toUpperCase().localeCompare($(b).children().eq(index).text().toUpperCase());
                    }else{
                        return $(a).children().eq(index).text().localeCompare($(b).children().eq(index).text(), 'kn', {numeric: true});
                    }
                    
                });
                
            }
    
            $.each(lista, function(idx, itm) {
                $(this).closest('tbody').append(itm);
            });
        
        }

    });
    
    $('.tblRegistro').find('tbody').find('tr').click(function(e){
        var id = $($(this).find('td')[0]).text();
        var location = $(this).closest("table").attr("id");
        window.location = "?p=" + location + "&id=" + id;
    });
    
    $('#btnNovo').click(function() {

        var frm = $('.frmRegistro');
        frm[0].reset();
        frm.attr('method', 'POST');

        $('#myModal').modal('show');
        
    });
    
    $('#btnAlterar').click(function() {

        var frm = $('.frmRegistro');
        frm[0].reset();
        frm.attr('method', 'PUT');

        var dados = $(this).closest('.row').data();

        $(frm).find('input, select').each(function(){
            var name = $(this).attr('name');
            if (typeof name != 'undefined'){
                
                var val = dados[name.toLocaleLowerCase()];
                
                if ($(this).attr('type') == 'radio'){
                    console.log("val = " + val);
                    console.log("thisval = " + $(this).val());
                    if ($(this).val() == val){
                        $(this).prop('checked', true);
                    }
                }else{
                    $(this).val(val);
                }
                
            }
        });

        $('#myModal').modal('show');
        
    });
    
    $('#btnRemover').click(function() {
        
        var data = $(this).closest('.row');
        
        var crud = data.data('crud');

        var id = $(data).data('id' + crud.toLocaleLowerCase());
        var nm = $(data).data('string');
        
        if (confirm("Tem certeza que deseja remover \n" + nm + "?")) {

            // criar parametros ajax
            var type = "DELETE";
            var url = "mvc/controller/Controller.php?class=" + crud;
            var data = [{"name": "id" + crud, "value": id}];

            // chamada ajax e definição da função success
            ajax(type, url, data, function(json) {

                // resposta ajax
                var id = json['id'];

                // exibir mensagem de sucesso
                msg('success', '<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;Registro removido com sucesso!');

                window.location = document.URL.split('?')[0];

            });
            
        }

    });
    
    $('.frmRegistro').submit(function(e) {

        // não submitar a pagina
        e.preventDefault();

        // criar parametros ajax
        var frm = $(this);

        // method, action e data
        var type = frm.attr('method');
        var url = frm.attr('action');
        var data = frm.toJSON();

        // chamada ajax e função success
        ajax(type, url, data, function(json) {

            // fechar modal de formulario
            frm.closest('.modal').find('.modal-header').find('button[data-dismiss="modal"]').click();

            // exibir mensagem de sucesso
            msg('success', '<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;Registro cadastrado com sucesso!');
            
            // recarregar a pagina
            location.reload();

        });

    });

});