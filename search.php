<?php
/**
 * Шаблон главной страницы
 * @package WordPress
 * @subpackage your-clean-template-3
 */
if ($_GET['date']) {

	$str = $_GET['date'];
	$sub = array(".01." => " января ", ".02." => " февраля ", 
	".03." => " марта ", ".04." => " апреля ", ".05." => " мая ", ".06." => " июня ", 
	".07." => " июля ", ".08." => " августа ", ".09." => " сентября ",
	".10." => " октября ", ".11." => " ноября ", ".12." => " декабря ", "2022" => '', '2023' => '', '2024'=>'', '2025'=>'');
	
	$count_dates = explode('-', $str);
	if (count($count_dates)>1) {
		$h1_plus = ' c ' . strtr($str, $sub);
	} else {
		$h1_plus = ' ' . strtr($str, $sub);
	}
	
} else {
	$h1_plus = '';
}
get_header(); // подключаем header.php ?>

<?php
    $theme_url = get_stylesheet_directory_uri();
	/*$terms_tax = get_terms('excursion');*/
	//$terms_tax = get_field('menu_cats', 'option');
	$_terms_tax = get_field('menu_cats_new_custom', 'option');
	$terms_tax = [];
	foreach($_terms_tax as $item){
		if($item['is_title'] && $item['title']){
			$item['cat']->name = $item['title'];
		}
		$terms_tax[] = $item['cat'];
	}
	if (isset($terms_tax)) {
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
			/*if($item->slug == 'grup-ekskursii' ){
				$term_all = $item;
			}*/
			if($term_id!='33'&&$item->parent=='33' || $term_id!='33'&&$item->term_id=='33')
				unset($terms_tax[$k]);
		}
	}
	$term_all = get_term(3, 'excursion');
