<?php
/**
 * Шаблон отдельной акции (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php 
$fields = get_fields();
$h1 = !empty($fields['h1']) ? $fields['h1'] : get_the_title();
$dateisset = !empty($fields['date_end']) ? $fields['date_end'] : '';
if ($dateisset) {
    $datearr = explode('/', $dateisset);
}
?>

<?php
    $theme_url = get_stylesheet_directory_uri();
?>

<section class="content content--promo mt-40">
	<div class="container">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="promo_wrap">
                    <div class="promo_thumb">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="thumbnail">
                                <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php echo $h1 ?>">
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="promo_content">
                        <h1><?php echo $h1 ?></h1>
                        <?php if ($dateisset): ?>
                            <div class="endOfDate" data-full_year="<?php echo $datearr[2] ?>" data-month="<?php echo $datearr[1] ?>" data-day = "<?php echo $datearr[0] ?>">
                                <span class="txt">До конца акции: </span><span data-time="<?php echo $fields['date_end'] ?>" id="endCount"></span>
                            </div>                            
                        <?php endif ?>

                        <?php the_content(); ?>

                        <?php if ($fields['promo_code']): ?>
                            <div class="promoCode">
                                <div class="promoDate"><span class="bold_upper">Ваш промокод</span> <span class="promo_body"><?php echo $fields['promo_code'] ?></span></div>
                                <a rel="nofollow" href="#" onclick="copyToClipboard('<?php echo $fields['promo_code'] ?>');opensuccess();return false;" class="share_hint__copy">Скопировать</a>
                            </div>
                            
                        <?php endif ?>
                    </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<section class="content--group-tour-page">
    <div class="container">
        <?php 
			if(get_the_ID() == 9828){
				$recs = get_posts( array(
					'numberposts' => -1,
					'post_type' => 'tours',
					'orderby'   => 'rand',
					'suppress_filters' => true
				) );
				foreach($recs as $k => $item){
					if(!get_field('p_shkolniki_sale', $item->ID))
						unset($recs[$k]);
				}
			} else {
				if ($fields['recommended']) {
					$recs = get_posts( array(
						'post_type' => 'tours',
						'include' => $fields['recommended']
					) );
				} else {
					$recs = get_posts( array(
						'numberposts' => -1,
						'post_type' => 'tours',
						'orderby'   => 'rand',
						'suppress_filters' => true
					) );
				}
			}

        ?>
                
        <h3 class="content__recommend-title exc">
            Эта акция подходит к экскурсиям:
        </h3>
    
        <div class="content__tours mb-5">
            <?php $i=0; ?>          
            <?php foreach($recs as $item): ?>
                <?php if (get_field('id_crm', $item->ID) || $lang == 'en'): ?>
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
                    
                    <div class="content__tour tour <?=$terms?>" data-crm-id="<?=get_field('id_crm', $item->ID)?>">
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

                            <?php if(get_field('id_crm', $post->ID)): ?>
                              <div class="tour__tickets-left">
                                Билетов на <?php echo $currentDate; ?>:
                                <span id="count_tickets">30</span>
                              </div>
                            <?php elseif($term_id != 33 || $num_tour): ?>
                                <div class="tour__tickets-left tour__tickets-space"></div>
                            <?php endif; ?>

                            <div class="tour__cost">
                                Стоимость:
                                <span>
                                    от 
                                    <span id="min_cost">
                                        <?php if (get_field('p_doshkolniki_sale', $item->ID)): ?> 
                                            <?php echo get_field('p_doshkolniki_sale', $item->ID); ?> руб/чел
                                        <?php elseif(get_field('p_doshkolniki', $item->ID)): ?> 
                                            <?php echo get_field('p_doshkolniki', $item->ID); ?> руб/чел
                                        <?php elseif(get_field('p_shkolniki_sale', $item->ID)): ?>  
                                            <?php echo get_field('p_shkolniki_sale', $item->ID); ?> руб/чел
                                        <?php else: ?>  
                                            <?php echo get_field('p_shkolniki', $item->ID); ?> руб/чел
                                        <?php endif ?>

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
                <?php endif ?>

            <?php endforeach; ?>
        </div>
    </div>
</section>
<style>
    .mb-5 {
        margin-bottom: 20px;
    }
    .mt-40 {
        margin-top: 40px;
    }
    .promo_wrap {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .promo_thumb {
        width: 42%;
    }
    .promo_content {
        width: 55%;
    }
    .promo_thumb img {
        width: 100%;
        border-radius: 5px;
    }
    .promoCode {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .endOfDate {
        margin-bottom: 20px;
    }

    .promoDate {
        padding: 10px 20px;
        border: 2px solid #bab8b8;
        border-radius: 20px;
        font-weight: bold;
        margin-right: 20px;
    }
    .promoDate .bold_upper {
        text-transform: uppercase;
        margin-right: 10px;
    }

    .promo_body {
        color: #aeaaaa;
        text-transform: uppercase;
    }

    .promoCode a {
        color: #fff;
        background-color: #0099ce;
        box-shadow: 0px 4px 20px rgb(120 120 120 / 30%);
        border-radius: 30px;
        display: flex;
        align-items: center;
        text-decoration: none;
        padding: 8px 35px;
        min-height: 40px;
    }


    .endOfDate {
        font-weight: bold;
    }
    .endOfDate .txt {
        color: #eb4545;
        margin-right: 20px;
    }
    @media screen and (max-width: 796px) {
        .promo_thumb, .promo_content {
            width: 100%;
        }
        .endOfDate .txt {
            display: block;
            margin-bottom: 5px;
        }
    }

    @media screen and (max-width: 796px) {
        .promoDate, .promoCode a {
            width: auto;
            margin: 0 0 10px;
        }
    }
</style>

<script>
    var copyToClipboard = function copyToClipboard(str) {
        $.cookie('promoCode', str,{path: '/'});
        var el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };

    function opensuccess() {
        $('.modal__content--copy').show();
        $('.modal').fadeIn(700);
        $(document.body).css('overflow', 'hidden');
    }
</script>
<?php get_footer(); ?>
