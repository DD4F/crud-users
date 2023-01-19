$(function() {
    $("#fecha_limite").datepicker({ startDate: '-0d' });
    $("#fecha_max").datepicker({ startDate: '+1d' });
    $("#fechalimitepa").datepicker({ startDate: '0d', dateFormat: 'yyyy-mm-dd' });
    $(".datepicker").datepicker();
    $('.select2').select2();
    $('.fechalimitepago').datepicker({ dateFormat: 'yyyy-mm-dd', defaultDate: '01-01-1985' });

});


function llenarSelect(datos){
	//datos.select
	//datos.ruta
	//datos.parametros {}
	//datos.selected
	//datos.key
	//datos.data
	//datos.texto (si tiene varios separados por punto se buscara el valor
	//               de esas variables)
	//podria colocar otro argumento para agregar un separador del texto resultante en la
	// descripcion , que podria
	//ser un guion u otra cosa pero que aun no lo voy a hacer
	//datos.firechange
	//datos.callback
	// $('#'+datos.select).empty().loading({message:'Cargando'});
	$('#'+datos.select).empty();

	var post_data=(undefined==datos || undefined==datos.parametros)?{}:datos.parametros;
	post_data._token=$('input[name ="_token"]').val();
	if(undefined==datos || undefined==datos.key){
			datos.key='id';
	}
	if(undefined==datos || undefined==datos.texto){
			datos.texto='descripcion';
	}
	var info=$.get(datos.ruta,post_data);
	var opciones='';
	var selected_default=(undefined==datos.selected || 0==datos.selected)?' selected="selected" ':'';
	opciones+='<option value="0">Seleccionar...</option>';
	info.done(function(msj){
		msj=JSON.parse(msj);
		$.each(msj, function(index, value){
			var textos=datos.texto.split(' ');
			var desc='';
			$.each(textos, function(indx2, vl2){
				desc+=value[vl2]+' ';
            });
            var data='';
            if(undefined!==datos.data){
				var dt=datos.data.split(' ');

				$.each(dt,function(idt, vdt){
					data+=' data-'+vdt+'="'+value[vdt]+'" ';
				});

			}
		opciones+='<option '+data+' '+selected_default+' value="'+value[datos.key]+'">'+desc+'</option>';
	    selected_default='';
	});
	// $('#'+datos.select).append(opciones).loading('stop');
	$('#'+datos.select).append(opciones);
	if(undefined !==datos && undefined!==datos.selected && datos.selected!==0){
		$('#'+datos.select).val(datos.selected);
	}
	if(undefined!==datos.firechange && datos.firechange){

			$('#'+datos.select).change();
	}
	if(datos!== undefined && typeof datos.callback == 'function'){
        datos.callback();
	}
	});
}

$(document).ready(function(){

	$('form').not('.ignorarform').submit(function(){
	event.preventDefault();
    $(this).find('.numberFormat').number( true, 2 , '.', '');
	$(this).unbind().submit();
	$(this).submit();

});




});

//esto es para calcular el valor total de los ajustes cuando se agregan detalle
//de ajustes
function calcular_sumas_ajuste(){

	var ajuste_capital= 0;
	var ajuste_interesmora= 0;


	var ajuste_capital_i=$('.calcular_ajuste_capital');
	var ajuste_interesmora_i=$('.calcular_ajuste_interesmora');

	$.each(ajuste_capital_i, function(index, value){
		var v=Number.isNaN(parseFloat($(value).val()))?0:parseFloat($(value).val());
		ajuste_capital+=v;
	});

	$.each(ajuste_interesmora_i, function(index, value){
		var v=Number.isNaN(parseFloat($(value).val()))?0:parseFloat($(value).val());
		ajuste_interesmora+=v;
	});

	// var ajuste_capital= parseFloat($('#calcular_ajuste_capital').val());
	// var ajuste_interesmora= parseFloat($('#calcular_ajuste_interesmora').val());

	var ajuste_capital_actual=parseFloat($('#valor_ajuste').data('valor_ajuste'));
	var ajuste_interesmora_actual=parseFloat($('#valor_interes_mora').data('valor_interes_mora'));

	var suma_capital=ajuste_capital_actual+ajuste_capital;
	var suma_mora=ajuste_interesmora_actual+ajuste_interesmora;

    $('#valor_ajuste').val(Number.isNaN(suma_capital)?ajuste_capital_actual:suma_capital);
    $('#valor_interes_mora').val(Number.isNaN(suma_mora)?ajuste_interesmora_actual:ajuste_interesmora_actual+ajuste_interesmora );

}