?>
<section class="content content--bus">
  <div class="container">
  <h1 class="mainh">Экскурсии в Санкт-Петербурге <?php echo $h1_plus ?></h1>

    <div class="slider-content banner-content">
    		<?php /*
            <span class="banner">
                <img src="<?php echo $theme_url; ?>/img/hiprice.png" class="bigImg" alt="Скидки" style="object-position: left">
                <img src="<?php echo $theme_url; ?>/img/hipricemob.jpg" class="smallImg" alt="Скидки" style="object-position: left">
            </span>
    		
			<span class="banner b_wheel btn-open" style="cursor: pointer;">
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"> <img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_1140-1.jpeg" class="for-1140" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"><img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_960х165-1.png" class="for-990" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"><img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_738х165-1.png" class="for-796" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"> <img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_360х165-2.png" class="for-360" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"> <img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_414х165-1.png" class="for-480" alt="Скидки" style="object-position: left"></a>
            </span>*/ ?>
			
			
            <span class="banner b_wheel btn-open triggers" style="cursor: pointer;">
            	<img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_1140х165.png" class="for-1140" alt="Скидки" style="object-position: left">
            	<img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_990х165.png" class="for-990" alt="Скидки" style="object-position: left">
            	<img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_768х165.png" class="for-796" alt="Скидки" style="object-position: left">
            	<img src="<?php echo $theme_url; ?>/img/parus-petersburg_360x165.png" class="for-360" alt="Скидки" style="object-position: left">
            	<img src="<?php echo $theme_url; ?>/img/parus-petersburg_480x165.png" class="for-480" alt="Скидки" style="object-position: left">
            </span>    
    </div>

	<div class="content__text--block">
		<p>
			Более 15 лет проводим незабываемые экскурсии в Санкт-Петербурге и окрестностях. Для наших туристов мы подобрали лучшие обзорные, авторские, тематические и эксклюзивные программы. Организуем <a href="/avtobusnyye-ekskursii/">автобусные</a> и <a href="/peshekhodnye/">пешие туры по городу</a>. Гиды аккредитованы при Комитете культуры Петербурга. Имеем прямые договоры с государственными музеями и заповедниками. Состоим в общероссийском генеральном реестре турагентств. Покажем парадный и неформальный Санкт-Петербург во время автобусных и пеших экскурсий.

		</p>
	</div>

	<div class="filter__general_wrapper">
		<div class="g-scrolling-carousel">
			<div class="content__filters items">
			  <span class="content__filter active" data-slug="grup-ekskursii">
				Все экскурсии
				<span><?=$term_all->count?></span>
			  </span>
				 <?php $i=0; ?>
				 <?php if (isset($terms_tax)): ?>
					  <?php foreach($terms_tax as $item): ?>
						<?php if($item->slug != 'grup-ekskursii'&&$item->slug != 'indiv-ekskursii' &&  $item->slug != 'zimniye' && $item->slug != 'novogodnie'): ?>
							<a href="/<?=$item->slug?>/" class="content__filter" data-slug="<?=$item->slug?>">
								<?php echo str_replace('экскурсии', '', $item->name);?>
								<span><?=$item->count?></span>
							</a>
							<?php $i++; ?>
						<?php endif; ?>
					  <?php endforeach; ?>				 	
				 <?php endif ?>

			  <a class="content__filter content__filter-more" href="#">Еще</a>
			</div>
		</div>
		<?php if (current_user_can('administrator') || 1==1): ?>
			<div class="filter_button_wrap">
				<div class="tl-tour-search--group filter_calendar input-group">
					<button class="apply-filters-float-btn"></button>
					<div class="input-group-append">
						<img src="<?php echo get_template_directory_uri()?>/img/shape.svg" alt="" style="margin-left: 10px;">
					</div>
					<div class="tl-dropdown" data-type="calendar">
						<div class="tl-dropdown--head">
							<input class="tl-datapicker--input" value="<?php  echo $str ? $str : $date;?>" name="date" type="text" readonly placeholder="Дата">
						</div>
						<div class="tl-dropdown--menu">
							<div class="tl-dropdown--menu-head">
								<button class="tl-toggle--btn active" data-clndr-toggle="day">Дни</button>
								<button class="tl-toggle--btn" data-clndr-toggle="month">Месяцы</button>
							</div>
							<div class="tl-dropdown--menu-inner">
								<div data-clndr="month" class="tl-datapicker-month"
									 data-min-view="months"
									 data-view="months"
									 data-date-format="MM yyyy"
								></div>
								<div data-clndr="day" class="tl-datapicker active " data-range="true" data-multiple-dates-separator=" - "></div>
							</div>
							<div class="tl-dropdown--footer">
								<?php if ($category->taxonomy =="tip-tura"): ?>
									<button class="tl-btn--default" data-dn-canceltour>
										Найти
									</button>
								<?php else: ?>    
									<button class="tl-btn--default" data-dn-cancel>
										Найти
									</button>
								<?php endif ?>
							</div>
						</div>
					</div>
					<img src="<?php echo get_template_directory_uri()?>/img/downs.svg" alt="" style="margin-left: auto;
    margin-right: 10px;
    position: absolute;
    right: 0;
    top: 14px;">
				</div>
				
				<button class="parametrs js-filter-duration_sort">
					<img src="<?php echo get_template_directory_uri()?>/img/clock.svg" alt="Длительность" style="margin-right: 10px;margin-left: 10px;">
					<span>Длительность</span> 
					<img src="<?php echo get_template_directory_uri()?>/img/downs.svg" alt="Длительность" style="margin-left: auto;margin-right: 10px;">
				</button>
			
				<button class="parametrs js-filter-toggle_sort">
					<img src="<?php echo get_template_directory_uri()?>/img/rank.svg" alt="" style="margin-right: 10px;margin-left: 10px;">
					<span>По популярности</span> 
					<img src="<?php echo get_template_directory_uri()?>/img/downs.svg" alt="" style="margin-left: auto;margin-right: 10px;">
				</button>

				<button class="js-filter-toggle"> 
					<img class="big" src="<?php echo get_template_directory_uri()?>/img/set.svg" alt="Фильтр">
					<img class="small" src="<?php echo get_template_directory_uri()?>/img/setwhite.svg" alt="Фильтр">
					<span>Фильтр</span> 
				</button>

				<div class="page-radio-wrap-body js-4">
					<label>
						<div class="input-radio-wrap input-radio-wrap-yes">
							<input type="checkbox" name="have_sale">
							<span>Со скидкой</span>
						</div>
					</label>
				</div>

				<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ) ?>" >
					<input class="d1" type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Что хотите найти?" />
					<input type="hidden" value="tours" name="post_type" />
					<input type="hidden" value="1" name="sentence" />
					<button class="d2">
						<img src="<?php echo get_template_directory_uri()?>/img/search.png" alt="" style="margin: auto;">
					</button>
				</form>

			</div>	
			<div class="js-parametrs">
				<div class="setting js-rank-parametrs">
					<div class="setting__item">
						<div class="setting__item-inner" data-select="select-4">
							<label>
								<div class="setting__item-radio js-4">
									<input type="radio" checked=""  name="sorts" value="pops">
									<span>По популярности</span>
								</div>
							</label>

							<label>
								<div class="setting__item-radio js-4">
									<input type="radio" name="sorts" value="expensive">
									<span>По возрастанию цены</span>
								</div>
							</label>
							<label>
								<div class="setting__item-radio js-4">
									<input type="radio" name="sorts" value="chip">
									<span>По убыванию цены</span>
								</div>
							</label>
						</div>
					</div>
				</div>	
				<div class="setting js-duration-parametrs">
					<div class="setting__item">
						<div class="setting__item-inner" data-select="select-4">
							<label>
								<div class="setting__item-radio js-4">
									<input type="radio"  name="duration" value="all">
									<span>Любая</span>
								</div>
							</label>
							<label>
								<div class="setting__item-radio js-4">
									<input type="radio"  name="duration" value="3">
									<span>до 3-х часов</span>
								</div>
							</label>

							<label>
								<div class="setting__item-radio js-4">
									<input type="radio" name="duration" value="5">
									<span>3-5 часов</span>
								</div>
							</label>
							<label>
								<div class="setting__item-radio js-4">
									<input type="radio" name="duration" value="more5">
									<span>более 5 часов</span>
								</div>
							</label>
						</div>
					</div>
				</div>			
			</div>

			<div class="count_tour_title"></div>
		<?php endif ?>
	</div>

	<div class="content__tours" id="tours">
		
	</div>

	<div class="content__text--block">
	 
    <h2>С нами интересно</h2>
