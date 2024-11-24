<?php
/**
 * Страница таксономии туров
 * @package WordPress
 * @subpackage your-clean-template-3
 */

$term = get_queried_object();
$term_id = $term->term_id;
$parent_id = $term->parent;
	if($term_id == 62) {
	wp_redirect('/'.strtoupper(get_queried_object()->slug), 301);
	exit();
}
if($term_id == 2)
	$indiv = true;
else
	$indiv = false;

$term = get_term($term_id);
$theme_url = get_stylesheet_directory_uri();
//$terms_tax = get_terms('excursion');
$terms_tax_tours = get_terms('excursion');

$h1 = get_field('h1', $term) ? get_field('h1', $term) : single_term_title('', false);
$num_tour = wp_get_term_taxonomy_parent_id( $term_id, 'excursion' );
$num_tour = $num_tour == '33' ? $num_tour : '';

$field = get_field('excursion_sort', $term);

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
$h1 .= $h1_plus;

$_terms_tax = get_field('menu_cats_new_custom', 'option');
$terms_tax = [];
foreach($_terms_tax as $item){
	if($item['is_title'] && $item['title']){
		$item['cat']->name = $item['title'];
	}
	$terms_tax[] = $item['cat'];
}

foreach($terms_tax_tours as $k=>$item){
	$args = array(
		'post_type' => 'tours',
		'posts_per_page' => -1,
		'suppress_filters' => true,
		'tax_query' => array(
			array(
				'taxonomy' => 'excursion',
				'field' => 'term_id',
				'terms' => $item->term_id
			)
		)
	);
	$query = new WP_Query( $args );

	if ($item->term_id == '33' && $term_id=='33' || $term->parent=='33' && $item->term_id=='33'){
		$term_all_tours = $item;
	}

	if($term_id =='33' && $item->parent!='33' || $term->parent=='33' && $item->parent != '33'){
		unset($terms_tax_tours[$k]);
	}

	if (!$num_tour) {
		if($term_id != '33' && $item->parent == '33' || $term_id != '33' && $item->term_id == '33'){
			 unset($terms_tax_tours[$k]);
		}
	}
}

$term_all = get_term(3, 'excursion');
if($term_id == 13 || $parent_id == 13){
	$school = $terms_tax_tours;
	foreach($school as $k=>$item){
		if($item->parent != 13)
			unset($school[$k]);
	}

	$terms_tax = $school;
	$term_all = get_term(13, 'excursion');
	$count_school = get_posts([
		'numberposts' => -1,
		'post_type' => 'tours',
		'tax_query' => array(
			array(
			  'taxonomy' => 'excursion',
			  'field' => 'id',
			  'terms' => 13
			)
		)
	]);
	$term_all->count = count($count_school);
	$indiv = false;
}
get_header(); // подключаем header.php ?>

