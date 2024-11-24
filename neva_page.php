<?php
/**
 * Template Name: Neva Page
 */ 
 global $wpdb;
 
get_header(); 
 $theme_url = get_stylesheet_directory_uri();
$all_posts = get_posts( array(
	'numberposts' => -1,
	'post_type' => 'tours',
	'post_status' => 'any',
	'suppress_filters' => true,
	'tax_query' => array(                                  // элемент (термин) таксономии 
		array(
			'taxonomy' => 'excursion',         // таксономия 
			'field' => 'slug',
			'terms'    => 'nevatravel123123' // термин 
		)
	),
) );

$ids = [];
$cur_t = time()+60*60*3;
$shedule_all = $wpdb->get_results('SELECT DISTINCT program_id FROM wp_nevatickets WHERE departure_time>='.$cur_t.' ORDER BY departure_time ASC;');
foreach($shedule_all as $item){
	$ids[] = $item->program_id;
}

foreach($all_posts as $key => $item){
	$f = get_field('neva_id', $item);
	if(!in_array($f, $ids))
		unset($all_posts[$key]);
}

?>
<section class="content content--bus">
  <div class="container">
  <h1 class="mainh"><?=get_field('h1')?></h1>
  
<div class="content__tours">
	<?php $num = 0; ?>
	<?php foreach($all_posts as $key => $item): ?>
		<?php include('template-parts/loop-front-preview.php'); ?>
	<?php endforeach; ?>
</div>
</div>
</section>


<?php get_footer(); // подключаем footer.php ?>