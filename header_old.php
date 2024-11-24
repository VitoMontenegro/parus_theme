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

</head>


<body <?php body_class(); // все классы для body ?>>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8Q34KX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div id="main">
<header class="header">
	<div class="container container--header">
		<a href="/" class="header__logo logo">
		  <div class="logo__image logo__image--header"></div>
		  <p class="logo__title">
			Экскурсии <br />
			по Санкт-Петербургу
		  </p>
		  <p class="logo__text">
			<span>отправление от Московского вокзала</span>
		  </p>
		</a>
		<a href="/заказать-экскурсию" class="header__order">Заказать экскурсию</a>
		<p class="header__schedule"><b>График работы:</b> с 7:30 до 23:30</p>
		<div class="header__contacts">
		  <!--<a href="tel:+79117726331" class="header__phone">+7 (911) 772-63-31</a>-->
		  <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="hederWatsaap icoWatsaap pcShow">+7 (951) 685-37-33</a>
          <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="phoneWatsaap icoWatsaap mobileShow">Написать в WhatsApp</a>
		  <div class="header__callback">Заказать обратный звонок</div>
		</div>
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