<?php

session_start();

header('Content-Type: application/json');

$cv = [];
parse_str(isset($_POST['data']) ? $_POST['data'] : [], $cv);
$_POST['data'] = $cv;
$data=$cv;

//проверяем ввод промо
//$promo_main = 'parus';
$promo_main = 'парус';
$promo_valid = false;
$promo = isset($_POST['promo']) ? $_POST['promo'] : '';
$promo = str_replace(array('"', "'", ' ', " "), null, $promo);
$promo = mb_strtolower($promo);

$promo_value='';
$promo_value = isset($data['promo_value']) ? $data['promo_value'] : '';
$promo_value = str_replace(array('"', "'", ' ', " "), null, $promo_value);
$promo_value = mb_strtolower($promo_value);

$promo_valid = (($promo_value!='')?($promo == $promo_value):($promo == $promo_main));

$promo_luxrent = ['люкс рент', 'lux rent', 'luxrent', 'люксрент'];
$promo_tourline = ['турлайн', 'tourline', 'tour line', 'тур лайн'];


$_promocode_crm = array();
$_t = file_get_contents('https://bazaparus.aristoff.ru/api/promokods');
if ($_t!='') {
	$_t = (unserialize($_t));
	if (is_array($_t)) { $_t=array($_t[0]);
		foreach($_t as $val){ 
			$start = strtotime($val->start_valid_date);
			$end = strtotime($val->end_valid_date);
			$cur_time = time();
			if(!$val->disable && $cur_time>=$start && $cur_time<=$end)
				$_promocode_crm[$val->name] = $val->value;   
		}
	}
}
	$index_array=array('sold_adults', 'sold_childs','sold_old','sold_school','sold_students','sold_adults_for','sold_students_for','sold_childs_for');
	$count = 0;/*$_POST['data']['sold_adults']
			+ $_POST['data']['sold_childs']
			+ $_POST['data']['sold_old']
			+ $_POST['data']['sold_school']
			+ $_POST['data']['sold_students'];
			+ $_POST['data']['sold_adults_for'];
			+ $_POST['data']['sold_students_for'];
			+ $_POST['data']['sold_childs_for'];*///не считает
	//считаем билеты пока простая скидка с каждого билета
	foreach($index_array as $index){
	  if (isset($data[$index])) $count +=$data[$index];
	}
	
if ($promo_valid || $promo == 'аврора'  || $promo == 'парус' /*|| $promo == 'parus'*/ || $promo == 'parus150' || $promo == 'вафли'){// = ($promo == $promo_main)){//промо введено верно
$promo_valid = true;

	if (isset($data['discount'])) {
		$discount=(int) $data['discount']; 
	} else { 
		$discount=100;$minus=0;
	}
	
	if ($promo == 'аврора'  || $promo == 'parus150') $discount=150;
	
	 $minus = $count * $discount;

	//$minus = ($promo_valid===true) ? $count * $discont: 0;

	//name=&mail=&phone=&trip=39975&price_adults=1000&price_childs=500&price_old=900&price_students=900
	//&price_school=800&price_adults_for=1300&price_students_for=1300&price_childs_for=1300&sold_childs=0&sold_school=0
	//&sold_students=0&sold_adults=0&sold_old=0&sold_adults_for=0&sold_students_for=0&sold_childs_for=3&promo=wow&dicount=150&amount=3900

	echo json_encode([
		'ok' => $promo_valid,
		'minus' => $minus,
		'discount' => (int) $discount,
		'count'=>$count
	]);
} elseif(in_array($promo,$promo_luxrent) || in_array($promo,$promo_tourline)){
	$promo_valid = true;
	$minus = round($data['true_price']*0.1);
	
	echo json_encode([
		'ok' => $promo_valid,
		'minus' => $minus,
		'discount' => (int) $discount,
		'count'=>$count
	]);
} elseif(isset($_promocode_crm[$promo])){
	$promo_valid = true;
	$promovalue=0;
	if (intval($_promocode_crm[$promo])>0){
		$promovalue=intval($_promocode_crm[$promo]);
	}
	if (stristr($_promocode_crm[$promo],"%",) && $promovalue>0){//есть процент
		
		$discount=round($data['true_price']*$promovalue*0.01);
		$minus = $discount;
	}else{
		
		$minus = $count*$promovalue;
	}
	
	
	
	echo json_encode([
		'ok' => $promo_valid,
		'minus' => $minus,
		'discount' => (int) $discount,
		'count'=>$count
	]);
} elseif($promo == 'парус78'){
	$promo_valid = true;
	$minus = round($data['true_price']*0.2);
	
	echo json_encode([
		'ok' => $promo_valid,
		'minus' => $minus,
		'discount' => (int) $discount,
		'count'=>$count
	]);
} elseif($promo == 'каникулы'){
	if($data['sold_school']!=0){
		echo json_encode([
			'ok' => true,
			'minus' => (int) $data['sold_school']*200,
			'discount' => (int) $data['sold_school']*200,
			'count'=>$count
		]);
	} else {
		echo json_encode([
			'ok' => false,
			'minus' => 0,
			'discount' => 0,
			'count'=>0,
			'msg' => 'Промокод действует только для школьников'
		]);
	}
}
else {//промо введено не верно
	echo json_encode([
		'ok' => $promo_valid,
		'minus' => 0,
		'discount' => 0,
		'count'=>0
	]);

}
?>
