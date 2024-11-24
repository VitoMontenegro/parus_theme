<?php
/**
 * Страница с рубрики новости
 * @package WordPress
 * Template Name: Новости
 */
get_header(); ?>
	<section class="content pageContentNews content--thanks">
		<div class="container">	
        <h1 class="pageTitle">
			Новости
            </h1>
			<?php
				$args = array(
					'posts_per_page' => '999',
					'category'    => 22,
					'post_type' => 'post',
                    );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ){ 
                setup_postdata($post); ?>
				<div class="newsItem">
						<a href="<?=get_permalink()?>"><h2 class="newsTitel" style="margin: 0px 0 15px 0;"><?php the_title(); ?></h2></a>
						<?/* <p class="dateItemNews"><?php esc_html_e( '', 'swell-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'swell-lite' ) ); ?></p>*/?>
						<div class="newsPhoto">
                        <?php the_post_thumbnail(); ?></div>
                        <p class="descNews"><?=wp_trim_words( get_the_content(), 40);?></p>
						<a class="readMoreNews" href="<?=get_permalink()?>"> Подробнее</a>
					</div>
				<?php
				}
			wp_reset_postdata(); // сбрасываем переменную $post
			?>
		</div>
	</section>
<?php get_footer(); ?>