<?php
/**
* Страница с кастомным шаблоном (page-custom.php)
* @package WordPress
* @subpackage your-clean-template-3
* Template Name: Контакты
*/
get_header(); // подключаем header.php
$theme_url = get_stylesheet_directory_uri(); ?>

<section class="content content--contacts">
	
	<div class="container container--contacts">
		<div class="content__left">
			<h1>Контакты</h1>	

			<div class="content__contacts mb-sm-0">
				<div class="content__contacts_name">
					Адреса
				</div>
				<div class="content__contacts_txt">
					<p>
						<span class="mb-5 d-block max-width-340"><span>Санкт-Петербург, Лиговский пр-т, 47,<br> 3-й этаж, офис 4</span></span>
					</p>
					<p><span>Невский проспект, д. 17</span></p>
					
				</div>
			</div>
			<div class="content__contacts mb-sm-0">
				<div class="content__contacts_name">
					График работы
				</div>
				<div class="content__contacts_txt">
					<p class="normal">
					<span>9:00–21:00</span> ежедневно
					</p>
				</div>
			</div>

			<div class="content__contacts">
				<div class="content__contacts_name">
					Телефон
				</div>
				<div class="content__contacts_txt">
                    <p class="normal">
                        <span><a href="tel:+88001015692">8 800 101-56-92</a></span> <br>
                        бесплатно по РФ
                    </p>
					<p class="normal">
						<span><a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a>, <a target="_blank" href="tg://resolve?domain=excursion_parus">Telegram</a></span> <br>
                        Только прием сообщений
					</p>
				</div>
			</div>

			<div class="content__contacts">
				<div class="content__contacts_name">
					Email
				</div>
				<div class="content__contacts_txt">
					<p>
						<span><a href="mailto:info@parus-peterburg.ru">info@parus-peterburg.ru</a></span> 
					</p>
				</div>
			</div>

			<div class="content__contacts_social">
				<div class="content__contacts_name" style="color: #5A5A5A;margin-bottom: 10px;">
					Социальные сети
				</div>
				<div class="content__contacts_social_icons"> 
					<a target="_blank" rel="nofollow" href="https://vk.com/parus_peterburg" class="vk icon"></a> 
					<a target="_blank" rel="nofollow" href="https://www.instagram.com/paruspeterburg/" class="insta icon"></a>
					<a target="_blank" rel="nofollow" href="https://dzen.ru/parus_excursii" class="dzen icon"></a>
				</div>
			</div>
		</div>

		<div class="content__right">
			<iframe src="https://yandex.ru/map-widget/v1/?z=12&ol=biz&oid=64817349525" width="560" height="400" frameborder="0"></iframe>
		</div>
	</div>
</section>
<style>
.max-width-340 {
    max-width: 340px;
}
.mb-5 {
	margin-bottom: 5px;
} 
.mb-50 {
	margin-bottom: 50px;
}
@media(min-width: 1025px) {
    body .content--contacts .content__right {
        margin-top: 55px;
    }
}
.content--contacts .content__right.mt-0 {
	margin-top: 0;
}
.img_cont img {
		height: 350px;
}
.mt-13 {
	margin-top: 13px;
}
.d-block {
	display: block;
}
.content p {
	display: block;
    margin-bottom: 7px;
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 130%;
    color: #3E3D3D;
}
.content .content__contacts_txt p {
	margin-bottom: 10px;
	font-family: Roboto;
	font-style: normal;
	font-weight: 300;
	font-size: 15px;
	line-height: 140%;
	color: #5A5A5A;
}
.content__contacts_txt p.normal {
	margin-bottom: 15px;
}
.content--contacts .content__left,
.content--contacts .content__right {
	width: 49%;
    display:flex;
    flex-direction: column;
}
.content--contacts .content__contacts {
    display: flex!important;
    align-items: baseline;
    justify-content: space-between;
    max-width: unset!important;
    margin-bottom: 15px;
}
.content__contacts_name {
    width: 13%;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 140%;
    color: #5A5A5A;
}
.content__contacts_social .content__contacts_name {
	width: 100%;
}
.content__contacts_txt {
    width: 85%;
    font-style: normal;
    font-weight: 300;
    font-size: 15px;
    line-height: 140%;
    color: #5A5A5A;
}
.normal {
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 130%;
    color: #3E3D3D;
}
.content__contacts_txt span,
.content__contacts_txt span a {
	font-style: normal;
	font-weight: 500;
	font-size: 18px;
	line-height: 130%;
	color: #000000;
	text-decoration: none;
}
.content__contacts_social_icons {
	    display: flex;
	    margin-bottom: 50px;
}
.content__contacts_social_icons .vk.icon {
	background-image: url(/wp-content/themes/parus/img/vk.png?v=1);
    width: 40px;
    height: 40px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    display: block;
    margin-right: 20px;
}
.content__contacts_social_icons .insta.icon {
    width: 40px;
    height: 40px;	
}
@media screen and (max-width: 1024px) {
	.content--contacts {
	    padding: 20px;
	}
	.container--contacts {
		flex-direction: row;
	}	
}

@media screen and (max-width: 820px) {
	.content__contacts_name {
		width: 23%
	}
	.content__contacts_txt {
	    width: 78%;
	}
}
@media screen and (max-width: 599px) {
	.container--contacts {
	    flex-wrap: wrap;
	}
	.content--contacts .content__contacts {
		flex-wrap: wrap;
	    border-bottom: 2px solid #DDE1E5;
	    margin: 10px 0;
	    padding: 10px 0;
	}
	.mb-sm-0 {
		margin-top: 0!important;
		padding-top: 0!important;
	}
	.content--contacts .content__left, 
	.content--contacts .content__right,
	.content__contacts_name,
	.content__contacts_txt {
	    width: 100%;
	}
	.content__left h1 {
		margin-bottom: 20px;
	}
	.content--contacts .content__left {
		padding: 0;
	}
	.content--contacts .content__left img, .content--contacts .content__right img {
	    object-fit: cover;
	    max-height: unset;
	    height: auto;
	}
	.content--contacts .content__right {
		margin-bottom: 0;
		padding: 0 15px;
	}
}
</style>
<?php get_footer(); // подключаем footer.php ?>