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

	$term_all = get_term(3, 'excursion');
	
	$_terms_tax = get_field('menu_cats_new_custom', 'option');
	$terms_tax = [];
	foreach($_terms_tax as $item){
		if($item['is_title'] && $item['title']){
			$item['cat']->name = $item['title'];
		}
		$terms_tax[] = $item['cat'];
	}
?>
<section class="content content--bus">
  <div class="container">
  <h1 class="mainh">Экскурсии в Санкт-Петербурге <?php echo $h1_plus ?></h1>


	<div class="content__text--block">
		<p>
			Более 19 лет проводим незабываемые экскурсии в Санкт-Петербурге и окрестностях. Для наших туристов мы подобрали лучшие обзорные, авторские, тематические и эксклюзивные программы. Организуем <a href="/avtobusnyye-ekskursii/">автобусные туры по городу</a>. Гиды аккредитованы при Комитете культуры Петербурга. Имеем прямые договоры с государственными музеями и заповедниками. Состоим в общероссийском генеральном реестре турагентств. Покажем парадный и неформальный Санкт-Петербург во время автобусных и пеших экскурсий.

		</p>
	</div>

	<div class="filter__general_wrapper"><?php //ob_start(); ?>	
		<div class="g-scrolling-carousel">
			<div class="content__filters items">
			  <span class="content__filter active" data-slug="grup-ekskursii">
				Все экскурсии
				<span id="all_count"><?=$term_all->count?></span>
			  </span>
				 <?php $i=0; ?>
				 <?php if (isset($terms_tax)): ?>
					  <?php foreach($terms_tax as $item): ?>
							<a href="/<?=$item->slug?>/" class="content__filter" data-slug="<?=$item->slug?>">
								<?php echo str_replace('экскурсии', '', $item->name);?>
								<span><?=$item->count?></span>
							</a>
							<?php $i++; ?>
					  <?php endforeach; ?>				 	
				 <?php endif ?>

			  <a class="content__filter content__filter-more" href="#">Еще</a>
			</div>
		</div><?php //$output=ob_get_contents();ob_end_clean(); ?>
 <?php /*<span id="content_scrolling_carousel_observer" data-inf='<?php echo htmlspecialchars(json_encode($output), ENT_QUOTES, 'UTF-8'); ?>'></span>
<script>init_lazy_html_section('content_scrolling_carousel_observer');	</script>	*/ ?>
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
	
	<?php
		$count_posts = 13;
		$all_posts = get_posts( array(
			'numberposts' => $count_posts,
			'post_type' => 'tours',
			'suppress_filters' => true,
			'tax_query' => array(                                  // элемент (термин) таксономии 
				array(
					'taxonomy' => 'excursion',         // таксономия 
					'field' => 'slug',
					'terms'    => 'grup-ekskursii' // термин 
				)
			),
		) );
		//var_dump($all_posts);
	?>

	<div class="content__tours" data-offset="<?=$count_posts?>" id="tours">
		<?php $num = 0; ?>
		<?php foreach($all_posts as $key => $item): ?>
			<?php include('template-parts/loop-front-preview.php'); ?>
		<?php endforeach; ?>
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
		<h2 class="content-header__title"><?=count($myposts)?> отзывов туристов об экскурсиях по Петербургу</h2>
		<a href="/reviews" class="content-header__link">Смотреть все отзывы</a>
	</div>
	
	<div class="review_slider" id="review_slider"><?php ob_start(); ?>
	
		<div class="review_slider--container" id="content_review_slider">
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
				            	<a data-fancybox="gallery<?=$item->ID?>" class="review_slider--img_href"  href="<?php echo $image['url']; ?>">
				            	<img class="lazy" src="" data-src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
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
			
		</div>
	 <?php $output=ob_get_contents(); ob_end_clean(); ?>
 <span  id="content_review_slider_observer" data-inf='<?php echo htmlspecialchars(json_encode($output), ENT_QUOTES, 'UTF-8'); ?>'></span>
<script>init_lazy_html_section('content_review_slider_observer','lazy_init_review_slider');</script>
		<div class="review_slider--all_link">
			<a href="/reviews">Смотреть все отзывы</a>
		</div>

	</div>
	
	<!--/noindex-->

	<div class="content__text--block">
		
