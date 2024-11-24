<?php
header('Content-Type: text/html; charset=utf-8', true);


if (!isset($_POST['mail']) || empty($_POST['mail']) || !isset($_POST['wheelselect'])) {
    die('empty responce');
} 

$file_links = 'visits.txt';
$theme = 'Заявка с колеса фортуны';
$wheelselect   = $_POST['wheelselect'];
$phone   = preg_replace('/[^0-9]/', '', $_POST['mail']);

if (!file_exists($file_links)) {
    $arr[1]=1;
    file_put_contents($file_links, serialize($arr));
}

$arr = unserialize(file_get_contents($file_links));

if (!isset($arr[$phone])) {
    $arr[$phone] = time();
    file_put_contents($file_links, serialize($arr));
} else {
    if (($arr[$phone] + 2629743) < time() ) {
        $arr[$phone] = time();
        file_put_contents($file_links, serialize($arr));
    } else {
        echo $arr[$phone]  + 2629743;
        exit;        
    }    
}

$subject = "=?utf-8?B?" . base64_encode("[parus-peterburg.ru] $theme") . "?=";
$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: parus-peterburg.ru\r\n";
$to =  'info@parus-peterburg.ru';
$to2 =  'testdev@kometatek.ru';

$message =  "Здравствуйте! С сайта parus-peterburg.ru было отправлено сообщение:
                <html>
                <head>
                    <title>$theme</title>
                </head>
                <body>
                    <h2>$theme</h2>
                <br>
                <table style='border:1px solid black;border-collapse:collapse;padding:5px;'>
                    <tr>
                        <td style='border:1px solid black; padding:5px; background:#ccc;'>Телефон</td>
                        <td style='border:1px solid black; padding:5px;'>$phone</td>
                    </tr>";
if ($wheelselect) {
    $message .= "<tr>
                        <td style='border:1px solid black; padding:5px; background:#ccc;'>Выбранный подарок</td>
                        <td style='border:1px solid black; padding:5px;'>$wheelselect</td>
                    </tr> ";  
}
$message .= "</table>
        </body>
        </html>";


if (mail($to2, $subject, $message, "Content-type: text/html; charset=\"utf-8\"\r\n From: admin@parus-peterburg.ru\r\n".'X-Mailer: PHP/' . phpversion())) {
    mail($to, $subject, $message, "Content-type: text/html; charset=\"utf-8\"\r\n From: admin@parus-peterburg.ru\r\n".'X-Mailer: PHP/' . phpversion());
    echo "Ваша заявка принята! Наш менеджер с вами свяжется."; 
} else {
    echo 'Отправка не удалась, попробуйте позже';
}



