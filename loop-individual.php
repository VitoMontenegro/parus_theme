	<?php
	$term_id = get_queried_object()->term_id;

	$theme_url = get_stylesheet_directory_uri();
	$start_time = (get_field('start_time', $post->ID))?get_field('start_time', $post->ID):'по запросу';
	$duration = (get_field('duration', $post->ID))?correctTime(get_field('duration', $post->ID)):'по запросу';
	$prevDesc = (get_field('previuDesk', $post->ID))?wp_trim_words(get_field('previuDesk', $post->ID),20):wp_trim_words(get_the_content(), 20);
	$prevDesc = str_ireplace('Описание экскурсии ', '', $prevDesc);
	$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');

	$thumbnail_url = (isset($thumbnail_attributes[0])) ? $thumbnail_attributes[0] : $theme_url.'/assets/images/340719-200.png';
	$url = (stripos(get_permalink($post->ID, true ),'%tours%')>-1)?get_permalink($post->ID, false ):get_permalink($post->ID, true );
	$terms_arr = [];
	$tickets_arr = json_decode(get_post_meta($post->ID, 'tickets', 1));
	$new_date = [];
	$sticker_background = get_field('sticker_background', $post->ID) ? get_field('sticker_background', $post->ID) : '';
	$sticker_text = get_field('sticker_text', $post->ID) ? get_field('sticker_text', $post->ID) : '';
	$video_after_gates = get_field('video_after_gates', $post->ID);
	
	$true_price = get_field('price', $post->ID) . ' руб/чел'; 

	foreach (get_the_terms($post->ID, 'excursion') as $te){
		$terms_arr[] = $te->slug;
	}
	$terms = implode(" ", $terms_arr);
	if ($_GET['date']) {
		$arr_get_date = explode('-', $_GET['date']);
		foreach ($arr_get_date as $key => $value) {
			$arg = trim($value);
			$arr_get_date[$key] = trim($arg,'0');
		}
	}
	$check_arr = [];
	if ($tickets_arr) {
		foreach ($tickets_arr as $key => $value) {
			if ($value->tickets > 0) {
				$tickets_date = explode('.', $value->date);
				$date = $tickets_date[2] . '-' . $tickets_date[1] . '-'. $tickets_date[0];
				break;
			}
		}
	}
	if ($tickets_arr) {
		foreach ($tickets_arr as $key => $value) {
			if ($value->tickets > 0) {				
				$tickets_date = explode('.', $value->date);
				if(strlen($tickets_date[0])==1) $tickets_date[0] = '0'.$tickets_date[0];
				$date2 = $tickets_date[2] . '-' . $tickets_date[1] . '-'. $tickets_date[0] ;
				if (is_array($new_date) && !in_array($date2, $new_date)) {
					$new_date[] = $date2;
					$check_arr[] = $value->date;
				}
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
	
	$lang = ($term_id == 41)?'en':'ru';


	if (!empty(get_field('p_doshkolniki_sale', $post->ID)) || !empty(get_field('p_shkolniki_sale', $post->ID)) || !empty(get_field('p_studenty_sale', $post->ID)) || !empty(get_field('p_vzroslie_sale', $post->ID)) || !empty(get_field('p_pensionery_sale', $post->ID)) || !empty(get_field('p_vzroslie_inostrancy_sale', $post->ID)) || !empty(get_field('p_studenty_inostrancy_sale', $post->ID)) || !empty(get_field('p_deti_inostrancy_sale', $post->ID))) {
		$is_sale = true;
	} else {
		$is_sale = false;
	}
	// if (get_field('p_doshkolniki_sale', $post->ID)) {
	// 	$datacost = get_field('p_doshkolniki_sale', $post->ID);
	// } elseif ( get_field('p_shkolniki_sale', $post->ID) ) {
	// 	$datacost = get_field('p_shkolniki_sale', $post->ID);
	// } elseif (get_field('p_doshkolniki', $post->ID)){
	// 	$datacost = get_field('p_doshkolniki', $post->ID);
	// }  elseif (get_field('p_shkolniki', $post->ID)){
	// 	$datacost = get_field('p_shkolniki', $post->ID);
	// }  else {
	// 	$datacost = get_field('p_vzroslie', $post->ID);
	// } 
	if (get_field('p_shkolniki_sale', $post->ID)) {
		$datacost = get_field('p_shkolniki_sale', $post->ID);
	} elseif ( get_field('p_shkolniki', $post->ID) ) {
		$datacost = get_field('p_shkolniki', $post->ID);
	} elseif (get_field('p_doshkolniki_sale', $post->ID)){
		$datacost = get_field('p_doshkolniki_sale', $post->ID);
	}  elseif (get_field('p_doshkolniki', $post->ID)){
		$datacost = get_field('p_doshkolniki', $post->ID);
	}  else {
		$datacost = get_field('p_vzroslie', $post->ID);
	} 
	$durationnolet = preg_replace("/[^,.:0-9]/", '', $duration);
	$durationclear = str_replace(',','.',$durationnolet);

	$data_date = '"123",';
	if ($new_date) {
		foreach ($new_date as $key => $value) {
			$data_date .= '"' . $value . '",';					
		}
	} else {
		$data_date = '';
	}

?>
	<div class="content__tour tour <?=$terms?>" data-crm-id="<?=get_field('id_crm', $post->ID)?>" data-true-price="<?=$true_price?>" data-sale="<?php echo $is_sale; ?>"  <?php if($datacost) { echo 'data-cost="' . $datacost . '"'; } ?> data-duration="<?php echo $durationclear; ?>" data-exlusive="<?=get_field('eksklyuziv', $post->ID)?>" data-popular="<?php echo $post->ID; ?>"  data-stuff='[<?php echo $data_date; ?>]'<?php  if($arr_get_date && empty(array_intersect($arr_get_date, $check_arr))){ echo 'style="margin-right: 10px; display: none;"';} ?>>
        <button class="wish-btn content__tour__wish-btn<? if($_COOKIE["product"]){ if(in_array($post->ID,$_COOKIE["product"])){echo' is-active';}}?>" data-wp-id="<?php echo $post->ID; ?>" data-title='<?php echo $post->post_title;?>'>
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
				<?php /*src="<?=$theme_url?>/assets/images/Spinner-1s-200px.svg" */ ?>
				<?php /*data-src="<?=$thumbnail_url?>" */ ?>
				src="<?=$thumbnail_url?>"
				alt="tour-image"
				<?php /* class="tour__image lazy" */ ?>
				class="tour__image"
			/>
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

			<?php $top = get_field('sticker', $item->ID) ? 60 : 15; ?>

			<?php if(have_rows('stick_group', $item->ID)): ?>
				<?php while ( have_rows('stick_group', $item->ID) ) : the_row(); ?>
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
		 	<?php if ((get_field('p_doshkolniki_sale', $post->ID) || get_field('p_shkolniki_sale', $post->ID) || get_field('p_studenty_sale', $post->ID) || get_field('p_vzroslie_sale', $post->ID) || get_field('p_pensionery_sale', $post->ID) || get_field('p_vzroslie_inostrancy_sale', $post->ID) || get_field('p_studenty_inostrancy_sale', $post->ID) || get_field('p_deti_inostrancy_sale', $post->ID))  && $post->ID !=4386): ?>
		 		<?php if (get_field('includ_sales', 'options')): ?>
		 			<?php 

					$sticker_backgrounds = '#904aca';
					$sticker_txt = get_field('sticker_text', 'options') ? get_field('sticker_text', 'options') : '#fff';
					if (get_field('p_shkolniki_sale', $post->ID)) {
						$priceold = get_field('p_doshkolniki', $post->ID);
						$pricenew = get_field('p_shkolniki_sale', $post->ID);


					} elseif (get_field('p_doshkolniki_sale', $post->ID)){
						$priceold = get_field('p_doshkolniki', $post->ID);
						$pricenew = get_field('p_doshkolniki_sale', $post->ID);

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
				  	<span class="stick" style="background: <?php echo $backgound;?><?php if (get_field('sticker', $post->ID) || have_rows('stick_group', $post->ID)) {echo ';top: '. $top .'px;';}?>">
				  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
				  		<span class="text" style="color: <?php echo $color;?>">Скидка на билеты</span>						  		
				  	</span>
			  	<?php endif ?>

		  	<?php endif ?>
		  	<?php if ($video_after_gates): ?>
			  	<span class="has_video" data-ll-status="observed"><svg height="100%" version="1.1" viewBox="0 0 68 48" width="35" style="position: absolute;top: 0;left: 0;"><path class="" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg></span>
		  	<?php endif ?>
		</a>				
		<div class="tour__content">
			<h2 class="tour__title"><?the_title()?></h2>
			<noindex><p><?=$prevDesc?></p></noindex>
			<div class="tour__info">
				<span class="tour__duration blue"><?=$duration?></span>
			</div>


		  <div class="tour__cost">
				Стоимость индив. группы: <span>от <span id="min_cost"><?=get_field('price', $post->ID)?></span> руб.</span>
				<?php /*Стоимость:
				<span>от <span id="min_cost">
				<?php
					echo get_field('price', $post->ID) . ' руб/чел';
				?>
				</span>
				</span>*/ ?>
		  </div>
		  
		  <a href="<?=$url?>" class="tour__book"><?=($lang=='en' || in_array('excursions-in-english', $terms_arr))?'Book now':'Забронировать'?></a>
		</div>
	</div>