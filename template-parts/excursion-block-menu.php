<?php

$theme_locations = get_nav_menu_locations();

$menu_obj = get_term( $theme_locations['excursion'], 'nav_menu' );

$menu_items = wp_get_nav_menu_items($menu_obj);

?>

<?php if($menu_items): ?>

<div class="category-cards">
    <?php foreach($menu_items as $menu_item):
        $image = get_field('menu_item_image', $menu_item->ID); ?>
    <a href="<?php echo $menu_item->url; ?>" class="lazy-bg category-card" data-src=<?php echo $image ? $image : ''; ?>>
        <h3 class="category-card__title"><?php echo $menu_item->title; ?></h3>
    </a>
    <?php endforeach; ?>
</div>

<?php endif; ?>