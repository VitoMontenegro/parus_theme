<?php $date = (get_field('date_reviews'))?get_field('date_reviews'):get_the_date('j F Y'); ?>
<div class="content__review review">
	<?php if (get_field('gid') || get_field('excursion') || get_field('excursion_obj')): ?>
		<div class="review__author">
			<?php if (get_field('gid')): ?>
				<div class="gid">
					<div class="gid-accreditation">Экскурсовод</div>

					<?php $gidarr = explode(',', get_field('gid')); ?>
					<ul>
						<?php foreach ($gidarr as $gid): ?>									
							<?php if ($gid != 'othergid'): ?>
								<li><?php echo $gid ?></li>
							<?php endif ?>								
						<?php endforeach ?>
					</ul>

				</div>
			<?php endif ?>
			<div class="excursion">
				<div class="excursion-list">Экскурсия</div>
				<?php if($excursions = get_field('excursion_obj')): ?>
					<ul>
						<?php foreach($excursions as $item): ?>
							<?php $name = (get_field('h1', $item))?get_field('h1', $item):get_the_title($item); ?>
							<?php if(get_post_status($item)=='publish'): ?>
								<li><a href="<?=get_the_permalink($item)?>"><?=$name?></a></li>
							<?php else: ?>
								<li><?=$name?></li>
							<?php endif ?>
						<?php endforeach ?>
					</ul>
				<?php elseif (get_field('excursion')): ?>
					<?php $excursionarr = explode(',', get_field('excursion')); ?>
					<ul>
						<?php foreach ($excursionarr as $excursion): ?>
							<?php if ($excursion): ?>
								<?php 
								$tour = get_posts([
									'post_type' => 'tours',
									"s" => $excursion
								]);
								?>
								<?php if($tour): ?>
									<li><a href="<?=get_the_permalink($tour[0])?>"><?php echo $excursion ?></a></li>
								<?php else: ?>
									<li><?php echo $excursion ?></li>								
								<?php endif ?>
							<?php endif ?>
						<?php endforeach ?>
					</ul>
				<?php endif ?>
			</div>
		</div>				
	<?php endif ?>

	<div class="review__text">
		<p class="review__author-name"><?php the_title(); ?></p>
		<p class="review__author-date"><?=$date?></p>
		<?php $rating = get_field('rating') ? 20*get_field('rating') : 0 ?>
		<div class="rating__stars"> 
			<span class="rating__stars-empty" data-ll-status="observed"></span> 
			<span class="rating__stars-fill" style="width: <?php echo $rating; ?>%" data-ll-status="observed"></span>
		</div>
		<?php if(get_field('review_img')): ?>
			<a class="review_slider--img_href" rel="gall<?php echo get_the_ID(); ?>" href="<?=get_field('review_img',$item->ID)['url']?>">
				<img src="<?=get_field('review_img',$item->ID)['sizes']['thumbnail']?>" alt="">
			</a>
		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>

		<?php 
			$images = get_field('галерея');
			$size = 'full'; // (thumbnail, medium, large, full или произвольный размер)
		?>
		<?php if( $images ): ?>
			<ul class="galery_rew">
				<?php foreach( $images as $image ): ?>
					<li>
						<a data-fancybox="gallery<?php echo get_the_ID(); ?>" href="<?php echo $image['url']; ?>">
							<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if (get_field('review_answer') && get_field('review_answer_show') != true): ?>
			<div class="review_answer_title">Официальный ответ<span class="sm-hide"> экскурсионного бюро «Парус»</span></div>
			<div class="review_answer_txt">
				<?php the_field('review_answer') ?>
			</div>
		<?php endif ?>

	</div>
</div>