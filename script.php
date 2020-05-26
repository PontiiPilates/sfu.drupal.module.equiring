<?php
// Объявляем заголовки. Чтобы принимать корретные параметры формы.
header('Content-Type: text/html; charset=utf-8');

// Подключаем файл с доступами.
require_once 'access.php';

//Для отладки.
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

//Для отладки.
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";

/**
 * Значения всех форм.
 */
$description 	= $_GET['description'];
$libnumber 		= $_GET['libnumber'];
$personal 		= $_GET['personal'];
$package 		= $_GET['package'];
$service 		= $_GET['service'];
$surname 		= $_GET['surname'];
$address 		= $_GET['address'];
$dogovor 		= $_GET['dogovor'];
$hostel 		= $_GET['hostel'];
$status 		= $_GET['status'];
$payer 			= $_GET['payer'];
$phone 			= $_GET['phone'];
$event 			= $_GET['event'];
$email 			= $_GET['email'];
$cost 			= $_GET['cost'];
$room 			= $_GET['room'];
$url 			= $_GET['url'];
$fio 			= $_GET['fio'];
$org 			= $_GET['org'];

/**
 * Подготовка значений для сценариев.
 */
// Страница, с которой осуществлен переход.
$ref 			= $_SERVER['HTTP_REFERER'];

//Для отладки.
// echo "<pre>";
// print_r($ref);
// echo "</pre>";
// Значения для формирования адресов.

$err 			= '?msg=err';
$edu 			= 'http://hg.pay/services/edu';
$internet 		= 'http://hg.pay/services/internet';
$hostels 		= 'http://hg.pay/services/hostels';
$courses 		= 'http://hg.pay/services/courses';
$antiplagiat 	= 'http://hg.pay/services/antiplagiat';
$ebook 			= 'http://hg.pay/services/ebook';
$events 		= 'http://hg.pay/services/events';
$other 			= 'http://hg.pay/services/other';

/**
 * Сценарии редиректа и преобразования в зависимости от адресов и параметров.
 */
if ($ref == $edu || $ref == $edu.$err) {
	if (!$fio || !$payer || !$org || !$status || !$dogovor || !$cost || !$phone || !$email || !$personal) {
		header("Location: $edu"."$err");
		exit;
	}
} elseif ($ref == $internet || $ref == $internet.$err) {
	if (!$fio || !$payer || !$cost || !$phone || !$email || !$personal) {
		header("Location: $internet"."$err");
		exit;
	}
} elseif ($ref == $hostels || $ref == $hostels.$err) {
	if (!$fio || !$payer || !$hostel || !$address || !$room || !$dogovor || !$cost || !$phone || !$email || !$personal) {
		header("Location: $hostels"."$err");
		exit;
	}
} elseif ($ref == $courses || $ref == $courses.$err) {
	if (!$fio || !$payer || !$dogovor || !$cost || !$phone || !$email || !$personal) {
		header("Location: $courses"."$err");
		exit;
	}
} elseif ($ref == $antiplagiat || $ref == $antiplagiat.$err) {
	if (!$fio || !$payer || !$surname || !$libnumber || !$package || !$phone || !$email || !$personal) {
		header("Location: $antiplagiat"."$err");
		exit;
	} else {
		switch ($package) {
				case '1':
					$cost = 1;
					break;
				case '2':
					$cost = 3;
					break;
				case '3':
					$cost = 150;
					break;
				case '4':
					$cost = 200;
					break;
				case '5':
					$cost = 250;
					break;
				case '6':
					$cost = 300;
					break;
				case '7':
					$cost = 350;
					break;
				case '8':
					$cost = 400;
					break;
				case '9':
					$cost = 450;
					break;
				case '10':
					$cost = 500;
					break;
			}
	}
} elseif ($ref == $ebook || $ref == $ebook.$err) {
	if (!$fio || !$cost || !$phone || !$email || !$personal) {
		header("Location: $ebook"."$err");
		exit;
	}
} elseif ($ref == $events || $ref == $events.$err) {
	if (!$fio || !$payer || !$event || !$dogovor || !$cost || !$phone || !$email || !$personal) {
		header("Location: $events"."$err");
		exit;
	}
} elseif ($ref == $other || $ref == $other.$err) {
	if (!$fio || !$payer || !$description || !$dogovor || !$cost || !$phone || !$email || !$personal) {
		header("Location: $other"."$err");
		exit;
	}
}


