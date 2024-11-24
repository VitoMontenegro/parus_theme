<?php
/**
 * Страница с кастомным шаблоном (page-custom.php)
 * @package WordPress
 * Template Name: Страница "Благодарности"
 */
get_header(); 
$h1 = (get_field('h1'))?get_field('h1'):get_the_title();
$gallery = get_field('gal');
?>
<section class="content content--thanks">
	<div class="container">
		<h1><?=$h1?></h1>
		<?php the_content(); ?>
        <div class="content__thanks">
			<div class="modal-images-fullsize">
				<?php foreach($gallery as $k => $item): ?>
				    <img src="<?=$item['url']?>" />
				<?php endforeach; ?>
			</div>
			<?php foreach($gallery as $k => $item): ?>
				<img
					src="<?=$item['sizes']['medium']?>"
					alt="thanks-photo"
					class="content__list"
					modal-img-id="<?=$k?>"
				/>
			<?php endforeach; ?>
        </div>
      </div>
    </section>
<?php get_footer(); ?>