<div class="cost_block">
	<h3 class="cost_title<?php if(get_field('cost_title_icon')) {echo " card";} ?>">
		<?php if (get_field('cost_title_icon')): ?>
			<img class="cost_card" src="<?php echo get_template_directory_uri() ?>/img/card.svg" alt="">
		<?php endif ?>
		<?php the_field('cost_title') ?>
	</h3>	
	<ul<?php if(get_field('cost_type_list') == 'plus') {echo ' class="plus"';} else {echo ' class="agree"';} ?>>
		<?php while ( have_rows('cost_list') ) : the_row() ?>
			<li><?php the_sub_field('cost_list_item') ?></li>
		<?php endwhile; ?>
	</ul>
</div>

