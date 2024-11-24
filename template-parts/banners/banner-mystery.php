<style>
.catalog_banner_mystery_text {
    width: calc(100% - 52px);
    position: absolute;
    top: 30px;
    left: 26px;
}

.mystery_text_shadow {
    position: absolute;
    width: calc(100% - 98px);
    top: 37px;
    left: 12px;
}
.mystery_text_btn.horror_banner__btn{
	position: absolute;
    bottom: 0;
    left: 10%;
}
.mystery_mob_img{
	display:none;
}
@media (max-width:576px){
	body .catalog_banner-mystery{
		min-height: unset;
	}
	.mystery_mob_img{
		display:block;
		max-width:100%
	}
	.mystery_text_shadow,.catalog_banner_mystery_text{
		display:none;
	}
}
</style>


<a href="/tajny-nochnogo-peterburga" class="catalog_banner catalog_banner-mystery content__tour tour" style="background-image:url(<?=$theme_url?>/img/banners/bg_mystery.jpg)">
	<img class="catalog_banner_mystery_text" src="<?=$theme_url?>/img/banners/mystery-text.svg" alt="">
	<img class="mystery_text_shadow" src="<?=$theme_url?>/img/banners/mystery_text_shadow.png" alt="">
	<div class="mystery_text_btn horror_banner__btn">Узнать подробнее</div>
	<img class="mystery_mob_img" src="<?=$theme_url?>/img/banners/mystery-mob.jpg" alt="">
</a>