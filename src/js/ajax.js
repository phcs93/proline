// função ajax padrão
function ajax(type, url, data, callback) {
    $.ajax({
        type: type,
        url: url,
        data: data,
        dataType: 'json',
        beforeSend: function(jqXHR, settings) {
            loading(true);
        },
        success: function(json, textStatus, jqXHR) {
            if (typeof json['exception'] !== 'undefined') {
                if (json['exception'].indexOf("SQLSTATE[23000]") > -1){
                    if (json['exception'].indexOf("cdLogin") > -1){
                        msg("danger", "Este login já esta sendo utilizado por outro usuário!");
                    }else{
                        msg("danger", "Este registro está sendo utilizado por outros registros!");
                    }
                }else{
                    alert("exception = " + json['exception']);
                    alert("stacktrace = " + json['trace']);
                }
            } else {
                callback(json);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(textStatus);
            alert(jqXHR.responseText);
            alert(errorThrown);
        },
        complete: function(jqXHR, textStatus) {
            loading(false);
        }
    });
}

// função loading
function loading(opt) {

    if (opt === true) {

        $('body').append("<div id='overlay'></div>");

        $('<img id="imgLoading" src="../src/img/loading.gif" alt="carregando..." />').css({
            'z-index': 5001,
            'position': 'fixed',
            'top': '50% ',
            'left': '47%'
        }).appendTo('body');

        $("#overlay").height($(document).height()).css({
            'opacity': 0.4,
            'position': 'absolute',
            'top': 0,
            'left': 0,
            'background-color': 'black',
            'width': '100%',
            'z-index': 5000
        });

    } else {

        $('#overlay').fadeOut("fast", function() {
            $(this).remove();
            $('#imgLoading').remove();
        });

    }
}