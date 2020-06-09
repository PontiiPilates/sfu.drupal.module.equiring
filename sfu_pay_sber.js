/**
 * Вызов функций после загрузки страницы.
 */
$(document).ready(function(){
	temporaryDisabled();
	userMessage();
	btnSendSber();
})

/**
 * Временное отключение функции оплаты со страниц.
 */
function temporaryDisabled() {
	url = String(window.location);
	val = ['internet', 'antiplagiat', 'ebook', '&', '?'];
	ind = 0;
	for (i = val.length-1; i >= 0; i--) {
		if (url.indexOf(val[i]) > -1) {
			ind++;
		}
	}
	if (ind > 0) {
		$('.btn-container-sberbank').remove();
	}
}

/**
 * Выводит сообщения от скрипта-обработчика формы.
 * Проверяет адресную строку на наличие GET-параметров.
 */
function userMessage(){
	// Проверяем строку запроса на наличие какого-либо ответа.
	// Также производим разбор на массив по символу.
	strGet = window.location.search.replace('?','').split('=');
	// Сообщение, выводимое пользователю.
	message = 'Пожалуйста заполните все поля формы.';
	// Если передан параметр "err", то сообщение выводится алертом.
	if (strGet[1] == 'err') {
		alert(message);
	}
};

/**
 * Отменяет стандартную отправку формы. Осуществляет изъятие данных формы.
 * И отправляет данные формы на скрипт-обработчик.
 */
function btnSendSber(){
	// Находим элемент.
	$('#edit-pay-sber').click(function(evt){
		//alert('Ok!');
		// Отменяем действие при отправке.
		evt.preventDefault();
		// Получаем данные формы.
		form = $('#sfu-pay-form').serialize();
		// Передаем данные в обработчик.
		window.location = '../sites/default/modules/sfu_pay_sber/script.php?' + form;
	})
};