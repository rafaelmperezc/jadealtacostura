$(function() {

    // Atribui evento e função para limpeza dos campos
    $('#busca').on('input', limpiaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#busca" ).autocomplete({
	    minLength: 2,
	    source: function( request, response ) {
	        $.ajax({
	            url: "consulta.php",
	            dataType: "json",
	            data: {
	            	acao: 'autocomplete',
	                parametro: $('#busca').val()
	            },
	            success: function(data) {
	               response(data);
	            }
	        });
	    },
	    focus: function( event, ui ) {
	        $("#busca").val( ui.item.titulo );
	        carregarDados();
	        return false;
	    },
	    select: function( event, ui ) {
	        $("#busca").val( ui.item.titulo );
	        return false;
	    }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><b>Código de Barra: </b>" + item.codigo_barra + "<br><b>Título: </b>" + item.titulo + " - <b> Categoria: </b>" + item.categoria + "</a><br>" )
        .appendTo( ul );
    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados(){
    	var busca = $('#busca').val();

    	if(busca != "" && busca.length >= 2){
    		$.ajax({
	            url: "consulta.php",
	            dataType: "json",	
	            data: {
	            	acao: 'consulta',
	                parametro: $('#busca').val()
	            },
	            success: function( data ) {
	               $('#codigo_barra').val(data[0].codigo_barra);
	               $('#titulo_livro').val(data[0].titulo);
	               $('#categoria').val(data[0].categoria);
	               $('#valor_compra').val(data[0].valor_compra);
	               $('#valor_venda').val(data[0].valor_venda);
	               $('#data_cadastro').val(data[0].data_cadastro);
	               $('#status').val(data[0].status);
	            }
	        });
    	}
    }

    // Função para limpar os campos caso a busca esteja vazia
    function limpiaCampos(){
       var busca = $('#busca').val();

       if(busca == ""){
	   $('#codigo_barra').val('');
           $('#titulo_livro').val('')
           $('#categoria').val('');
           $('#valor_compra').val('');
           $('#valor_venda').val('');
           $('#data_cadastro').val('');
           $('#status').val('')
       }
    }
});