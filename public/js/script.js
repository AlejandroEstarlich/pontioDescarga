function calculo(){
	var potenciaInstalada = $('#potencia_instalada');

	var pagoMensual = $('#pago_mensual').val();
	var potenciaContratada = $('#potencia_contratada').val();
	var numeroPaneles = $('#numero_paneles');
	var superficieNecesaria = $('#superficie_necesaria');
	var ahorroAnual = $('#ahorro_anual');
	var co2Evitado = $('#co2_evitado');
	var arbolesPlantados = $('#arboles_plantados');

	var alphaZona = 1422;

	// Fórmula alpha Potencia Instalada
	var totalPotenciaInstalada = parseFloat((((pagoMensual-((potenciaContratada)*3.2876))/0.11))/(alphaZona/12));
	potenciaInstalada.val(parseFloat(totalPotenciaInstalada).toFixed(2));

	// Fórmula alpha Número Paneles
	var totalNumeroPaneles = parseInt((totalPotenciaInstalada*1000)/330);
	numeroPaneles.val(totalNumeroPaneles);

	// Fórmula Alpha Superficie necesaria
	superficieNecesaria.val(totalNumeroPaneles*2);

	// Fórmula Alpha Ahorro Anual
	var totalAhorroAnual = parseFloat((totalPotenciaInstalada*1000)*(1.7/96));
	ahorroAnual.val(parseFloat(totalAhorroAnual).toFixed(2));

	// Fórmula Alpha CO2 evitado
	var totalCo2Evitado = parseFloat(((totalPotenciaInstalada*alphaZona)*0.11*(0.4))+((totalPotenciaInstalada*alphaZona)*0.11*(0.6)));
	co2Evitado.val(parseFloat(totalCo2Evitado).toFixed(4));

	// Fórmula Alpha Árboles Plantados
	arbolesPlantados.val(parseInt(totalCo2Evitado/5.9));

	console.log(potenciaInstalada.val());
	console.log(pagoMensual);
	console.log(totalPotenciaInstalada);
	console.log(potenciaContratada);

}