<ul> 
	<li>Наши экскурсоводы знают и любят город. Имеют культурологическое или историческое образование и очень широкую эрудицию. Весело и интересно подают материал.</li>
	<li>Разрабатываем авторские экскурсии. Ищем и проверяем факты. Консультируемся с экспертами и перерабатываем научную литературу.</li>
	<li>Работаем со многими музеями, которые проводят для нас регулярные ознакомительные поездки.</li>
	<li>Учитываем обратную связь. Внимательно изучаем ваши отзывы и дорабатываем туры в соотвествии с пожеланиями туристов.</li>
 </ul>
<h2>Экскурсии для гостей и жителей города</h2>
	<p>Наша компания готова предложить своим клиентам более 200 программ экскурсий по Санкт-Петербургу и пригородам.</p>
<ul> 
	<li>Туристам, которые в нашем городе впервые или приехали проездом на один день, рекомендуем начать <a href="https://parus-peterburg.ru/obzornyye/">с обзорной экскурсии</a>. За пару часов мы объедем все основные достопримечательности Северной Венеции.</li>
	<li>Всех, кто приехал в Питер на более долгий срок, приглашаем в <a href="/prigorodnyye/">путешествия по его пригородам</a>. Для вас откроют свои двери дворцы Пушкина, Павловска, Гатчины, заиграют на солнце фонтаны Петергофа и покорит своей сдержанной красотой Кронштадт.</li>
	<li>Если вы приехали в наш замечательный город в период белых ночей, не упустите возможность <a href="/nochnyye/">полюбоваться ночным городом</a> и, конечно же, <a href="/teplokhodnyye/">прокатиться на теплоходе под разводными мостами</a>. </li>
	<li>Коренных питерцев и всем, кто устал от парадно-туристического Петербурга приглашаем <a href="/avtorskiye/">на авторские тематические экскурсии</a>, посвященные религиозной жизни и мистическим тайнам города, прогулки по крышам и питерским дворикам. </li>
 </ul>
 <h2>Изучайте город с нами!</h2>
<p>Начать знакомство с Северной столицей рекомендуем с основных достопримечательностей: прогуляйтесь по Невскому проспекту, полюбуйтесь знаменитым домом Зингера, в котором располагается главный городской книжный. Посетите Дворцовую и Сенатскую площадь, чтоб полюбоваться Зимним дворцом и памятником Медный всадник, которые неслучайно стали символами Питера. </p>
<p>Стоит также посетить Васильевский остров, прогуляться по его стрелке и набережной с грифонами, а дальше направиться к <a href="https://parus-peterburg.ru/ekskursii-v-petropavlovskuyu-krepost/">Петропавловской крепости</a>.</p>
<p>Нельзя обойти вниманием и храмы Петербурга: Исаакиевский, Казанский, Смольный соборы, Спас-на-Крови, часовню Ксении Блаженной - каждый из них является неповторимым произведением искусства. </p>
<p>Если вы располагаете временем, стоит посетить и знаменитые музеи: Эрмитаж, Русский музей, кунсткамеру. </p>
<p>А может, стоит сойти с “туристических троп” и познакомиться с “непарадным” Санкт-Петербургом: побывать в одном из дворов-колодцев, музее современного искусства и подняться на крышу. </p>
<p>Наши гиды расскажут историю каждой достопримечательности и каждого дома на пути.</p>
<p>Если вы хотите увидеть все главные достопримечательности и прикоснуться в истории нашего прекрасного города, приглашаем вас на экскурсии по СПб!</p>
    <p>Заказ по телефонам <a href="tel:+79516853733">+7(951)685-37-33</a>
	</p>
	</div>

	<?php // get_template_part('/template-parts/excursion-block-menu'); ?>

	<div class="content__text--block">
   
	</div>
	<?php 
		$args = array(
			'posts_per_page' => '15',
			'post_type' => 'reviews'
		);
		$myposts = get_posts( $args );
	?>
	<!--noindex-->
	<div class="content-header content-header-reviews">
		<h2 class="content-header__title">Отзывы наших туристов</h2>
		<a href="/reviews" class="content-header__link">Смотреть все отзывы</a>
	</div>
	<div class="review_slider">
		
		<div class="review_slider--container">
			<?php foreach($myposts as $item): ?>
				<?php $date = (get_field('date_reviews',$item->ID))?get_field('date_reviews',$item->ID):get_the_date('d.m.Y',$item->ID); ?>



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
						
						<span><?php echo $item->post_content; ?></span>
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
								<?php if ($gid != 'othergid'): ?>
									<li><?php echo $gid ?></li>
								<?php endif ?>								
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
			<a href="/reviews">Смотреть все отзывы</a>
		</div>
	</div>
	<!--/noindex-->
  </div>
</section>

<?php get_footer(); // подключаем footer.php ?>