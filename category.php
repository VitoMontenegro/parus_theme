<?php
/**
 * Шаблон рубрики (category.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */

if(is_paged() && !is_home()) {
  wp_redirect('/'.strtoupper(get_queried_object()->slug), 301);
  exit();
}
get_header(); // подключаем header.php 
?> 
<section class="content content--thanks">
	<div class="container">
        <h1><?=get_queried_object()->name?></h1>
		<?=get_queried_object()->description?>
	</div>
</section>

<?php get_footer(); // подключаем footer.php ?>