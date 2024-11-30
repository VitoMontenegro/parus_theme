<?php
/**
 * Block Name: Гид
 */

$gid_name = explode(' ', get_field('name'));
$gid_name_last = array_pop($gid_name);
array_unshift($gid_name, $gid_name_last);
$gid_review = get_field('review');
$gid_video_review = getDzenSrc(get_field('review_video'));
$gid_video_fragment = getDzenSrc(get_field('video_fragment'));
$dots = 0;
?>

<div class="gid gid-card">
	<div class="gid__title">
		<a href="<?php the_field('img'); ?>" class="gid__img" style="background-image:url(<?php the_field('img'); ?>)"></a>
		<div class="gid__title_info">
			<div class="gid__name">
				<?php foreach($gid_name as $item): ?>
					<span><?=$item?></span>
				<?php endforeach ?>
			</div>
			 <div class="gid-experience"><?php the_field('experience'); ?></div>
		</div>
	</div>
	<div class="gid__accreditation"><?php the_field('accreditation'); ?></div>
	<div class="gid__more">
		<div class="gid__more_title">Подробнее</div>
		<div class="gid__more_tabs">
			<?php if($gid_video_review): ?>
				<?php $dots++; ?>
				<div class="gid__more_tab" data-tab="video_review">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M4.66699 4.54663V11.4533C4.66699 11.98 5.24699 12.3 5.69366 12.0133L11.1203 8.55997C11.5337 8.29996 11.5337 7.69997 11.1203 7.4333L5.69366 3.98663C5.24699 3.69996 4.66699 4.01996 4.66699 4.54663Z" fill="white"/>
					</svg>
					<span>Видео-отзыв</span>
				</div>
			<?php endif ?>
			<?php if($gid_video_fragment): ?>
				<?php $dots++; ?>
				<div class="gid__more_tab" data-tab="video_fragment">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M4.66699 4.54663V11.4533C4.66699 11.98 5.24699 12.3 5.69366 12.0133L11.1203 8.55997C11.5337 8.29996 11.5337 7.69997 11.1203 7.4333L5.69366 3.98663C5.24699 3.69996 4.66699 4.01996 4.66699 4.54663Z" fill="white"/>
					</svg>
					<span>Фрагмент с экскурсии</span>
				</div>
			<?php endif ?>
			<?php if($gid_review): ?>
				<?php $dots++; ?>
				<div class="gid__more_tab" data-tab="review">
					<span>Отзыв</span>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="gid__tabs">
		<?php if($gid_video_review): ?>
			<div class="gid__tab" data-tab="video_review" style="display:none">
				<iframe style="width: 100%; height: 278px;    display: block;" src="<?=$gid_video_review?>" allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
			</div>
		<?php endif ?>
		<?php if($gid_video_fragment): ?>
			<div class="gid__tab" data-tab="video_fragment" style="display:none">
				<iframe style="width: 100%; height: 278px;    display: block;" src="<?=$gid_video_fragment?>" allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
			</div>
		<?php endif ?>
		<?php if($gid_review): ?>
			<div class="gid__tab" data-tab="review" style="display:none">
				<div class="gid__review">
					<img src="/wp-content/themes/parus/img/quote.png" alt="">
					<p><?=$gid_review?></p>
					<b><?php the_field('review_author'); ?></b>
				</div>
			</div>
		<?php endif ?>
	</div>
	<?php if($dots>0): ?>
		<div class="gid__dots">
			<?php for($i=0;$i<$dots;$i++): ?>
				<div class="gid__dot<?php if($i==0): ?> active<?php endif ?>"></div>
			<?php endfor ?>
		</div>
	<?php endif ?>
</div>

<style>
</style>