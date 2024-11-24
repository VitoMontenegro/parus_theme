<?php
/**
 * Запись в цикле (promo.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */ 
 
 $term_id = get_queried_object()->term_id;
 $lang = ($term_id == 41)?'en':'ru';
?>

<div class="content__tour tour promo" data-true-price="999999" data-popular="99999">
            <div class="subscribe-card__title">
                <?=($lang=='en')?'It is convenient and safe with us':'С нами удобно и безопасно'?>
            </div>
            <div class="f-item p6">
                <div class="f-icon" style="margin-bottom: 6px;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumb-up.svg" alt="Бесплатная отмена бронирования">
                </div>
				<?php if($lang=='en'): ?>
					<div style="font-size: 16px" class="f-header">Free cancellation of<br>booking till 24 hours</div>					
				<?php else: ?>
					<div class="f-header for-pc"><a style="font-size: 16px" target="_blank" href="/usloviya/">Бесплатная отмена <br>бронирования за 24 ч</a></div>
					<div class="f-header for-mobile"><a style="font-size: 16px" target="_blank" href="/usloviya/">Бесплатная отмена <br>брони за 24 часа</a></div>
				<?php endif; ?>
            </div>
            <div class="f-item">
                <div class="f-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/bus.svg" alt="Собственный транспорт">
                </div>
                <div class="f-header">
					<a style="font-size: 16px" href="/avtopark/" target="_blank">
						<?php if($lang=='en'): ?>
							Our own<br>modern transport
						<?php else: ?>
							Современный транспорт
						<?php endif; ?>
					</a>
				</div>
            </div>
            <div class="f-item">
                <div class="f-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/museum.svg" alt="Вход без очереди в музеи">
                </div>
				<?php if($lang=='en'): ?>
					<div style="font-size: 16px" class="f-header">Entering to the museums<br>without queue</div>					
				<?php else: ?>
				<div style="font-size: 16px" class="f-header"><a style="font-size: 16px" href="/muzei-bez-ocheredi" target="_blank">Вход без очереди<br>в музеи</a></div>
				<?php endif; ?>                
            </div>
            <div class="f-item">
                <div class="f-icon" style="margin-bottom: 1px;">
                	
                    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/office.svg" alt="Офис в центре города">
                    
                </div>
                <div class="f-header" style="font-size: 16px; color: #0099ce;">
						<?php if($lang=='en'): ?>
							Our office <br>in the city center
						<?php else: ?>
							Офис в центре города
						<?php endif; ?>	
				</div>
            </div>
</div>