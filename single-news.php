<?php
/**
 * Template Name: Страница новости
 * Template Post Type: post 
 * Шаблон стриници новости (single-news.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?>
<section class="page-content page-default-content">
    <div class="container">
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <div><?php esc_html_e( '', 'swell-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'swell-lite' ) ); ?></div>
     <?php the_content(); ?>
 <?php endwhile; ?>
    </div>
</section>
<?php get_footer(); // подключаем footer.php ?>