<?php
/**
 * Шаблон обычной страницы (page.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?>
<?php
	$h1 = (get_field('h1'))?get_field('h1'):get_the_title();
?>
<section class="page-content page-default-content">
    <div class="container">

    </div>
</section>
<section class="content content--thanks">
      <div class="container">
        <h1><?=$h1?></h1>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
      </div>
    </section>
<?php get_footer(); // подключаем footer.php ?>