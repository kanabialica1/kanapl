<?php
/**
 *
 * PapaDropApi v1.0
 *
 * Description:
 * В архиве имеются файлы send-form.php, thank-you-page.php, error.php и папка со стилями /css
 * Мы предоставляем эти файлы по умолчанию чтобы упростить вывод страницы благодарности и ошибок, для вас.
 * Вам не обязательно их использовать, вы можете подключить свои страницы или редактировать наши по своему усмотрению,
 * если у вас есть опыт в программировании.
 * Так же до раздела "Необходимые поля" вы можете использовать любой ваш код, например отправка уведомлений на ваш email.
 *
 * Данный файл уже подготовлен к работе, все что вам необходимо:
 * - Изменить в форме action на send-form.php или скопировать этот код в ваш файл обработчик;
 * - Создать поток выбрав вариант "Свой сайт", указать URI вашего сайта и цены на товар указаные на вашем лендинге;
 * - Сформированный Flow_id подставить в переменную $flow_id;
 *
 * Если вам необходима помощь, вы можете обратиться к @papadropsupport в телеграмм.
 *
 * P.S. Не рекомендуем трогать код в разделе "Обработка заявки"!
 */

//----------------------------------------------- Необходимые поля ---------------------------------------------------//

//Вставьте свой код потока.
// (!)Пример: $flow_id = '601bc2f4c57f517cfe6fedf2';
$flow_id = '601da64dc57f517875167cd3';

//Убедитесь что поля имени и номера телефона вашей формы имеют атребуты name="name" и name="phone"
// (!)Если ваша форма имеет атребут name="telephone" измените переменную на $_POST['telephone'];
$name = $_POST['name'];
$phone = $_POST['phone'];

//----------------------------------------------- Обработка заявки ----------------------------------------------------//

//Проверка номера телефона. Если номер пустой - возвращаем ошибку.
if (!$phone) {
    $message = 'Не указан номер телефона! Пожалуйста заполните форму повторно.';
    header("Location: error.php?message=$message");
    exit;
}

//форматирование номера телефона в вид +38########## (13 символов)
$phone = PhoneFormat($phone);

//Если количество символов меньше 13 - возвращаем ошибку о не верном формате номера
if (strlen($phone) < 13) {
    $message = 'Не верный формат номера телефона! Пожалуйста заполните форму повторно.';
    header("Location: error.php?message=$message");
    exit;
}

//Функция ниже передает данные на обработку в наш КЦ и автоматически закрепляет эту заявку за вашим аккаунтом
$data = [
    'flow_id' => $flow_id,
    'name'    => $name,
    'phone'   => $phone,
    'type'    => 'custom',
    'utm_source'   => $_POST['utm_source'],
    'utm_content'  => $_POST['utm_content'],
    'utm_medium'   => $_POST['utm_medium'],
    'utm_campaign' => $_POST['utm_campaign'],
    'utm_term'     => $_POST['utm_term'],
    'utm_sub1'     => $_POST['utm_sub1'],
    'utm_sub2'     => $_POST['utm_sub2'],
    'utm_sub3'     => $_POST['utm_sub3'],
    'utm_sub4'     => $_POST['utm_sub4'],
    'utm_sub5'     => $_POST['utm_sub5'],
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'papadrop.com.ua/api/call_center/store_app');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//Получаем ответ
$response = json_decode(curl_exec($ch));

curl_close($ch);

//Если ответ положительный возвращаем Thank You Page, иначе выводим ошибку полученую от сервера.
if ($response->success) {
    header("Location: thank-you-page.php?name=$name&phone=$phone");
} else {
    $message = $response->errors[0];
    header("Location: error.php?message=$message");
    exit;
}

//------------------------------------------------ Доп Функции -------------------------------------------------------//

function PhoneFormat($phone, $mask = '#', $codeSplitter = '0') {

    $phone = preg_replace('/[^0-9]/', '', $phone);

    $phone = substr($phone, strpos($phone, $codeSplitter));

    $format = [
        '12' => '+############', // for +38 0XX XX XXX XX or 38 0XX XX XXX XX
        '10' => '+38##########' // for 0XX XX XXX XX
    ];

    if (is_array($format)) {
        if (array_key_exists(strlen($phone), $format)) {
            $format = $format[strlen($phone)];
        } else {
            return $phone;
        }
    }

    $pattern = '/' . str_repeat('([0-9])?', substr_count($format, $mask)) . '(.*)/';

    $format = preg_replace_callback(
        str_replace('#', $mask, '/([#])/'),
        function () use (&$counter) {
            return '${' . (++$counter) . '}';
        },
        $format
    );

    return ($phone) ? trim(preg_replace($pattern, $format, $phone, 1)) : false;
}
