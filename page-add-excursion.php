<?php
/**
 * Страница с кастомным шаблоном (page-custom.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Добавить экскурсию (для подписчиков)
 */
acf_form_head();
get_header(); // подключаем header.php ?>
<?php
	$id = 'new_post';
	$current_user_id = get_current_user_id();
	if($current_user_id)
		$query = new WP_Query('author='.$current_user_id.'&post_type=tours&post_status=any');
	if(isset($query) && count($query->posts))
		$id = $query->posts[0]->ID;
		

?>
<section>
	<div class="container">
	<?php
		$args = array(
			'post_id' => $id,
			'new_post' => array(
				'post_type' => 'tours',
				'post_status' => 'draft',
			),
			'post_title' => true,
			'post_content' => true,
			'fields' => ['galery'],
			'uploader' => 'basic',
			'submit_value' => 'Создать',
			'updated_message' => 'Ваша запись поставлена в очередь на модерацию',
			'label_placement' => 'left',
		);
		acf_form( $args );
	?>
	</div>
</section>
<?php get_footer(); // подключаем footer.php ?>