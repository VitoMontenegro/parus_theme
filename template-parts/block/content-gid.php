<?php
/**
 * Block Name: Гид
 */

?>

<div class="gid gid-card">
    <div class="gid-img">
        <img src="<?php the_field('img'); ?>">
    </div>
    <div class="gid-info">
        <div class="gid-header"><?php the_field('name'); ?></div>
        <div class="gid-accreditation"><?php the_field('accreditation'); ?></div>
        <div class="gid-experience"><?php the_field('experience'); ?></div>
        <div class="gid-review">
            <div class="gid-review-header">Отзывы туристов</div>
            <div class="gid-review-text"><?php the_field('review'); ?></div>
            <div class="gid-review-author"><?php the_field('review_author'); ?></div>
        </div>
    </div>
</div>

<style>
</style>