function calcularAnual(){
	
	//calcular campo total_ingresosmcpio_10
	var ingresosbrutos_8 = parseFloat($('#ingresosbrutos_8').val());
	var ingresosfueramcpio_9 = parseFloat($('#ingresosfueramcpio_9').val());
	var total_ingresosmcpio_10=ingresosbrutos_8-ingresosfueramcpio_9;
	//colocar el valor de total_ingresosmcpio_10 en el campo
	$('#total_ingresosmcpio_10').val(total_ingresosmcpio_10);
	
	//calcular el campo total_ingresosnetosgravables_16
	// = 10 -11 -12 -13 -14 -15
	
	var ingresosdevoluciones_11=parseFloat($('#ingresosdevoluciones_11').val());
	var ingresosexportaciones_12=parseFloat($('#ingresosexportaciones_12').val());
	var ingresosventaactivosfijos_13=parseFloat($('#ingresosventaactivosfijos_13').val());
	var ingresosactividadesnosujetas_14=parseFloat($('#ingresosactividadesnosujetas_14').val());
	var ingresosotrasactiviadadesexentas_15=parseFloat($('#ingresosotrasactiviadadesexentas_15').val());
	
	var total_ingresosnetosgravables_16=total_ingresosmcpio_10-
	                                    ingresosdevoluciones_11-
	                                    ingresosexportaciones_12-
										ingresosventaactivosfijos_13-
										ingresosactividadesnosujetas_14-
										ingresosotrasactiviadadesexentas_15;
	
	//colocar el valor de total_ingresosnetosgravables_16 en el campo
	$('#total_ingresosnetosgravables_16').val(total_ingresosnetosgravables_16);
	
	// calcular el campo impuestoica_20 
	//=sumatoria de los valores calculados en la tabla actividadesicadeclaradas
	
	var inputs_impuestoica_20=$('#actividadesicadeclaradas').find('.impuestoica_20');

    var impuestoica_20=0;
	
	$.each(inputs_impuestoica_20, function(index, value){
		impuestoica_20+=parseFloat($(value).val());
	});
	
 console.log(impuestoica_20);
	
	//colocar el valor al campo  impuestoica_20
	$('#impuestoica_20').val(impuestoica_20);
	
	
	//calcular el valor de impuestoavisostableros_21, sobretasabomberil_23
	//(21)=15% del Reglón 20 -- (23)= 7% del Reglón 20
	var impuestoica_20=parseFloat($('#impuestoica_20').val());
	
	var impuestoavisostableros_21=(impuestoica_20*15)/100;
	var sobretasabomberil_23=(impuestoica_20*7)/100;
	//colocar el valor de impuestoavisostableros_21 en el campo
	$('#impuestoavisostableros_21').val(impuestoavisostableros_21);
	$('#sobretasabomberil_23').val(sobretasabomberil_23);
	
	//calcular el valor del campo 25 total_impuestocar_25
	//= 20 +21 +22 +23 +24
	var unidadescomerciales_22=parseFloat($('#unidadescomerciales_22').val());
	var sobretasabomberil_23=parseFloat($('#sobretasabomberil_23').val());
	var sobretasaseguridad_24=parseFloat($('#sobretasaseguridad_24').val());
	
	var total_impuestocar_25=impuestoica_20+
							 impuestoavisostableros_21+
							 unidadescomerciales_22+
							 sobretasabomberil_23+
							 sobretasaseguridad_24;
							 
	//colocar el valor del campo total_impuestocar_25;
	$('#total_impuestocar_25').val(total_impuestocar_25);
	
	//calcular el valro del campo anticipovigenciasiguiente_30
	//=impuestoica_20*40%
	var anticipovigenciasiguiente_30=(impuestoica_20*40)/100;
	
	//colocar el valor del campo anticipovigenciasiguiente_30
	$('#anticipovigenciasiguiente_30').val(anticipovigenciasiguiente_30);					 
	
	//calcular campo total_saldocar_33
	//= 25 -26 -27 -28 -29 +30 +31 -32
	
	var excenciones_26=parseFloat($('#excenciones_26').val());
	var retencionespracticaron_27=parseFloat($('#retencionespracticaron_27').val());
	var autorretencionespracticadas_28=parseFloat($('#autorretencionespracticadas_28').val());
	var anticipovigenciaanterior_29=parseFloat($('#anticipovigenciaanterior_29').val());
	var sancion_31=parseFloat($('#sancion_31').val());
	var saldofavorvigenciaanterior_32=parseFloat($('#saldofavorvigenciaanterior_32').val());
	
	var total_saldocar=total_impuestocar_25-
							 excenciones_26-
							 retencionespracticaron_27-
							 autorretencionespracticadas_28-
							 anticipovigenciaanterior_29+
							 anticipovigenciasiguiente_30+
							 sancion_31-
							 saldofavorvigenciaanterior_32;
							 
	
	
	// calcular el valor del campo total_saldofavor_34
	
	/* var total_saldofavor_34=total_impuestocar_25-
							 excenciones_26-
							 retencionespracticaron_27-
							 autorretencionespracticadas_28-
							 anticipovigenciaanterior_29+
							 anticipovigenciasiguiente_30+
							 sancion_31-
							 saldofavorvigenciaanterior_32; */
							 
	// OJO aqui hay una condicion que dice 'si el valor es'	

	if(total_saldocar >= 0 ){
		//colocar el valor del campo total_saldocar_33;
		$('#total_saldocar_33').val(total_saldocar);
		$('#total_saldofavor_34').val(0);
	}else if( total_saldocar < 0){
		//colocar el valor del campo total_saldofavor_34;
		$('#total_saldofavor_34').val(total_saldocar);
		$('#total_saldocar_33').val(0);
	}
	
	$('#valorpagar_35').val(total_saldocar);
	
	//calcular el valor del campo total_pagar_38
	// = 35 - 36 + 37
	var valorpagar_35=total_saldocar;
	var descuentoprontopa_36=parseFloat($('#descuentoprontopa_36').val());
	var interesmora_37=parseFloat($('#interesmora_37').val());
	
	var total_pagar_38=valorpagar_35-
	                   descuentoprontopa_36+
					   interesmora_37;
	
	//colocar el valor del campo total_pagar_38;
	$('#total_pagar_38').val(total_pagar_38);
	
	//calcular el valor del campo total_pagarconpavoluntario_40
	//= 38 +39
	var pavoluntario_39=parseFloat($('#pavoluntario_39').val());
	var total_pagarconpavoluntario_40=total_pagar_38+
	                                  pavoluntario_39;
									  
	//colocar el valor del campo total_pagarconpavoluntario_40;
	$('#total_pagarconpavoluntario_40').val(total_pagarconpavoluntario_40);								  
	$('#valor').val(total_pagarconpavoluntario_40);								  
									  
									  
	
};