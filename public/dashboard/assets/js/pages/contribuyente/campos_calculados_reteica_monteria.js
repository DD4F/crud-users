function calcularReteica(){
	
	// calcular totalpagar_10
	var retencionica_8= parseFloat($('#retencionica_8').val());
	
	var totalpagar_10=retencionica_8;
	
	$('#totalpagar_10').val(totalpagar_10);
	$('#paretenciones_13').val(totalpagar_10);
	$('#patotal_14').val(totalpagar_10);
	
	//valor total
	$('#valor').val(totalpagar_10);
	
};