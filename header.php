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
	<?php /* RSS и всякое */ ?>
	<link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php bloginfo('rdf_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php bloginfo('comments_rss2_url'); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous" media="print"   onload="this.media='all'; this.onload = null">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Bold.ttf" as="font" type="font/ttf" crossorigin="anonymous" media="print"   onload="this.media='all'; this.onload = null">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Medium.ttf" as="font" type="font/ttf" crossorigin="anonymous" media="print"   onload="this.media='all'; this.onload = null">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Roboto-Light.ttf" as="font" type="font/ttf" crossorigin="anonymous" media="print"   onload="this.media='all'; this.onload = null">
	<link rel="preload" href="<?=$theme_url?>/assets/fonts/Cricket-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous" media="print"   onload="this.media='all'; this.onload = null">
	<link href="/jivosite/jivosite.css" rel="stylesheet"  media="print"   onload="this.media='all'; this.onload = null">
	<!--script src="/jivosite/jivosite.js" type="text/javascript"></script-->
	<!-- <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?169",t.onload=function(){VK.Retargeting.Init("VK-RTRG-1220956-cl0MB"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script> -->
	<?php if (is_home()): ?>
		<meta name="robots" content="noyaca" />
		<meta name="yandex" content="noyaca" />
	<?php endif; ?>

	<?php /* Все скрипты и стили теперь подключаются в functions.php */ ?>

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		#menu-item-9093 a span {
			padding: 0;
		}
		#menu-item-9093 span span {
			padding: 0;
		}
		.page-loader {
			background-image: url(/wp-content/themes/parus/img/Cube-1s-200px.svg);
			background-repeat: no-repeat;
			background-position: center;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #f1f2f3;
			z-index: 12;
		}
		.modalwheel-wrapper {
			visibility: hidden;
			opacity: 0;
		}
	</style>
 <script>
var LazyM = {};//LazyInitMethod
function bindLate(context, funcName) {
  return function() {
    return context[funcName].apply(context, arguments);
  };
} 
let init_lazy_html_section= function(idname,cbname=null){
	if ('IntersectionObserver' in window) { 
	    function handleIntersection(entries) {
	      entries.map((entry) => {
	        if (entry.isIntersecting) { 
			entry.target.insertAdjacentHTML("afterEnd", JSON.parse(entry.target.dataset.inf)); entry.target.dataset.inf='';
			entry.target.outerHTML='';
	     	observer.unobserve(entry.target);	
	     	if (cbname!=null) {
				var cb = bindLate(LazyM, cbname);
				cb();
			}
	        }
	      });
	    }
	
	    const htmlsection = document.getElementById(idname);
	    const observer = new IntersectionObserver(
	      handleIntersection,
	      { 	root: null,	rootMargin: "0px",	threshold: 0.7, }
	    );
	    observer.observe(htmlsection);		
	} else {
	  	const htmlsection = document.getElementById(idname);
	  	footermenu.insertAdjacentHTML("afterEnd", JSON.parse(htmlsection.dataset.inf)); htmlsection.dataset.inf='';htmlsection.outerHTML='';
		if (cbname!=null) {
			var cb = bindLate(LazyM, cbname);
			cb();
		}
	}
}

/*if (typeof $ == 'undefined') {
   var $ = jQuery;
}*/

</script>

    <?php  $term_id = get_queried_object()->term_id; ?>

	<?php wp_head(); // необходимо для работы плагинов и функционала ?>

</head>


<body <?php body_class(); // все классы для body ?>>
<?php if (get_field('happy_new_year', 'option')):?>
	<?php require_once __DIR__.'/template-parts/happy_new_year.php'; ?>
<?php endif; ?>

<noscript><div><img src="https://mc.yandex.ru/watch/16828501" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<div id="main">

<?php /*
<div class="attention-block">
    <div class="attention-block__wrap">
    <div class="attention-block__text">
        В связи с высокой загрузкой есть вероятность к нам не дозвониться.
        Пишите, пожалуйста, в <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a> и менеджеры вам обязательно ответят.
    </div>
    <button class="attention-block__close">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M2 2L18 18" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 2L2 18" stroke="black" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
    </div>
</div>
*/ ?>

