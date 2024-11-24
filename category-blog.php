<?php

add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
/**
 * Страница с рубрики блог
 * @package WordPress
 * Template Name: Блог
 */
get_header(); ?>
	<section class="content content--thanks">
		<div class="container">	
        	<h1 class="pageTitle">Интересные заметки</h1>
        	<?php if ( have_posts() ) : ?>
        		<div class="wp-block-columns wrap">
	        		<?php while ( have_posts() ) : the_post(); ?>
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
								$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
								$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
								$excerpt = $excerpt . '...';
								?>
								<p class="descNews"><?php echo $excerpt; ?></p>
								<?php /*
								<p class="descNews"><?php echo wp_trim_words( get_the_content(), 20);?></p>
								*/ ?>
							</a>
						</div>
					<?php endwhile; ?>
        		</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>
<?php get_footer(); ?>