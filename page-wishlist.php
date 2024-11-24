<?php
/**
 * Template Name: Страница Избранное
 */

get_header(); // подключаем header.php ?>
<?php
$h1 = (get_field('h1'))?get_field('h1'):get_the_title();
?>
<section class="page-content page-default-content">
    <div class="container">

    </div>
</section>
<section class="content content--bus content--wishlist">
    <div class="container">
        <h1><?=$h1?></h1>

        <div class="content__tours" id="tours">

                <?php
                if($_COOKIE["product"]){
                    $posts = get_posts(array(
                        'posts_per_page'	=> -1,
                        'post_type'		=> 'tours',
                        'include' => $_COOKIE["product"],
                    )); ?>

                <?php foreach ($posts as $key => $item){
                    $post = get_post($item);
                    setup_postdata($post);


                    $tury = has_term(33, 'excursion', $item);

                    $periodicity = (get_field('periodicity', $item->ID))?get_field('periodicity', $item->ID):'по запросу';
                    $start_time = (get_field('start_time', $item->ID))?get_field('start_time', $item->ID):'по запросу';
                    $duration = (get_field('duration', $item->ID))?correctTime(get_field('duration', $item->ID)):'по запросу';
                    $durationnolet = preg_replace("/[^,.:0-9]/", '', $duration);
                    $durationclear = str_replace(',','.',$durationnolet);
                    $prevDesc = (get_field('previuDesk', $item->ID))?wp_trim_words(get_field('previuDesk', $item->ID),20):wp_trim_words($item->post_content, 20);
                    $thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'medium');
                    $thumbnail_url = (isset($thumbnail_attributes[0]))?$thumbnail_attributes[0]:$theme_url.'/assets/images/340719-200.png';
                    $url = (stripos(get_permalink($item->ID, true ),'%tours%')>-1)?get_permalink($item->ID, false ):get_permalink($item->ID, true );
                    $addr = (get_post_meta($item->ID, 'on_address', 1))?'Московский вокзал или Невский, 17':'Московский вокзал';
                    if(!get_field('id_crm', $item->ID) && get_field('departure_address', $item->ID)){
                        $addr = get_field('departure_address', $item->ID);
                    }


                    if ($post->ID == '4649') {
                        $addr = 'Университетская наб., 13';
                    }
                    if (get_the_ID() == '4386' || get_the_ID() == '4285') {
                        $addr = 'Дворцовая площадь';
                    }
                    if (get_the_ID() == '8257') {
                        $addr = 'Сенатская пристань';
                    }

                    if( get_field('departure_address', $item->ID)){
                        $addr = get_field('departure_address', $item->ID);
                    }

                    $terms_arr = [];
                    foreach (get_the_terms($item->ID, 'excursion') as $te){
                        $terms_arr[] = $te->slug;
                    }
                    $terms = implode(" ", $terms_arr);

                    $tickets_arr = json_decode(get_post_meta($item->ID, 'tickets', 1));
                    $new_date = [];
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
                        foreach ($tickets_arr as $key2 => $value2) {
                            if ($value2->tickets > 0) {

                                $tickets_date2 = explode('.', $value2->date);
                                if(strlen($tickets_date2[0])==1) $tickets_date2[0] = '0'.$tickets_date2[0];
                                $date2 = $tickets_date2[2] . '-' . $tickets_date2[1] . '-'. $tickets_date2[0] ;
                                if (!in_array($date2, $new_date)) {
                                    $new_date[] = $date2;
                                    $check_arr[] = $value2->date;
                                }
                            }
                        }
                    }
                    //var_dump($check_arr);
                    if ($_GET['date']) {
                        $arr_get_date = explode('-', $_GET['date']);
                        foreach ($arr_get_date as $key => $value) {
                            $arg = trim($value);
                            $arr_get_date[$key] = trim($arg,'0');
                        }
                    }

                    //var_dump($new_date);
                    $_monthsList = array(".01." => "января", ".02." => "февраля",
                        ".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня",
                        ".07." => "июля", ".08." => "августа", ".09." => "сентября",
                        ".10." => "октября", ".11." => "ноября", ".12." => "декабря");
                    $currentDate = date("d.m.", strtotime($date));
                    $_mD = date(".m.", strtotime($date));
                    $currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);
                    $sticker_background = get_field('sticker_background', $item->ID) ? get_field('sticker_background', $item->ID) : '';
                    $sticker_text = get_field('sticker_text', $item->ID) ? get_field('sticker_text', $item->ID) : '';
                    if (!empty(get_field('p_doshkolniki_sale', $item->ID)) || !empty(get_field('p_shkolniki_sale', $item->ID)) || !empty(get_field('p_studenty_sale', $item->ID)) || !empty(get_field('p_vzroslie_sale', $item->ID)) || !empty(get_field('p_pensionery_sale', $item->ID)) || !empty(get_field('p_vzroslie_inostrancy_sale', $item->ID)) || !empty(get_field('p_studenty_inostrancy_sale', $item->ID)) || !empty(get_field('p_deti_inostrancy_sale', $item->ID))) {
                        $is_sale = true;
                    } else {
                        $is_sale = false;
                    }
                    $video_after_gates = get_field('video_after_gates', $item->ID);

                    if (get_field('p_shkolniki_sale', $item->ID)) {
                        $datacost = get_field('p_shkolniki_sale', $item->ID);
                    } elseif ( get_field('p_shkolniki', $item->ID) ) {
                        $datacost = get_field('p_shkolniki', $item->ID);
                    } elseif (get_field('p_doshkolniki_sale', $item->ID)){
                        $datacost = get_field('p_doshkolniki_sale', $item->ID);
                    }  elseif (get_field('p_doshkolniki', $item->ID)){
                        $datacost = get_field('p_doshkolniki', $item->ID);
                    }  else {
                        $datacost = get_field('p_vzroslie', $item->ID);
                    }
                    $data_date = '"123",';
                    if ($new_date) {
                        foreach ($new_date as $key => $value) {
                            $data_date .= '"' . $value . '",';
                        }
                    } else {
                        $data_date = '';
                    }


                    ?>

                    <div class="content__tour tour <?=$terms?>" data-crm-id="<?=get_field('id_crm', $item->ID)?>" data-wp-id="<?=$item->ID?>" data-sale="<?php echo $is_sale; ?>" <?php if($datacost) { echo 'data-cost="' . $datacost . '"'; } ?>  data-duration="<?php echo $durationclear; ?>" data-exlusive="<?=get_field('eksklyuziv', $item->ID)?>" data-popular="<?php echo $num; ?>"  data-stuff='[<?php echo $data_date; ?>]'<?php  if($arr_get_date && empty(array_intersect($arr_get_date, $check_arr))){ echo 'style="margin-right: 10px; display: none;"';} ?>>
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
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/Spinner-1s-200px.svg"
                                <?php /* data-src="<?=$thumbnail_url?>" */ ?>
                                    data-src="<?=get_webp($thumbnail_url)?>"
                                    alt="tour-image"
                                <?php /* class="tour__image lazy" */ ?>
                                    class="tour__image lazy"
                            />
                            <?php if ($video_after_gates): ?>
                                <span class="has_video" data-ll-status="observed"><svg height="100%" version="1.1" viewBox="0 0 68 48" width="35" style="position: absolute;top: 0;left: 0;"><path class="" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg></span>
                            <?php endif ?>


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

                            <?php if ((get_field('p_doshkolniki_sale', $item->ID) || get_field('p_shkolniki_sale', $item->ID) || get_field('p_studenty_sale', $item->ID) || get_field('p_vzroslie_sale', $item->ID) || get_field('p_pensionery_sale', $item->ID) || get_field('p_vzroslie_inostrancy_sale', $item->ID) || get_field('p_studenty_inostrancy_sale', $item->ID) || get_field('p_deti_inostrancy_sale', $item->ID))  && $item->ID !=4386 ): ?>

                                <?php if (get_field('includ_sales', 'options')): ?>
                                    <?php
                                    $backgrounds = '#904aca';
                                    $sticker_txt = get_field('sticker_text', 'options') ? get_field('sticker_text', 'options') : '#fff';
                                    if (get_field('p_shkolniki_sale', $item->ID)) {
                                        $priceold = get_field('p_shkolniki', $item->ID);
                                        $pricenew = get_field('p_shkolniki_sale', $item->ID);


                                    } elseif (get_field('p_doshkolniki_sale', $item->ID)){
                                        $priceold = get_field('p_doshkolniki', $item->ID);
                                        $pricenew = get_field('p_doshkolniki_sale', $item->ID);

                                    }
                                    $newprice = 100-($pricenew*100/$priceold);

                                    ?>
                                    <span class="stick" style="background: <?php echo $sticker_backgrounds; ?> <?php if (get_field('sticker', $item->ID) || have_rows('stick_group', $item->ID)) {echo ';top: '. $top .'px;';}?>" >
							  		<span class="quatr" style="background: <?php echo $sticker_backgrounds; ?>"></span>
							  		<span class="text" style="font-weight: 500;color: <?php echo $sticker_txt; ?>">Скидка -<?php echo round($newprice);?>% c 23 по 30 ноября</span>
							  	</span>
                                <?php else: ?>
                                    <?php $backgound =  "#45c451"; ?>
                                    <?php $color = $sticker_text ? $sticker_text : "#fff"; ?>
                                    <span class="stick" style="background: <?php echo $backgound;?> <?php if (get_field('sticker', $item->ID) || have_rows('stick_group', $item->ID)) {echo ';top: '. $top .'px;';}?>">
							  		<span class="quatr" style="background: <?php echo $backgound;?>"></span>
							  		<span class="text" style="color: <?php echo $color;?>">Скидка на билеты</span>
							  	</span>
                                <?php endif ?>

                            <?php endif ?>
                        </a>
                        <a href="<?=$url?>" class="tour__content">
                            <h4 class="tour__title"><?=$item->post_title?></h4>
                            <noindex><p><?=$prevDesc?></p></noindex>
                            <?php if($tury): ?>
                                <?php
                                $periodicity = (get_field('turi_otpravlenie', $item->ID))?get_field('turi_otpravlenie', $item->ID):'по запросу';
                                $start_time = (get_field('turi_mounthes', $item->ID))?get_field('turi_mounthes', $item->ID):'по запросу';
                                $duration = (get_field('turi_duration', $item->ID))?get_field('turi_duration', $item->ID):'по запросу';
                                $true_price = (get_field('turi_price', $item->ID))?get_field('turi_price', $item->ID).' руб/чел':'по запросу';
                                ?>
                                <div class="tour__info">
                                    <span class="tour__duration blue">Продолжительность: <?=$duration?></span>
                                    <span class="tour__days blue">Месяцы проведения: <?=$start_time?></span>
                                </div>
                            <?php else: ?>
                                <div class="tour__info">
                                    <span class="tour__days"><?=$periodicity?></span>
                                    <span class="tour__time"><?=$start_time?></span>
                                    <span class="tour__duration"><?=$duration?></span>
                                    <span class="tour__addr"><?=$addr?></span>
                                </div>
                            <?php endif; ?>
                            <?php if(get_field('id_crm', $item->ID)): ?>
                                <div class="tour__tickets-left">
                                    Билетов на <?php echo $currentDate; ?>:
                                    <span id="count_tickets">30</span>
                                </div>
                            <?php else: ?>
                                <div class="tour__tickets-left tour__tickets-space"></div>
                            <?php endif; ?>
                            <div class="tour__cost">
                                <?php if ( !in_array('excursions-in-english', $terms_arr) ): ?>
                                    <?php
                                    $rub =' руб/чел'; $norub = ' по запросу';
                                    ?>
                                    Стоимость:
                                <?php else: ?>
                                    <?php
                                    $rub =' rub/person'; $norub = ' on request';
                                    ?>
                                    Cost:
                                <?php endif ?>

                                <?php if(get_field('p_shkolniki', $item->ID)): ?>
                                    <span>от
								<span id='min_cost'>

									<?php if(get_field('p_shkolniki_sale', $item->ID)): ?>
                                        <span class='old-price-front'><?=get_field('p_shkolniki', $item->ID)?></span>
                                        <span class="ajax_price"><?=get_field('p_shkolniki_sale', $item->ID)?></span> <?=$rub?>
                                    <?php else: ?>
                                        <span class="ajax_price"><?=get_field('p_shkolniki', $item->ID)?></span> <?=$rub?>
                                    <?php endif; ?>
								</span>
							</span>
                                <?php elseif($tury): ?>
                                    <span>от
								<span id='min_cost'>
									<?php if (get_field('turi_price_old', $item->ID)) { ?>
                                        <span class='old-price-front'><?=get_field('turi_price_old', $item->ID)?></span>
                                    <?php } ?>
                                    <?php if (get_field('turi_price', $item->ID)) { ?>
                                        <span class="ajax_price"><?=get_field('turi_price', $item->ID)?></span><?=$rub?>
                                    <?php } ?>
								</span>
							</span>
                                <?php else: ?>
                                    <span><?=$norub?></span>
                                <?php endif; ?>

                            </div>
                            <?php if (!in_array('excursions-in-english', $terms_arr)): ?>
                                <a href="<?=$url?>" class="tour__book">Забронировать</a>
                            <?php else: ?>
                                <a href="<?=$url?>" class="tour__book">Book now</a>
                            <?php endif ?>
                        </a>
                    </div>

                    <?php
                }
                wp_reset_postdata();
                }      ?>

        </div>

    </div>
</section>
<?php get_footer(); // подключаем footer.php ?>

