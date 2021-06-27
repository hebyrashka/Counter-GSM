/*
document.addEventListener('DOMContentLoaded', function(){
    let buttonResult = document.getElementById('js-show-result');

	let result = document.getElementById('js-result');
	let distanceShow = document.getElementById('js-distance-show');

	let inputDistance = document.getElementById('js-distance');
	let inputNorma = document.getElementById('js-norma');

	buttonResult.onclick = function() {
		if (inputDistance.value != '' && inputNorma.value != '') {
			if (norma == "summer") {
				distanceShow.value = inputDistance.value + ' км.';
				result.value = Math.floor(inputDistance.value * (inputNorma.value / 100)) + ' л.';
			}
			if (norma == "winter") {
				distanceShow.value = inputDistance.value  + 'км.';
				result.value = Math.floor(inputDistance.value * (inputNorma.value * 1.15 / 100)) + ' л.';
			}
		}
	}
}, false);*/
