function load_curr_rate() {
	xhr.open('GET', 'ajax.php');
	xhr.onload = function () {
		var json = JSON.parse(xhr.responseText)
		//console.log(json);
		$('#euro').text(json.Nominal);
		$('#rub').text(json.Value);
		setInterval(load_curr_rate, 10000);
	};
	xhr.send();
}

$(document).ready(function(){
	var xhr = new XMLHttpRequest;
}