<header class="header header_gradient">

	<?php $info_block = get_theme_mod( 'info_block' );
		 $info_block_on = get_theme_mod( 'info_block_on' );
		if($info_block && is_front_page() && $info_block_on): ?>
	<div class="header__info-block info-block">
		<div class="info-block__txt"><?php echo $info_block; ?></div>
		<span class="info-block__close"></span>
	</div>
	<?php endif; ?>

	<div class="container--header">

		<div class="header-top">
			<div class="container-fluid">
				<span  class="regnum">Реестровый номер туроператора: 024208</span>
				<div class="header-top__right">
					<span class="flex">
						<a target="_blank"  class="telegram icon"href="tg://resolve?domain=excursion_parus" rel="nofollow" ></a>
						<a target="_blank" class="whatsapp icon" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" rel="nofollow"></a>			
						<a target="_blank" href="https://vk.com/parus_peterburg" class="vk icon xsHidden"></a>
					</span>
					<div class="rate_block"></div>
					<form role="search" method="get" class="searchform searchform-top filter_button_wrap" action="<?php echo home_url( '/' ) ?>" >
						<input class="d1" type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Поиск по экскурсиям" />
						<input type="hidden" value="tours" name="post_type" />
						<input type="hidden" value="1" name="sentence" />
						<button class="d2">
							<img src="<?php echo get_template_directory_uri()?>/img/search.png" alt="" style="margin: auto;">
						</button>
					</form>

                    <a href="/wishlist" class="favs favs__count-wrap<?if($_COOKIE["product"]){echo' favs-have';}?>">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <g clip-path="url(#clip0_8_12)">
                                    <path d="M7.5 13.9865C7.42412 13.9865 7.34827 13.9669 7.28031 13.9276C7.20648 13.885 5.45245 12.8666 3.67325 11.3321C2.61874 10.4227 1.77699 9.52061 1.17142 8.65108C0.38779 7.52591 -0.0062817 6.44362 7.57055e-05 5.43426C0.0075171 4.25975 0.42819 3.1552 1.18469 2.32405C1.95397 1.4789 2.98059 1.01349 4.0755 1.01349C5.47873 1.01349 6.76166 1.79952 7.50003 3.0447C8.2384 1.79955 9.52134 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9935 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53563 12.866 7.7942 13.8844 7.72093 13.927C7.65264 13.9666 7.57629 13.9865 7.5 13.9865Z" fill="white"/>
                                </g>
                            </svg>
                        </i>
                        <span class="favs__count"><?php if($_COOKIE["product"]){echo count($_COOKIE["product"]);}; ?></span>
                    </a>

				</div> 
			</div> 
			
		</div>
		<div class="header-bottom">		
			<div class="container-fluid">

                <a href="/wishlist" class="favs favs__count-wrap favs__count-wrap--mobile<?if($_COOKIE["product"]){echo' favs-have';}?>">
                    <i class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <g clip-path="url(#clip0_8_12)">
                                <path d="M7.5 13.9865C7.42412 13.9865 7.34827 13.9669 7.28031 13.9276C7.20648 13.885 5.45245 12.8666 3.67325 11.3321C2.61874 10.4227 1.77699 9.52061 1.17142 8.65108C0.38779 7.52591 -0.0062817 6.44362 7.57055e-05 5.43426C0.0075171 4.25975 0.42819 3.1552 1.18469 2.32405C1.95397 1.4789 2.98059 1.01349 4.0755 1.01349C5.47873 1.01349 6.76166 1.79952 7.50003 3.0447C8.2384 1.79955 9.52134 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9935 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53563 12.866 7.7942 13.8844 7.72093 13.927C7.65264 13.9666 7.57629 13.9865 7.5 13.9865Z" fill="white"/>
                            </g>
                        </svg>
                    </i>
                    <span class="favs__count"><?php if($_COOKIE["product"]){echo count($_COOKIE["product"]);}; ?></span>
                </a>

				<div class="xsShow">
						<span class="question-button header__schedule" ></span>
				        <div class="note big">
							<div class="header__schedule">
								<p>Офис у Московского вокзала</p>
								<p class="header__schedule_bold">Лиговский проспект, 47 <br> c 9:00 до 22:00</p> 
							</div>
							<div class="header__schedule">
								<p>Офис у Строгановского дворца</p>
								<p class="header__schedule_bold">Невский проспект, 17 <br> с 9:00 до 22:00</p> 
							</div>					
				        </div>
						<span class="question-button header-phone" ></span>
				        <div class="note">
				            <div class="header__contacts">
							  	<div class="header__callback">
							  		<span>с 9.00 до 20.00 по МСК</span>
							  	</div>
							  	<a target="_blank" href="tel:+88001015692" class="header-phone">8 800 101-56-92</a>
							</div>
				            <div class="header__contacts">
							  	<div class="header__callback">
							  		<span><a style="color: #0099ce;text-decoration: none;" target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a>, <a style="color: #0099ce;text-decoration: none;" target="_blank" href="tg://resolve?domain=excursion_parus">Telegram</a></span>
							  	</div>
							  	<a target="_blank" href="tel:+79516853733" class="header-phone">+7 951 685-37-33</a>
							</div>
				        </div>
				</div>
				<a href="/" class="header__logo logo">
				  <div class="logo__image logo__image--header"><img width="234" height="69" src="<?php echo get_template_directory_uri() ?>/assets/images/parus.svg" alt="logo"></div>
				</a>

				<div class="header-flex">
					<div class="header__contacts firt xsHidden">
						<div class="header__callback"><span>Бесплатно по РФ</span></div>
					  	<a target="_blank" href="tel:+88001015692" class="header-phone">8 800 101-56-92</a>
					</div>

                    <div class="header__contacts xsHidden">
					  	<div class="header__callback cursor-auto">
						  	Только прием сообщений
					  	</div>
					  	<span class="header-phone header-phone--size"><a style="color: #0099ce;text-decoration: none;" target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a>, <a style="color: #0099ce;text-decoration: none;" target="_blank" href="tg://resolve?domain=excursion_parus">Telegram</a></span>

					</div>

					<div class="header__schedule pcShow">
						<p>Московский вокзал</p>
						<p class="header__schedule_bold"> Лиговский проспект, 47</p> 
					</div>
					<div class="header__schedule pcShow">
						<p>Строгановский дворец</p>
						<p class="header__schedule_bold">Невский проспект, 17</p> 
					</div>	
					<div class="mobileShow xsHidden">						
						<span class="question-button header__schedule" ></span>
				        <div class="note big">
							<div class="header__schedule">
								<p>Офис у Московского вокзала</p>
								<p class="header__schedule_bold">Лиговский проспект, 47 <br> c 9:00 до 22:00</p> 
							</div>
							<div class="header__schedule">
								<p>Офис у Строгановского дворца</p>
								<p class="header__schedule_bold">Невский проспект, 17 <br> с 9:00 до 22:00</p> 
							</div>					
				        </div>
					</div>
					
					<div class="header__button ham">
						<svg 
						 xmlns="http://www.w3.org/2000/svg"
						 xmlns:xlink="http://www.w3.org/1999/xlink"
						 width="25px" height="20px">
						<path fill-rule="evenodd"  fill="rgb(32, 32, 32)"
						 d="M1.112,8.963 L16.437,8.963 C16.989,8.963 17.437,9.410 17.437,9.963 L17.437,10.712 C17.437,11.264 16.989,11.712 16.437,11.712 L1.112,11.712 C0.559,11.712 0.112,11.264 0.112,10.712 L0.112,9.963 C0.112,9.410 0.559,8.963 1.112,8.963 Z"/>
						<path fill-rule="evenodd"  fill="rgb(32, 32, 32)"
						 d="M1.112,0.715 L23.854,0.715 C24.406,0.715 24.854,1.163 24.854,1.715 L24.854,2.464 C24.854,3.017 24.406,3.464 23.854,3.464 L1.112,3.464 C0.559,3.464 0.112,3.017 0.112,2.464 L0.112,1.715 C0.112,1.163 0.559,0.715 1.112,0.715 Z"/>
						<path fill-rule="evenodd"  fill="rgb(32, 32, 32)"
						 d="M1.112,17.210 L23.854,17.210 C24.406,17.210 24.854,17.658 24.854,18.210 L24.854,18.959 C24.854,19.512 24.406,19.959 23.854,19.959 L1.112,19.959 C0.559,19.959 0.112,19.512 0.112,18.959 L0.112,18.210 C0.112,17.658 0.559,17.210 1.112,17.210 Z"/>
						</svg>

						<svg 
						 xmlns="http://www.w3.org/2000/svg"
						 xmlns:xlink="http://www.w3.org/1999/xlink"
						 width="20px" height="17px">
						<defs>
						<filter id="Filter_0">
						    <feFlood flood-color="rgb(255, 255, 255)" flood-opacity="1" result="floodOut" />
						    <feComposite operator="atop" in="floodOut" in2="SourceGraphic" result="compOut" />
						    <feBlend mode="normal" in="compOut" in2="SourceGraphic" />
						</filter>

						</defs>
						<g filter="url(#Filter_0)">
						<path fill-rule="evenodd"  fill="rgb(32, 32, 32)"
						 d="M2.793,0.578 L19.533,14.997 C19.903,15.316 19.862,15.801 19.442,16.082 L18.682,16.590 C18.262,16.871 17.622,16.840 17.252,16.521 L0.512,2.102 C0.142,1.783 0.183,1.297 0.603,1.017 L1.363,0.509 C1.783,0.228 2.423,0.259 2.793,0.578 Z"/>
						<path fill-rule="evenodd"  fill="rgb(32, 32, 32)"
						 d="M17.252,0.578 L0.512,14.997 C0.142,15.316 0.183,15.801 0.603,16.082 L1.363,16.590 C1.783,16.871 2.423,16.840 2.793,16.521 L19.533,2.102 C19.903,1.783 19.862,1.297 19.442,1.017 L18.682,0.509 C18.262,0.228 17.622,0.259 17.252,0.578 Z"/>
						</g>
						</svg>
					</div>
				</div>
			</div>
				
			
		</div>

		
	</div>

		<nav class="header__nav nav">
			<div class="container-fluid">
				<div class="mobileShow">
					<div class="header-flex">
						
						<div class="header__contacts">
							<div class="header__callback"><span>Бесплатно по РФ</span></div>						  	
						  	<a target="_blank" href="tel:88001015692" class="header-phone">8 (800) 101-56-92</a>
						</div>

						<div class="header__contacts header__contacts--2">
                            <div class="header__callback cursor-auto">
                                Только прием сообщений
                            </div>
                            <span class="header-phone header-phone--size"><a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a>, <a target="_blank" href="tg://resolve?domain=excursion_parus">Telegram</a></span>
						</div>	

				  		<a target="_blank"  class="telegram icon"href="tg://resolve?domain=excursion_parus" rel="nofollow" ></a>

				  		<a target="_blank" class="whatsapp icon" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" rel="nofollow"></a>

						<span class="question-button header__schedule" ></span>
				        <div class="note big">
							<div class="header__schedule">
								<p>Офис у Московского вокзала</p>
								<p class="header__schedule_bold">Невский проспект, 71/1 <br> c 9:00 до 22:00</p> 
							</div>
							<div class="header__schedule">
								<p>Офис у Строгановского дворца</p>
								<p class="header__schedule_bold">Невский проспект, 17 <br> с 9:00 до 22:00</p> 
							</div>					
				        </div>
					</div>
				</div>
				<?php 
					wp_nav_menu([
						'menu' => 'главное меню',
						'link_before'     => '<span>',
						'link_after'      => '</span>',
					]);
				?>
				<div class="mobileShow">
					<span class="flex big ">
					  	<a target="_blank"  class="telegram icon"href="tg://resolve?domain=excursion_parus" rel="nofollow" ></a>
					  	<a target="_blank" class="whatsapp icon" href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" rel="nofollow"></a>			
						<a target="_blank" href="https://vk.com/parus_peterburg" class="vk icon"></a>
					</span>		
					<div style=" margin-top: 20px;margin-left: 18px;">
						<div class="rate_block"></div>
					</div>
					          			
				</div>
			</div>
		</nav>
