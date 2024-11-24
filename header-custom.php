<?php
/**
 * Шаблон шапки (header.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
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
<?php
    $theme_url = get_stylesheet_directory_uri();
    global $post;
	if ($post)
		$post_slug = $post->post_name;
?>
<style>
body .header { 
    background: linear-gradient(180deg, #142147 0%, #1476cc 152px);
    color:#fff;
}
body .nav {
    font-size: 14px;
    color: #fff;
    font-weight: 700;
    line-height: 52px;
    background: #ffffff1a;
    transition: 0.8s;
}
body .hederWatsaap {
	color:#fff;
}
body .header__callback {
    display: block;
    margin-top: 8px;
    width: 100%;
    color: #fff;
    font-size: 15px;
    font-weight: normal;
    text-align: right;
    text-decoration: none;
    cursor: unset;
}
body .header__callback:hover {
	color:#fff;
}
.header__logo span {
	color:#fff;
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
    width: 185px;
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
</style>
<body <?php body_class(); // все классы для body ?>>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8Q34KX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div id="main">
<header class="header header_gradient">
	<div class="container container--header">
		<a href="/" class="header__logo logo flex">
		  <img src="<?php echo get_template_directory_uri(); ?>/img/boat.svg" alt="logo" height="55">
		 <span>Экскурсионное <br>бюро "Парус"</span>
		</a>
		<p class="header__schedule">Офис у Московского вокзала<br> Лиговский проспект 43/45 <br> пн-пт 07:30 до 23:30</p>
		<div class="header__contacts">
		  <div class="header__callback">Круглосуточно</div>
		  <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="hederWatsaap icoWatsaap pcShow">+7 (951) 685-37-33</a>
          <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="phoneWatsaap icoWatsaap mobileShow">Написать в WhatsApp</a>
		</div>

		<a href="/заказать-экскурсию" class="header__order">Заказать звонок</a>
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