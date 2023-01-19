
function agregarActividadDeclarar(){
event.preventDefault();

var elem=$('option:selected','#id_estadoinscripcion');
var id_codiciiu=elem.data('id');
var codigo=elem.data('codigo');
var nombre=elem.data('nombre');
var tarifa=elem.data('tarifa');

if($('#act_declarada_'+id_codiciiu).length>0){
	toastr.error('La actividad con Codigo: '+codigo+' ya ha sido agregada');
}else{

	var tr=$("<tr id='act_declarada_"+id_codiciiu+"'>"+
		"<td>"+codigo+"</td>"+
		"<td>"+nombre+"</td>"+
		"<td>"+
		"<input readonly name='actividades_declaradas["+id_codiciiu+"][tarifa]' class='form-control' value='"+parseFloat(tarifa)+"'></td>"+
		"<td><input onkeyup='calcularValorActividad(this);calcularAnual();' name='actividades_declaradas["+id_codiciiu+"][valor_declarado]' class='numberFormat form-control' value='0'></td>"+
		"<td><input readonly name='actividades_declaradas["+id_codiciiu+"][valor]' class='numberFormat form-control impuestoica_20' value='0'>"+
		"</td>"+
		"<td>"+
		"<input type='hidden' name='actividades_declaradas["+id_codiciiu+"][id_declaracionica]' value='0'>"+
		"<input type='hidden' name='actividades_declaradas["+id_codiciiu+"][id_codiciiu]' value='"+id_codiciiu+"'>"+
		"<button onclick='$(this).parent().parent().remove()' class='button btn btn-danger active'>Quitar</button></td>"+
	"</tr>");
	
	tr.find('.numberFormat').number( true, 2 );

$('#actividadesicadeclaradas').prepend(tr);

}
calcularAnual();
}

function calcularValorActividad(elem_valor){
	var valor_tarifa=parseFloat($(elem_valor).parent().prev().children('input').val());
	var valor_declarado=parseFloat($(elem_valor).val());
	var valor_total = (valor_tarifa*valor_declarado)/1000;
	$(elem_valor).parent().next().children('input').val(parseFloat(valor_total).toFixed(2));
}


//SELECCIONAR TIPO DE DECLARACION LLENAR SELECTS DE TIPO Y PERIODO

function llenarSelectTipoDeclaracion(selected){

	llenarSelect({select:"id_tipodeclaracionica",
		              ruta:$('#_url_').val()+'/ica/declaracion/buscartipodeclaraciondisponible/',
					  parametros:{vigencia:$('#vigencia').val(),contribuyente_id:$('#contribuyente_id').val()},
					  selected:selected,
					  texto:'nombre',
					  firechange:true
					  });
}

function llenarSelectPeriodoDeclaracion(selected){
	llenarSelect({select:"id_periododeclaracionica",
		              ruta:$('#_url_').val()+'/ica/declaracion/buscarperiododeclaraciondisponible/',
					  parametros:{vigencia:$('#vigencia').val(),
					              contribuyente_id:$('#contribuyente_id').val(),
								  id_tipodeclaracionica:$('#id_tipodeclaracionica').val()},
					  selected:selected,
					  texto:'periododeclaracion',
					  firechange:true
					  });
}
