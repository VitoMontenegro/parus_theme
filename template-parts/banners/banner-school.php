<style>
@font-face {
	font-family: "BeerMoney";
	src: url("/wp-content/themes/parus/fonts/banners/BeerMoney-08po.ttf");
}
@font-face {
	font-family: "impact";
	src: url("/wp-content/themes/parus/fonts/banners/impact.ttf");
}
@font-face {
	font-family: "MontserratExtraBold";
	src: url("/wp-content/themes/parus/fonts/banners/Montserrat-ExtraBold.ttf");
}
@font-face {
	font-family: "MontserratSemiBold";
	src: url("/wp-content/themes/parus/fonts/banners/Montserrat-SemiBold.ttf");
}

.catalog_banner-school {
    background-position: center;
	color:#fff;
    padding: 20px;

}
.school1_wrap_kids {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 90%;
    z-index: 1;
}
.school1_wrap_list-bg {
    background-size: cover;
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
	z-index: 2;
}
.school1_wrap_list {
    position: absolute;
    width: 150px;
    right: 12px;
    bottom: 22%;
    z-index: 32;
}
.school1_wrap,
.school2_wrap,
.school3_wrap {
    z-index: 10;
}
.school1, .school3 {
    font-family: "impact";
    font-size: 30px;
    text-align: center;
    text-transform: uppercase;
    line-height: normal;
    letter-spacing: 2px;
}
.school2 {
	font-family: "BeerMoney";
    font-size: 34px;
    background-image: url(/wp-content/themes/parus/img/banners/school-plash1.svg);
    text-align: center;
    background-size: contain;
    line-height: normal;
    color: #000;
    background-repeat: no-repeat;
    background-position: center bottom;
    margin: -6px auto 4px auto;
}
.school2_wrap {
    font-family: "BeerMoney";
    font-size: 26px;
    margin-top: 50px;
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    text-align: right;
}
.school_copy{
	font-size: 20px;
    text-transform: uppercase;
    color: #222!important;
	position: relative;
}
.school5 {
    width: 100%;
}
.school3_wrap small{
	font-size: 12px;
}
.school6 {
    text-align: right;
    padding-right: 60px;
    width: 100%;
}
.school3_wrap b,
.school3_wrap a{
	font-family: "MontserratExtraBold";
}
.school7 {
    text-align: right;
    width: 100%;
}
.school3_wrap {
    position: absolute;
    bottom: 20px;
    left: 0;
        padding: 54px 20px 36px 20px;
    color: #222222;
    background-image: url(/wp-content/themes/parus/img/banners/school-plash2.svg);
    font-family: "MontserratSemiBold";
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    text-align: center;
    font-size: 16px;
    line-height: 22px;
}
.school4 {
    width: 100%;
    text-align: left;
}
.school1_copyico {
    position: absolute;
    width: 13px;
    right: -16px;
    top: -2px;
}
@media (max-width:576px){
	.catalog_banner-school {
		min-height: 800px!important;
	}
}
@media (max-width:480px){
	.school2_wrap {
		margin-top: 10px;
	}
	.catalog_banner-school {
		min-height: 580px!important;
	}
	.school1_wrap_list{
		display:none;
	}
	.school1_wrap_kids {
		max-width: 326px;
	}
}
</style>


<div class="catalog_banner catalog_banner-school content__tour tour" style="background-image:url(<?=$theme_url?>/img/banners/school-bg.jpg)">
	<div class="school1_wrap_list-bg" style="background-image:url(<?=$theme_url?>/img/banners/scool-list-bg.png)"></div>
	<img class="school1_wrap_list" src="<?=$theme_url?>/img/banners/school-list.png">
	<img class="school1_wrap_kids" src="<?=$theme_url?>/img/banners/school-kids.png">

	<div class="school1_wrap">
		<div class="school1">Лучшие экскурсии</div>
		<div class="school2">для школьников</div>
		<div class="school3">Этой осенью</div>
	</div>
	<div class="school2_wrap">
		<div class="school4">Обзорные экскурсии,</div>
		<div class="school5">Пушкин (Царское село),</div>
		<div class="school6">Кронштадт</div>
		<div class="school7">и другие</div>
	</div>
	
	<div class="school3_wrap">
		<b>Скидка 200<small>руб.</small></b> на школьный билет по промокоду <a class="school_copy" href="#">каникулы<img class="school1_copyico" src="<?=$theme_url?>/img/banners/copy.png"></a>
	</div>
</div>