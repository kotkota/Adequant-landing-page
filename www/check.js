function SendForm () {
var tmp, radiook;

if (document.getElementById('last_name1').value == '' || document.getElementById('name1').value == '' || document.getElementById('company1').value == '' || document.getElementById('oc1').value == '' || document.getElementById('phone_number1').value == ''){
	alert('Заполните все обязательные поля!');
	return false;
}

if (document.getElementById('email1').value.indexOf( "@", 2) == -1) 
{
	alert('Неправильно введена почта!');
	return false;
} 
return true;
}
