$(document).ready(function(){
	
	$('#data').change(function(){
		var data = $(this).val();
        if (data == ""){
            window.location = "?p=caixa";
        }else{
            window.location = "?p=caixa&d=" + data + "&t=" + $(this).attr('type');
        }
	});
	
	$('#dateType').change(function(){
	    $('#data').attr('type', $(this).val());
	});

});