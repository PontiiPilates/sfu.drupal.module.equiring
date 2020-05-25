<?php
header('Content-Type: text/html; charset=utf-8');

echo "<pre>";
print_r($_GET);
echo "</pre>";



/**
 * Переменные.
 */
// Значения формы.
$service 		= $_GET['service'];
$fio 			= $_GET['fio'];
$payer 			= $_GET['payer'];
$org 			= $_GET['org'];
$status 		= $_GET['status'];
$dogovor 		= $_GET['dogovor'];
$cost 			= $_GET['cost'];
$phone 			= $_GET['phone'];
$email 			= $_GET['email'];
$personal 		= $_GET['personal'];

// Подготовка переменных
echo "<pre>";
print_r($fio);
echo "</pre>";
echo "<pre>";
print_r($payer);
echo "</pre>";

// Обрезаем лишние пробелы в случае их наличия.
$fio = trim($fio);
$fio = str_replace(' ', '+', $fio);
$payer = trim($payer);
$payer = str_replace(' ', '+', $payer);

echo "<pre>";
print_r($fio);
echo "</pre>";
echo "<pre>";
print_r($payer);
echo "</pre>";

// Параметры запроса.
$register_do 	= 'https://3dsec.sberbank.ru/payment/rest/register.do';
$userName 		= 'sfu-kras-api';
$password 		= 'sfu-kras';
$returnUrl 		= 'http://hg.pay/node/6';
$failUrl 		= 'http://hg.pay/node/7';
$orderNumber 	= time();
$amount 		= $cost;
$jsonParams 	= '{"fio":"'.$fio.'","payer":"'.$payer.'","org":"'.$org.'","phone":"'.$phone.'","email":"'.$email.'"}';

$query = $register_do.
	'?userName='.$userName.
	'&password='.$password.
	'&description='.$service.
	'&returnUrl='.$returnUrl.
	'&failUrl='.$failUrl.
	'&orderNumber='.$orderNumber.
	'&amount='.$amount.
	'&jsonParams='.$jsonParams;


//$response = file_get_contents($query);





/*
https://3dsec.sberbank.ru/payment/rest/register.do?
userName=sfu-kras-api&
password=sfu-kras&
description=Оплата+обучения+онлайн&
returnUrl=https://vogu35.ru&
failUrl=https://4pda.ru&
orderNumber=11&
amount=100&
jsonParams={"fio":"Мальчиков+Михаил+Александрович","dealId":"И00031487","email":"test@gmail.com","phone":"+79261111111"}
*/
/*
https://3dsec.sberbank.ru/payment/rest/register.do?
userName=sfu-kras-api&
password=sfu-kras&
description=edu&
returnUrl=http://drupal631/node/2&
failUrl=http://drupal631/node/3&
orderNumber=1589943329&
amount=654321&
jsonParams={"fio":"Альберт","payer":"Ахмед","org":"ИЭУиП","phone":"+7923","email":"zloileshii@gmail.com"}
*/

// 1. Создать страницу информации с требованиями сбербанка.
// 2. Разместить ссылки на страницу:
//	2.1. В меню.
//	2.2. Под кнопкой оплаты.
//	2.3. На страницах со статусом платежа.