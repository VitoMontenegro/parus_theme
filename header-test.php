<?php
/**
 * Шаблон шапки (header.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php
    $theme_url = get_stylesheet_directory_uri();
    global $post;
	if ($post)
		$post_slug = $post->post_name;
?>
<!DOCTYPE html>
<html <?php language_attributes(); // вывод атрибутов языка ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); // кодировка ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">	
	<?php /* RSS и всякое */ ?>
	<link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php bloginfo('rdf_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php bloginfo('comments_rss2_url'); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Bold.ttf" as="font" type="font/ttf" crossorigin="anonymous">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Medium.ttf" as="font" type="font/ttf" crossorigin="anonymous">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Light.ttf" as="font" type="font/ttf" crossorigin="anonymous">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Cricket-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
	
	<?php if (is_home()): ?>
		<meta name="robots" content="noyaca" />
		<meta name="yandex" content="noyaca" />
	<?php endif; ?>

	<?php /* Все скрипты и стили теперь подключаются в functions.php */ ?>

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); // необходимо для работы плагинов и функционала ?>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N8Q34KX');</script>
	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168614129-3"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-168614129-3');
</script>

<style>

body .nav {
    font-size: 14px;
    color: #fff;
    font-weight: 700;
    line-height: 52px;
    background: linear-gradient(180deg, #2d71b4 0%, #2c84d1 100%);
    transition: 0.8s;    
    
}

body .header__nav {
	max-height: 52px;
}

body .header__callback {
    display: block;
    margin-top: 8px;
    width: 100%;
    font-size: 15px;
    font-weight: normal;
    text-align: right;
    text-decoration: none;
    cursor: unset;
}

.header__logo span {
	display: flex;
	align-items: center;
	font-weight: bold;
}
body .header__schedule {
    font-size: 14px;
    line-height: 1.25;
    opacity: 0.9;
}
body .header__order {
    width: 165px;
    height: 40px;
    line-height: 42px;
}
body .nav__link:hover,  body  .header__nav .menu>li:hover {
    background-color: #5fa3e2;
}
body .nav__link:hover,body  .menu-item:hover {
    background-color: #5fa3e2;
}
body ul.sub-menu li {
	background: #2c79c0;
}
.container--header {
	padding: 5px 0;
}
body .icoWatsaap::before {
	    left: -30px;
}
body .logo__title {
    bottom: 7px;
    position: absolute;
    font-size: 7.4px;
    right: 0px;
    background: #2c77bd;
    color: #fff;
    padding: 8px 2px 7px 2px;
    line-height: 0;
    margin: 0;
    border: 0;
}
body .logo__image--header {
    background: url(/wp-content/themes/parus/assets/images/parus.svg);
    background-repeat: no-repeat;
    max-width: 100%;
    background-position: 0 0;
    background-size: contain;
    display: inline-block;
    width: 260px;
    height: 90px;
}
body .logo__text::before {
    width: 95%;
    left: 3%;
}

body .header__logo {
	margin-right: 35px;
    display: block;
    max-width: 260px;
    position: relative;
    top: -5px;
}
.header__nav ul.menu {
    display: flex;
}
@media screen and (min-width: 993px) {
	.header__nav ul.menu .sub-menu {
	    opacity: 0;
	    visibility: hidden;
	}
}
@media screen and (max-width: 768px) {
	.header .header__logo {
	    width: auto;
	}
	.home .mainh {
	    margin-top: 15px;
	}
}


.container {
    max-width: 1140px;
    margin: 0 auto;
}
</style>
</head>


<body <?php body_class(); // все классы для body ?>>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8Q34KX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div id="main">
<header class="header header_gradient">
	<div class="container container--header">
		<a href="/" class="header__logo logo">
		  <div class="logo__image logo__image--header"></div>
		  <p class="logo__title">
			Экскурсии 
			по Санкт-Петербургу
		  </p>
		</a>

		<p class="header__schedule">Офис у Московского вокзала<br> Лиговский проспект 43/45 <br> пн-пт 07:30 до 23:30</p>
		
		<div class="header__contacts">
		  <div class="header__callback">Круглосуточно</div>
		  <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="hederWatsaap icoWatsaap pcShow">+7 (951) 685-37-33</a>
          <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="phoneWatsaap icoWatsaap mobileShow">Написать в WhatsApp</a>
		</div>

		<a href="#" id="header__callback" class="header__order">Заказать звонок</a>
		<span  class="regnum">Реестровый номер туроператора: 020849</span>
	</div>

	<div class="header__button"></div>
	<nav class="header__nav nav">
		<div class="container">
			<?php 
				wp_nav_menu([
					'menu' => 'главное меню',
					'link_before'     => '<span>',
					'link_after'      => '</span>',
				]);
			?>
		</div>
	</nav>
</header>
<?php if(!is_home()): ?>
	<?php $i=2; ?>
	<section class="breadcrumbs">
		<div class="container">
			<ol itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a  itemtype="http://schema.org/Thing" itemprop="item" href="https://parus-peterburg.ru">
						<span itemprop="name">Главная</span>
					</a>
					<meta itemprop="position" content="1" />
				</li>
				<li>></li>
				<?php if(get_post_type()=='tours'): ?>
					<?php if (is_tax()): ?>
						
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						
							<span itemprop="name" data-ll-status="observed"><?php single_term_title(); ?></span>
						
						<meta itemprop="position" content="<?=$i?>" />
					</li>
						
					<?php elseif(has_term('indiv-ekskursii', 'excursion', get_the_ID())): ?>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a  itemtype="http://schema.org/Thing" itemprop="item" href="https://parus-peterburg.ru/indiv-ekskursii">
								<span itemprop="name" data-ll-status="observed">Индивидуальные экскурсии</span>
							</a>
							<meta itemprop="position" content="<?=$i++?>" />
						</li>
						<li>></li>
					<?php endif; ?>
				<?php elseif(get_the_category() && !is_category()): ?>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a  itemtype="http://schema.org/Thing" itemprop="item" href="<?=get_category_link(get_the_category()[0])?>">
							<span itemprop="name" data-ll-status="observed"><?=get_the_category()[0]->name?></span>
						</a>
						<meta itemprop="position" content="<?=$i++?>" />
					</li>
					<li>></li>
				<?php endif; ?>

				<?php if(is_category()): ?>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						
							<span itemprop="name" data-ll-status="observed"><?=get_the_category()[0]->name?></span>
						
						<meta itemprop="position" content="<?=$i++?>" />
					</li>
				<?php else: ?>
					<?php if (!is_tax()): ?>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						
							<span itemprop="name" data-ll-status="observed"><?=(get_field('h1'))?get_field('h1'):get_the_title(); ?></span>
						
						<meta itemprop="position" content="<?=$i?>" />
					</li>
					<?php endif; ?>
				<?php endif; ?>
			</ol>
		</div>
	</section>
<?php endif; ?>