<?php
/**
 * Страница с кастомным шаблоном (page-custom.php)
 * @package WordPress
 * Template Name: Тест главная
 */
get_header('test'); // подключаем header.php ?>

<?php
    $theme_url = get_stylesheet_directory_uri();
	$terms_tax = get_terms('excursion');
	// echo "<div style='display: none;'><pre>";
	// var_dump($terms_tax);
	// echo "</pre></div>";

	foreach($terms_tax as $k=>$item){
		$args = array(
			'post_type' => 'tours',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'excursion',					
					'field' => 'term_id',
					'terms' => $item->term_id
				)
			)
		);
		$query = new WP_Query( $args );
		
		foreach($query->posts as $post){
			if(!get_post_meta($post->ID, 'tickets', 1)){
				$terms_tax[$k]->count += -1;
			}
		}
		
		if($item->slug == 'grup-ekskursii' ){
			$term_all = $item;
			//var_dump($query->posts);
		}
	}
?>

<section class="content content--bus">
  <div class="container">
  <h1 class="mainh">Экскурсии в Санкт-Петербурге</h1>
        <div class="slider-content banner-content">
        	<?php /*
			<a href="/skidki" class="banner banner__friday">
				<div class="friday__title-bg">
					<div class="friday__title">
						<div class="friday__title-1">Черная</div>
						<div class="friday__title-2">пятница</div>
					</div>
				</div>
				<div class="friday__content">
					<div class="friday__text-1">Скидки до <span class="friday__percent">50%</span> на экскурсии</div>
					<div class="friday__text-2">Супер цены только с 23 по 30 ноября</div>
				</div>
			</a>
            <a href="/skidki" class="banner">
            	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $theme_url; ?>/img/banner-990.jpg" class="for-pc lazy for-have" alt="Скидки" style="object-position: left">
            	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $theme_url; ?>/img/banner-768.jpg" class="for-tablet lazy for-have" alt="Скидки" style="object-position: left">
            	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $theme_url; ?>/img/banner-480.jpg" class="for-mobile lazy for-have" alt="Скидки" style="object-position: left">
            </a>
			*/ ?>
			<?php /*
            <a href="/kronshtadt" class="banner no-img">
            	<img src="<?php echo $theme_url; ?>/img/23feb.jpg" class="for-pc" alt="Скидки">
            	<img src="<?php echo $theme_url; ?>/img/23feb-mob.jpg" class="for-mobile for-tablet" alt="Скидки">
            </a>
            
             
			<div class="banner banner__march8">
			    <div class="banner__march8_wrap">
				<div class="march8__title"><span>скидка 50% </span><span></span> для женщин</div>
				<div class="march8__content">на Обзрную экскурсию с Петропавловской крепостью</div>	
				<div class="march8__conditions"><span>Только 5,6,7 и 8 марта</span> билет за 450 рублей</div>
			    </div>
			</div>
            <div class="slider-nav">
                <div class="slider-nav-item active"></div>
                <div class="slider-nav-item"></div>
            </div>*/ ?>
            <a href="/skidki" class="banner">
                <span class="banner__title">Скидки</span>
                <span class="banner__percent">до 50%</span>
                <div class="banner__conditions"><span>При покупке</span> билетов на сайте</div>
                <?php /*
                <span class="banner__details">Подробнее</span>
                */ ?>
            </a>
            
            
            <?php /*<div class="slider-nav">
                <div class="slider-nav-item active"></div>
                <div class="slider-nav-item"></div>
            </div>
            
            <a href="/skidki" class="banner">
            	<img src="<?php echo $theme_url; ?>/img/banner-2.jpg" class="for-pc" alt="Скидки">
            	<img src="<?php echo $theme_url; ?>/img/banner-2-mob.jpg" class="for-mobile" alt="Скидки">
            </a>
            

            <div class="slider-nav">
                <div class="slider-nav-item active"></div>
                <div class="slider-nav-item"></div>
            </div>
            */ ?>
        </div>

        <?php /*
        <div class="features" id="features">
			<div class="f-item">
		        <div class="f-icon">
		            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/24-hours.svg" alt="24 часа с вами на связи">
		        </div>
		        <div class="f-header">24 часа с вами<br>на связи</div>
		    </div>
		    <div class="f-item">
		        <div class="f-icon">
		            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tickets.svg" alt="Удобные электронные билеты">
		        </div>
		        <div class="f-header">Удобные электронные билеты</div>
		    </div>
		    <div class="f-item">
		        <div class="f-icon">
		            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/bus.svg" alt="Собственный транспорт">
		        </div>
		        <div class="f-header">Собственный современный транспорт</div>
		    </div>
		    <div class="f-item">
		        <div class="f-icon">
		            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tourist-office.svg" alt="Вход без очереди в музеи">
		        </div>
		        <div class="f-header">Вход без очереди<br>в музеи</div>
		    </div>
		</div>
        */ ?>

	

	

	<div class="content__filters">
	  <div class="content__filter active" data-slug="grup-ekskursii">
		Все экскурсии
		<span><?=$term_all->count?></span>
	  </div>
	  <?php foreach($terms_tax as $item): ?>
		<?php if($item->slug != 'grup-ekskursii'&&$item->slug != 'indiv-ekskursii'): ?>
			<a href="/<?=$item->slug?>/" class="content__filter" data-slug="<?=$item->slug?>">
				<?php echo str_replace('экскурсии', '', $item->name);?>
				<span><?=$item->count?></span>
			</a>
		<?php endif; ?>
	  <?php endforeach; ?>
	</div>
	<?php
		$all_posts = get_posts( array(
			'numberposts' => -1,
			'post_type' => 'tours',
			'suppress_filters' => true,
			'meta_query' => array(
				'product_rank' => array(
					'key' => 'sort',
					'type' => 'NUMERIC'
				),
			),
			'orderby' => 'product_rank',
			'order' => 'ASC',
			'tax_query' => array(                                  // элемент (термин) таксономии 
				array(
					'taxonomy' => 'excursion',         // таксономия 
					'field' => 'slug',
					'terms'    => 'grup-ekskursii' // термин 
				)
			),
		) );
		
	?>

	<div class="content__text--block">
	<p>
	Организовываем автобусные экскурсии в Санкт-Петербурге и пригородах. 
	У нас можно купить разнообразные программы: обзорные, авторские и 
	тематические в рамках индивидуальных или групповых туров. Предоставляем
	новые комфортабельные автобусы. Имеем прямые договоры с государственными
    музеями и заповедниками.

	</p>
	</div>
		<div class="content__tours" id="tours">
			<?php $num = 0; ?>
			<?php foreach($all_posts as $item): ?>
				<?php
					$periodicity = (get_field('periodicity', $item->ID))?get_field('periodicity', $item->ID):'по запросу';
					$start_time = (get_field('start_time', $item->ID))?get_field('start_time', $item->ID):'по запросу';
					$duration = (get_field('duration', $item->ID))?correctTime(get_field('duration', $item->ID)):'по запросу';
					$prevDesc = (get_field('previuDesk', $item->ID))?wp_trim_words(get_field('previuDesk', $item->ID),20):wp_trim_words($item->post_content, 20);
					$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'large');
					$thumbnail_url = (isset($thumbnail_attributes[0]))?$thumbnail_attributes[0]:$theme_url.'/assets/images/340719-200.png';
					$url = (stripos(get_permalink($item->ID, true ),'%tours%')>-1)?get_permalink($item->ID, false ):get_permalink($item->ID, true );
					$terms_arr = [];
					foreach (get_the_terms($item->ID, 'excursion') as $te){
						$terms_arr[] = $te->slug;
					}
					$terms = implode(" ", $terms_arr);
					$tickets_arr = json_decode(get_post_meta($item->ID, 'tickets', 1));
					foreach ($tickets_arr as $key => $value) {
						if ($value->tickets > 0) {
							$tickets_date = explode('.', $value->date);
							$date = $tickets_date[2] . '-' . $tickets_date[1] . '-'. $tickets_date[0];
							break;
						}
					}
					$_monthsList = array(".01." => "января", ".02." => "февраля", 
					".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
					".07." => "июля", ".08." => "августа", ".09." => "сентября",
					".10." => "октября", ".11." => "ноября", ".12." => "декабря");
					$currentDate = date("d.m.", strtotime($date));
					$_mD = date(".m.", strtotime($date));
					$currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);
					$sticker_background = get_field('sticker_background', $item->ID) ? get_field('sticker_background', $item->ID) : '';
					$sticker_text = get_field('sticker_text', $item->ID) ? get_field('sticker_text', $item->ID) : '';
				?>		
				<?php if(get_post_meta($item->ID, 'tickets', 1)): ?>					
					<?php if ($num == 5): ?>
						<?php get_template_part('promo'); ?>
					<?php endif ?>
					<div class="content__tour tour <?=$terms?>" data-crm-id="<?=get_field('id_crm', $item->ID)?>">
						<a href="<?=$url?>" class="tour__header">
						  <img
							src="<?=$theme_url?>/assets/images/Spinner-1s-200px.svg"
							data-src="<?=$thumbnail_url?>"
							alt="tour-image"
							class="tour__image lazy"
						  />
						  	<?php if(get_field('sticker', $item->ID)): ?>
							  	<?php if (get_field('sticker', $item->ID) == 'Для детей'): ?>
									<?php $backgound =  get_field('sticker_background', $item->ID) ? get_field('sticker_background', $item->ID) : "#904aca"; ?>
									<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
								  	<span class="stick" style="background: <?php echo $backgound;?>">
								  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
								  		<span class="text" style="color: <?php echo $color;?>"><?php echo get_field('sticker', $item->ID); ?></span>				  		
								  	</span>
							  	<?php elseif(get_field('sticker', $item->ID) == 'Эксклюзив'): ?>	
									<?php $backgound =  get_field('sticker_background', $item->ID) ? get_field('sticker_background', $item->ID) : "#d62c32"; ?>
									<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
								  	<span class="stick" style="background: <?php echo $backgound;?>">
								  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
								  		<span class="text" style="color: <?php echo $color;?>"><?php echo get_field('sticker', $item->ID); ?></span>				  		
								  	</span>
							  	<?php else: ?>	
									<?php $backgound =  get_field('sticker_background', $item->ID) ? get_field('sticker_background', $item->ID) : "#9e14d5"; ?>
									<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
							  		<span class="stick" style="background: <?php echo $backgound;?>">
							  			<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  			<span class="text" style="color: <?php echo $color;?>"><?php echo get_field('sticker', $item->ID); ?></span>						  				
						  			</span>
							  	<?php endif ?>	
						 	<?php elseif (get_field('p_doshkolniki_sale', $item->ID) || get_field('p_shkolniki_sale', $item->ID) || get_field('p_studenty_sale', $item->ID) || get_field('p_vzroslie_sale', $item->ID) || get_field('p_pensionery_sale', $item->ID) || get_field('p_vzroslie_inostrancy_sale', $item->ID) || get_field('p_studenty_inostrancy_sale', $item->ID) || get_field('p_deti_inostrancy_sale', $item->ID)): ?>

						 		<?php if (get_field('includ_sales', 'options')): ?>
						 			<?php 
									$backgrounds = get_field('sticker_background', 'options') ? get_field('sticker_background', 'options') : '#904aca';
									$sticker_txt = get_field('sticker_text', 'options') ? get_field('sticker_text', 'options') : '#fff';
									if (get_field('p_doshkolniki_sale', $item->ID)) {
										$priceold = get_field('p_doshkolniki', $item->ID);
										$pricenew = get_field('p_doshkolniki_sale', $item->ID);


									} elseif (get_field('p_shkolniki_sale', $item->ID)){
										$priceold = get_field('p_doshkolniki', $item->ID);
										$pricenew = get_field('p_shkolniki_sale', $item->ID);

									}  
									$newprice = 100-($pricenew*100/$priceold);

						 			 ?>
								  	<span class="stick" style="background: <?php echo $sticker_backgrounds; ?> <?php if (get_field('sticker', $item->ID)) {echo ';top: 60px;';}?>" >
								  		<span class="quatr" style="background: <?php echo $sticker_backgrounds; ?>"></span>
								  		<span class="text" style="font-weight: 500;color: <?php echo $sticker_txt; ?>">Скидка -<?php echo round($newprice);?>% c 23 по 30 ноября</span>						  		
								  	</span>	
						 		<?php else: ?>
									<?php $backgound = $sticker_background ? $sticker_background : "#45c451"; ?>
									<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
								  	<span class="stick" style="background: <?php echo $backgound;?> <?php if (get_field('sticker', $item->ID)) {echo ';top: 60px;';}?>">
								  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
								  		<span class="text" style="color: <?php echo $color;?>">Скидка на билеты</span>						  		
								  	</span>	
						 		<?php endif ?>

						 	<?php endif ?>

						  <!--h3><?=$item->post_title?></h3-->
						</a>				
						<a href="<?=$url?>" class="tour__content">
							<h4 class="tour__title"><?=$item->post_title?></h4>
						  <noindex><p><?=$prevDesc?></p></noindex>
							<!-- <?=wp_trim_words($item->post_content, 15)?> -->
						  <div class="tour__info">
							<span class="tour__days"><?=$periodicity?></span>
							<span class="tour__time"><?=$start_time?></span>
							<span class="tour__duration"><?=$duration?></span>
						  </div>

						  <div class="tour__tickets-left">
							Билетов на <?php echo $currentDate; ?>:
							<span id="count_tickets">30</span>
						  </div>
						  <div class="tour__cost">
							Стоимость:
							<span>от <span id="min_cost">

							<?php 
							if (get_field('p_doshkolniki_sale', $item->ID)) {
								echo "<span class='old-price-front'>".get_field('p_doshkolniki', $item->ID)."</span>";
								echo get_field('p_doshkolniki_sale', $item->ID) . ' руб/чел';
							} elseif ( get_field('p_doshkolniki', $item->ID) ) {
							    echo get_field('p_doshkolniki', $item->ID) . ' руб/чел';
							} elseif (get_field('p_shkolniki_sale', $item->ID)){
							    echo get_field('p_shkolniki_sale', $item->ID) . ' руб/чел';
							}  else {
							    echo get_field('p_shkolniki', $item->ID) . ' руб/чел';
							} 
							?>
							</span>
							</span>
						  </div>
						  <a href="<?=$url?>" class="tour__book">Забронировать</a>
						</a>
					</div>
				<?php $num++; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>

	<div class="content__text--block">
	 <p>
	 У нас работают аккредитованные экскурсоводы с опытом работы более 15 лет, 
	 историческим или культурологическим образованием, которые провели множество
	 экскурсий, любят и знают город.
    <p>Проводим туры по СПб на русском и иностранных языках: на автобусе, 
     водные на теплоходе или пешеходные. С нами можно посмотреть дневной
     и <a href="/ночной-петербург">ночной Питер</a>. Начало у Московского вокзала. Приглашаем на
     прогулку по городу белых ночей и разводных мостов!
    </p>
	 <p>Цены порадуют вас своей доступностью. Мы работаем со многими музеями,
	 которые проводят для нас регулярные ознакомительные поездки. 
	 </p>
	
	 <h2>Какую экскурсию выбрать?</h2>
    <p>Наша компания готова предложить своим клиентам более 200 программ автобусных экскурсий по Санкт-Петербургу и пригородам.</p>
    <ul>
	   <li> Туристам, которые в нашем городе впервые или приехали проездом на один день, рекомендуем 
	   начать <a href="/%D0%BE%D0%B1%D0%B7%D0%BE%D1%80%D0%BD%D0%B0%D1%8F-2">с обзорной экскурсии</a>. 
	   За пару часов мы объедем все основные достопримечательности Северной Венеции. </li>
	    <li>
		Всех, кто приехал в Питер на более долгий срок, приглашаем в путешествия по его пригородам.
	   </li>
	    <li>
		Если вы посетили нас в период белых ночей, не упустите возможность осмотреть ночной город и обязательно прокатиться по Неве на теплоходе под разводными мостами.
	   </li>
	    <li>
		Для жителей СПБ мы проводим увлекательные тематические экскурсии, посвященные религиозной жизни и мистическим тайнам города.
	   </li>
	  </ul>
	</div>

	<?php // get_template_part('/template-parts/excursion-block-menu'); ?>

	<div class="content__text--block">
   <h2>Что посмотреть в СПб?</h2>
    <p>Начать знакомство с Северной столицей рекомендуем с основных достопримечательностей: прогуляйтесь
    по Невскому проспекту, полюбуйтесь знаменитым домом Зингера, в котором располагается главный городской книжный.
    Посетите Дворцовую и Сенатскую площадь, чтоб полюбоваться Зимним дворцом и памятником Медный всадник, которые неслучайно стали символами Питера. </p>
    <p>Стоит также посетить Васильевский остров, прогулятся по его стрелке и набережной с грифонами, 
	 а дальше направиться к Петропавловской крепости. </p>
    <p>Нельзя обойти вниманием и храмы Петербурга: Исаакиевский, Казанский, Смольный соборы,
	   Спас-на-Крови, часовню Ксении Блаженной - каждый из них является неповторимым произведением искусства. </p>
    <p>Если вы располагаете временем, стоит посетить и знаменитые музеи: Эрмитаж, Русский музей, кунсткамеру. </p>
    <p>А может, стоит сойти с “туристических троп” и познакомиться с “непарадным” Санкт-Петербургом: побывать 
	в одном из дворов-колодцев, музее современного искусства и подняться на крышу. </p>
    <h2>Экскурсии в Пригороды</h2>
    <p> Отдельного внимания требуют пригороды города. Их дворцово-парковые комплексы не уступают красотам самого города и привлекают тысячи туристов. </p>
    <p>Удобнее всего добираться до них на экскурсионном автобусе: поездка сопровождается интересными рассказами гида по пути и включает посещение всех достопримечательностей. Часть туров позволяет посетить за один день несколько пригородов. </p>
    <p>Вместе с нами вы можете посетить:</p>
     <ul>
	   <li>
		Петергоф с его потрясающим парком и фонтанами;
	   </li>
	    <li>
		Царское село и Екатерининский дворец;
	   </li>
	    <li>
		Дворец и парк в Павловске;
	   </li>
	    <li>
		<a href="/средневековый-выборг/">Древний Выборг</a>;
	   </li>
	   <li>
		<a href="/kronshtadt">Кронштадт с его защитными фортами</a>;
	   </li>
	    <li>
		Крепость Орешек.
	   </li>
      </ul>
     <p>Если вы хотите увидеть все главные достопримечательности и прикоснуться в истории нашего прекрасного города,
    приглашаем вас на автобусные экскурсии по СПб! </p>
    <p>Заказ по телефонам <a href="tel:+79516853733">+7(951)685-37-33</a>
	</p>
	</div>
	<?php 
		$args = array(
			'posts_per_page' => '99',
			'post_type' => 'reviews'
		);
		$myposts = get_posts( $args );
	?>
	<!--noindex-->
	<div class="content-header content-header-reviews">
		<h2 class="content-header__title">Отзывы наших туристов</h2>
		<a href="/отзывы" class="content-header__link">Смотреть все отзывы</a>
	</div>
	<div class="review_slider">
		
		<div class="review_slider--container">
			<?php foreach($myposts as $item): ?>
				<?php $date = (get_field('date_reviews',$item->ID))?get_field('date_reviews',$item->ID):get_the_date('d.m.Y',$item->ID); ?>
				<?php /*
				<!--<div class="review_slider--item">
					<div class="review_slider--title"><?=$item->post_title?></div>
					<div class="review_slider--date"><?=$date?></div>
					<div class="review_slider--content">
					<?php if(get_field('review_img',$item->ID)['url']): ?>
						<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
					<?php else: ?>
						<div class="review_slider--text">
							<?=wp_trim_words($item->post_content,50,'...')?>
						</div>
					<?php endif; ?>
					</div>
				</div>	 -->
				*/ ?>


		<div class="review_slider--item">
			<div class="review__text">
				<p class="review__author-name"><?php echo $item->post_title; ?></p>
				<?php $date = (get_field('date_reviews',$item->ID))?get_field('date_reviews',$item->ID):get_the_date('j F Y',$item->ID); ?>
				<p class="review__author-date"><?php echo $date; ?></p>
				<?php $rating = get_field('rating',$item->ID) ? 20*get_field('rating',$item->ID) : 0 ?>
				<div class="rating__stars"> 
					<span class="rating__stars-empty" data-ll-status="observed"></span> 
					<span class="rating__stars-fill" style="width: <?php echo $rating; ?>%" data-ll-status="observed"></span>
				</div>
				<div class="text-body">
					<?php if(get_field('review_img',$item->ID)): ?>
						<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img class="lazy" src="" data-src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
					<?php else: ?>
						
						<span><?php echo crop_str($item->post_content, 400, '...') ; ?></span>
					<?php endif; ?>	

				<?php 
					$images = get_field('галерея',$item->ID);
					$size = 'full'; // (thumbnail, medium, large, full или произвольный размер)
				if( $images ): ?>
				    <ul class="galery_rew">
				        <?php foreach( $images as $image ): ?>
				            <li>
				            	<a class="review_slider--img_href"  href="<?php echo $image['url']; ?>">
				            	<img class="lazy" src="" data-src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
				            	</a>
				            </li>
				        <?php endforeach; ?>
				    </ul>
				<?php endif; ?>				
				</div>
			</div>
			<span class="more">Читать далее</span>
			<?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
				<div class="review__author">
				<?php if ($ex = get_field('excursion',$item->ID)): $excursionarr = explode(',', $ex); ?>
					<div class="excursion">
						<div class="excursion-list">Экскурсия</div>
						<ul>
							<?php foreach ($excursionarr as $excursion): ?>
								<?php if ($excursion): ?>
									<li><?php echo $excursion ?></li>								
								<?php endif ?>
							<?php endforeach ?>
						</ul>
					</div>
					<?php endif ?>
					<?php if ($gid = get_field('gid',$item->ID)): $gidarr = explode(',', $gid); ?>
					<div class="gid">
						<div class="gid-accreditation">Экскурсовод</div>
						<ul>
							<?php foreach ($gidarr as $gid): ?>
								<li><?php echo $gid ?></li>
							<?php endforeach ?>
						</ul>
					</div>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>




			<?php endforeach; ?>
		</div>
		<div class="review_slider--all_link">
			<a href="/отзывы">Смотреть все отзывы</a>
		</div>
	</div>
	<!--/noindex-->
  </div>
</section>

<?php get_footer(); // подключаем footer.php ?>