</header>
<?php if(!is_home() && !is_search() && !is_404()): ?>
	<?php $i=2; ?>
	<section class="breadcrumbs">
		<div class="container">
			<?php $term_id = get_queried_object()->term_id; ?>
			<ol itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a  itemtype="http://schema.org/Thing" itemprop="item" href="https://parus-peterburg.ru">
						<span itemprop="name">Главная</span>
					</a>
					<meta itemprop="position" content="1" />
				</li>
				<li>></li>
				<?php if ($term_id && $term_id==76): ?>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						
							<span itemprop="name" data-ll-status="observed">Речные круизы</span>
						
						<meta itemprop="position" content="<?=$i?>" />
					</li>
				<?php endif ?>
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
						
					<?php elseif(is_singular('tours')): ?>
						<?php
							if($cat_id = get_field('cat_hk')){
								if($cat_id==106) $cat_id = 10;
								$term = get_term($cat_id);
							}
							else
								$term = get_the_terms(get_the_ID(), 'excursion')[0];
						?>
						<?php if ($term): ?>
							<li><a href="<?=get_term_link($term)?>"><?=$term->name?></a></li>
							<li>></li>
						<?php endif; ?>
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
				<?php elseif(get_post_type()=='promos'): ?>
					<?php if (is_single()): ?>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a  itemtype="http://schema.org/Thing" itemprop="item" href="/promos/">
									<span itemprop="name" data-ll-status="observed">Акции и скидки</span>
								</a>
							
							<meta itemprop="position" content="<?=$i++?>" />
						</li>
						<li>></li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							
								<span itemprop="name" data-ll-status="observed"><?=(get_field('h1'))?get_field('h1'):get_the_title(); ?></span>
							
							<meta itemprop="position" content="<?=$i?>" />
						</li>
					<?php else: ?>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							
								<span itemprop="name" data-ll-status="observed">Акции и скидки</span>
							
							<meta itemprop="position" content="<?=$i++?>" />
						</li>
					<?php endif; ?>
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