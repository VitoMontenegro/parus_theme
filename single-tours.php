<?php
	$sopr = get_field('id_crm_eks');
	if($sopr){
		$df = get_field('date_from_dup');
		$dt = get_field('date_till_dup');
		
		if($df && $dt){
			$df = strtotime($df);
			$dt = strtotime($dt)+3600*24;
			$cur_time = time();
			if($cur_time>=$df && $cur_time<=$dt){
				$args = array(
					'post_type' => 'tours',
					'numberposts' => -1,
					'meta_key' => 'id_crm',
					'meta_value' => $sopr,
				);
				$posts = get_posts($args);

				if($posts && count($posts)){
					global $post;
					$post = $posts[0]; // перепишем глоб. `$post`
					setup_postdata($posts[0]);
				}
			}
		}
	}
	$term = 'indiv';
	$indiv = false;
	$tury = false;
	$t_name_exc = '';
	$ploschad_vosstaniya = false;
	if (get_the_terms( get_the_ID(), 'excursion' )){
		foreach(get_the_terms( get_the_ID(), 'excursion' ) as $item){ 
			if($item->slug=='grup-ekskursii'){
				$term = 'group';
			}
			if(!$t_name_exc)
				$t_name_exc = $item->slug;
			if($item->term_id==2){
				$indiv = true;
			}
			if($item->term_id==33){
				$term = 'tury';
				$tury = true;
				$priceMain = (get_field('turi_price'))? number_format(get_field('turi_price'), 0, ',', ' ').' руб.' : 'по запросу';
				$mtxt = 'от';
				$turipriceold = get_field('turi_price_old');
			}
			if($item->term_id==41){
				$lang = 'en';
				$priceMain = ($priceMain=='по запросу')?'on request':str_replace(['руб','от'], ['rub','from'], $priceMain);
				$t_name_exc_en = $item->slug;
			}
			
			if($item->term_id==64 || $item->term_id==66 || $item->term_id==68 || $item->term_id==68 || get_the_ID()==13467 || get_the_ID()==1332){
				$ploschad_vosstaniya = true;
			}
		}
	}


	$reqtext = ($lang=='en') ? 'on request' : 'по запросу';
	get_header(); // подключаем header.php ?>

	<?php
		$sopr = get_field('id_crm_eks');
		if($sopr){
			$df = get_field('date_from_dup');
			$dt = get_field('date_till_dup');
			
			if($df && $dt){
				$df = strtotime($df);
				$dt = strtotime($dt)+3600*24;
				$cur_time = time();
				if($cur_time>=$df && $cur_time<=$dt){
					$args = array(
						'post_type' => 'tours',
						'numberposts' => -1,
						'meta_key' => 'id_crm',
						'meta_value' => $sopr,
					);
					$posts = get_posts($args);

					if($posts && count($posts)){
						global $post;
						$post = $posts[0]; // перепишем глоб. `$post`
						setup_postdata($posts[0]);
					}
				}
			}
		}
		
		$theme_url = get_stylesheet_directory_uri();
		$h1 = (get_field('h1'))?get_field('h1'):get_the_title();
		$galery = get_field('galery');
		foreach($galery as $k => $item){
			
			if(substr($galery[$k]['url'],-3) == 'png'){
				$galery[$k]['url'] = png_to_jpg($galery[$k]['url']);
			}
			if(substr($galery[$k]['sizes']['medium'],-3) == 'png'){
				$galery[$k]['sizes']['medium'] = png_to_jpg($galery[$k]['sizes']['medium']);
			}
		}
		
		$galery_first = $galery[0];
		unset($galery[0]);
		$galery_first['url'] = (isset($galery_first['url']))?$galery_first['url']:$theme_url.'/assets/images/340719-200.png';
		$periodicity = (get_field('periodicity'))?get_field('periodicity'):$reqtext;
		$start_time = (get_field('start_time'))?get_field('start_time'):$reqtext;
		$duration = (get_field('duration'))?correctTime(get_field('duration')):$reqtext;	
		$area = (get_field('area'))?get_field('area'):false;	
		$sticker_background = get_field('sticker_background') ? get_field('sticker_background') : '';
		$sticker_text = get_field('sticker_text') ? get_field('sticker_text') : '';
		$id_crm = get_field('id_crm') ? get_field('id_crm') : '';	
		$after_gates = get_field('after_gates');
		$video_after_gates = get_field('video_after_gates');
		$video_after_gates_dzen = get_field('video_after_gates_dzen');
		$video_after_gates_dzen_more = get_field('video_after_gates_dzen_more');
		$json_decode = json_decode(get_post_meta(get_the_ID(), 'tickets', 1))[0];
		$sopr = get_field('id_crm_eks');
		if(!$json_decode && $sopr){
			$sopr_post = get_posts([
				'post_type' => 'tours',
				'post_status' => 'any',
				'meta_query' => [
					[
						'key' => 'id_crm',
						'value' => $sopr
					]
				]
			])[0];
			$json_decode = json_decode(get_post_meta($sopr_post->ID, 'tickets', 1))[0];
		}		
		$json_decode_start_date = explode('.', $json_decode->date);
		$start_date = $json_decode_start_date[2] . '-' . $json_decode_start_date[1] . '-' .$json_decode_start_date[0];
		$start_tickets = $json_decode->tickets;
		$addr = (get_post_meta(get_the_ID(), 'on_address', 1)) ? 'Московский вокзал или Невский, 17' : 'Московский вокзал';

		if(!$id_crm && get_field('departure_address', $item->ID)) {			
			$addr = get_field('departure_address', $item->ID);
		}
		$n20 = [1296, 1370, 4107, 4285, 1390, 1382, 17551, 11655, 1302]; 
		if(in_array(get_the_ID(), $n20) && get_post_meta(get_the_ID(),'on_address', 1)) {
			$addr = ' Невский, 20';
		}
		if (get_the_ID() == '4649') {
			$addr = 'Университетская наб., 13';
		}
		if (get_the_ID() == '4386' || get_the_ID() == '1326' || get_the_ID() == '4322') {
			$addr = 'Дворцовая площадь';
		}
		if (get_the_ID() == '8257') {
			$addr = 'Дворцовая наб., 36';
		}
		if (get_the_ID() == '4990' || get_the_ID() == '7015' || get_the_ID() == '8778' || get_the_ID() == '3288' || get_the_ID() == '1305' 
			|| get_the_ID() == '1332' || get_the_ID() == '1366' || $ploschad_vosstaniya) {
			$addr = 'пл. Восстания, Лиговский пр-т, 10';
		}
		if (get_the_ID() == '20742' && get_field('departure_address')) {
			$addr = get_field('departure_address');
		}

		if (!$tury) {
			if (get_field('p_shkolniki_sale')) {
				$price = 'от '.get_field('p_shkolniki_sale').' руб.';
				$priceMain = 'от <span class="old-price-front main-price">'. get_field('p_shkolniki') .'</span> <span class="single_ajax_price">'.get_field('p_shkolniki_sale').'</span> руб.';
			} elseif ( get_field('p_shkolniki')) {
				$priceMain = $price = 'от <span class="single_ajax_price">'.get_field('p_shkolniki').'</span> руб.';
			} elseif ( get_field('p_doshkolniki_sale')) {
				$price = 'от '.get_field('p_doshkolniki_sale').' руб.';
				$priceMain = 'от <span class="old-price-front main-price">'. get_field('p_doshkolniki') .'</span> <span class="single_ajax_price">' .get_field('p_doshkolniki_sale').'</span> руб.';
			} elseif ( get_field('p_doshkolniki')) {
				$priceMain = $price = 'от <span class="single_ajax_price">'.get_field('p_doshkolniki').'</span> руб.';
			} else {
				$priceMain = $price = $reqtext;
			}
		}

		if (get_field('recommended')) {
			$recs = get_posts( array(
				'post_type' => 'tours',
				'include' => get_field('recommended')
			) );
		} else {
			if ($t_name_exc_en) {
				$recs = get_posts( array(
					'numberposts' => -1,
					'post_type' => 'tours',
					'orderby'   => 'rand',
					'suppress_filters' => true,
					'tax_query' => array(                                  // элемент (термин) таксономии 
						array(
							'taxonomy' => 'excursion',         // таксономия 
							'field' => 'slug',
							'terms'    => $t_name_exc_en // термин 
						)
					),
				) );			// code...
			} else {
				if($cat_id = get_field('cat_hk')){
					$termhk = get_term($cat_id);
					$t_name_exc = $termhk->slug;
				}
				$recs = get_posts( array(
					'numberposts' => -1,
					'post_type' => 'tours',
					'orderby'   => 'rand',
					'post__not_in'   => array(get_the_ID()),
					'suppress_filters' => true,
					'tax_query' => array(                                  // элемент (термин) таксономии 
						array(
							'taxonomy' => 'excursion',         // таксономия 
							'field' => 'slug',
							'terms'    => $t_name_exc // термин 
						)
					),
				) );
				
			}
		}
		
		if(count($recs)<3){
			if(!is_array($recs))
				$count = 0;
			else
				$count = count($recs);
			$recsmerge = get_posts( array(
					'numberposts' =>4-$count,
					'post_type' => 'tours',
					'orderby'   => 'rand',
					'post__not_in'   => array(get_the_ID()),
					'suppress_filters' => true
				) );
			$recs = array_merge($recs, $recsmerge);
		}

		$recs2 = get_posts( array(
			'numberposts' => -1,
			'post_type' => 'tours',
			'orderby'   => 'rand',
			'suppress_filters' => true,
			'tax_query' => array(                                  // элемент (термин) таксономии 
				array(
					'taxonomy' => 'excursion',         // таксономия 
					'field' => 'slug',
					'terms'    => 'tury' // термин 
				)
			),
		) );
		
			
	if(get_field('neva_id')){
		$priceMain = $price = 'от <span class="single_ajax_price">'.get_field('neva_childprice').'</span> руб.';
	}
	?>

	<section class="content content--group-tour-page" itemprop="event" itemscope itemtype="http://schema.org/Event">
		<meta itemprop="eventAttendanceMode" content="offline">
	  	<meta itemprop="inLanguage" content="ru-RU">

	  	<div class="container">
	  		<?php if (!$tury): ?>
		        <h1><?=$h1?></h1>
	  		<?php else: ?>
				<div class="slider-content banner-content">
					
		        </div>
	  			<h1 style="margin-top: 30px;margin-bottom: 15px;"><?=$h1?></h1>	
	  		<?php endif ?>

	        <div class="content__header">
		      	<div class="content__left">

                    <button class="wish-btn content__tour__wish-btn<? if($_COOKIE["product"]){ if(in_array($post->ID,$_COOKIE["product"])){echo' is-active';}}?><?php if($galery && count($galery)>3): ?> content__image-wrapper-slider<?php endif ?>" data-wp-id="<?php echo $post->ID; ?>" data-title="<?php the_title(); ?>">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <g clip-path="url(#clip0_2_41)">
                                    <path d="M7.50002 13.9865C7.42414 13.9865 7.34829 13.9669 7.28032 13.9276C7.20649 13.885 5.45246 12.8666 3.67327 11.3321C2.61876 10.4227 1.777 9.52061 1.17144 8.65108C0.387805 7.52591 -0.00626644 6.44362 9.09643e-05 5.43426C0.00753236 4.25975 0.428205 3.1552 1.18471 2.32405C1.95398 1.4789 2.9806 1.01349 4.07551 1.01349C5.47874 1.01349 6.76168 1.79952 7.50005 3.0447C8.23841 1.79955 9.52135 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9936 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53565 12.866 7.79422 13.8844 7.72094 13.927C7.65265 13.9666 7.57631 13.9865 7.50002 13.9865V13.9865Z" fill="#A5A5A5"/>
                                </g>
                            </svg>
                        </i>
                    </button>

					<?php if($galery && count($galery)>3) : ?>
						<?php $more_img = (count($galery)>4); ?>
						<div class="single_gal">
							<div class="single_gal__vertical">
								<a data-fancybox="single" href="<?=get_webp($galery[1]['url'])?>" style="background-image:url(<?=$galery[1]['sizes']['medium']?>)"></a>
								<a data-fancybox="single" href="<?=get_webp($galery[2]['url'])?>" style="background-image:url(<?=$galery[2]['sizes']['medium']?>)"></a>
							</div>
							<a data-fancybox="single" class="single_gal__big" href="<?=get_webp($galery_first['url'])?>" style="background-image:url(<?=$galery_first['sizes']['large']?>)">
								<button class="wish-btn content__tour__wish-btn<? if($_COOKIE["product"]){ if(in_array($post->ID,$_COOKIE["product"])){echo' is-active';}}?>" data-wp-id="<?php echo $post->ID; ?>" data-title="<?php the_title(); ?>">
									<i class="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
											<g clip-path="url(#clip0_2_41)">
												<path d="M7.50002 13.9865C7.42414 13.9865 7.34829 13.9669 7.28032 13.9276C7.20649 13.885 5.45246 12.8666 3.67327 11.3321C2.61876 10.4227 1.777 9.52061 1.17144 8.65108C0.387805 7.52591 -0.00626644 6.44362 9.09643e-05 5.43426C0.00753236 4.25975 0.428205 3.1552 1.18471 2.32405C1.95398 1.4789 2.9806 1.01349 4.07551 1.01349C5.47874 1.01349 6.76168 1.79952 7.50005 3.0447C8.23841 1.79955 9.52135 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9936 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53565 12.866 7.79422 13.8844 7.72094 13.927C7.65265 13.9666 7.57631 13.9865 7.50002 13.9865V13.9865Z" fill="#A5A5A5"/>
											</g>
										</svg>
									</i>
								</button>
							</a>
							<a data-fancybox="single" class="single_gal__half" href="<?=get_webp($galery[3]['url'])?>" style="background-image:url(<?=$galery[3]['sizes']['medium']?>)"></a>
							<a data-fancybox="single" class="single_gal__half" href="<?=get_webp($galery[4]['url'])?>" style="background-image:url(<?=$galery[4]['sizes']['medium']?>)">
								<?php if($more_img): ?>
									<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
									  <path fill="#ffffff" d="M6.1,6v16H22V6H6.1z M20,17.8H8.1V8H20V17.8z"></path>
									  <polygon fill="#ffffff" points="18.9 2 2 2 2 18.9 4 18.9 4 4 18.9 4"></polygon>
									</svg>
								<?php endif ?>
							</a>
						
							<?php if($more_img): ?>
								<?php foreach($galery as $k=>$item): ?>
									<?php if($k<5) continue; ?>
									<a data-fancybox="single" style="display:none" href="<?=get_webp($item['url'])?>"></a>
								<?php endforeach ?>
							<?php endif ?>
						</div>
					<?php endif ?>

		            <!-- SLIDER -->
		            <div class="content__image-wrapper slider-hero<?php if($galery && count($galery)>3): ?> content__image-wrapper-slider<?php endif ?>">
				        <?php if(get_field('galery')[0]): ?>
							<?php $caption = ($galery_first['caption'])?$galery_first['caption']:'Фотография размещена в редакционных целях и не предназначена для коммерческого использования'; ?>
							<?php $caption = ($galery_first['caption'])?$galery_first['caption']:''; ?>
							<div>
							<div class="content__image-caption"><?=$caption?></div>
							<img
				                <?php /* src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg"
				                data-src="<?=$galery_first['url']?>" */ ?>
				                src="<?=get_webp($galery_first['url'])?>"
				                alt="<?=$galery_first['alt']?>"
				                title="<?=$galery_first['title']?>"
				                class="content__image" 
				                modal-img-id="0" 
								data-caption="<?=$caption?>" 
							/>
							</div>
			        	<?php elseif (has_post_thumbnail()): ?>
							<?php
								$image_id = get_post_thumbnail_id(get_the_ID());
								$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
							?>
			        		<img
				                <?php /* src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg"
				                data-src="<?php echo get_the_post_thumbnail_url(get_the_ID() , 'full');?>" */ ?>
				                src="<?php echo get_the_post_thumbnail_url(get_the_ID() , 'full');?>"
				                alt="<?=$image_alt?>"
				                title="tour-image"
				                <?php /* class="content__image lazy" */ ?>
				                class="content__image"
				                modal-img-id="0"
				              />	
				        <?php else: ?>
				            <img
				                <?php /* src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg"
				                data-src="<?=$galery_first['url']?>" */ ?>
				                src="<?=$galery_first['url']?>"
				                alt="<?=$galery_first['alt']?>"
				                title="<?=$galery_first['title']?>"
				                <?php /* class="content__image lazy" */ ?>
				                class="content__image"
				                modal-img-id="0"
				              />
			        	<?php endif ?>

					  	<?php if(get_field('sticker', $post->ID)): ?>
						  	<?php if (get_field('sticker', $post->ID) == 'Для детей'): ?>
								<?php $backgound =  $sticker_background ? $sticker_background : "#904aca"; ?>
								<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
							  	<span class="stick" style="background: <?php echo $backgound;?>">
							  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  		<span class="text" style="color: <?php echo $color;?>"><?php echo get_field('sticker', $post->ID); ?></span>				  		
							  	</span>
						  	<?php elseif(get_field('sticker', $post->ID) == 'Эксклюзив'): ?>	
								<?php $backgound =  $sticker_background ? $sticker_background : "#d62c32"; ?>
								<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
							  	<span class="stick" style="background: <?php echo $backgound;?>">
							  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  		<span class="text" style="color: <?php echo $color;?>"><?php echo get_field('sticker', $post->ID); ?></span>				  		
							  	</span>
						  	<?php else: ?>	
								<?php $backgound =  $sticker_background ? $sticker_background : "#9e14d5"; ?>
								<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
							  	<span class="stick" style="background: <?php echo $backgound;?>">
							  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  		<span class="text" style="color: <?php echo $color;?>"><?php echo get_field('sticker', $post->ID); ?></span>				  		
							  	</span>
						  	<?php endif ?>	
						<?php endif ?>

						<?php $top = get_field('sticker', $post->ID) ? 60 : 15; ?>
						<?php if(have_rows('stick_group', $post->ID)): ?>
							<?php while ( have_rows('stick_group', $post->ID) ) : the_row(); ?>
								<?php if (get_sub_field('sticker')): ?>
									<?php $backgound =  get_sub_field('sticker_background') ? get_sub_field('sticker_background') : "#9e14d5"; ?>
		
									<?php $color = get_sub_field('sticker_text') ? get_sub_field('sticker_text') : "#fff"; ?>
							  		<span class="stick" style="background: <?php echo $backgound;?><?php echo ';top: '.$top.'px;';?>">
							  			<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  			<span class="text" style="color: <?php echo $color;?>"><?php the_sub_field('sticker'); ?></span>					  				
						  			</span>
						  			<?php $top += 45; ?>									
								<?php endif ?>
								
							<?php endwhile; ?>
						<?php endif ?>


					 	<?php if ((get_field('p_doshkolniki_sale', $post->ID) || get_field('p_shkolniki_sale', $post->ID) || get_field('p_studenty_sale', $post->ID) || get_field('p_vzroslie_sale', $post->ID) || get_field('p_pensionery_sale', $post->ID) || get_field('p_vzroslie_inostrancy_sale', $post->ID) || get_field('p_studenty_inostrancy_sale', $post->ID) || get_field('p_deti_inostrancy_sale', $post->ID)) && $post->ID !=4386  ): ?>
					 		<?php if (get_field('includ_sales', 'options')): ?>
					 			<?php 

								if (get_field('p_doshkolniki_sale', $post->ID)) {
									$priceold = get_field('p_doshkolniki', $post->ID);
									$pricenew = get_field('p_doshkolniki_sale', $post->ID);
									$sticker_backgrounds =  '#904aca';
									$sticker_txt = get_field('sticker_text', 'options') ? get_field('sticker_text', 'options') : '#fff';


								} elseif (get_field('p_shkolniki_sale', $post->ID)){
									$priceold = get_field('p_doshkolniki', $post->ID);
									$pricenew = get_field('p_shkolniki_sale', $post->ID);

								}  
								$newprice = 100-($pricenew*100/$priceold);

					 			 ?>
							  	<span class="stick" style="background: <?php echo $sticker_backgrounds; ?><?php if (get_field('sticker', $post->ID) || have_rows('stick_group', $post->ID)) {echo ';top: '. $top .'px;';}?>">
							  		<span class="quatr" style="background: <?php echo $sticker_backgrounds; ?>"></span>
							  		<span class="text" style="font-weight: 500;color: <?php echo $sticker_txt; ?>">Скидка -<?php echo round($newprice);?>% c 23 по 30 ноября</span>						  		
							  	</span>	
					 		<?php else: ?>
								<?php $backgound = "#45c451"; ?>
								<?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
								<?php
									if(get_field('p_shkolniki') && get_field('p_shkolniki_sale')){
										$sale_sum = get_field('p_shkolniki')-get_field('p_shkolniki_sale');
									}
								?>
							  	<span class="stick" style="background: <?php echo $backgound;?><?php if (get_field('sticker', $post->ID) || have_rows('stick_group', $post->ID)) {echo ';top: '. $top .'px;';}?>">
							  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  		<span class="text" style="color: <?php echo $color;?>">
										<?php if(isset($sale_sum)): ?>
											Экономия от <?=$sale_sum?> руб.
										<?php else: ?>
											Скидка на билеты
										<?php endif ?>
									</span>						  		
							  	</span>
						  	<?php endif ?>
					  	<?php endif ?>
						<?php if($galery) : ?>
							<?php foreach ($galery as $k=>$item): ?>
								<?php $caption = ($item['caption'])?$item['caption']:'Фотография размещена в редакционных целях и не предназначена для коммерческого использования'; ?>
								<?php $caption = ($item['caption'])?$item['caption']:''; ?>
								<?php /* <img modal-img-id="<?=$k?>" src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" data-src="<?=$item['sizes']['thumbnail']?>" alt="<?=$item['title']?>" class="lazy" /> */ ?>
								<div style="position:relative">
									<?php if($caption): ?>
										<div class="content__image-caption"><?=$caption?></div>
									<?php endif ?>
									<img modal-img-id="<?=$k?>" src="<?=$item['sizes']['large']?>" alt="<?=$item['title']?>" title="<?=$item['title']?>" class="" />
								</div>
							<?php endforeach; ?>
						<?php endif ?>
		            </div>

					<?php if($galery) : ?>
						<div class="content__slider slider<?php if($galery && count($galery)>3): ?> content__image-wrapper-slider<?php endif ?>">
						  <button class="slider__prev"></button>
						  <div class="slider__images">
							<div class="slider__images-inner">
								<div class="modal-images-fullsize">
									<?php $caption = ($galery_first['caption'])?$galery_first['caption']:'Фотография размещена в редакционных целях и не предназначена для коммерческого использования'; ?>
									<div>
									<img src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" data-src="<?=$galery_first['url']?>" alt="" class="lazy" />
									<div class="modal-images-caption"><?=$caption?></div>
									</div>
									<?php if($galery): ?>
										<?php foreach ($galery as $k=>$item): ?>
											<?php $caption = ($item['caption'])?$item['caption']:'Фотография размещена в редакционных целях и не предназначена для коммерческого использования'; ?>
											<div>
											<img src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" data-src="<?=$item['url']?>" alt="<?=$item['title']?>" title="<?=$item['title']?>" class="lazy" />
											<div class="modal-images-caption"><?=$caption?></div>
											</div>
										<?php endforeach; ?>  
									<?php endif; ?>
								</div>
								<?php if($galery): ?>
									<?php foreach ($galery as $k=>$item): ?>
										<?php /* <img modal-img-id="<?=$k?>" src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" data-src="<?=$item['sizes']['thumbnail']?>" alt="<?=$item['title']?>" class="lazy" /> */ ?>
										<img modal-img-id="<?=$k?>" src="<?=$item['sizes']['thumbnail']?>" alt="<?=$item['title']?>" title="<?=$item['title']?>" class="" />
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						  </div>
						  <button class="slider__next"></button>
						</div>
					<?php elseif(has_post_thumbnail()) :?>
						<div class="modal-images-fullsize">
							<img src="<?php echo get_the_post_thumbnail_url(get_the_ID() , 'full');?>" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID() , 'full');?>" alt="" class="lazy" />
						</div>
					<?php endif ?>

                    <?php $indiv_prices = get_field('indiv_price'); ?>

                    <?php if((count($indiv_prices) >= 2) and (!$tury)){ //если большая высота сайдбара ?>
                        <div class="features for-pc features--padding" id="features">
                            <div class="f-item">
                                <div class="f-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumb-up.svg" alt="Бесплатная отмена бронирования">
                                </div>
                                <div class="f-header">
                                    <?php if($lang=='en'): ?>
                                        Free cancellation<br>of booking till<br>24 hours
                                    <?php else: ?>
                                        <a style="font-size: 16px" href="/usloviya/" target="_blank">Бесплатная отмена бронирования за 24ч</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="f-item">
                                <div class="f-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/bus.svg" alt="Собственный транспорт">
                                </div>
                                <div class="f-header">
                                    <a style="font-size: 16px" href="/avtopark/" target="_blank">
                                        <?php if($lang=='en'): ?>
                                            Our own modern<br>transport
                                        <?php else: ?>
                                            Современный транспорт
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="f-item">
                                <div class="f-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/museum.svg" alt="Вход без очереди в музеи">
                                </div>
                                <div class="f-header" style="font-size: 16px">
                                    <a style="font-size: 16px" href="/muzei-bez-ocheredi/" target="_blank">
                                        <?php if($lang=='en'): ?>
                                            Entering<br>to the museums<br>without queue.
                                        <?php else: ?>
                                            Вход без очереди<br>в музеи
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="f-item">
                                <?/* <a class="review_slider--img_href" href="<?php echo get_stylesheet_directory_uri(); ?>/img/fasad.jpg">*/?>
                                <div class="review_slider--img_href">
                                    <div class="f-icon">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/office.svg" alt="24 часа с вами на связи">
                                    </div>
                                    <div class="f-header" style="font-size: 16px; color: #0099ce;">
                                        <?php if($lang=='en'): ?>
                                            Our office <br>in the city center
                                        <?php else: ?>
                                            Офис в центре города
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
					                    <?php if((count($indiv_prices) < 2) and (!$tury)): //обычная высота сайдбара?>
				     	<div class="features for-pc" id="features">
						    <div class="f-item">
						        <div class="f-icon">
						            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumb-up.svg" alt="Бесплатная отмена бронирования">
						        </div>
						        <div class="f-header">
									<?php if($lang=='en'): ?>
										Free cancellation<br>of booking till<br>24 hours
									<?php else: ?>
										<a style="font-size: 16px" href="/usloviya/" target="_blank">Бесплатная отмена бронирования за 24ч</a>
									<?php endif; ?>					
								</div>
						    </div>
						    <div class="f-item">
						        <div class="f-icon">
						            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/bus.svg" alt="Собственный транспорт">
						        </div>
						        <div class="f-header">
									<a style="font-size: 16px" href="/avtopark/" target="_blank">
										<?php if($lang=='en'): ?>
											Our own modern<br>transport
										<?php else: ?>
											Современный транспорт
										<?php endif; ?>						
									</a>
								</div>
						    </div>
						    <div class="f-item">
						        <div class="f-icon">
						            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/museum.svg" alt="Вход без очереди в музеи">
						        </div>
						        <div class="f-header" style="font-size: 16px">
									<a style="font-size: 16px" href="/muzei-bez-ocheredi/" target="_blank">
									<?php if($lang=='en'): ?>
										Entering<br>to the museums<br>without queue.
									<?php else: ?>
										Вход без очереди<br>в музеи
									<?php endif; ?>
									</a>
								</div>
						    </div>
							<div class="f-item">
								<div class="review_slider--img_href">
						        <div class="f-icon">
						            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/office.svg" alt="24 часа с вами на связи">
						        </div>
				                <div class="f-header" style="font-size: 16px; color: #0099ce;">
										<?php if($lang=='en'): ?>
											Our office <br>in the city center
										<?php else: ?>
											Офис в центре города
										<?php endif; ?>	
								</div>
								</div>
						    </div>
						</div>
					<?php endif; ?>
		      	</div>

		      	<div class="content__info tours">
					<div class="content__info__wrap tours">
						<div class="content__wrap-price">
							<?php if($indiv_prices): ?>
								<div>
									<?php if($indiv): ?>
										<p class="content__price">Стоимость индив. группы:</p>
									<?php else: ?>
										<p class="content__price">Стоимость</p>
									<?php endif ?>
									<p class="content__price-indiv">
										<?php if($indiv_prices): ?>
											<?php foreach($indiv_prices as $item):
												$item_text = $item['str'];
												if ( substr($item['str'], 0, 3) == '✓') {
													$item_text = str_replace('✓', '<img src="' . get_template_directory_uri() . '/img/agree.svg" alt="✓" class="content__price-indiv__icon-agree">', $item['str']);
												}?>
												<span class="content__price-indiv__item"><?=$item_text?></span>
											<?php endforeach; ?>
										<?php else: ?>
											<span>по запросу</span>
										<?php endif; ?>
									</p>
								</div>
							<?php else: ?>
								<div>
									<?php if ($tury): ?>
									<h3><?=($lang=='en')?' Price for person':'Цена за человека'?></h3>
									<?php endif ?>
									<p class="content__price">
										<span><?=$mtxt?></span> <span style="color:#f00;text-decoration:line-through;"><?=$turipriceold?></span> <?=$priceMain?>
									</p>
									<?php if (!$tury): ?>
									<div class="content__price-comment"><?=($lang=='en')?' Price for person':'за человека'?></div>
									<?php endif ?>
									<div class="content__link"></div>
								</div>
							<?php endif; ?>
							
							<?php /*if(wp_is_mobile()) : ?>
							<a href="#all-prices" class="content__link-all-prices">Все цены</a>
							<?php endif;*/ ?>
						</div>

						<a href="#orderForm" class="content__book"><?=($lang=='en')?'Book now':'Забронировать'?></a>

							<?php $the_content = get_the_content();
							if((str_contains($the_content, 'Программа экскурсии') == true) or
								(str_contains($the_content, 'Программа мероприятия') == true) or
								(str_contains($the_content, 'Программа обзорной экскурсии') == true)
							){?>
								<a href="#title_excursion_program" class="content__anchor-excursion">Программа экскурсии</a>
							<? } ?>

						<p class="content__text content__text_info" style="padding-left: 22px;">
							<?php if ($tury):?>
								<strong class="tour__duration blue">Продолжительность тура: </strong>
								
								<?=(get_field('turi_duration')) ? (get_field('turi_duration')):$reqtext;?>
								
								<strong class="tour__days blue">Даты проведения: </strong>
								<?=(get_field('turi_otpravlenie'))?(get_field('turi_otpravlenie')):$reqtext;?>
								
								<strong class="tour__time blue">Месяцы проведения: </strong>
								<?=(get_field('turi_mounthes'))?(get_field('turi_mounthes')):$reqtext;?>
							<?php else: ?>
								<strong class="tour__duration blue"><?=($lang=='en')?'Duration of the excursion':'Продолжительность'?>: </strong>
								<meta itemprop="duration" content="PT<?php echo (int)$duration; ?>M00S">
								<?=$duration?>

								<strong class="tour__days blue"><?=($lang=='en')?'Days of the week':'Дни недели'?>: </strong>
								<?=$periodicity?>

								<strong class="tour__time blue"><?=($lang=='en')?'Departure time':'Время отправления'?>: </strong>
								<?=$start_time?>
								<?php if($area): ?>
									<strong class="tour__addr blue"><?=($lang=='en')?'Place of departure':'Место отправления'?>: </strong>
									<?=$area?>
								<?php endif; ?>

								<?php if(get_field('show_address')):?>
									<?php if($lang=='en'): ?>
										<strong class="tour__addr">Departure adress: </strong>
									<?php else: ?>
										<strong class="tour__addr blue">Адрес<?php if(get_post_meta(get_the_ID(), 'on_address', 1)):?>а<?php endif;?> отправления: </strong>
									<?php endif; ?>
									<?=$addr?>
								<?php endif; ?>
								<?php if ($lang=='en'): ?>
									<strong class="tour__phone">Contact phone number: </strong>
									<a href="tel:+79531612607">8 (953) 161-26-07</a>
								<?php endif ?>
							<?php endif; ?>
						</p>
						<iframe src="https://yandex.ru/sprav/widget/rating-badge/64817349525?type=rating" style="margin: 5px 0 0 20px;" width="150" height="50" frameborder="0"></iframe>
					</div>
					<div class="single_attention">
						<div class="single_attention__title">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2.27494 17.4999H17.7166C18.3583 17.4999 18.7583 16.8082 18.4416 16.2499L10.7166 2.91655C10.3916 2.35822 9.5916 2.35822 9.27494 2.91655L1.54994 16.2499C1.23327 16.8082 1.63327 17.4999 2.27494 17.4999ZM10.8333 14.9999H9.1666V13.3332H10.8333V14.9999ZM9.99994 11.6666C9.5416 11.6666 9.1666 11.2916 9.1666 10.8332V9.16655C9.1666 8.70822 9.5416 8.33322 9.99994 8.33322C10.4583 8.33322 10.8333 8.70822 10.8333 9.16655V10.8332C10.8333 11.2916 10.4583 11.6666 9.99994 11.6666Z" fill="#2C84D1"/>
							</svg>
							<span>Важно</span>
						</div>
						<p>Перед экскурсией ознакомьтесь
	с условиями предоставления услуг</p>
						<div class="single_attention__btn">Читать условия</div>
					</div>
		      	</div>
				

	        </div>

			<div class="tours-wrap" data-sticky-container>
				<div class="tours-content" itemprop="location" itemscope itemtype="http://schema.org/Place">

		        	<?php the_content(); ?>
				</div>


				<?php if (have_rows('gates')): ?>
					<div class="content__gates">
						<ul>
						<?php while ( have_rows('gates') ) : the_row() ?>
							<li><?php the_sub_field('gate') ?></li>
						<?php endwhile; ?>						
						</ul>
					</div>
				<?php endif ?>	

			</div>
		</div>

		<div class="content-form_wrap tours-wrap">
			<div class="container">
				<a name="orderForm"></a>
				<?php if($lang=='en'):?>
					<h2>Book excursion</h2>
				<?php else: ?>
		  		<h2 class="tours-wrap__title">Забронировать <?php echo (!$tury) ? 'экскурсию' : 'тур' ; ?></h2>
		  		<?php endif; ?>
				
				<?php 
					if($neva_id = get_field('neva_id')){
						include_once('template-parts/order_form_neva.php');
					} else {
						include_once('template-parts/order_form.php');
					}
				?>

			</div>
		</div>
		
		<?php if ($after_gates || $video_after_gates_dzen): ?>
			<div class="container mt-30">
				<div class="tours-wrap" data-sticky-container>				
					<div class="tours-content" id="after_gates_wrap">
						<?php if ($video_after_gates || $video_after_gates_dzen): ?>
							<?php if(get_the_ID()==1343): ?>
								<h2 class="single_tour__video_title">Видео экскурсии</h2>
							<?php elseif($video_after_gates_dzen_more && count($video_after_gates_dzen_more)): ?>
								<div class="content-header content-header-videos">
									<div class="revs_title_arrs">
										<h2 class="content-header__title">Фрагменты с экскурсии</h2>
										<div class="arrs_block">
											<button class="arrs_btn arrs_btn-prev"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M9.69883 8.30898L13.5788 12.189L9.69883 16.069C9.30883 16.459 9.30883 17.089 9.69883 17.479C10.0888 17.869 10.7188 17.869 11.1088 17.479L15.6988 12.889C16.0888 12.499 16.0888 11.869 15.6988 11.479L11.1088 6.88898C10.7188 6.49898 10.0888 6.49898 9.69883 6.88898C9.31883 7.27898 9.30883 7.91898 9.69883 8.30898Z" fill="white"/>
											</svg></button>
											<button class="arrs_btn arrs_btn-next"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M9.69883 8.30898L13.5788 12.189L9.69883 16.069C9.30883 16.459 9.30883 17.089 9.69883 17.479C10.0888 17.869 10.7188 17.869 11.1088 17.479L15.6988 12.889C16.0888 12.499 16.0888 11.869 15.6988 11.479L11.1088 6.88898C10.7188 6.49898 10.0888 6.49898 9.69883 6.88898C9.31883 7.27898 9.30883 7.91898 9.69883 8.30898Z" fill="white"/>
											</svg></button>
										</div>
									</div>
								</div>
							<?php else: ?>
								<h2>Фрагменты с экскурсии</h2>
							<?php endif ?>
							<?php if($video_after_gates_dzen): ?>
								<div class="slider_videos">
									<iframe style="width: 100%;height: 440px;" src="<?=getDzenSrc($video_after_gates_dzen)?>" allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media" frameborder="0" scrolling="no" allowfullscreen></iframe>
									<?php if($video_after_gates_dzen_more && count($video_after_gates_dzen_more)): ?>
										<?php foreach($video_after_gates_dzen_more as $item): ?>
											<iframe style="width: 100%;height: 440px;" src="<?=getDzenSrc($item['code'])?>" allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media" frameborder="0" scrolling="no" allowfullscreen></iframe>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							<?php else: ?>
								<div id="video_after_gates" data-src="https://www.youtube.com/embed/<?php echo getYoutubeEmbedUrl($video_after_gates); ?>">
									<img class="video_after_gates__img" style="width:100%" src="https://img.youtube.com/vi/<?php echo getYoutubeEmbedUrl($video_after_gates); ?>/hqdefault.jpg">
								</div>
							<?php endif ?>
						<?php endif ?>
						<?php echo $after_gates; ?>
					</div>
			
					<?php if (have_rows('gates')): ?>
						<div class="content__gates">
							<ul>
							<?php while ( have_rows('gates') ) : the_row() ?>
								<li><?php the_sub_field('gate') ?></li>
							<?php endwhile; ?>						
							</ul>
						</div>
					<?php endif ?>	
				</div>				
			</div>
		<?php endif ?>
        
        <?php //Вопрос - Ответ
        if (get_field('faq_title') && have_rows('faq_list')) { ?>
            <div class="container">
                <div class="block_wrap">
                    <div class="content-header">
                        <h2 class="content-header__title"><?php the_field('faq_title'); ?></h2>
                    </div>
                    <div class="faq">
                        <?php while (have_rows('faq_list')) : the_row(); ?>
                            <div class="faq__item">
                                <div class="faq__title_wrap">
                                    <div class="faq__title">
                                        <?php the_sub_field('faq_list_question'); ?>
                                    </div>
                                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87978 6.43895L5.99978 2.55895L2.11978 6.43895C1.72978 6.82895 1.09978 6.82895 0.709784 6.43895C0.319784 6.04895 0.319784 5.41895 0.709784 5.02895L5.29978 0.438946C5.68978 0.0489458 6.31978 0.0489458 6.70978 0.438946L11.2998 5.02895C11.6898 5.41895 11.6898 6.04895 11.2998 6.43895C10.9098 6.81895 10.2698 6.82895 9.87978 6.43895Z" fill="#028AE0"></path>
                                    </svg>
                                </div>
                                <div class="faq__text">
                                    <?php the_sub_field('faq_list_answer'); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php } ?>


		<div class="container">

			<?php if (!$tury): ?>

<div class="content__tour tour promo for-mobile" data-true-price="999999" data-popular="99999">
            <div class="subscribe-card__title">
                <?=($lang=='en')?'It is convenient and safe with us':'С нами удобно и безопасно'?>
            </div>
            <div class="f-item p6">
                <div class="f-icon" style="margin-bottom: 6px;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumb-up.svg" alt="Бесплатная отмена бронирования">
                </div>
				<?php if($lang=='en'): ?>
					<div style="font-size: 16px" class="f-header">Free cancellation of<br>booking till 24 hours</div>					
				<?php else: ?>
					<div class="f-header"><a style="font-size: 16px" target="_blank" href="/usloviya/">Бесплатная отмена <br>брони за 24 часа</a></div>
				<?php endif; ?>
            </div>
            <div class="f-item">
                <div class="f-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/bus.svg" alt="Собственный транспорт">
                </div>
                <div class="f-header">
					<a style="font-size: 16px" href="/avtopark/" target="_blank">
						<?php if($lang=='en'): ?>
							Our own<br>modern transport
						<?php else: ?>
							Современный транспорт
						<?php endif; ?>
					</a>
				</div>
            </div>
            <div class="f-item">
                <div class="f-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/museum.svg" alt="Вход без очереди в музеи">
                </div>
				<div class="f-header">
					<?php if($lang=='en'): ?>
						 <a style="font-size: 16px" href="/muzei-bez-ocheredi/" target="_blank">Entering to the museums<br>without queue</a>					
					<?php else: ?>
					
						 <a style="font-size: 16px" href="/muzei-bez-ocheredi/" target="_blank">Вход без очереди<br>в музеи</a>
					<?php endif; ?>                
				</div>
            </div>
            <div class="f-item">
                <div class="f-icon" style="margin-bottom: 1px;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/office.svg" alt="Офис в центре города">
                </div>
                <div class="f-header" style="font-size: 16px;color: #0099ce;">
						<?php if($lang=='en'): ?>
							Our office <br>in the city center
						<?php else: ?>
							Офис в центре города
						<?php endif; ?>	
				</div>
            </div>
</div>						
			<?php endif; ?>
			
			
			
	        <!-- recent posts-->
			<?php if ($tury): ?>
		        <h3 class="content__recommend-title">
		          	РЕКОМЕНДУЕМ ТАКЖЕ СЛЕДУЮЩИЕ ТУРЫ:
		        </h3>

		        <div class="content__tours">
					<?php $i=0; ?>			
					<?php foreach($recs2 as $item): ?>
					  	<?php
							$periodicity = (get_field('turi_otpravlenie', $item->ID))?get_field('turi_otpravlenie', $item->ID):'по запросу';
							$start_time = (get_field('turi_mounthes', $item->ID))?get_field('turi_mounthes', $item->ID):'по запросу';
							$duration = (get_field('turi_duration', $item->ID))?get_field('turi_duration', $item->ID):'по запросу';
							$true_price = (get_field('turi_price', $item->ID))?get_field('turi_price', $item->ID).' руб/чел':'по запросу';	
							$prevDesc = (get_field('previuDesk', $item->ID))?wp_trim_words(get_field('previuDesk', $item->ID),20):wp_trim_words($item->post_content, 20);
							$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'large');
							$thumbnail_url = (isset($thumbnail_attributes[0]))?$thumbnail_attributes[0]:$theme_url.'/assets/images/340719-200.png';
							$url = (stripos(get_permalink($item->ID, true ),'%tours%')>-1)?get_permalink($item->ID, false ):get_permalink($item->ID, true );
						?>	
						<?php $i++; ?>
						<?php if($i==4) break; ?>
						<div class="content__tour tour <?=$terms?>" data-crm-id="<?=get_field('id_crm', $item->ID)?>">
                            <button class="wish-btn content__tour__wish-btn<? if($_COOKIE["product"]){ if(in_array($item->ID,$_COOKIE["product"])){echo' is-active';}}?>" data-wp-id="<?php echo $item->ID; ?>"  data-title='<?php echo $item->post_title;?>'>
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <g clip-path="url(#clip0_2_41)">
                                            <path d="M7.50002 13.9865C7.42414 13.9865 7.34829 13.9669 7.28032 13.9276C7.20649 13.885 5.45246 12.8666 3.67327 11.3321C2.61876 10.4227 1.777 9.52061 1.17144 8.65108C0.387805 7.52591 -0.00626644 6.44362 9.09643e-05 5.43426C0.00753236 4.25975 0.428205 3.1552 1.18471 2.32405C1.95398 1.4789 2.9806 1.01349 4.07551 1.01349C5.47874 1.01349 6.76168 1.79952 7.50005 3.0447C8.23841 1.79955 9.52135 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9936 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53565 12.866 7.79422 13.8844 7.72094 13.927C7.65265 13.9666 7.57631 13.9865 7.50002 13.9865V13.9865Z" fill="#A5A5A5"/>
                                        </g>
                                    </svg>
                                </i>
                            </button>
                            <a href="<?=$url?>" class="tour__header">
							  <img
								src="<?=$thumbnail_url?>"
								alt="tour-image"
								class="tour__image"
							  />
							</a>

							<div class="tour__content">
								<h4 class="tour__title"><?=$item->post_title?></h4>
							  	<noindex><p><?=$prevDesc?></p></noindex>
							  	<div class="tour__info">
									<span class="tour__duration">Продолжительность: <?=$duration?></span>
									<span class="tour__days">Месяцы проведения: <?=$start_time?></span>	

							  	</div>

							  	<div class="tour__cost">
									Стоимость:
									<span>
										от 
										<span id="min_cost">
											<?php echo (get_field('turi_price', $item->ID))?get_field('turi_price', $item->ID). ' руб/чел':'по запросу'; ?>

											<?php /*
											<?php if ( get_field('p_doshkolniki', $item->ID) ) {
											    echo get_field('p_doshkolniki', $item->ID) . ' руб/чел';
											} else {
											    echo get_field('p_shkolniki', $item->ID) . ' руб/чел';
											} ?>
											*/ ?>
										</span>
									</span>
							  	</div>

							  	<a href="<?=$url?>" class="tour__book">Забронировать</a>
							</div>
						</div>
					<?php endforeach; ?>
		        </div>


		        <div class="content__back-wrapper">
		          	<a href="/tury/" class="content__back"><< Вернуться к списку туров</a>
		        </div>
			<?php else: ?>
				<?php
					$revs = get_posts([
						'post_type' => 'reviews',
						'orderby' => 'date',
						'order' => 'DESC',
						'numberposts' => -1,
						'meta_query' => [
							'relation' => 'AND',
							[
								'key' => 'excursion_obj',
								'compare_key' => 'EXISTS'
							],
							[
								'key' => 'rating',
								'value' => 5,
								'type' => 'numeric'
							]
						]
					]);
					
					$cat_hk = get_field('cat_hk');
					if(!$cat_hk){
						$terms = get_the_terms(get_the_ID(), 'excursion');
						$cat_hk = $terms[0]->term_id;
					}
					
					$excs = get_posts([
						'numberposts' => -1,
						'post_type' => 'tours',
						'post_status' => 'publish',
						'tax_query' => [
							[
								'taxonomy' => 'excursion',
								'field' => 'term_id', 
								'terms' => $cat_hk,
								'include_children' => false
							]
						],
						'fields'          => 'ids'
					]);
					
					$revs_single = [];

					foreach($revs as $k => $item){
						$tour_id = get_field('excursion_obj', $item);
						
						if($tour_id[0]==get_the_ID()){
							$revs_single[] = $item;
						}
						if(!$tour_id || !in_array($tour_id[0], $excs)){
							unset($revs[$k]);
						}
					}
					$revs = array_slice($revs, 0, 8);
					$revs_single = array_slice($revs_single, 0, 8);
				?>

				<?php if(count($revs_single)): ?>
				<div class="content-header content-header-reviews">
					<div class="revs_title_arrs">
						<h2 class="content-header__title">Отзывы туристов после экскурсии</h2>
						<div class="arrs_block">
							<button class="arrs_btn arrs_btn-prev"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.69883 8.30898L13.5788 12.189L9.69883 16.069C9.30883 16.459 9.30883 17.089 9.69883 17.479C10.0888 17.869 10.7188 17.869 11.1088 17.479L15.6988 12.889C16.0888 12.499 16.0888 11.869 15.6988 11.479L11.1088 6.88898C10.7188 6.49898 10.0888 6.49898 9.69883 6.88898C9.31883 7.27898 9.30883 7.91898 9.69883 8.30898Z" fill="white"/>
							</svg></button>
							<button class="arrs_btn arrs_btn-next"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.69883 8.30898L13.5788 12.189L9.69883 16.069C9.30883 16.459 9.30883 17.089 9.69883 17.479C10.0888 17.869 10.7188 17.869 11.1088 17.479L15.6988 12.889C16.0888 12.499 16.0888 11.869 15.6988 11.479L11.1088 6.88898C10.7188 6.49898 10.0888 6.49898 9.69883 6.88898C9.31883 7.27898 9.30883 7.91898 9.69883 8.30898Z" fill="white"/>
							</svg></button>
						</div>
					</div>
					<a href="/reviews" class="content-header__link">Смотреть все отзывы</a>
				</div>				
				<!--noindex-->
					<div class="review_slider">			
						<div class="review_slider--container" id="content_review_slider">
							<?php foreach($revs_single as $item): ?>
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
							<?php foreach($myposts2 as $item): ?>
								<?php $date = (get_field('date_reviews',$item->ID))?get_field('date_reviews',$item->ID):get_the_date('d.m.Y',$item->ID); ?>
								<?php /*
									<div class="review_slider--item">
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
									</div>
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
				<?php
					$ex_obj = get_field('excursion_obj',$item->ID);
				?>
				<div class="review__author">
					<?php if ($ex = get_field('excursion',$item->ID) && !$ex_obj): $excursionarr = explode(',', $ex); ?>
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
					<?php elseif(is_array($ex_obj) && count($ex_obj)): ?>
						<?php 
							$excursionarr = get_posts([
								'post_type' => 'tours',
								"post__in" => $ex_obj
							]);
						?>
						<div class="excursion">
							<div class="excursion-list">Экскурсия</div>
							<ul>
								<?php foreach ($excursionarr as $tour): ?>
									<li><a href="<?=get_the_permalink($tour)?>"><?=$tour->post_title?></a></li>
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
							<a href="/reviews">Все отзывы</a>
						</div>
					</div>
					<!--/noindex-->    
					<?php endif ?>
			
				<div class="content-header content-header-reviews">
					<h3 class="content__recommend-title exc">Рекомендуем также следующие экскурсии:</h3>
					<a href="/" class="content-header__link">Вернуться к списку экскурсий</a>
				</div>
			
		        <div class="content__tours content__tours-related">
					<?php $i=0; ?>			
					<?php foreach($recs as $item): ?>
						<?php if ($item->ID != get_the_ID()): ?>
						  	<?php
								$periodicity = (get_field('periodicity', $item->ID))?get_field('periodicity', $item->ID):$reqtext;
								$start_time = (get_field('start_time', $item->ID))?get_field('start_time', $item->ID):$reqtext;
								$duration = (get_field('duration', $item->ID))?correctTime(get_field('duration', $item->ID)):$reqtext;
								$prevDesc = (get_field('previuDesk', $item->ID))?wp_trim_words(get_field('previuDesk', $item->ID),20):wp_trim_words($item->post_content, 20);
								$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'large');
								$thumbnail_url = (isset($thumbnail_attributes[0]))?$thumbnail_attributes[0]:$theme_url.'/assets/images/340719-200.png';
								$url = (stripos(get_permalink($item->ID, true ),'%tours%')>-1)?get_permalink($item->ID, false ):get_permalink($item->ID, true );
								$terms_arr = [];
								foreach (get_the_terms($item->ID, 'excursion') as $te){
									$terms_arr[] = $te->slug;
								}
								$terms = implode(" ", $terms_arr);
								$addr = (get_post_meta($post->ID, 'on_address', 1))?'Московский вокзал или Невский, 17':'Московский вокзал';

								if(!get_field('id_crm', $post->ID) && get_field('departure_address', $post->ID)){
									$addr = get_field('departure_address', $post->ID);
								}	
								$tickets_arr = json_decode(get_post_meta($post->ID, 'tickets', 1));		
								if ($tickets_arr) {
									foreach ($tickets_arr as $key => $value) {
										if ($value->tickets > 0) {
											$tickets_date = explode('.', $value->date);
											$date = $tickets_date[2] . '-' . $tickets_date[1] . '-'. $tickets_date[0];
											break;
										}
									}
								}
								$_monthsList = array(".01." => "января", ".02." => "февраля", 
								".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
								".07." => "июля", ".08." => "августа", ".09." => "сентября",
								".10." => "октября", ".11." => "ноября", ".12." => "декабря");
								$currentDate = date("d.m.", strtotime($date));
								$_mD = date(".m.", strtotime($date));
								$currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);		
							?>	
							<?php $i++; ?>
							<?php if($i==4) break; ?>
							<div class="content__tour tour <?=$terms?>" data-crm-id="<?=get_field('id_crm', $item->ID)?>" data-wp-id="<?=$item->ID?>">
                                <button class="wish-btn content__tour__wish-btn<? if($_COOKIE["product"]){ if(in_array($item->ID,$_COOKIE["product"])){echo' is-active';}}?>" data-wp-id="<?php echo $item->ID; ?>" data-title='<?php echo $item->post_title;?>'>
                                    <i class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                            <g clip-path="url(#clip0_2_41)">
                                                <path d="M7.50002 13.9865C7.42414 13.9865 7.34829 13.9669 7.28032 13.9276C7.20649 13.885 5.45246 12.8666 3.67327 11.3321C2.61876 10.4227 1.777 9.52061 1.17144 8.65108C0.387805 7.52591 -0.00626644 6.44362 9.09643e-05 5.43426C0.00753236 4.25975 0.428205 3.1552 1.18471 2.32405C1.95398 1.4789 2.9806 1.01349 4.07551 1.01349C5.47874 1.01349 6.76168 1.79952 7.50005 3.0447C8.23841 1.79955 9.52135 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9936 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53565 12.866 7.79422 13.8844 7.72094 13.927C7.65265 13.9666 7.57631 13.9865 7.50002 13.9865V13.9865Z" fill="#A5A5A5"/>
                                            </g>
                                        </svg>
                                    </i>
                                </button>
                                <a href="<?=$url?>" class="tour__header">
								  <img
									src="<?=$thumbnail_url?>"
									alt="tour-image"
									class="tour__image"
								  />
								</a>

								<div class="tour__content">
									<h4 class="tour__title"><?=$item->post_title?></h4>
								  	<noindex><p><?=$prevDesc?></p></noindex>
								  	<div class="tour__info">
										<span class="tour__days"><?=$periodicity?></span>
										<span class="tour__time"><?=$start_time?></span>
										<span class="tour__duration"><?=$duration?></span>
										<span class="tour__addr"><?=$addr?></span>
								  	</div>

									<?php if(get_field('id_crm', $item->ID)): ?>
										<div class="tour__tickets-left">
											Билетов на <?php echo $currentDate; ?>:
											<span class="count_tickets">30</span>
										</div>
									<?php else: ?>
										<div class="tour__tickets-left tour__tickets-space"></div>
									<?php endif; ?>

								  	<div class="tour__cost">
									<?php 
										$price = get_from_price($item->ID);
									?>
										Стоимость:
										<span>
											от 
											<span id="min_cost"><?=$price['price']?></span>
										</span>
								  	</div>

								  	<a href="<?=$url?>" class="tour__book">Забронировать</a>
								</div>
							</div>							
						<?php endif ?>

					<?php endforeach; ?>
		        </div>
	        <?php endif ?>
	        <!-- /recent posts-->
			
			


	  	</div>
	</section>

<?php 
	$school_price = get_field('p_shkolniki_sale')?get_field('p_shkolniki_sale'):get_field('p_shkolniki');
	if(!$school_price) $school_price = get_field('from_price');
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "<?=get_the_title()?>",
  "description": "<?=wp_trim_words(get_the_content(),20)?>",
  "image": "<?=$galery_first['url']?>",
  "url": "<?=get_permalink()?>",
  "offers": {
                "@type": "AggregateOffer",
                "priceCurrency": "RUB",
                "lowPrice": "<?=$school_price?>"
            }
}
</script>

	<?php get_footer(); // подключаем footer.php ?>