<?php
/**
 * Доступы для подключения к api Сбербанка.
 */
// Запрос к шлюзу для тестовой среды.
$register_do 	= 'https://3dsec.sberbank.ru/payment/rest/register.do';
// Запрос к шлюзу для боевой среды.
$register_do_b 	= 'https://securepayments.sberbank.ru/payment/rest/register.do';
https://securepayments.sberbank.ru/
// Доступы.
$api_name 		= 'sfu-kras-api';
$api_pass 		= 'sfu-kras';
// Страницы редиректа.
$returnUrl 		= 'https://pay.sfu-kras.ru/success';
$failUrl 		= 'https://pay.sfu-kras.ru/error';