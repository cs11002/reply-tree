var id = 11;
function readmore() {
	var max = id+5;
	for(; id < max; id++) {
		if(document.getElementById(id) != null) {
			document.getElementById(id).style.display="block";
		}	
	}
}