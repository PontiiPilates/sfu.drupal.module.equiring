/**
 * Функция для передачи данных из формы на обработчик.
 */
$(document).ready(function(){
	// Находим элемент.
	$('#sber-submit').click(function(evt){
		alert('Ok!');
		// Отменяем действие при отправке.
		evt.preventDefault();
		// Получаем данные формы.
		form = $('#sfu-pay-form').serialize();
		// Передаем данные в обработчик.
		window.location = '../sites/all/modules/custom/paysber/script.php?' + form;
	})
})