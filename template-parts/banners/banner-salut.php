<style>

.catalog_banner-salut .catalog_banner__block{
	height:100%;
	z-index:2;
	position:relative
}
.catalog_banner-salut .catalog_banner__block>*:first-child{
	width: 80%;
    margin: 16px auto auto auto;
}
.catalog_banner-salut .catalog_banner__block>*:first-child img{
	width: 100%;
}
.catalog_banner-salut .catalog_banner__block>*:last-child img {
    width: calc(100% - 60px);
    max-width: 380px;
}
.catalog_banner-salut .catalog_banner__block>*:last-child{
	position: absolute;
    bottom: 30px;
    width: 100%;
    text-align: center;
}
.catalog_banner-salut::before,
.catalog_banner-salut::after{
	content: '';
	display: block;
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height: 60px;
	background: linear-gradient(0deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
	z-index:1
}
.catalog_banner-salut::after{
    top: unset;
    bottom: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgb(0 0 0 / 90%) 100%);
    height: 350px;
}
</style>

<a href="/salyut-v-chest-dnya-goroda" class="catalog_banner catalog_banner-salut content__tour tour" style="background-image:url(<?=$theme_url?>/assets/images/banners/slut_bg.jpg)">
	<div class="catalog_banner__block">
		<div>
			<img src="<?=$theme_url?>/assets/images/banners/salut_text1.svg" alt="">
		</div>
		<div>
			<img src="<?=$theme_url?>/assets/images/banners/salut_text2.svg" alt="">
		</div>
	</div>
</a>