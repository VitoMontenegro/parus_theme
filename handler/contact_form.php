<?php
    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
    $recepient = 'info@parus-peterburg.ru,testdev@kometatek.ru';
    $sender = 'admin@parus-peterburg.ru';
    $sitename = "Parus Peterburg";
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $text = trim($_POST["message"]);
    $url = trim($_POST["url"]);
    $subject = trim($_POST["subject"]);
    $email = trim($_POST["email"]);
	
	if ($text)
		$pagetitle = "Сообщение со страницы [Контакты] с сайта \"$sitename\"";
	elseif ($subject)
		$pagetitle = $subject;
	else
		$pagetitle = "Запрос обратного звонка с сайта \"$sitename\"";
    $message = "Страница: $url <br />Имя: $name <br/>Номер телефона: <b>$phone</b><br/>Email: $email<br/>$text";
   
	if (stristr($pagetitle,"Заявка на тур.") )
		echo $recepient = $recepient.',sales1@tourline.spb.ru';


    $headers= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    /* дополнительные шапки */
    $headers .= "From: parus-peterburg.ru<no-reply@parus-peterburg.ru>\r\n";

    mail($recepient, $pagetitle, $message, 'Content-type: text/html; charset=UTF-8 \r\n From: admin@parus-peterburg.ru\r\n'.'X-Mailer: PHP/' . phpversion());
    wp_mail($recepient, $pagetitle, $message, $headers);


			$chat_id="1731649696";//"300193513";
			$bot_id="5309473099:AAEcvzdzq_tVs7LEK3Zebw5J9q7w9OEaAnU";

			$disable_web_page_preview = null;
			$reply_to_message_id = null;
			$reply_markup = null;
			$data = array(
					'chat_id' => urlencode($chat_id),
					'text' => $pagetitle."\r\nСтраница: $url \r\nИмя: $name \r\nНомер телефона: $phone\r\nEmail: $email\r\n$text",
					'disable_web_page_preview' => urlencode($disable_web_page_preview),
					'reply_to_message_id' => urlencode($reply_to_message_id),
					'reply_markup' => urlencode($reply_markup)
				);

			$url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage';

			//  open connection
			$ch = curl_init();
			//  set the url
			curl_setopt($ch, CURLOPT_URL, $url);
			//  number of POST vars
			curl_setopt($ch, CURLOPT_POST, count($data));
			//  POST data
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			//  To display result of curl
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//  execute post
			$resultes = curl_exec($ch);
			//  close connection
			curl_close($ch);
?>