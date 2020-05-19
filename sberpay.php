<?php
header('Content-Type: text/html; charset=utf-8');

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_GET);
echo "</pre>";

$context_options = array (
	"ssl" => array (
		"verify_peer" => false,
		"verify_peer_name" => false
	)
);




// Принимаем параметры с фронтенда
$q = json_decode($_GET['x']);

echo "<pre>";
print_r($q);
echo "</pre>";






$json_path = 'https://3dsec.sberbank.ru/payment/rest/register.do?userName=sfu-kras-api&password=sfu-kras&amount=100&orderNumber=15';
$json = file_get_contents($json_path, false, stream_context_create($context_options));
$arr_resp = json_decode($json, true);





echo "<pre>";
print_r($arr_resp);
echo "</pre>";



// Получение данных:
	// Джсоном.
	// Из формы.

// Расшифровка данных.
	// Разобрать джсон.

// Формирование запроса.

// Отправка запроса.




// Ответ.
	// 1. Распарсить ответ.
	// 2. Сделать редирект после распарсинга.
		// На страницу ошибки.
		// На страницу успеха.
		// На страницу оплаты.