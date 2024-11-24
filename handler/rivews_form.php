<?php
    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); 
    $recepient = 'info@parus-peterburg.ru,testdev@kometatek.ru';
    $recepient_2 = 'world.julia1@gmail.com';
    $sender = 'info@parus-peterburg.ru';
    $sitename = "Parus Peterburg";
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $text = trim($_POST["message"]);

    // unset($_POST["excurs_arr"][array_search('otherexcurs',$_POST["excurs_arr"])]);
    // unset($_POST["gid_arr"][array_search('othergid',$_POST["gid_arr"])]);
    
    $excurs_arr = isset($_POST["excurs_arr"]) ? $_POST["excurs_arr"] : '';
    $gid_arr = isset($_POST["gid_arr"]) ? implode(",", $_POST["gid_arr"]) : '';



    $gid = isset($_POST["gid"]) ? wp_strip_all_tags($_POST["gid"]) : '';
    $excurs = isset($_POST["excurs"]) ? wp_strip_all_tags($_POST["excurs"]) : '';
    $rating = isset($_POST["rating"]) ? (int)$_POST["rating"] : '';

    if ($gid && $gid != 'othergid') {
        $gid_arr.= ',' .$gid;
    }

    
    $gid_arr = trim($gid_arr, ",");

    /*if ($excurs) {
        $excurs_arr.= ',' .$excurs;
    }
    $excurs_arr = trim($excurs_arr, ",");*/
	
	$names = [];
	if($excurs_arr)
		foreach($excurs_arr as $item)
			$names[] = get_field('h1', $item)?get_field('h1', $item):get_the_title($item);


    $message = "Дата: " . $name . "<br/><br/>\r\n";
    $message = "Имя: " .  $name . "<br/><br/>\r\n";
    $message .= "Гид: " .  $gid_arr . "<br/><br/>";
    $message .= "Экскурсия: " .  implode(', ',$names) . "<br/><br/>";
    $message .= "Рейтинг: " .  $rating . "<br/><br/>";
    $message .= "Телефон или Email: " .  $email . "<br/><br/>";
    $message .= "Cообщение: " .  $text . "<br/><br/>";
    $pagetitle = "Новый отзыв с сайта \"$sitename\"";

	$post_data = array(
		'post_title'    => wp_strip_all_tags($name),
		'post_content'  => wp_strip_all_tags($text),
		'post_status'   => 'pending',
		'post_author'   => 1,
		'post_type' => 'reviews',			
	);
	$post_id = wp_insert_post( $post_data );


if ($_FILES['file']){
    $files = array_map('RemapFilesArray',
    $_FILES['file']['name'],
    $_FILES['file']['type'],
    $_FILES['file']['tmp_name'],
    $_FILES['file']['error'],
    $_FILES['file']['size']
);

$gallery=array();

foreach ($files as $file){ //loop through each file
    $att = my_update_attachment($file,$post_id);
    array_push($gallery,$att['attach_id']);
}
    update_field('field_5fad894783054',$gallery,$post_id);
    update_field('field_644b06e279cc3',$excurs_arr,$post_id);
    update_field('field_5fad896583056',$gid_arr,$post_id);
    update_field('field_5fad897183057',$rating,$post_id);
    update_field('field_612cc6d2ad914',$email,$post_id);

}

$message .= "Дата:  " . date('d/m/Y') . "<br/><br/>";
$message .= "Ссылка на отзыв : https://parus-peterburg.ru/wp-admin/post.php?post=" . $post_id . "&action=edit<br/><br/>";

// var_dump($message);
// die();

    wp_mail($recepient, $pagetitle, $message, "Content-type: text/html; charset=\"utf-8\"\r\n From: info@parus-peterburg.ru\r\n".'X-Mailer: PHP/' . phpversion());
    wp_mail($recepient_2, $pagetitle, $message, "Content-type: text/html; charset=\"utf-8\"\r\n From: info@parus-peterburg.ru\r\n".'X-Mailer: PHP/' . phpversion());

    //mail('info@parus-peterburg.ru', 'Новый отзыв с сайта parus-peterburg.ru', $message, "Content-type: text/html; charset=\"utf-8\"\r\n From: admin@parus-peterburg.ru\r\n".'X-Mailer: PHP/' . phpversion());
    //mail('world.julia1@gmail.com', 'Новый отзыв с сайта parus-peterburg.ru', $message, "Content-type: text/html; charset=\"utf-8\"\r\n From: admin@parus-peterburg.ru\r\n".'X-Mailer: PHP/' . phpversion());
