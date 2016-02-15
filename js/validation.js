function validate_id() {
	var reg =;
	if(document.forms["form_peralatan"]["idalat"].value.match(reg)) {
		alert("hai");
		return false;
	}
	else {  
		alert("Masukan ID salah!");
		return false;
	}
}