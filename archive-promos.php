<?php

    wp_redirect( '/skidki', 301 );
    status_header(301);
    exit;

    
get_header(); ?>
	<section class="content content--thanks">
		<div class="container">	
        	<h1 class="pageTitle">Специальные предложения, акции и новые направления</h1>
            <?php 
                $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'promos'
                );
                $myposts = get_posts( $args ); ?>
             
                <div class="promo_wrap">
                    <?php $count_tem = 0 ?>

                    <?php foreach ($myposts as $post): setup_postdata($post); ?>
                        <div class="promos_item">
                            <div class="promosPhoto">
                                <?php $dateisset = !empty(get_field('date_end')) ? get_field('date_end') : ''; ?>
                                
                                <a href="<?php echo get_permalink()?>">
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php echo get_the_title()?>">
                                </a>
                                <?php if ($dateisset): ?>
                                    <?php $datearr = explode('/', $dateisset); ?>
                                    
                                    <?php if (time() < mktime(0,0,0,$datearr[1],$datearr[0],$datearr[2])): ?>
                                        <div class="endItemDate" data-full_year="<?php echo $datearr[2] ?>" data-month="<?php echo $datearr[1] ?>" data-day="<?php echo $datearr[0] ?>">
                                            <span class="itemTxt">До конца акции: </span>
                                            <span data-time="<?php echo $fields['date_end'] ?>" class="endItemCount" id="endItemCount<?php echo ++$count_tem; ?>"></span>
                                        </div>                                        
                                    <?php endif ?>

                                <?php endif ?>
                            </div>

                            <a class="promosTitle" href="<?php echo get_permalink()?>">
                                <h2><?php the_title(); ?></h2>
                            </a>
                                
                            <a href="<?php echo get_permalink()?>">
                                <p class="promosDesc">
                                    <?php if (get_field('short_desc')): ?>
                                        <?php the_field('short_desc') ?>
                                    <?php else: ?>
                                        <?php echo wp_trim_words( get_the_content(), 40);?> 
                                    <?php endif ?>
                                </p>
                            </a>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>              
                </div>
		</div>
	</section>

    <style>
    	.promos_item {
    		width: 32%;
    		border-radius: 20px;
    		overflow: hidden;
    		margin-bottom: 65px;
    	}
    	.promos_item a {
    		text-decoration: none;
    	}
        .promosPhoto {
            position: relative;
        }
    	.promosPhoto img {
    		width: 100%;
            height: 245px;
            object-fit: cover;
    	}
        .endItemDate {
            position: absolute;
            left: 0px;
            top: 15px;
            padding: 7px 7px 7px 7px;
            font-size: 14px;
            line-height: 20px;
            display: block;
            z-index: 12;
            background: #cc2f3e;
            color: #fff;
        }
        .itemTxt {
            display: block;
        }
    	.promosTitle {
    		text-decoration: none;
    	}
    	.promosTitle h2 {
    		font-size: 18px;
    		    margin: 5px 0 5px 0;
    	}
        p.promosDesc{
            position: relative;
            overflow-y: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .promosDesc:after {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, rgb(255 255 255 / 0%) 30%, rgb(255 255 255) 100%, rgb(255 255 255) 97%);
        }

        .mb-5 {
            margin-bottom: 20px;
        }
        .promo_wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .promo_thumb {
            width: 35%;
        }
        .promo_content {
            width: 62%;
        }
        .promo_thumb img {
            width: 100%;
            border-radius: 25px;
        }
        .promoCode {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }
        .endOfDate {
            margin-bottom: 20px;
        }

        .promoDate {
            padding: 10px 20px;
            border: 2px solid #bab8b8;
            border-radius: 5px;
            font-weight: bold;
        }
        .promoDate .bold_upper {
            text-transform: uppercase;
            margin-right: 10px;
        }

        .promo_body {
            color: #aeaaaa;
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
            .promos_item {
            	width: 48%;
            }
            .promoDate, .promoCode a {
                width: auto;
                margin: 0 0 10px;
            }
        }

        @media screen and (max-width: 494px) {
            .promos_item {
            	width: 100%;
            }
        }
    </style>

<?php get_footer(); ?>