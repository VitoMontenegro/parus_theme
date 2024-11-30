<?php
/**
* Страница с кастомным шаблоном (page-custom.php)
* @package WordPress
* Template Name: Отзывы
*/
//var_dump(get_the_content(null, null, 2425));
$gid_arr = []; //массив гидов []=>name
$excurs_arr = []; // массив экскурсий [id]=>title

$args = array(
	'post_type' => 'tours',
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'excursion',					
			'field' => 'term_id',
			'terms' => 3
		)
	)
);
$query = new WP_Query( $args );

foreach($query->posts as $post){
	$excurs_arr[$post->ID] = get_the_title();
}
wp_reset_postdata(); 

$parse_content = parse_blocks( get_the_content(null,null,2425) );
foreach ($parse_content as $key => $value) {
	if (isset($value["attrs"]["data"]["name"])) {
		$gid_arr[] = $value["attrs"]["data"]["name"];
	}
}

get_header(); 
$h1 = (get_field('h1'))?get_field('h1'):get_the_title();

$args = array(
	'posts_per_page' => '30',
	'post_type' => 'reviews'
);
$myposts = get_posts( $args );

$args2 = array(
	'numberposts' => -1,
	'post_type' => 'reviews'
);
$myposts2 = get_posts( $args2 );
?>
<section class="content content--reviews">
	<div class="container">
		<h1>Отзывы наших туристов (<?=count($myposts2)?>)</h1>

		<a href="#rev_form" class="content__review-add">Оставить отзыв</a>
		<?php the_content(); ?>

		<?php foreach( $myposts as $post ) :
			setup_postdata($post); 
			
			
			get_template_part('template-parts/loop', 'reviews');
			?>


			
		<?php endforeach; wp_reset_postdata(); ?> 
		<div class="text-center reviews__show_more_wrapper">
			<a href="#" class="reviews__show_more">Загрузить еще</a>
		</div>
	</div>

	<div class="container content--contacts">
		<form id="rev_form" class="content__form form reviews_form contact_page">
			<h3>Поделитесь впечатлениями</h3>
			<div class="form-wrap">
				<div class="form-left">
					<label class="form__label">
						<input name="name" type="text" required class="popup-input form__input name_field">
						<span class="placeholder-text">Ваше имя<span class="form__star">*</span></span>
					</label>

					<div class="kind_of_exc">
						<select id="chkex" name="excurs_arr[]" multiple="multiple">
							<option data-val="otherexcurs" value="">Ввести название вручную</option>
							<?php foreach ($excurs_arr as $key => $value): ?>
								<option value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php endforeach ?>
						</select>
					</div>

					<div class="step-field hide text-excurs to">
						<label class="form__label">
							<input class="field form__input name_field" name="excurs" placeholder="Напишите название экскурсии" type="text" />
						</label>
					</div>		

					<div class="kind_of_staff">
						<select id="chkveg" name="gid_arr[]" multiple="multiple">
							<option data-val="othergid" value="">Ввести имя вручную</option>
							<?php foreach ($gid_arr as $key => $value): ?>
								<option value="<?php echo $value ?>"><?php echo $value ?></option>
							<?php endforeach ?>
						</select>
					</div>


					<div class="step-field hide text-gid to">
						<label class="form__label">
							<input class="field form__input name_field" name="gid" placeholder="Напишите имя экскурсовода" type="text" />
						</label>
					</div>

					<label class="form__label mb0">
						<input name="email" type="email" class="popup-input form__input name_field">
						<span class="placeholder-text">Ваш Email</span>
					</label>
				</div>

				<div class="form-right">
					<div class="review-rating">
						<div class="label">Оцените ваши впечатления</div>
						<div class="rating-area">
							<input type="radio" id="star-1" name="rating" value="5">
							<label for="star-1" title="Оценка «5»"></label>
							<input type="radio" id="star-2" name="rating" value="4">
							<label for="star-2" title="Оценка «4»"></label> 
							<input type="radio" id="star-3" name="rating" value="3">
							<label for="star-3" title="Оценка «3»"></label> 
							<input type="radio" id="star-4" name="rating" value="2">
							<label for="star-4" title="Оценка «2»"></label>     
							<input type="radio" id="star-5" name="rating" value="1">
							<label for="star-5" title="Оценка «1»"></label>	   
						</div>       			
					</div>

					<label class="form__label form__textarea-block">
						<textarea name="message" required class="form__textarea popup-input"></textarea>
						<span class="placeholder-text">Напишите свой отзыв<span class="form__star">*</span></span>
					</label>
				</div>
			</div>

			<?php /*
				<div class="rating__stars"> 
				<span class="rating__stars-empty" data-ll-status="observed"></span> 
				<span class="rating__stars-fill" style="width: 94%;" data-ll-status="observed"></span>
				</div>
			*/ ?>

			<div class="form__footer">
				<p style="font-style:italic; font-weight:bold;padding-right:40px;margin:3px 0;"><span class="form__star">*</span><b>Если у вас есть претензии, вместе с отзывом оставьте свой E-mail и с вами свяжется отдел качества. Анонимные жалобы не публикуем.</b></p>
				<div class="flex-form">
					<div id="rev_upload">
						<div class="popup-input-content popup-input-file-content">
							<input type="file" id="browse"  multiple="multiple"  class="popup-input-file photo" name="file[]" accept="image/*">
							<div class="popup-input-file-btn">Прикрепите фотографии</div>
						</div>
						<div id="preview" class="file-name"></div>
						<img src="/wp-content/themes/parus/img/paper-clip.png" class="popup-input-file-img" alt="Изображение отзыва">
					</div>
					<input type="submit" value="Отправить" class="form__submit">					
				</div>

			</div>
			<?php /*
				<div style="margin-top: 15px;" class="form-agreement">Нажимая “Отправить” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.</div>
			*/ ?>
		</form>
	</div>

	<div class="container">
		<h2>Смотрите также</h2>
		<ul class="round-list"> 
			<li><a href="/"><a href="/"> Все экскурсии по Санкт-Петербургу</a></a> </li>
			<li><a href="/nochnyye/"> Экскурсия по ночному Санкт-Петербургу</a> </li>
		</ul> 
	</div>
</section>

<?php get_footer(); ?>