<div id="izuchayte_gorod">
	<h2>Изучайте город с нами!</h2>
	<p>Начать знакомство с городом рекомендуем с экскурсии по основным достопримечательностям Питера: мы прогуляемся по Невскому проспекту, посмотрим на знаменитый дом Зингера, в котором располагается главный городской книжный. Посетим Дворцовую и Сенатскую площадь, чтоб полюбоваться Зимним дворцом и памятником Медный всадник, которые неслучайно стали символами города на Неве. </p>

			
	<!-- блок с превью разделов -->
	<?php echo do_shortcode( '[banner_obzornyye id="9" img="/wp-content/uploads/2024/02/obzornie-avtobusnie.jpg" size="col-3" name="Обзорные" ]' );?>
	<?php echo do_shortcode( '[banner_obzornyye id="11" img="/wp-content/uploads/2024/02/nochnie-1.jpg" size="col-3" name="Ночные" ]' );?>
	<?php echo do_shortcode( '[banner_obzornyye id="59" img="/wp-content/uploads/2020/04/peter-and-paul-fortress-and-tomb-saint-petersburg-russia-1.jpg" size="col-3" name="Петропавловская крепость"]' );?>
	<?php echo do_shortcode( '[banner_obzornyye id="60" img="/wp-content/uploads/2024/02/misticheskie.jpg" size="col-3" name="Мистические" ]' );?>
	<?php echo do_shortcode( '[banner_obzornyye id="117" img="/wp-content/uploads/2020/12/winter-palace-palace-square-st-petersburg-winter-morning.jpg" size="col-3" name="Эрмитаж" ]' );?>
	<?php echo do_shortcode( '[banner_obzornyye id="18" img="/wp-content/uploads/2024/02/po-hramam.jpg" size="col-3" name="По храмам и соборам" ]' );?>
		
	<p>Если вы приехали в наш замечательный город в период белых ночей, не упустите возможность <a href="/nochnyye/">полюбоваться ночным городом</a> и, конечно же, <a href="/teplokhodnyye/">прокатиться на теплоходе под разводными мостами</a>.</p>
	<p>Коренных питерцев и всех, кто устал от парадно-туристического Петербурга приглашаем <a href="/avtorskiye/">на авторские тематические экскурсии</a>, посвященные религиозной жизни и мистическим тайнам города, прогулки по крышам и питерским дворикам.</p>
</div>

<h2>
	Пригороды Санкт-Петербурга
		</h2>
		<p>
			Всех, кто приехал в Питер на более долгий срок, приглашаем в <a href="/prigorodnyye/">путешествия по его пригородам</a>. Для вас откроют свои двери дворцы Пушкина, Павловска, Гатчины, заиграют на солнце фонтаны Петергофа и покорит своей сдержанной красотой Кронштадт.
		</p>
		<p>
			Вы можете выбрать один или посетить за одну экскурсию сразу 2 города. 
		</p>
		<!--  здесь превью разделов -->
		<?php echo do_shortcode( '[banner_obzornyye id="79" img="/wp-content/uploads/2023/09/interior-of-the-chinese-palace-1762-oranienbaum-saint-petersburg-russia.jpg" size="col-3" name="Дворцы и особняки" ]' );?>
        <?php echo do_shortcode( '[banner_obzornyye id="17" img="/wp-content/uploads/2024/02/pushkin.jpg" size="col-3" name="Царское село (Пушкин)" ]' );?>
        <?php echo do_shortcode( '[banner_obzornyye id="19" img="/wp-content/uploads/2024/02/petergof.jpg" size="col-3" name="Петергоф" ]' );?>
		<?php echo do_shortcode( '[banner_obzornyye id="31" img="/wp-content/uploads/2024/02/kronshtadt_min.jpg" size="col-3" name="Кронштадт" ]' );?>
		<?php echo do_shortcode( '[banner_obzornyye id="65" img="/wp-content/uploads/2020/12/ancient-vyborg-castle-in-winter-aerial-view-1.jpg" size="col-3" name="Выборг" ]' );?>
		<?php echo do_shortcode( '[banner_obzornyye id="90" img="/wp-content/uploads/2024/02/pavlovsk.jpg" size="col-3" name="Павловск" ]' );?>
        <?php //echo do_shortcode( '[tour_on_post ids="1323" tour_per_page="1"]' );?>
		
<p>Если вы хотите увидеть все главные достопримечательности и прикоснуться в истории нашего прекрасного города, приглашаем вас на экскурсии по СПб! Заказ по телефону <a href="tel:+78001015692">8 800 101-56-92</a>
	</p>
	</div>



	<?php // get_template_part('/template-parts/excursion-block-menu'); ?>
	<?php get_template_part('/template-parts/block/gids'); ?>

      <div class="content-header">
          <h2 class="content-header__title">Полезные новости и статьи <?php echo date('Y'); ?> года</h2>
          <a href="/blog" class="content-header__link blog-link--desktop">Перейти в Блог</a>
      </div>

        <? $posts = get_posts(array(
                'posts_per_page' => 8,
                'category' => 58
          )); ?>
