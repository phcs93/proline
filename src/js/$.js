$(document).ready(function() {

    //-------------------------------------------------------------------------
    // ativar tooltips
    //-------------------------------------------------------------------------
    $("body").tooltip({selector: '[data-toggle="tooltip"]'});

    //-------------------------------------------------------------------------
    // mascara de bloqueio em inputs com pattern definido
    //-------------------------------------------------------------------------
    $('input[pattern!=""]').keypress(function(e) {
        var key = String.fromCharCode(e.keyCode);
        var idx = $(this).getCursorPosition();
        var val = $(this).val();
        var output = [val.slice(0, idx), key, val.slice(idx)].join('');
        var regexp = new RegExp($(this).attr("pattern"));
        if (!regexp.test(output)) {
            e.preventDefault();
        }
    });

    //-------------------------------------------------------------------------
    // fix de form reset pora limpar input type hidden
    //-------------------------------------------------------------------------
    $('form').bind('reset', function(){
        $(this).find('input[type="hidden"]').val('');
    });

});

// exibe um alert de notificação no topo da tela ou dentro de um modal
function msg(type, text) {

    if($('.modal.in').length > 0){

        $($('.modal.in')[$('.modal.in').length - 1]).find('.modal-body').prepend(
            $('<div id="modal-msg" class="alert" style="display: none;">')
        );

        $('#modal-msg').addClass('alert-' + type).addClass('text-center').html('<strong>' + text + '</strong>').slideDown('fast').delay(5000)
        .slideUp('fast', function() {
            $(this).removeClass('alert-' + type);
        });

    }else{

        $('#msg').addClass('alert-' + type).addClass('text-center').html('<strong>' + text + '</strong>').slideDown('fast').delay(5000)
        .slideUp('fast', function() {
            $(this).removeClass('alert-' + type);
        });

    }
    
}

//================================================================
// hacks
//================================================================

// filter select by text
(function($) {
    
    $.fn.filterByText = function(textbox, selectSingleMatch) {
        
        return this.each(function() {
    
            var select = this;
            var options = [];
    
            $(select).find('option').each(function() {
                options.push($(this));
            });
    
            $(select).data('options', options);
    
            $(textbox).bind('change keyup', function() {
    
                var options = $(select).empty().scrollTop(0).data('options');
                var search = $.trim($(this).val());
                
                var words = search.split(' ');
    
                $.each(options, function(i) {
                    
                    var option = options[i];
                    
                    for (var ii = words.length; ii--; ) {
                        
                        var word = words[ii];
                    
                        if (!$(option).text().match(new RegExp(word, 'gi'))) {
                            return;
                        }
                    
                    }
                    
                    $(select).append(option);
                    
                });
    
                if (selectSingleMatch === true && $(select).children().length === 1) {
                    $(select).children().get(0).selected = true;
                }
    
            });
    
        });
        
    };
    
})(jQuery);

//================================================================
// jQuery missing events & functions
//================================================================

// on append
(function($) {
    var origAppend = $.fn.append;
    $.fn.append = function() {
        return origAppend.apply(this, arguments).trigger("append");
    };
})(jQuery);

// on remove
(function($) {
    var origRemove = $.fn.remove;
    $.fn.remove = function() {
        this.trigger("remove");
        return origRemove.apply(this, arguments);
    };
})(jQuery);

// on show
(function($) {
    var origShow = $.fn.show;
    $.fn.show = function() {
        return origShow.apply(this, arguments).trigger("show");
    };
})(jQuery);

// on hide
(function($) {
    var origHide = $.fn.hide;
    $.fn.hide = function() {
        return origHide.apply(this, arguments).trigger("hide");
    };
})(jQuery);

// pega o indice do cursor em um campo de texto
(function($) {
    $.fn.getCursorPosition = function() {
        var input = this.get(0);
        if (!input)
            return; // No (input) element found
        if (document.selection) {
            // IE
            input.focus();
        }
        return 'selectionStart' in input ? input.selectionStart : '' || Math.abs(document.selection.createRange().moveStart('character', -input.value.length));
    };
})(jQuery);

//----------------------------------------------------------------
// toJSON - serialize table tr com data-attr
//----------------------------------------------------------------
(function($) {
    $.fn.toJSON = function(options) {

        // serializeArray original
        var data = $(this).serializeArray();

        // para cada tabela no form
        $(this).find('table').each(function(){

            // array com dados de todos os trs
            var tblData = new Array();

            // coletar dados de todos os trs
            $(this).find('tbody tr').each(function(){
                tblData.push($(this).data());
            });

            // criar objeto com o array de dados da tabela
            data.push({
                'name' : $(this).attr('id'),
                'value' : JSON.stringify(tblData)
            });

        });

        // retornar dados
        return data;
    };
})(jQuery);