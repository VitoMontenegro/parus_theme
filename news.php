<?php
/**
 * Страница с кастомным шаблоном (page-custom.php)
 * @package WordPress
 * Template Name: Новости
 */
get_header(); ?>
	<section class="page-content page-default-content">
		<div class="container">	
			<?php the_content(); ?>
			<?php
				$args = array(
					'posts_per_page' => '999',
					'category'    => 7,
					'post_type' => 'post'
				);
				$myposts = get_posts( $args );
				foreach( $myposts as $post ){ setup_postdata($post);
				?>
					<div class="wp-block-table">
						<a href="<?=get_permalink()?>"><h2 class="newsTitel" style="margin: 0px 0 15px 0;"><?php the_title(); ?></h2></a>
						<p><?php esc_html_e( '', 'swell-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'swell-lite' ) ); ?></p>
						<?=							
							wp_trim_words( get_the_content(), 40);
						?>
						<a href="<?=get_permalink()?>"> ...Читать далее</a>
					</div>
				<?php
				}
			wp_reset_postdata(); // сбрасываем переменную $post
			?>
		</div>
	</section>
<?php get_footer(); ?>