<?php ob_start(); ?>
              <div class="wp-block-columns wrap blog-list-slider" id="blog-list-slider">


                      <?foreach( $posts as $post ): setup_postdata( $post );
                          ?>
                      <div class="wp-block-column globBorder">
                          <a href="<?php echo get_permalink()?>" class="newsPhoto">
                              <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" />
                              <?php // the_post_thumbnail(); ?>
                          </a>
                          <?php /* <p class="dateItemNews"><?php esc_html_e( '', 'swell-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'swell-lite' ) ); ?></p> */?>
                          <a href="<?php echo get_permalink()?>" class="h-100">
                              <h2 class="newsTitel" style="margin: 0px 0 15px 0;"><?php the_title(); ?></h2>
                          </a>
                          <a href="<?php echo get_permalink()?>">
                              <?php
                              $excerpt = get_the_content();
                              $excerpt = preg_replace(" ([.*?])",'',$excerpt);
                              $excerpt = strip_shortcodes($excerpt);
                              $excerpt = strip_tags($excerpt);
                              $excerpt = substr($excerpt, 0, 300);
                                //исключения (под высоту)
                                if(get_the_ID() == 8394){$excerpt = substr($excerpt, 0, 110);}
                                if(get_the_ID() == 16338){$excerpt = substr($excerpt, 0, 240);}

                              $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
                              $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
                              ?>
                              <p class="descNews"><?php echo $excerpt; ?></p>
                              <?php /*
								<p class="descNews"><?php echo wp_trim_words( get_the_content(), 20);?></p>
								*/ ?>
                          </a>
                      </div>
                      <?php endforeach; ?>
	                  
              </div>
                  <?php wp_reset_postdata(); ?>
<?php $output=ob_get_contents(); ob_end_clean(); ?>
 <span id="content_blog_list_slider_observer" data-inf='<?php echo htmlspecialchars(json_encode($output), ENT_QUOTES, 'UTF-8'); ?>'></span>
              
<script>init_lazy_html_section('content_blog_list_slider_observer','lazy_init_blog_list_slider');</script>

          <a href="/blog" class="content-header__link blog-link--mobile">Перейти в Блог</a>

<?php
	$int_mesta = get_field('int_mesta', 'option');
?>
<?php if($int_mesta): ?>
	<h2>Интересные места Санкт-Петербурга</h2>
	<div class="int_mesta">
		<?php foreach($int_mesta as $item): ?>
			<div class="int_mesta__item<?php if(!$item['ist']): ?> int_mesta__item-no_ist<?php endif ?>" style="background-image:url(<?=get_webp($item['img']['sizes']['newpost-thumb'], true, 373)?>)">
				<?php if($item['preview_link']): ?>
					<a class="int_mesta__link" href="<?=$item['preview_link']?>"></a>
				<?php endif ?>
				<div class="int_mesta__content">
					<div class="int_mesta__name"><?=$item['name']?></div>
					<?php if($item['ist'] && $item['ist_link']): ?>
						<a href="<?=$item['ist_link']?>" target="_blank" class="int_mesta__ist">Фото с официального сайта<br><?=$item['ist']?></a>
					<?php endif ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>
  
	
	
	            <?php
            $faq = [
                [
                    'title' => 'Есть ли скидки для школьников, студентов и пенсионеров?',
                    'text' => 'Да, мы предлагаем специальные скидки для школьников, студентов и пенсионеров. Эти скидки действуют на большинство наших экскурсионных программ. На страницах с конкретными экскурсиями вы можете увидеть актуальные цены для всех категорий.'
                ],
				[
                    'title' => 'Доступны ли экскурсии на иностранных языках?',
                    'text' => 'Да, мы предоставляем экскурсионные услуги на нескольких иностранных языках по запросу клиента. Сообщите о желаемом языке нашему менеджеру и мы подберем вам подходящего экскурсовода.'
                ],
                [
                    'title' => 'Какие достопримечательности включены в обзорные экскурсии?',
                    'text' => 'Обзорные экскурсии включают посещение основных достопримечательностей Санкт-Петербурга, таких как Невский проспект, дом Зингера, Дворцовая и Сенатская площади, Зимний дворец и памятник Медный всадник. В программу также могут входить посещения Исаакиевского собора, Спаса на Крови, Казанского собора и других знаковых мест города. Каждая экскурсия предлагает уникальный маршрут, который позволит вам увидеть как знаменитые памятники, так и менее известные, но не менее интересные уголки Петербурга.'
                ],
                [
                    'title' => 'Есть ли программы для тех, кто уже посещал основные достопримечательности?',
                    'text' => 'Да, для тех, кто уже посетил основные достопримечательности, мы предлагаем авторские тематические экскурсии. Они могут включать прогулки по питерским дворикам, экскурсии, посвященные религиозной жизни и мистическим тайнам города, а также уникальные туры по менее известным, но не менее интересным местам Санкт-Петербурга.  '
                ],		
	            [
                    'title' => 'Какую одежду и обувь лучше выбрать для экскурсии?',
                    'text' => 'В первую очередь, ваша одежда и обувь должна быть удобной и практичной. Выбирайте теплую и водоотталкивающую одежду, особенно если экскурсия проходит в межсезонье или зимой. Если планируется посещение храмов, лучше выберите закрытую обувь и скромную одежду. '
                ],	
                [
                    'title' => 'Есть ли специальные программы для школьных и студенческих групп?',
                    'text' => 'Да, мы предлагаем <a href="/detskiye/">специальные программы для школьников</a>. Эти экскурсии разрабатываются с учетом возрастных особенностей и образовательных потребностей учащихся. В программе могут быть включены интерактивные элементы, игры, конкурсы и задания, которые помогут сделать экскурсию более увлекательной и познавательной.'
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
	  </div>
</section>

		




<?php get_footer(); // подключаем footer.php ?>