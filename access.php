<?php
/**
 * Доступы для подключения к api Сбербанка.
 */
// Запрос к шлюзу.
$register_do 	= 'https://3dsec.sberbank.ru/payment/rest/register.do';
// Доступы.
$api_name 		= 'sfu-kras-api';
$api_pass 		= 'sfu-kras';
// Страницы редиректа.
$returnUrl 		= 'http://hg.pay/node/6';
$failUrl 		= 'http://hg.pay/node/7';