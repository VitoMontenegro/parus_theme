<?php
error_reporting(-1);
       $disable_web_page_preview = null;
        $reply_to_message_id = null;
        $reply_markup = null;
        $chat_id="1731649696";
        $bot_id="5309473099:AAEcvzdzq_tVs7LEK3Zebw5J9q7w9OEaAnU";

        $data = array(
                'chat_id' => urlencode($chat_id),
                'text' => $text,
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
	} else {		
		$result['text'] = '<p class="red">Внимание! При отправке сообщения возникла ошибка. Свяжитесь с нами другим удобным для вас способом.';
	}

?>