/**
 * Подготовка значений для формирования Json.
 * Замена " " на "+".
 */
$description    = trim($description);
$description    = str_replace(' ', '+', $description);
$libnumber      = trim($libnumber);
$libnumber      = str_replace(' ', '+', $libnumber);
$surname        = trim($surname);
$surname        = str_replace(' ', '+', $surname);
$address        = trim($address);
$address        = str_replace(' ', '+', $address);
$dogovor        = trim($dogovor);
$dogovor        = str_replace(' ', '+', $dogovor);
$payer          = trim($payer);
$payer          = str_replace(' ', '+', $payer);
$phone        	= trim($phone);
$phone        	= str_replace(' ', '+', $phone);
$event        	= trim($event);
$event        	= str_replace(' ', '+', $event);
$fio            = trim($fio);
$fio            = str_replace(' ', '+', $fio);

/**
 * Параметры запроса.
 */
$orderNumber 	= time();       // Таймштамп будет номером заказа.
$amount 		= $cost*100;    // Сбер принимает цену в копейках.
$jsonParams 	= '{"ФИО":"'.$fio.'","URL":"'.$url.'","Плательщик":"'.$payer.'","Организация":"'.$org.'","Статус":"'.$status.'","Общежитие":"'.$hostel.'","Адрес":"'.$address.'","Комната":"'.$room.'","Описание":"'.$description.'","Событие":"'.$event.'","Фамилия+читателя":"'.$surname.'","Читательский+билет":"'.$libnumber.'","Количество+проверок":"'.$package.'","Договор":"'.$dogovor.'","Телефон":"'.$phone.'","Почта":"'.$email.'"}';

/**
 * Формирование запроса для отправки на шлюз.
 */
$query = $register_do.
	'?userName='.$api_name.
	'&password='.$api_pass.
	'&description='.$service.
	'&returnUrl='.$returnUrl.
	'&failUrl='.$failUrl.
	'&orderNumber='.$orderNumber.
	'&amount='.$amount.
	'&jsonParams='.$jsonParams;

//Для отладки.
// echo "<pre>";
// print_r($query);
// echo "</pre>";

// Получаем строку ответа на запрос.
$response = file_get_contents($query);

//Для отладки.
//echo "<pre>";
//var_dump($response);
//echo "</pre>";

// Декодируем ответ в ассоциативный массив.
$decode = json_decode($response, TRUE);
// Адрес страницы с формой оплаты.
$redirect = $decode['formUrl'];
// Уникальный № заказа в системе. Нужен ли он пользователю? Хз. На всякий случай.
$uid = $decode['orderId'];
// Перенаправление на страницу оплаты.
header("Location: $redirect");
exit;

//Для отладки.
//echo "<pre>";
//print_r();
//echo "</pre>";

// В платежной форме изменить поле цены на целое число.
// На http://hg.pay/services/ebook сумма в рублях установлена по умолчанию. Посмотри чтобы сделать везде тип число и значение по умолчанию 100.

/**
 * Структура запроса.
 */
/*
https://3dsec.sberbank.ru/payment/rest/register.do
?userName=sfu-kras-api
&password=sfu-kras
&description=Оплата+обучения+онлайн
&orderNumber=125
&returnUrl=https://vogu35.ru
&failUrl=https://4pda.ru
&amount=100000&jsonParams={"fio":"Мальчиков+Михаил+Александрович","dealId":"И00031487","email":"test@gmail.com","phone":"+79261111111"}
*/