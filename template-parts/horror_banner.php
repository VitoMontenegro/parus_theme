<?php if(!isset($theme_url) || $theme_url) $theme_url = get_stylesheet_directory_uri(); ?>

<style>
	
	@font-face {
		font-family: youmurdererbb;
		src: url(<?=$theme_url?>/fonts/youmurdererbb.otf);
	}
	

	.horror_banner__2nd {
		font-family: youmurdererbb;
		font-size: 80px;
		color: #FED532;
		line-height: 58px;
		margin: 6px 0 8px 0px;
	}
	@media (max-width:670px) and (min-width:577px){
		.horror_banner__1st {
			font-size: 14px;
		}
		.horror_banner__2nd {
			font-size: 60px;
			line-height: 43px;
		}
		.horror_banner__3rd {
			font-size: 11px;
		}
		.horror_banner__block {
			top: calc(50% - 362px / 2)!important;
		}
	}
</style>

<a href="/tours/uzhasy_peterburga/" class="horror_banner horror_banner-true content__tour tour" style="background-image:url(<?=$theme_url?>/assets/images/banners/horror2.jpg)">
	<div class="horror_banner__block">
		<div class="horror_banner__1st">эксклюзив</div>
		<div class="horror_banner__2nd">Ужасы Петербурга</div>
		<div class="horror_banner__3rd">Узнайте самые страшные истории города</div>
	</div>
	<div class="horror_banner__btn">Узнать подробнее</div>
</a>