<section class="content content--bus<?php if($field):?> nosort<?php endif ?>">
	<div class="container">
            <?php if ($term_id !='33' && !$num_tour && !$indiv): ?>
	 			<h1 class="mainh"><?php echo $h1; ?></h1>
			    <div class="slider-content banner-content">
			    	<?php /*
				        <a href="/skidki" class="banner">
				        	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $theme_url; ?>/img/banner-990.jpg" class="for-pc lazy for-have" alt="Скидки" style="object-position: left">
				        	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $theme_url; ?>/img/banner-768.jpg" class="for-tablet lazy for-have" alt="Скидки" style="object-position: left">
				        	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $theme_url; ?>/img/banner-480.jpg" class="for-mobile lazy for-have" alt="Скидки" style="object-position: left">
				        </a>
			            <a href="/kronshtadt" class="banner no-img">
			            	<img src="<?php echo $theme_url; ?>/img/23feb.jpg" class="for-pc" alt="Скидки">
			            	<img src="<?php echo $theme_url; ?>/img/23feb-mob.jpg" class="for-mobile for-tablet" alt="Скидки">
			            </a>
						<a href="/shou-programma-pochuvstvuj-sebya-russkim/" class="banner banner_fillRus">
						    <div class="banner_fillRus_wrap">
							<div class="fillRus_title">ДАРИМ БИЛЕТ</div>
							<div class="fillRus_subtitle">на фольклорное шоу</div>
							<div class="fillRus_contentname">«Почувствуй себя русским»</div>
							<div class="fillRus_conditionstop">при заказе 2-х любых экскурсий</div>
							<div class="fillRus_conditionsbot">предложение ограничено</div>
						    </div>
						</a>

			            <div class="banner banner_emart">
			            	<div class="img_block">
			            		<img src="<?php echo $theme_url; ?>/assets/images/cafe.png" alt="">
			            	</div>
			            	<div class="text-block">
				            	<div class="emart_title">Скидка всем нашим туристам на натуральный кофе от <span>EM'Art Coffee</span></div>
				            	<div class="emart_desc">Для активации скидки назовите слово <span>«Парус»</span></div>

			            	</div>
			            </div>

						<div class="banner banner__may">
							<a href="/skidki">
						    <div class="banner__may_wrap">
								<div class="may__title">Эксклюзивные <span>экскурсии</span></div>
								<div class="may__content">
									от компании «‎Парус» и <span class="md-hide">нашего партнёра —</span> Центрального военно-морского музея <span class="sm-hide">им. </span><span class="md-hide">императора</span> <span class="sm-hide">Петра Великого</span>
								</div>
								<div class="may__conditions">
									<div class="column">
										<span class="xs-hide">Морская миля: Кронштадт с теплоходной прогулкой + крейсер «Аврора»</span>
										<span class="xs-visible">Экскурсия в Кронштадт + «Аврора»</span>
									</div>
									<div class="column">
										<span class="xs-hide">Большая обзорная по Санкт-Петербургу + крейсер «Аврора»</span>
										<span class="xs-visible">Обзорная экскурсия + «Аврора»</span>
									</div>
								</div>
						    </div>
						    </a>
						</div>

			            <span class="banner">
			                <img src="<?php echo $theme_url; ?>/img/hiprice.png" class="bigImg" alt="Скидки" style="object-position: left">
			                <img src="<?php echo $theme_url; ?>/img/hipricemob.jpg" class="smallImg" alt="Скидки" style="object-position: left">
			            </span>

					<span class="banner b_wheel btn-open" style="cursor: pointer;">
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"> <img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_1140-1.jpeg" class="for-1140" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"><img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_960х165-1.png" class="for-990" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"><img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_738х165-1.png" class="for-796" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"> <img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_360х165-1.png" class="for-360" alt="Скидки" style="object-position: left"></a>
            	<a href="https://tourline.spb.ru/tip-tura/turi-s-kashbakom-po-rossii/" target="blank_"> <img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_414х165-1.png" class="for-480" alt="Скидки" style="object-position: left"></a>
            </span>


		            <span class="banner b_wheel btn-open triggers" style="cursor: pointer;">
		            	<img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_1140х165.png" class="for-1140" alt="Скидки" style="object-position: left">
		            	<img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_990х165.png" class="for-990" alt="Скидки" style="object-position: left">
		            	<img src="<?php echo $theme_url; ?>/img/parus-peterburg_banners_768х165.png" class="for-796" alt="Скидки" style="object-position: left">
		            	<img src="<?php echo $theme_url; ?>/img/parus-petersburg_360x165.png" class="for-360" alt="Скидки" style="object-position: left">
		            	<img src="<?php echo $theme_url; ?>/img/parus-petersburg_480x165.png" class="for-480" alt="Скидки" style="object-position: left">
		            </span> 

					<!--div class="banner">
				        <a href="/skidki">
				            <span class="banner__title">Скидки</span>
				            <span class="banner__percent">до 50%</span>
				            <div class="banner__conditions"><span>При покупке</span> билетов на сайте</div>
				        </a>
					</div-->

		            <!--a href="/skidki" class="banner b_wheel">
		            	<img src="<?php echo $theme_url; ?>/img/cafe_1140.png" class="for-1140" alt="Скидки">
		            	<img src="<?php echo $theme_url; ?>/img/cafe_990.png" class="for-990" alt="Скидки">
		            	<img src="<?php echo $theme_url; ?>/img/cafe_768.png" class="for-796" alt="Скидки">
		            	<img src="<?php echo $theme_url; ?>/img/cafe_480.png" class="for-360" alt="Скидки">
		            	<img src="<?php echo $theme_url; ?>/img/cafe_360.png" class="for-480" alt="Скидки">
		            </a-->

		            <!--div class="slider-nav">
		                <div class="slider-nav-item active"></div>
		                <div class="slider-nav-item"></div>

		            </div-->*/ ?>
			    </div>
            <?php else: ?>
	 			<h1 class="mainh" style="margin-top: 30px;margin-bottom: 15px;"><?php echo $h1; ?></h1>

            <?php endif ?>

			<?php if ($term_id==76): ?>
				<div id="riverlines" data-key="e1f09e232bb204e224224a54e3daff22dd2f7e02" data-id="2326"></div>
				<script src="https://riverlines.ru/src/riverlines.js"></script>
				<div style="margin-bottom: 120px;"></div>
			<?php else: ?>

				<div class="content__text--block">
					<?php if (term_description()): ?>
						<?php echo term_description() ?>
					<?php endif ?>

				</div>

				<?php if(!$indiv): ?>
					<div class="filter__general_wrapper<?php if($term_id=='33'): ?> filter__general_wrapper-term33<?php endif; ?>">
						<?php if($term_id=='33'): $ct = 0;?>
							<div class="g-scrolling-carousel g-scrolling-carousel-term33">
								<div class="content__filters items">
									  <a href="#" class="content__filter content__filter--nolink active" data-slug="tury">
										Все туры
										<?php foreach($terms_tax_tours as $item): ?>
											<?php $ct+=$item->count; ?>
										<?php endforeach; ?>
										<span><?=$ct?></span>
									  </a>
									  <?php foreach($terms_tax_tours as $item): ?>
											<?php
												if($item->term_id==36)
													continue;
											?>
											<?php if($item->slug != 'grup-ekskursii' && $item->slug != 'indiv-ekskursii' &&  $item->slug != 'zimniye' && $item->slug != 'novogodnie'): ?>
												<a href="/<?=$item->slug?>" class="content__filter content__filter--nolink" data-slug="<?=$item->slug?>">
													<?php echo str_replace('экскурсии', '', $item->name);?>
													<span><?=$item->count?></span>
												</a>
											<?php endif; ?>
									  <?php endforeach; ?>
								</div>
							</div>
						<?php elseif($num_tour): $ct = 0; ?>
							<div class="g-scrolling-carousel g-scrolling-carousel-term33">
								<div class="content__filters items">
									  <a href="/tury/" class="content__filter content__filter--nolink" data-slug="tury">
										Все туры
										<?php foreach($terms_tax as $item): ?>
											<?php $ct+=$item->count; ?>
										<?php endforeach; ?>
										<span><?=$ct?></span>
									  </a>
									  <?php foreach($terms_tax_tours as $item): ?>
											<?php if($item->slug != 'grup-ekskursii' && $item->slug != 'indiv-ekskursii' &&  $item->slug != 'zimniye' && $item->slug != 'novogodnie'): ?>
												<?php $active = explode('/',$_SERVER['REQUEST_URI'])[1] == $item->slug ? ' active' : ''; ?>
												<a href="/<?=$item->slug?>" class="content__filter<?php echo $active;?>" data-slug="<?=$item->slug?>">
													<?php echo str_replace('экскурсии', '', $item->name);?>
													<span><?=$item->count?></span>
												</a>
											<?php endif; ?>
									  <?php endforeach; ?>
									  <a class="content__filter content__filter-more" href="#">Еще</a>
								</div>
							</div>
						<?php else: ?>
							<div class="g-scrolling-carousel">
								<div class="content__filters items">
									<?php if($term_id == 13 || $parent_id == 13): ?>
										<a href="/" class="content__filter<?php if($term_id == 13): ?> active<?php endif ?>" data-slug="shkolnye-ehkskursii">
											Все экскурсии
											<span><?=$term_all->count?></span>
										</a>
									<?php else: ?>
										<a href="/" class="content__filter" data-slug="grup-ekskursii">
											Все экскурсии
											<span><?=$term_all->count?></span>
										</a>
									<?php endif; ?>
								  <?php foreach($terms_tax as $item): ?>
									<?php // if (explode('/',$_SERVER['REQUEST_URI'])[1] == $item->slug) continue; ?>
									<?php $active = explode('/',$_SERVER['REQUEST_URI'])[1] == $item->slug ? ' active' : ''; ?>
										<a href="/<?=$item->slug?>" class="content__filter<?php echo $active;?>" data-slug="<?=$item->slug?>/">
											<?php if($_tmp = get_field('term_filter_name', $item)): ?>
												<?=$_tmp?>
											<?php else: ?>
												<?php echo str_replace('экскурсии', '', $item->name);?>
											<?php endif ?>
											<span><?=$item->count?></span>
										</a>
								  <?php endforeach; ?>
								  <a class="content__filter content__filter-more" href="#">Еще</a>
								</div>
							</div>
						<?php endif; ?>

						<?php if ($term_id !='33' && !$num_tour): ?>
							<div class="filter_button_wrap">
								<div class="tl-tour-search--group filter_calendar input-group">
									<button class="apply-filters-float-btn"></button>
									<div class="input-group-append">
										<img src="<?php echo get_template_directory_uri()?>/img/shape.svg" alt="" style="margin-left: 10px;">
									</div>
									<div class="tl-dropdown" data-type="calendar">
										<div class="tl-dropdown--head">
											<input class="tl-datapicker--input" value="<?php echo $str ? $str : $date;?>" name="date" type="text" readonly placeholder="Дата">
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
									<img src="https://parus-peterburg.ru/wp-content/themes/parus/img/downs.svg" alt="" style="margin-left: auto; margin-right: 10px; position: absolute;right: 0; top: 14px;">
								</div>

								<button class="parametrs js-filter-duration_sort">
									<img src="<?php echo get_template_directory_uri()?>/img/clock.svg" alt="" style="margin-right: 10px;margin-left: 10px;">
									<span>Длительность</span>
									<img src="<?php echo get_template_directory_uri()?>/img/downs.svg" alt="" style="margin-left: auto;margin-right: 10px;">
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
													<input type="radio" checked="" name="sorts" value="pops">
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
				<?php endif; ?>

				<div class="tours_block">
					<div class="content__tours" id="tours">
						<?php
							$num = 0;
							$post_num = 0;
							query_posts(array(
								'post_type' => 'tours',
								'posts_per_page' => -1,
								'tax_query' => array(
									array(
										'taxonomy' => 'excursion',
										'field' => 'term_id',
										'terms' => $term_id
									)
								)
							));

							$all_posts = get_posts( array(
								'numberposts' => -1,
								'post_type' => 'tours',
								'tax_query' => array(                                  // элемент (термин) таксономии
									array(
										'taxonomy' => 'excursion',         // таксономия
										'field' => 'term_id',
										'terms'    => $term_id
									)
								),
							) );

							$_all_posts = $all_posts_true = [];
							if($field){
								$ids = explode(',', $field);
								
								
								foreach($all_posts as $item){
									$_all_posts[$item->ID] = $item;
								}
								foreach($ids as $item){
									$all_posts_true[$item] = $_all_posts[$item];
								}
								foreach($all_posts as $item){
									if(!in_array($item->ID, $ids)){
										$all_posts_true[$item->ID] = $item;
									}
								}
								//var_dump($_all_posts);
								$all_posts = $all_posts_true;
							}
						?>

						<?php
						//if (have_posts()) :
						if (count($all_posts)) :

							$title_arr[] = str_replace('Экскурсии в ', '', $h1);
							//while (have_posts()) : the_post(); // если посты есть - запускаем цикл wp
							foreach($all_posts as $k => $item):
							$post_num++;
							if(!$item->ID) continue;
							$post = $item;
							?>
								<?php if($indiv == true): ?>
									<?php get_template_part('loop-individual'); ?>
									<?php $num++; ?>
								<?php else: ?>
									<?php if(get_field('id_crm', $item->ID) && !count(get_post_meta($item->ID, 'tickets'))) continue; ?>
									    <?php if ($num == 1): ?>
											<?php /*include('template-parts/banner-school.php');*/ ?>
										<?php endif ?>
									<?php if ($num == 2): ?>
										<?php /*include('template-parts/banners/banner-luxury.php');
										<?php include('template-parts/banners/banner-salut.php'); ?>
                                        <?php include('template-parts/banner-evening-excursions.php'); ?>
										<?php $num++; ?>*/ ?>
									<?php endif ?>
									<?php if ($num == 6): ?>
										<a href="/novogodnii-sankt-peterburg" class="ng_banner content__tour tour" style="background-image:url(<?=$theme_url?>/assets/images/banners/ny2025-2.jpg);    background-position: top center;"></a>
										<?php $num++; ?>
									<?php endif ?>
									<?php if ($num == 8 || ($num >= count($all_posts)&&count($all_posts)<6)): ?>
										<?php include('template-parts/horror_banner.php'); ?>
										<?php $num++; ?>
									<?php endif ?>
									<?php if ($num == 15 || $num >= count($all_posts)): ?>
										<?php get_template_part('promo_wheel'); ?>
										<?php $num++; ?>
									<?php endif ?>
									<?php /*if ($num == 8): ?>
										<?php get_template_part('promo'); ?>
										<?php $num++; ?>
									<?php endif*/ ?>
									<?php if(get_the_title() == 'Обзорная экскурсия с Петропавловской крепостью'){
										$title_arr[] = 'Обзорная экскурсия с посещением соборов и Петропавловской крепости';
										$title_arr[] = 'Обзорная с посещением Петропавловской крепости';
									}
									?>
									<?php $title_arr[] = get_the_title(); ?>
									<?php get_template_part('loop_tax', '', ['i'=>$num]); // для отображения каждой записи берем шаблон loop.php ?>
									<?php $num++; ?>
									<?php if ($num == 21 || $post_num==count($all_posts)): ?>
										<?php include('template-parts/crime_banner.php'); ?>
										<?php $num++; ?>
									<?php endif ?>
								<?php endif; ?>
							<?php endforeach //endwhile; // конец цикла?>
							<?php if ($num < 5 && !$indiv): ?>
								<?php get_template_part('promo'); ?>
							<?php endif ?>
						<?php else: echo '<p class="fs-weight">По вашему запросу ничего не найдено, попробуйте еще раз.</p>';
						endif; // если записей нет, напишим "простите" ?>
					</div>
				</div>
			<?php endif ?>

			<?php if (get_field('after_cat_txt', $term)) : ?>
				<div class="content__text--block">
					<?php the_field('after_cat_txt', $term); ?>
				</div>
			<?php endif; ?>

		<?php //get_template_part('/template-parts/excursion-block-menu'); ?>
		<?php
			// $args = array(
			// 	'posts_per_page' => '99',$title_arr[]
			// 	'post_type' => 'reviews',

			// );
			// $myposts = get_posts( $args );

			// $args = array(
			// 	'posts_per_page' => '8',
			// 	'post_type' => 'reviews',
			// 	'meta_query' => array(
			// 			array(
			// 				'key'     => 'excursion',
			// 				'value'   => $title_arr,
			// 				'compare' => 'IN',
			// 		),
			// 	),
			// 	'orderby' => 'date',
			// 	'order' => 'DESC'
			// );
			// $myposts = get_posts( $args );
			// wp_reset_postdata(); // сброс

	  		//$args2 = array(
			// 	'posts_per_page' => '5',
			// 	'post_type' => 'reviews',
			// 	'meta_query' => array(
			// 			array(
			// 				'key'     => 'excursions',
			// 				'value'   => $title_arr,
			// 				'compare' => 'NOT IN',
			// 		),
			// 	),
			// 	'orderby' => 'date',
			// 	'order' => 'DESC'
			// );
			// $myposts2 = get_posts( $args2 );
			// wp_reset_postdata(); // сброс

	/*		$meta_query = [];


			$meta_query['relation'] = 'OR';

        if($term_id !== 13)// если не "Детские экскурсии /detskiye/" --TODO //убрать когда появятся отзывы
        {
            foreach ( $title_arr as $zipcode ) {
                $meta_query[] = [
                    'key'     => 'excursion',
                    'value'   => $zipcode,
                    'compare' => 'LIKE',
                ];
            }
        }


			$query_adresses   = [
			    'post_type'      => 'reviews',
			    'posts_per_page' => 10,
			    'meta_query'     => $meta_query,
			    'orderby' => 'date',
			    'order' => 'DESC'
			];

			$myposts = get_posts( $query_adresses );
			wp_reset_postdata(); // сброс

			if (count($myposts) < 10) {
				$countpost = 10 - count($myposts);
				$meta_query2 = [];

				foreach ( $title_arr as $zipcode ) {
				    $meta_query2[] = [
				        'key'     => 'excursion',
				        'value'   => $zipcode,
				        'compare' => 'NOT LIKE',
				    ];
				}

				$meta_query2[] = [
					'key'     => 'rating',
					'value'   => 5,
					'compare' => '>=',
					'type'    => 'NUMERIC'
				];

				$query_adresses2   = [
				    'post_type'      => 'reviews',
				    'posts_per_page' => $countpost,
				    'meta_query'     => $meta_query2,
				    'orderby' => 'date',
				    'order' => 'DESC'
				];
				$myposts2 = get_posts( $query_adresses2 );*/
				wp_reset_postdata(); // сброс
			//}
		?>
		<?php
			$args = array(
				'posts_per_page' => '5',
				'post_type' => 'reviews',
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_query' => array(
					[
						'key'     => 'rating',
						'value'   => 5,
						'compare' => '>=',
						'type'    => 'NUMERIC'
					]
				),
			);
			$myposts2 = get_posts( $args );
		?>

		<div class="rev_else_block">
			<div class="order_mob_0">
				<?php $termsId = get_field( "choose_taxonomy", 'category_' . $term_id);
					if($termsId) : ?>
					<h2 class="content-header__title">Вас также могут заинтересовать</h2>
					<div class="content__tours">
						<?php $i = 0;
						foreach($termsId as $termId) :
							if ($termId == $term_id) :
								continue;
							endif;
							$term  = get_term($termId);
							$name        = $term->name;
							$description = $term->description;
							$slug = $term->slug;
							$taxonomy = $term->taxonomy;
							$src = get_field( "tax_img", 'category_' . $termId);
							$link = get_term_link($termId);
							$items_prices = [];

							$queryPosts = new WP_Query(array(
								'posts_per_page' => -1,
								'post_type' => 'tours',
								'post_status' => 'publish',
								'tax_query' => array(
									array(
										'taxonomy' => 'excursion',
										'field' => 'term_id',
										'terms' => $termId
									)
								)
							));
							$the_title = [];
							if($queryPosts->have_posts()):
								while ( $queryPosts->have_posts() ) :
									$queryPosts->the_post();
									$id = get_the_id();
									$min_price_arr = [];
									if (get_field('p_doshkolniki_sale', $id)) {
										$min_price_arr[]=(int)get_field('p_doshkolniki_sale', $id);
									}
									if ( get_field('p_doshkolniki', $id) ) {
										$min_price_arr[]=(int)get_field('p_doshkolniki', $id);
									}
									if (get_field('p_shkolniki_sale', $id)){
										$min_price_arr[]=(int)get_field('p_shkolniki_sale', $id);
									}
									if (get_field('p_shkolniki', $id)) {
										$min_price_arr[]=(int)get_field('p_shkolniki', $id);
									}

									if (empty($min_price_arr)) continue;

								    $items_prices[] = min($min_price_arr);
								endwhile;

								if (count($items_prices)>1) {
									$min_price = min($items_prices);
								}

							endif;
							wp_reset_postdata(); // сброс
							?>
							<div class="content__tour tour ekskursii-s-vodnoj-progulkoj ekskursii-po-rekam-i-kanalam bilety-bez-ocheredi obzornyye teplokhodnyye grup-ekskursii">
								<a href="<?php echo $link; ?>" class="tour__header">
									<img src="<?php if($src): echo $src; endif; ?>" alt="tour-image" class="tour__image">
								</a>
								<div class="tour__content">
									<h4 class="tour__title"><?php if($name): echo $name; endif; ?></h4>
									<noindex><p><?php if($description): echo $description; endif; ?></p></noindex>
									<div class="tour__cost">
										Стоимость:&nbsp;
										<span>от
											<span id="min_cost">
											<?php if($min_price): echo $min_price; endif; ?>
											руб/чел</span>
										</span>
									</div>
								</div>
							</div>
							<?php $i++;
							if($i >= 3):
								break;
							endif;
						endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			
			<?php if($term_id==11): ?>
				<div class="content-header">
					<h2 class="content-header__title">Достопримечательности ночного Санкт-Петербурга</h2>
				</div>
				<div class="int_mesta int_mesta-4col">
					<div class="int_mesta__item" style="background-image:url(<?=get_stylesheet_directory_uri()?>/img/st-petersburg-2722742_1280.jpg)">
						<a class="int_mesta__link" href="/%D0%B8%D1%81%D0%B0%D0%B0%D0%BA%D0%B8%D0%B5%D0%B2%D1%81%D0%BA%D0%B8%D0%B9-%D1%81%D0%BE%D0%B1%D0%BE%D1%80"></a>
						<div class="int_mesta__content">
							<div class="int_mesta__name">Исаакиевский собор</div>
						</div>
					</div>
					<div class="int_mesta__item" style="background-image:url(<?=get_stylesheet_directory_uri()?>/img/smolniy.png)">
						<a class="int_mesta__link" href="/%D1%81%D0%BC%D0%BE%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9-%D1%81%D0%BE%D0%B1%D0%BE%D1%80"></a>
						<div class="int_mesta__content">
							<div class="int_mesta__name">Этнографический музей</div>
							<span class="int_mesta__ist">Источник: <a href="https://commons.wikimedia.org/wiki/File:%D0%A1%D0%BC%D0%BE%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9_%D0%BC%D0%BE%D0%BD%D0%B0%D1%81%D1%82%D1%8B%D1%80%D1%8C.png" target="_blank">Святослав Владимирович</a>, CC BY-SA <a href="https://creativecommons.org/licenses/by-sa/3.0" target="_blank">3.0</a>, via Wikimedia Commons</span>
						</div>
					</div>
					<div class="int_mesta__item" style="background-image:url(<?=get_stylesheet_directory_uri()?>/img/wint.jpg)">
						<a class="int_mesta__link" href="/%D0%B3%D0%BE%D1%81%D1%83%D0%B4%D0%B0%D1%80%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D1%8B%D0%B9-%D1%8D%D1%80%D0%BC%D0%B8%D1%82%D0%B0%D0%B6"></a>
						<div class="int_mesta__content">
							<div class="int_mesta__name">Эрмитаж</div>
						</div>
					</div>
					<div class="int_mesta__item" style="background-image:url(<?=get_stylesheet_directory_uri()?>/img/aur.jpg)">
						<a class="int_mesta__link" href="/%D0%BA%D1%80%D0%B5%D0%B9%D1%81%D0%B5%D1%80-%D0%B0%D0%B2%D1%80%D0%BE%D1%80%D0%B0"></a>
						<div class="int_mesta__content">
							<div class="int_mesta__name">Крейсер «Аврора»</div>
						</div>
					</div>
				</div>
			<?php endif ?>
			
			<?php get_template_part('/template-parts/block/gids'); ?>
			<div class="order_mob_1">
				<?php if($term_id == '24'):

				   $meta_reviews = array(
						'relation' => 'AND',
						array(
							 'key'     => 'excursion',
				             'value'   => ['Новогодняя ночь', 'Царская ёлка в Николаевском Дворце','Советский Новый год'],
							 'compare' => 'IN',
						)
					);
					$queryreview   = [
				    'post_type'      => 'reviews',
				    'posts_per_page' => 20,
				    'meta_query'     => $meta_reviews,
				    'orderby' => 'date',
				    'order' => 'DESC'
				];
				$reviews = get_posts( $queryreview );

					$queryreviewall   = [
				    'post_type'      => 'reviews',
				    'posts_per_page' => 20,
				    'orderby' => 'date',
				    'order' => 'DESC'
				];
				$reviewsothers = get_posts( $queryreviewall );
				?>
					<div class="content-header content-header-reviews">
						<h2 class="content-header__title">Отзывы наших туристов</h2>
						<a href="/reviews" class="content-header__link">Смотреть все отзывы</a>
					</div>
					<div class="review_slider--container">
						<?php foreach($reviews as $item): ?>
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
											<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
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
									            	<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
									            	</a>
									            </li>
									        <?php endforeach; ?>
									    </ul>
									<?php endif; ?>
									</div>
								</div>

								<?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
									<div class="review__author">
										<div class="excursion">
											<div class="excursion-list">Экскурсия</div>
											<?php if (get_field('excursion',$item->ID)): ?>
												<?php $excursionarr = explode(',', get_field('excursion',$item->ID)); ?>
												<ul>
													<?php foreach ($excursionarr as $excursion): ?>
														<?php if ($excursion): ?>
															<li><?php echo $excursion ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
										<div class="gid">
											<div class="gid-accreditation">Экскурсовод</div>
											<?php if (get_field('gid',$item->ID)): ?>
												<?php $gidarr = explode(',', get_field('gid',$item->ID)); ?>
												<ul>
													<?php foreach ($gidarr as $gid): ?>
														<?php if ($gid != 'othergid'): ?>
															<li><?php echo $gid ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>
							</div>
						<?php endforeach; ?>
						<?php if (is_array($myposts2)): foreach($myposts2 as $item): ?>
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
											<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
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
									            	<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
									            	</a>
									            </li>
									        <?php endforeach; ?>
									    </ul>
									<?php endif; ?>
									</div>
								</div>
								<?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
									<div class="review__author">
										<div class="excursion">
											<div class="excursion-list">Экскурсия</div>
											<?php if (get_field('excursion',$item->ID)): ?>
												<?php $excursionarr = explode(',', get_field('excursion',$item->ID)); ?>
												<ul>
													<?php foreach ($excursionarr as $excursion): ?>
														<?php if ($excursion): ?>
															<li><?php echo $excursion ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
										<div class="gid">
											<div class="gid-accreditation">Экскурсовод</div>
											<?php if (get_field('gid',$item->ID)): ?>
												<?php $gidarr = explode(',', get_field('gid',$item->ID)); ?>
												<ul>
													<?php foreach ($gidarr as $gid): ?>
														<?php if ($gid != 'othergid'): ?>
															<li><?php echo $gid ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>
							</div>
						<?php endforeach;
					  endif;?>

						<?php foreach($reviewsothers as $item): ?>
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
											<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
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
									            	<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
									            	</a>
									            </li>
									        <?php endforeach; ?>
									    </ul>
									<?php endif; ?>
									</div>
								</div>

								<?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
									<div class="review__author">
										<div class="excursion">
											<div class="excursion-list">Экскурсия</div>
											<?php if (get_field('excursion',$item->ID)): ?>
												<?php $excursionarr = explode(',', get_field('excursion',$item->ID)); ?>
												<ul>
													<?php foreach ($excursionarr as $excursion): ?>
														<?php if ($excursion): ?>
															<li><?php echo $excursion ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
										<div class="gid">
											<div class="gid-accreditation">Экскурсовод</div>
											<?php if (get_field('gid',$item->ID)): ?>
												<?php $gidarr = explode(',', get_field('gid',$item->ID)); ?>
												<ul>
													<?php foreach ($gidarr as $gid): ?>
														<?php if ($gid != 'othergid'): ?>
															<li><?php echo $gid ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>
							</div>
						<?php endforeach; ?>
						<?php if (is_array($myposts2)): foreach($myposts2 as $item): ?>
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
											<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
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
									            	<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
									            	</a>
									            </li>
									        <?php endforeach; ?>
									    </ul>
									<?php endif; ?>
									</div>
								</div>

								<?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
									<div class="review__author">
										<div class="excursion">
											<div class="excursion-list">Экскурсия</div>
											<?php if (get_field('excursion',$item->ID)): ?>
												<?php $excursionarr = explode(',', get_field('excursion',$item->ID)); ?>
												<ul>
													<?php foreach ($excursionarr as $excursion): ?>
														<?php if ($excursion): ?>
															<li><?php echo $excursion ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
										<div class="gid">
											<div class="gid-accreditation">Экскурсовод</div>
											<?php if (get_field('gid',$item->ID)): ?>
												<?php $gidarr = explode(',', get_field('gid',$item->ID)); ?>
												<ul>
													<?php foreach ($gidarr as $gid): ?>
														<?php if ($gid != 'othergid'): ?>
															<li><?php echo $gid ?></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>
							</div>
						<?php endforeach;
					  endif;?>

					</div>
					<div class="review_slider--all_link">
						<a href="/reviews">Смотреть все отзывы</a>
					</div>
					<!--/noindex-->
				<?php endif; ?>


				<?php if ($term_id !='33' && $term_id != '24' && !$num_tour && !$indiv): ?>
					<!--noindex-->
					<div class="content-header content-header-reviews">
						<h2 class="content-header__title">Отзывы наших туристов</h2>
						<a href="/reviews" class="content-header__link">Смотреть все отзывы</a>
					</div>
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
											<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
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
									            	<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
									            	</a>
									            </li>
									        <?php endforeach; ?>
									    </ul>
									<?php endif; ?>
									</div>
								</div>

                                <?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
                                    <div class="review__author">
                                        <?php if($excursions = get_field('excursion_obj',$item->ID)): ?>
                                            <div class="excursion">
                                                <div class="excursion-list">Экскурсия</div>
                                                <ul>
                                                    <?php foreach($excursions as $item2): ?>
                                                        <?php $name = (get_field('h1', $item2))?get_field('h1', $item2):get_the_title($item2); ?>
                                                        <?php if(get_post_status($item2)=='publish'): ?>
                                                            <li><a href="<?=get_the_permalink($item2)?>"><?=$name?></a></li>
                                                        <?php else: ?>
                                                            <li><?=$name?></li>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        <?php elseif ($ex = get_field('excursion',$item->ID)): $excursionarr = explode(',', $ex); ?>
                                            <div class="excursion">
                                                <div class="excursion-list">Экскурсия</div>
                                                <ul>
                                                    <?php foreach ($excursionarr as $excursion): ?>
                                                        <?php if ($excursion): ?>
                                                            <?php
                                                            $tour = get_posts([
                                                                'post_type' => 'tours',
                                                                "s" => $excursion
                                                            ]);
                                                            ?>
                                                            <?php if($tour): ?>
                                                                <li><a href="<?=get_the_permalink($tour[0])?>"><?php echo $excursion ?></a></li>
                                                            <?php else: ?>
                                                                <li><?php echo $excursion ?></li>
                                                            <?php endif ?>
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
						<?php if (is_array($myposts2)): foreach($myposts2 as $item): ?>
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
											<a class="review_slider--img_href" href="<?=get_field('review_img',$item->ID)['url']?>"><img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt=""></a>
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
									            	<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
									            	</a>
									            </li>
									        <?php endforeach; ?>
									    </ul>
									<?php endif; ?>
									</div>
								</div>

								<?php if (get_field('excursion',$item->ID) || get_field('gid',$item->ID)): ?>
                                    <div class="review__author">
                                        <?php if($excursions = get_field('excursion_obj',$item->ID)): ?>
                                            <div class="excursion">
                                                <div class="excursion-list">Экскурсия</div>
                                                <ul>
                                                    <?php foreach($excursions as $item2): ?>
                                                        <?php $name = (get_field('h1', $item2))?get_field('h1', $item2):get_the_title($item2); ?>
                                                        <?php if(get_post_status($item2)=='publish'): ?>
                                                            <li><a href="<?=get_the_permalink($item2)?>"><?=$name?></a></li>
                                                        <?php else: ?>
                                                            <li><?=$name?></li>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        <?php elseif ($ex = get_field('excursion',$item->ID)): $excursionarr = explode(',', $ex); ?>
                                            <div class="excursion">
                                                <div class="excursion-list">Экскурсия</div>
                                                <ul>
                                                    <?php foreach ($excursionarr as $excursion): ?>
                                                        <?php if ($excursion): ?>
                                                            <?php
                                                            $tour = get_posts([
                                                                'post_type' => 'tours',
                                                                "s" => $excursion
                                                            ]);
                                                            ?>
                                                            <?php if($tour): ?>
                                                                <li><a href="<?=get_the_permalink($tour[0])?>"><?php echo $excursion ?></a></li>
                                                            <?php else: ?>
                                                                <li><?php echo $excursion ?></li>
                                                            <?php endif ?>
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
						<?php endforeach; endif;?>
					</div>
					<div class="review_slider--all_link">
						<a href="/reviews">Смотреть все отзывы</a>
					</div>
					<!--/noindex-->
				<?php endif ?>
			</div>
		</div>
		
		<?php if($term_id==11): ?>
			<?php
				$faq = [
					[
						'title' => 'Какая одежда и обувь рекомендуются для ночных экскурсий?',
						'text' => 'Рекомендуем выбирать удобную одежду и обувь. Пожалуйста, учтите, что по ночам в Питере часто бывает прохладно, поэтому лучше одеваться многослойно, чтобы можно было легко приспособиться к изменениям температуры. Также стоит взять с собой легкую куртку или свитер. '
					],
					[
						'title' => 'Откуда отправляются экскурсии?',
						'text' => 'Большая часть наших автобусных экскурсий отправляется с Московского вокзала. Теплоходные ночные прогулки мы начинаем от одного из центральных причалов.  '
					],
					[
						'title' => 'Проводятся ли экскурсии при плохой погоде?',
						'text' => 'Да, экскурсии проводятся при любой погоде. Наши экскурсии проходят на автобусах и теплоходах, оснащенных кондиционерами и обогревателями. На открытых палубах теплоходов предусмотрены тенты от дождя, поэтому непогода не сможет помешать вашему путешествию.'
					],
					[
						'title' => 'Есть ли экскурсоводы, владеющие иностранными языками?',
						'text' => 'Да. Мы регулярно проводим экскурсии на английском языке. Также у нас есть гиды, владеющие немецким, французским и даже японским языками. '
					],
					[
						'title' => 'Есть ли у вас льготы для студентов и пенсионеров?',
						'text' => 'Да, у нас действуют специальные цены для пенсионеров, студентов, школьников и дошкольников. '
					],
				];
			?>

		
		
			<div class="block_wrap">
				<div class="content-header">
					<h2 class="content-header__title">Популярные вопросы</h2>
				</div>
				<div class="faq">
					<?php foreach($faq as $k=>$item): ?>
						<div class="faq__item">
							<div class="faq__title_wrap">
								<div class="faq__title">
									<?=$item['title']?>
								</div>					
								<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
								</svg>
							</div>
							<div class="faq__text"><?=$item['text']?></div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			
			<div class="content-header"></div>
			<div id="izuchayte_gorod">
				<div class="banner-block banner-block--col-3">
					<img src="/wp-content/uploads/2021/06/drawbridge-palace-bridge-peter-paul-fortress-saint-petersburg-russia.jpg" class="banner-block__img" alt="Водные экскурсии">
					<div class="banner-block__time">
						<i class="icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.3041 17C14.1067 17 18 13.1944 18 8.5C18 3.80558 14.1067 0 9.3041 0C4.5015 0 0.608227 3.80558 0.608227 8.5C0.608227 10.5534 1.35819 12.4881 2.67467 14.0016H0.668914C0.299483 14.0016 1.1134e-08 14.2944 0 14.6555C-1.11359e-08 15.0166 0.299483 15.3093 0.668913 15.3093H4.45286C4.82229 15.3093 5.12177 15.0166 5.12177 14.6555V10.9567C5.12177 10.5956 4.82229 10.3029 4.45286 10.3029C4.08343 10.3029 3.78395 10.5956 3.78395 10.9567V13.2562C2.61413 11.9609 1.94605 10.2842 1.94605 8.5C1.94605 4.5278 5.24037 1.30769 9.3041 1.30769C13.3678 1.30769 16.6622 4.5278 16.6622 8.5C16.6622 12.4722 13.3678 15.6923 9.3041 15.6923C8.93467 15.6923 8.63519 15.985 8.63519 16.3462C8.63519 16.7073 8.93467 17 9.3041 17ZM9.30415 4.18521C9.67358 4.18521 9.97306 4.47794 9.97306 4.83905V9.10093L12.1455 11.2244C12.4067 11.4797 12.4067 11.8937 12.1455 12.1491C11.8842 12.4044 11.4607 12.4044 11.1995 12.1491L8.83115 9.8341C8.70571 9.71148 8.63523 9.54517 8.63523 9.37176V4.83905C8.63523 4.47794 8.93472 4.18521 9.30415 4.18521Z" fill="#2C84D1"></path>
							</svg>
						</i>
						<span>
							от 1 до 14&nbsp;часов        </span>
					</div>
					<div class="banner-block__text">
						<div class="name">Водные экскурсии</div>
						<div class="text text-price">от 500 ₽/чел</div>
					</div>
					<a href="/ekskursii-s-vodnoj-progulkoj/" class="banner-block__btn">Посмотреть экскурсии</a>
				</div>
				<div class="banner-block banner-block--col-3">
					<img src="/wp-content/uploads/2024/02/astoria-hotel-saint-petersburg-winter-night.jpg" class="banner-block__img" alt="Водные экскурсии">
					<div class="banner-block__time">
						<i class="icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.3041 17C14.1067 17 18 13.1944 18 8.5C18 3.80558 14.1067 0 9.3041 0C4.5015 0 0.608227 3.80558 0.608227 8.5C0.608227 10.5534 1.35819 12.4881 2.67467 14.0016H0.668914C0.299483 14.0016 1.1134e-08 14.2944 0 14.6555C-1.11359e-08 15.0166 0.299483 15.3093 0.668913 15.3093H4.45286C4.82229 15.3093 5.12177 15.0166 5.12177 14.6555V10.9567C5.12177 10.5956 4.82229 10.3029 4.45286 10.3029C4.08343 10.3029 3.78395 10.5956 3.78395 10.9567V13.2562C2.61413 11.9609 1.94605 10.2842 1.94605 8.5C1.94605 4.5278 5.24037 1.30769 9.3041 1.30769C13.3678 1.30769 16.6622 4.5278 16.6622 8.5C16.6622 12.4722 13.3678 15.6923 9.3041 15.6923C8.93467 15.6923 8.63519 15.985 8.63519 16.3462C8.63519 16.7073 8.93467 17 9.3041 17ZM9.30415 4.18521C9.67358 4.18521 9.97306 4.47794 9.97306 4.83905V9.10093L12.1455 11.2244C12.4067 11.4797 12.4067 11.8937 12.1455 12.1491C11.8842 12.4044 11.4607 12.4044 11.1995 12.1491L8.83115 9.8341C8.70571 9.71148 8.63523 9.54517 8.63523 9.37176V4.83905C8.63523 4.47794 8.93472 4.18521 9.30415 4.18521Z" fill="#2C84D1"></path>
							</svg>
						</i>
						<span>
							от 2,5 до 14&nbsp;часов        </span>
					</div>
					<div class="banner-block__text">
						<div class="name">Мистические экскурсии</div>
						<div class="text text-price">от 600 ₽/чел</div>
					</div>
					<a href="/misticheskiye/" class="banner-block__btn">Посмотреть экскурсии</a>
				</div>
				<div class="banner-block banner-block--col-3">
					<img src="/wp-content/uploads/2021/05/view-of-saint-petersburg-from-neva-river-russia.jpg" class="banner-block__img" alt="Водные экскурсии">
					<div class="banner-block__time">
						<i class="icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.3041 17C14.1067 17 18 13.1944 18 8.5C18 3.80558 14.1067 0 9.3041 0C4.5015 0 0.608227 3.80558 0.608227 8.5C0.608227 10.5534 1.35819 12.4881 2.67467 14.0016H0.668914C0.299483 14.0016 1.1134e-08 14.2944 0 14.6555C-1.11359e-08 15.0166 0.299483 15.3093 0.668913 15.3093H4.45286C4.82229 15.3093 5.12177 15.0166 5.12177 14.6555V10.9567C5.12177 10.5956 4.82229 10.3029 4.45286 10.3029C4.08343 10.3029 3.78395 10.5956 3.78395 10.9567V13.2562C2.61413 11.9609 1.94605 10.2842 1.94605 8.5C1.94605 4.5278 5.24037 1.30769 9.3041 1.30769C13.3678 1.30769 16.6622 4.5278 16.6622 8.5C16.6622 12.4722 13.3678 15.6923 9.3041 15.6923C8.93467 15.6923 8.63519 15.985 8.63519 16.3462C8.63519 16.7073 8.93467 17 9.3041 17ZM9.30415 4.18521C9.67358 4.18521 9.97306 4.47794 9.97306 4.83905V9.10093L12.1455 11.2244C12.4067 11.4797 12.4067 11.8937 12.1455 12.1491C11.8842 12.4044 11.4607 12.4044 11.1995 12.1491L8.83115 9.8341C8.70571 9.71148 8.63523 9.54517 8.63523 9.37176V4.83905C8.63523 4.47794 8.93472 4.18521 9.30415 4.18521Z" fill="#2C84D1"></path>
							</svg>
						</i>
						<span>
							от 2,5 до 14&nbsp;часов        </span>
					</div>
					<div class="banner-block__text">
						<div class="name">Обзорные экскурсии</div>
						<div class="text text-price">от 500 ₽/чел</div>
					</div>
					<a href="/obzornyye/" class="banner-block__btn">Посмотреть экскурсии</a>
				</div>
			</div>
		<?php endif ?>



        <?php if($term_id==79): ?>
            <?php
            $faq = [
                [
                    'title' => 'Какие дворцы и особняки можно посетить во время экскурсии?',
                    'text' => 'Во время наших экскурсий вы сможете посетить самые знаменитые достопримечательности Санкт-Петербурга и его пригородов. В городе вас ждут великолепные дворцы, такие как Зимний дворец — главная резиденция российских императоров и часть комплекса Эрмитажа, Строгановский и Юсуповский дворец.
Также наши экскурсии включают поездки в пригороды Санкт-Петербурга: <a href="/pushkin/">в Царское Село с его знаменитым Екатерининским дворцом</a>, где можно увидеть легендарную Янтарную комнату, и <a href="/pavlovsk/">в Павловск</a>, который славится своим великолепным парком и одноименным дворцом — бывшей летней резиденцией императоров. Не менее впечатляющими являются Большой дворец <a href="/petergof/">в Петергофе</a> с его великолепными фонтанами и Ораниенбаум — уникальный комплекс, сохранивший атмосферу XVIII века. '
                ],
                [
                    'title' => 'Нужно ли заранее бронировать экскурсию?',
                    'text' => 'Да, мы рекомендуем заранее бронировать экскурсии, чтобы гарантировать себе место в группе и удобное время для посещения. Так как многие из наших экскурсий пользуются большой популярностью, особенно в высокий сезон.
Кроме того, при заказе экскурсии через наш сайт вы получаете скидку. '
                ],
                [
                    'title' => 'Есть ли скидки для детей, студентов или пенсионеров?',
                    'text' => 'Да, для детей, студентов и пенсионеров у нас действуют специальные цены на экскурсии! Мы стремимся сделать посещение исторических резиденций Санкт-Петербурга доступным для всех и предлагаем скидки для этих категорий посетителей. '
                ],
                [
                    'title' => 'Что делать в случае плохой погоды?',
                    'text' => 'Не беспокойтесь о погоде — наши экскурсии проводятся на комфортных автобусах, что позволяет наслаждаться осмотром дворцов и особняков независимо от погодных условий. Внутренние осмотры дворцов и резиденций также возможны в любую погоду.'
                ],
                [
                    'title' => 'Какие языки доступны для экскурсий?',
                    'text' => 'Наши экскурсии проводятся не только на на русском, но и на английском, немецком, французском и испанском языках.  '
                ],
            ];
            ?>



        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>

		
       <?php if($term_id==24): ?>
            <?php
            $faq = [
                [
                    'title' => 'Есть ли ограничения по возрасту для участников новогодних экскурсий?',
                    'text' => 'Наши новогодние экскурсии подходят для всех возрастов! У нас есть программы как для взрослых, так и специальные экскурсионные программы для детей, которые идеально подойдут для школьных каникул. Вы можете взять ребенка с собой на любую дневную экскурсию и подарить ему незабываемые впечатления от праздничного Петербурга. Однако, если вы планируете участие в экскурсии в новогоднюю ночь, учитывайте, что для маленьких детей это может быть утомительно из-за позднего времени и длительности мероприятия. '
                ],
                [
                    'title' => 'Будет ли возможность сделать остановки для фотографий?',
                    'text' => 'Да, на нашем маршруте предусмотрены остановки для фотографирования! Вы сможете сделать снимки у всех новогодних елок города и в самых живописных местах Санкт-Петербурга. Наслаждайтесь видами и создавайте незабываемые воспоминания на каждой остановке! '
                ],
                [
                    'title' => 'Есть ли возможность арендовать автобус для частной новогодней экскурсии?',
                    'text' => 'Да, помимо групповых экскурсий, у нас есть возможность организовать индивидуальные новогодние экскурсии. Вы сможете выбрать маршрут, время и программу по вашему желанию, а наш гид сделает поездку еще более увлекательной.  '
                ],
                [
                    'title' => 'Есть ли экскурсии на других языках, кроме русского?',
                    'text' => 'Да, по предварительному заказу мы проводим экскурсии на английском, немецком, французском и испанском языках.'
                ],
                [
                    'title' => 'Как одеваться для новогодних экскурсий? Требуется ли теплая одежда?',
                    'text' => 'Для новогодних экскурсий по Санкт-Петербургу важно одеваться тепло и комфортно, так как, несмотря на то, что основная часть маршрута проходит в уютном автобусе, вам предстоит выйти на улицу для осмотра праздничных достопримечательностей и фотосессий. Мы рекомендуем выбирать многослойную одежду, теплые куртки, шапки, шарфы и перчатки, а также удобную зимнюю обувь, чтобы вам было комфортно даже в самую морозную погоду.  '
                ],
            ];
            ?>



        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>

		
		       <?php if($term_id==13): ?>
            <?php
            $faq = [
                [
                    'title' => 'Какие меры безопасности предусмотрены для школьников во время экскурсий?',
                    'text' => 'Во время экскурсий для школьников мы уделяем особое внимание безопасности детей. Все маршруты тщательно проверены, автобусы проходят регулярный технический осмотр и соответствуют требованиям безопасности. На всех маршрутах осуществляется контроль за группой, дети не остаются без присмотра.'
                ],
                [
                    'title' => 'Какие возрастные категории учащихся могут участвовать в экскурсиях?',
                    'text' => 'Наши экскурсии адаптированы для школьников всех возрастных категорий, от младших классов до старшеклассников. Программы разработаны с учетом возрастных особенностей, чтобы они были интересны и полезны как для начальной школы, так и для учеников среднего и старшего звена. Мы предлагаем интерактивные экскурсии, мастер-классы и квесты, которые соответствуют уровню подготовки и интересам детей разных возрастов, дополняя школьную программу и расширяя их знания о Санкт-Петербурге и его окрестностях. '
                ],
                [
                    'title' => 'Можно ли провести экскурсию на иностранном языке?',
                    'text' => 'Да, мы можем организовать экскурсии для школьников на иностранных языках. В зависимости от запроса группы, экскурсия может проводиться на английском, немецком, французском или другом языке. '
                ],
                [
                    'title' => 'Предусмотрены ли перерывы и отдых для детей во время длительных экскурсий?',
                    'text' => 'Да, во время длительных экскурсий для школьников предусмотрены регулярные перерывы для отдыха. Программы спланированы с учетом потребностей детей: есть время для перекусов, посещения туалета и активного отдыха.   '
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
				
  <?php if($term_id==28): ?>
            <?php
            $faq = [
                [
                    'title' => 'Есть ли питание во время однодневных экскурсий или нужно брать еду с собой?',
                    'text' => 'В программу большинства наших однодневных экскурсий входит посещение кафе, где вы сможете перекусить и отдохнуть. Питание оплачивается отдельно и не включена в общую цену экскурсии, поэтому, если вы предпочитаете, можно взять с собой легкий перекус. Обратите внимание на расписание экскурсии — в нем всегда указаны места и время остановок для обеда. '
                ],
                [
                    'title' => 'Какие документы нужно иметь при себе во время однодневной экскурсии?',
                    'text' => 'Лучше взять с собой паспорт или иной удостоверяющий личность документ. Если экскурсия включает посещение музеев или других объектов, предоставляющих льготы для определенных категорий граждан (дети, студенты, пенсионеры), не забудьте взять документы, подтверждающие ваш статус.  '
                ],
                [
                    'title' => 'Как организовано время на маршруте: есть ли свободное время для самостоятельного осмотра?',
                    'text' => 'Во время наших однодневных экскурсий предусмотрены остановки для осмотра достопримечательностей, фотографирования и посещения кафе. В большинстве маршрутов также выделяется время для самостоятельного осмотра, чтобы вы могли погулять, изучить интересующие вас объекты поближе или приобрести сувениры. Продолжительность свободного времени зависит от конкретной экскурсии и расписания, но мы всегда стараемся оставить достаточно времени, чтобы каждый участник смог получить максимум удовольствия от поездки. '
                ],
                [
                    'title' => 'Какой уровень физической подготовки необходим для участия в экскурсиях?',
                    'text' => 'Большинство наших однодневных экскурсий рассчитаны на участников с любым уровнем физической подготовки. Основная часть маршрута проходит на автобусе, а пешие прогулки и осмотры достопримечательностей занимают умеренное количество времени. '
                ],
                [
                    'title' => 'Можно ли оплатить экскурсию на месте или только через сайт?',
                    'text' => 'Чтобы забронировать экскурсию, необходимо внести полную оплату или предоплату в размере 30% от стоимости. Рекомендуем бронировать и оплачивать экскурсии заранее, чтобы гарантированно забронировать место в группе. '
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		
						
  <?php if($term_id==19): ?>
            <?php
            $faq = [
                [
                    'title' => 'Какой вид транспорта удобнее выбрать для поездки в Петергоф: автобус или метеор?',
                    'text' => 'Оба варианта транспорта имеют свои преимущества:<br>
					<ul>
					  <li>Автобус подходит тем, кто предпочитает наземный транспорт и хочет насладиться видами города по дороге. Автобусные экскурсии часто включают обзорную экскурсию. </li>
					  <li>Метеор - самый быстрый способ добраться до Петергофа, всего за 35-40 минут. По пути можно полюбоваться видами водных просторов Невы и Финского залива. Метеор особенно удобен в летнее время, когда можно насладиться прекрасными видами с воды. </li>
					</ul>
					'
                ],
                [
                    'title' => 'В какое время лучше всего посещать Петергоф, чтобы увидеть фонтаны в действии?',
                    'text' => 'Чтобы насладиться прогулкой по Петергофу и увидеть фонтаны в действии, лучше всего посещать парк в теплое время года — с 23 апреля по 16 октября. Фонтаны включаются ежедневно в 10:00 и работают до 19:45.  '
                ],
                [
                    'title' => 'Есть ли экскурсии, которые включают посещение других достопримечательностей, помимо Петергофа?',
                    'text' => 'Да, у нас есть экскурсии, которые позволяют посетить несколько пригородов в один день. Популярные варианты — это экскурсии «Петергоф + Кронштадт» и «Петергоф + Павловск». '
                ],
                [
                    'title' => 'Есть ли экскурсии с вечерними или ночными посещениями фонтанов?',
                    'text' => 'Ночных экскурсий в Петергоф нет, так как фонтаны работают до 19:30, а парк закрывается в 20:00. Для вечерних прогулок рекомендуем посещать Петергоф в летний период, чтобы успеть насладиться работой фонтанов и красотой парка перед его закрытием. '
                ],
                [
                    'title' => 'Можно ли посетить Петергоф зимой и какие объекты доступны для осмотра?',
                    'text' => 'Да, Петергоф доступен для посещения зимой. В это время можно прогуляться по Нижнему парку, который открыт ежедневно с 9:00 до 18:00, и вход в него бесплатный. Стоит учитывать, что часть скульптур будет укрыта. Также можно посетить Большой дворец, который работает круглый год. Зимой фонтаны не работают, но можно наслаждаться зимними видами дворцово-паркового ансамбля и осмотреть дворцы и павильоны.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==17): ?>
            <?php
            $faq = [
                [
                    'title' => 'Как организовано время на маршруте: будет ли свободное время для самостоятельного осмотра?',
                    'text' => 'На экскурсиях в Пушкин предусмотрено время для свободного осмотра. После основного маршрута с гидом у вас будет возможность самостоятельно прогуляться по паркам, посетить сувенирные лавки или просто отдохнуть в живописных уголках Царского Села.'
                ],
                [
                    'title' => 'Проводятся ли тематические экскурсии по истории Лицея, где учился Пушкин?',
                    'text' => 'Да, у нас есть комплексная экскурсия, которая включает посещение Екатерининского парка, дворца и Царскосельского лицея. В рамках этой программы гости познакомятся с историей лицея, где учился А.С. Пушкин, прогуляются по парку и смогут посетить знаменитую Янтарную комнату в Екатерининском дворце. '
                ],
                [
                    'title' => 'Есть ли скидки для школьников и студентов?',
                    'text' => 'Да, для школьников и студентов предусмотрены скидки на экскурсии. Напоминаем, что для входа в Екатерининский дворец необходимо иметь при себе документ, подтверждающий право на льготу, например, студенческий билет или ученическое удостоверение. '
                ],
                [
                    'title' => 'Проводятся ли экскурсии на иностранных языках?',
                    'text' => 'Да, мы проводим экскурсии на иностранных языках. Пожалуйста, уточняйте доступные языки и наличие гида на нужном языке при бронировании.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==27): ?>
            <?php
            $faq = [
                [
                    'title' => 'Требуется ли специальная физическая подготовка для участия в пешеходных экскурсиях?',
                    'text' => 'Нет, специальная физическая подготовка не требуется. Наши маршруты очень легкие, продолжительность прогулок составляет 1,5-2 часа, и мы идем в спокойном темпе, комфортном для всех участников.'
                ],
                [
                    'title' => 'Есть ли маршруты, которые подходят для семей с маленькими детьми?',
                    'text' => 'Да, у нас есть маршруты, которые отлично подойдут для семей с маленькими детьми. Мы выбираем безопасные и легкие маршруты без интенсивных нагрузок, чтобы прогулка была комфортной для всей семьи, включая самых маленьких участников. '
                ],
                [
                    'title' => 'Проводятся ли экскурсии в дождливую погоду, и что делать в случае плохих погодных условий?',
                    'text' => 'Экскурсии проводятся в любую погоду, включая дождливую. Мы рекомендуем одеваться по погоде и брать с собой зонт или дождевик. В случае сильного дождя гиды адаптируют маршрут, делая акцент на прогулках под навесами или кратковременными остановками в крытых местах.'
                ],
                [
                    'title' => 'Проводятся ли экскурсии на иностранных языках?',
                    'text' => 'Да, у нас есть экскурсии на нескольких иностранных языках. Вы можете заранее согласовать язык экскурсии при бронировании, чтобы выбрать программу с гидом, говорящим на нужном вам языке.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
<?php if($term_id==78): ?>
            <?php
            $faq = [
                [
                    'title' => 'Как обеспечивается безопасность пассажиров во время ночных прогулок на развод мостов?',
                    'text' => 'Все суда оснащены современными системами навигации и связи, спасательными средствами, такими как жилеты и круги, а также противопожарным оборудованием. Экипаж судна проходит специальную подготовку. На борту строго соблюдаются правила техники безопасности, а гиды и персонал всегда готовы оказать необходимую помощь пассажирам.'
                ],
                [
                    'title' => 'В какой период проводятся экскурсии на развод мостов?',
                    'text' => 'Экскурсии на разводение мостов проводятся с конца апреля до середины ноября, когда навигация на реках и каналах Санкт-Петербурга открыта и мосты разводятся для прохождения судов.  '
                ],
                [
                    'title' => 'Существуют ли возрастные ограничения для участия в групповых экскурсиях на развод мостов?',
                    'text' => 'Групповые экскурсии на развод мостов, как правило, не имеют строгих возрастных ограничений, но важно учитывать, что ночные прогулки могут быть утомительными для маленьких детей. '
                ],
                [
                    'title' => 'Есть ли экскурсии на иностранных языках?',
                    'text' => 'Да, групповые экскурсии на развод мостов в Санкт-Петербурге доступны на нескольких иностранных языках, включая английский, немецкий, французский и другие. Уточняйте доступные языковые варианты при бронировании.  '
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==10): ?>
            <?php
            $faq = [
                [
                    'title' => 'Какие маршруты теплоходных экскурсий наиболее популярны среди туристов?',
                    'text' => 'Среди популярных маршрутов теплоходных экскурсий по Санкт-Петербургу можно выделить <a href="/ekskursii-po-rekam-i-kanalam/">прогулки по рекам и каналам</a>, которые охватывают основные достопримечательности центра города. <a href="/excursiya-po-nochnomu-peterburgu">Ночные экскурсии на теплоходе</a> особенно востребованы в период белых ночей. Поездки в пригороды, такие как Кронштадт, Петергоф и крепость Орешек, тоже привлекают множество туристов. В дни городских праздников, например, на «Алые паруса» или день ВМФ, проводятся специальные рейсы, которые позволяют увидеть шоу с лучших позиций на воде.'
                ],
				[
                    'title' => 'Есть ли возможность присоединиться к группе в последний момент или необходимо бронировать заранее?',
                    'text' => 'Присоединиться к группе в последний момент возможно, если есть свободные места, но в высокий сезон, особенно во время белых ночей или праздников, рекомендуется бронировать заранее, так как билеты быстро раскупаются. '
                ],
                [
                    'title' => 'Как проходит рассадка на теплоходе?',
                    'text' => 'Во время групповых экскурсий на теплоходе рассадка обычно свободная, и пассажиры могут занять любые доступные места.  '
                ],
                [
                    'title' => 'Как организована безопасность на борту?',
                    'text' => 'Все суда оснащены спасательными жилетами и кругами, экипаж обучен действиям в чрезвычайных ситуациях, а флот регулярно проходит технические проверки на исправность.'
                ],
                [
                    'title' => 'Подходят ли экскурсии для детей?',
                    'text' => 'Да, многие теплоходные экскурсии подходят для детей. Они предлагают комфортные условия и интересные маршруты, которые могут быть интересны всей семье. Однако, лучше заранее уточнить детали и убедиться, что экскурсия соответствует возрасту и интересам ваших детей. '
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		
				<?php if($term_id==61): ?>
            <?php
            $faq = [
                [
                    'title' => 'Как часто обновляются экскурсионные программы и маршруты?',
                    'text' => 'Экскурсионные программы и маршруты обновляются регулярно, чтобы учитывать сезонные изменения, новые достопримечательности и отзывы клиентов. Обычно обновления происходят несколько раз в год, в зависимости от спроса и изменений в туристической инфраструктуре.'
                ],
                [
                    'title' => 'Есть ли возможность выбора мест в автобусе или они распределяются случайным образом?',
                    'text' => 'У нас свободная посадка, вы можете выбрать любые свободные места. '
                ],
                [
                    'title' => 'Какие меры принимаются для обеспечения комфорта и безопасности на автобусе?',
                    'text' => 'В автобусах имеются удобные кресла, кондиционеры и обогреватели. Кроме того, все автобусы проходят регулярное техническое обслуживание и оснащены системами безопасности, такими как ремни безопасности и пожарные огнетушители.'
                ],
                [
                    'title' => 'Каковы условия для проведения экскурсии в случае непогоды?',
                    'text' => 'Для автобусных экскурсий в случае непогоды мы продолжаем проводить экскурсии в обычном режиме, так как большинство времени проводится в комфортабельном автобусе. Однако, если программа включает остановки на открытом воздухе, мы можем скорректировать маршрут или заменить его на более защищенные участки, чтобы обеспечить комфорт и безопасность участников. '
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==15): ?>
            <?php
            $faq = [
                [
                    'title' => 'Как организовано питание во время экскурсии, или необходимо брать с собой еду?',
                    'text' => 'Во время продолжительных экскурсий мы заезжаем в кафе, но также вы можете взять с собой еду или перекусить в свободное время.'
                ],
                [
                    'title' => 'Можно ли на экскурсии взять с собой маленького ребенка?',
                    'text' => 'Большинство экскурсий длятся около 5-6 часов, а некоторые и дольше. Для маленьких детей такая продолжительность может оказаться утомительной. Однако в рамках каждой экскурсии предусмотрены перерывы, свободное время, во время которого можно отдохнуть, перекусить или найти более спокойные занятия для ребенка. '
                ],
                [
                    'title' => 'Существует ли возможность для проведения экскурсий на иностранных языках?',
                    'text' => 'Да, мы проводим экскурсии на иностранных языках. При бронировании вы можете выбрать экскурсию с гидом, который владеет нужным вам языком.'
                ],
                [
                    'title' => 'Какой уровень физической подготовки требуется для участия в экскурсиях по пригородам?',
                    'text' => 'Экскурсии по пригородам Санкт-Петербурга не требуют особой физической подготовки. Маршруты проходят в спокойном темпе, однако прогулки по паркам и дворцам могут включать длительное время на ногах и перемещение по лестницам.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==60): ?>
            <?php
            $faq = [
                [
                    'title' => 'Есть ли возрастные ограничения для участия в мистических экскурсиях?',
                    'text' => 'Возрастных ограничений для участия в мистических экскурсиях нет, однако некоторые рассказы и атмосфера могут быть пугающими для маленьких детей. Рекомендуется заранее учитывать содержание экскурсии и выбирать подходящую программу для младших участников.'
                ],
                [
                    'title' => 'Какой процент мистических историй, рассказанных на экскурсии, основан на реальных событиях?',
                    'text' => 'Примерно 70-80% мистических историй, рассказанных на экскурсиях, основаны на реальных исторических событиях и городских легендах, которые придают им дополнительную загадочность и достоверность.'
                ],
                [
                    'title' => 'Как организована транспортировка группы во время экскурсии?',
                    'text' => 'Мистические экскурсии проходят на комфортабельном автобусе. Это позволяет участникам удобно перемещаться между локациями, слушать экскурсовода в пути и оставаться в тепле и комфорте независимо от погодных условий.'
                ],
                [
                    'title' => 'Проводятся ли экскурсии в дождливую или холодную погоду?',
                    'text' => 'Да, экскурсии проводятся в любую погоду, включая дождливую и холодную. Поскольку транспортировка осуществляется на автобусе, участники остаются в тепле и комфорте во время поездки, а при выходах на улицу можно воспользоваться зонтом или теплой одеждой.'
                ],				
                [
                    'title' => 'Можно ли присоединиться к экскурсии в последний момент?',
                    'text' => 'Да, если есть свободные места, можно присоединиться к экскурсии в последний момент. Однако, чтобы гарантировать участие, лучше забронировать билеты заранее. Кроме того, при заказе через сайт действует скидка. '
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>		
		
		
		<?php if($term_id==9): ?>
            <?php
            $faq = [
                [
                    'title' => 'Включает ли экскурсия возможность выйти и прогуляться по достопримечательностям?',
                    'text' => 'Большинство достопримечательностей можно увидеть только с автобуса, но на некоторых экскурсиях предусмотрены остановки с посещением музеев, таких как Эрмитаж, Крейсер "Аврора", Петропавловская крепость и Юсуповский дворец.'
                ],
                [
                    'title' => 'Как организована безопасность на борту автобусов?',
                    'text' => 'Наши автобусы регулярно проходят техосмотр, оснащены ремнями безопасности, а за рулем опытные гиды. Все пассажиры застрахованы. '
                ],
                [
                    'title' => 'Включены ли входные билеты в музеи в стоимость экскурсии?',
                    'text' => 'Да, входные билеты в музеи включены в стоимость экскурсии, если они предусмотрены программой тура.'
                ],
                [
                    'title' => 'Есть ли ограничения по возрасту для участия в обзорных экскурсиях?',
                    'text' => 'Возрастных ограничений для участия в обзорных экскурсиях нет, они подходят для всех возрастов.'
                ],				
                [
                    'title' => 'Проводятся ли экскурсии в плохую погоду?',
                    'text' => 'Да, экскурсии проводятся в любую погоду, так как большую часть времени наши гости проводят в комфортабельных автобусах.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>	
		
		<?php if($term_id==59): ?>
            <?php
            $faq = [
                [
                    'title' => 'Можно ли присоединиться к экскурсии по Петропавловской крепости без предварительного бронирования?',
                    'text' => 'Да, к экскурсии по Петропавловской крепости можно присоединиться без предварительного бронирования, если есть свободные места в группе. Однако, чтобы гарантировать участие, мы рекомендуем бронировать заранее. Кроме того, при заказе через наш сайт действует скидка.'
                ],
                [
                    'title' => 'Предусмотрены ли скидки для студентов или пенсионеров на экскурсии по Петропавловской крепости?',
                    'text' => 'Да, для студентов, школьников и пенсионеров предусмотрены специальные цены на экскурсии. '
                ],
                [
                    'title' => 'Какой транспорт используется для автобусной части экскурсии?',
                    'text' => 'Для автобусной части экскурсии используется комфортный экскурсионный автобус, оснащенный кондиционером и микрофоном для гида, что обеспечивает приятную и удобную поездку по городу.'
                ],				
                [
                    'title' => 'На каких языках доступны экскурсии по Петропавловской крепости?',
                    'text' => 'Экскурсии по Петропавловской крепости проводятся на русском языке. Для иностранцев доступны экскурсии на английском и других языках по предварительному запросу.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==31): ?>
            <?php
            $faq = [
                [
                    'title' => 'Входит ли питание в программу экскурсии в Кронштадт?',
                    'text' => 'Нет, питание в программу экскурсии в Кронштадт не включено, но у вас будет возможность поесть во время свободного времени или приобрести перекус в местных кафе.'
                ],
                [
                    'title' => 'Как далеко находятся форты от Кронштадта и сколько времени занимает их посещение?',
                    'text' => 'Во время наших экскурсий мы посещаем только южные форты Кронштадта. Они находятся в пределах 2-8 км от города. Посещение каждого из них занимает от 30 минут до 1,5 часов, в зависимости от программы экскурсии и времени, выделенного на осмотр. '
                ],
                [
                    'title' => 'Какую одежду и обувь лучше выбрать для экскурсии в Кронштадт?',
                    'text' => 'Для экскурсии в Кронштадт рекомендуется выбирать удобную одежду и обувь, так как часть времени вы проведете на свежем воздухе, посещая форты и достопримечательности. Лучше всего подойдут спортивная или повседневная обувь с нескользящей подошвой. Также стоит одеваться многослойно, поскольку с Финского залива может быть холодный ветер, даже если в городе тепло.'
                ],
                [
                    'title' => 'Проводятся ли экскурсии в Кронштадт круглый год?',
                    'text' => 'Экскурсии в Кронштадт доступны круглый год, но в осенне-зимний период, когда закрыта навигация, доступны только автобусные экскурсии, без теплоходной прогулки.'
                ],				
                [
                    'title' => 'Разрешено ли фотографировать внутри Никольского собора?',
                    'text' => 'Фотографирование внутри собора разрешено и бесплатно.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>		

		<?php if($term_id==73): ?>
            <?php
            $faq = [
                [
                    'title' => 'Сколько времени занимает дорога на метеоре до Петергофа или Кронштадта?',
                    'text' => 'Дорога на метеоре до Петергофа занимает около 30-40 минут, до Кронштадта — примерно 1 час.'
                ],
                [
                    'title' => 'Могут ли пассажиры выходить на палубу во время движения метеора?',
                    'text' => 'Нет, метеор оборудован только закрытыми палубами для безопасности и комфорта. '
                ],
                [
                    'title' => 'Как организована безопасность на борту метеора?',
                    'text' => 'Судно оснащено спасательными жилетами и кругами. Экипаж проходит регулярное обучение по действиям в случае аварийных ситуаций.'
                ],				
                [
                    'title' => 'В какой период доступны экскурсии на метеоре?',
                    'text' => 'Экскурсии на метеоре доступны в период навигации, которая обычно длится с мая по ноябрь.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==90): ?>
            <?php
            $faq = [
                [
                    'title' => 'Включены ли в стоимость экскурсии входные билеты в Павловский дворец?',
                    'text' => 'Да, если посещение Павловского дворца предусмотрено в программе экскурсии, входные билеты в дворец уже включены в ее стоимость.'
                ],
				[
                    'title' => 'Разрешено ли фотографировать в Павловском дворце?',
                    'text' => 'В Павловском дворце разрешена любительская фотосъемка без использования штатива, монопода (ручного штатива) и дополнительного освещения. '
                ],
                [
                    'title' => 'Можно ли взять с собой детей на экскурсию в Павловск, и есть ли возрастные ограничения?',
                    'text' => 'Возрастных ограничений нет. Но учитите только, что экскурсии длятся около 5-6 часов, для маленьких детей это может быть утомительно.'
                ],
                [
                    'title' => 'Проводятся ли экскурсии в Павловск в зимний период?',
                    'text' => 'Да, экскурсии в Павловск проводятся в том числе зимой. Однако стоит учитывать погодные условия и выбрать теплую одежду для прогулки по парку.'
                ],				
                [
                    'title' => 'Есть ли на территории Павловского парка сувенирные магазины?',
                    'text' => 'Да, на территории Павловского парка есть сувенирные магазины, где можно приобрести памятные подарки и сувениры, связанные с Павловском и его историей.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==26): ?>
            <?php
            $faq = [
                [
                    'title' => 'Когда проходит экскурсия на праздник Алые паруса и что в себя включает?',
                    'text' => 'Экскурсия на праздник "Алые паруса" обычно проходит в июне, совпадая с датами выпускных. Она включает обзорную экскурсию по городу, а также возможность наблюдать праздничный фейерверк и шоу на воде с кораблем под алыми парусами.'
                ],
                [
                    'title' => 'Можно ли получить скидку на летние экскурсии?',
                    'text' => 'Да. Специальные цены предоставляются для школьников, студентов и пенсионеров. Также действует скидка при заказе через сайт.'
                ],
                [
                    'title' => 'Какие экскурсионные программы лучше всего подходят для тех, кто хочет увидеть все главные достопримечательности города за один день?',
                    'text' => 'Лучше всего для однодневного осмотра всех главных достопримечательностей подойдут обзорные автобусные экскурсии по Санкт-Петербургу. Они охватывают ключевые места, такие как Исаакиевский собор, Петропавловская крепость, Зимний дворец и другие знаковые объекты. Также можно дополнить экскурсию водной прогулкой по рекам и каналам, чтобы увидеть город с воды и насладиться его архитектурой с разных ракурсов.'
                ],				
                [
                    'title' => 'Предоставляются ли экскурсии на разных языках для иностранных туристов?',
                    'text' => 'По запросу мы проводим экскурсии на нескольких языках. Обычно можно выбрать экскурсовода, владеющего английским, немецким, французским и другими языками.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		
		<?php if($term_id==25): ?>
            <?php
            $faq = [
                [
                    'title' => 'Можно ли заказать экскурсию в новогоднюю ночь?',
                    'text' => 'Да. У нас есть специальная программа для новогодней ночи.'
                ],
				[
                    'title' => 'Есть ли у вас программы, включающие посещение музеев зимой?',
                    'text' => 'Да, у нас есть обзорные экскурсии с посещением Эрмитажа, крейсера «Аврора» и Юсуповского двореца. Также у есть тематические экскурсии, посвященные блокаде Ленинграда, с посещением соответствующих музеев. Экскурсии в пригороды включают осмотр дворцов, таких как Екатерининский и Павловский дворцы.'
                ],
                [
                    'title' => 'Входит ли в экскурсионные программы посещение катков или зимних ярмарок?',
                    'text' => 'Да, в некоторые зимние экскурсионные программы может быть включено посещение популярных катков или зимних ярмарок, особенно в праздничный сезон. Например, во время новогодних экскурсий можно посетить центральные площади с новогодними ярмарками, а также катки, расположенные в знаковых местах города. Подробности можно уточнить при бронировании конкретной программы.'
                ],
                [
                    'title' => 'Какие дворцы пригородов можно посетить зимой?',
                    'text' => 'Большой Петергофский, Екатерининский в Царском Селе, Павловский и Гатчинский дворцы. Несмотря на то, что парки и фонтаны закрыты, эти дворцы остаются открытыми для посещений, и зимние виды вокруг них добавляют особое очарование экскурсии.'
                ],				
                [
                    'title' => 'Какие достопримечательности Санкт-Петербурга особенно красивы зимой?',
                    'text' => 'Зимой в Санкт-Петербурге особенно красивы заснеженные Исаакиевский и Казанский соборы, Спас-на-Крови, а также дворцы на Дворцовой площади. Невский проспект, украшенный праздничными огнями, и заснеженные набережные придают городу сказочную атмосферу. Зимние виды Петропавловской крепости, замерзшая Нева и виды Васильевского острова также создают незабываемую картину зимнего Петербурга.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		<?php if($term_id==18): ?>
            <?php
            $faq = [
                [
                    'title' => 'Есть ли возможность посещать службы во время экскурсии?',
                    'text' => 'Да, в некоторых храмах и соборах можно посетить службы во время экскурсии, если они проводятся в то время, когда группа находится в храме.'
                ],
				[
                    'title' => 'Как лучше всего одеться для экскурсии по храмам?',
                    'text' => 'Для экскурсии по храмам рекомендуется одеваться скромно и с уважением к религиозным традициям. Женщинам желательно надеть юбку ниже колен и взять с собой платок, а мужчинам – избегать шорт.'
                ],
                [
                    'title' => 'Включены ли входные билеты в соборы в стоимость экскурсии?',
                    'text' => 'Да, если собор или храм, который вы посещаете, является музеем и вход в него платный, стоимость билетов уже включена в цену экскурсии.'
                ],
                [
                    'title' => 'Можно ли фотографировать внутри храмов и соборов?',
                    'text' => 'Чаще всего фотографировать можно, но правила зависят от конкретного места. В некоторых храмах можно фотографировать без вспышки. '
                ],				
                [
                    'title' => 'Можно ли купить свечи и иконы в храмах, которые посещаются во время экскурсии?',
                    'text' => 'Да, во многих храмах, которые мы посетим, есть церковные лавки, где можно купить свечи, иконы и другие религиозные товары.'
                ],
            ];
            ?>

        <div class="block_wrap">
            <div class="content-header">
                <h2 class="content-header__title">Популярные вопросы</h2>
            </div>
            <div class="faq">
                <?php foreach($faq as $k=>$item): ?>
                    <div class="faq__item">
                        <div class="faq__title_wrap">
                            <div class="faq__title">
                                <?=$item['title']?>
                            </div>
                            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"/>
                            </svg>
                        </div>
                        <div class="faq__text"><?=$item['text']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif;?>
		
		
		

	</div>
</section>
<?php get_footer(); // подключаем footer.php ?>

