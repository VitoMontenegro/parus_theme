<?php
/**
 * Шаблон подвала (footer.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>

    <footer class="footer"><?php  ob_start(); ?>
      <div class="container container--footer for-pc">

        <div class="footer__info">
             <h4 class="footer__title">Контакты</h4>
			 <div class="footer-phone">
				<a target="_blank" href="tel:88001015692" class="footer-phone_l">8 (800) 101-56-92</a>
			</div>
          <div class="footer__contacts">
           
            <div class="footer__contacts-col w37">

                <div class="footer__icon footer__icon--phone"><a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a><a target="_blank" href="tg://resolve?domain=excursion_parus">Telegram</a></div>

              <a
                href="mailto:info@parus-peterburg.ru"
                class="footer__icon footer__icon--mail"
              >
                info@parus-peterburg.ru
              </a>
              <div class="mm-item">
                <a target="_blank" rel="nofollow" href="https://vk.com/parus_peterburg" class="vk icon"></a> Мы в ВК
                <?php /*
                <a target="_blank" rel="nofollow" href="#" class="facebook icon"></a>
                */ ?>
              </div>
            </div>

            <div class="footer__contacts-col w63">
              <div class="footer__icon footer__icon--metro">
                «Площадь Восстания»
              </div>
              <div class="footer__icon footer__icon--address" style="width: 100%;line-height: 1.2; margin-bottom: 15px;">
                Санкт-Петербург, Лиговский пр-т, 47, 3-й этаж, офис 4
              </div>
              <div class="footer__icon footer__icon--time">
				  по Москве <br>
                с 9.00 до 21.00 ежедневно
				
              </div>
            </div>
          </div>
          <div class="register"> 
            <img src="<?=get_template_directory_uri()?>/img/logo-rosturizm.png" alt="" class="rgisterImg">
            <div><span class="footer__company"> Мы внесены в Единый реестр туроператоров РТО 024208</span>
            </div>
	        </div>
	    	</div>
	
        <div class="footer__tours">
          <h4 class="footer__title">Экскурсии</h4>
          <a href="/avtobusnyye-ekskursii/" class="footer__link">Автобусные экскурсии</a>
          <a href="/indiv-ekskursii" class="footer__link">Индивидуальные экскурсии</a>
			<a href="/usloviya/" class="footer__link" target="_blank">Условия и правила</a>
          <a href="/wp-content/uploads/2024/01/parus-price-new-2024.pdf" class="footer__link" download>Скачать прайс на экскурсии 2024</a>
         <a href="/dogovor-oferta/" class="footer__link">Договор-оферта</a>
          <div class="safe_travels">          	
                <img src="<?=get_template_directory_uri()?>/img/safetravels.png" alt="" class="safetravels">
                <span>Участвуем в международной<br>программе Safe Travels<br>(безопасные путешествия)</span>
          </div>
        </div>

        <div class="footer__menu">
          <h4 class="footer__title">Меню</h4>
          <a href="/" class="footer__link">Главная</a>
          <a href="/skidki" class="footer__link">Скидки</a>
          <a href="/reviews" class="footer__link">Отзывы</a>
          <a href="/o-kompanii" class="footer__link">О компании</a>
          <a href="/gidy/" class="footer__link">Наши экскурсоводы</a>
		  <a href="/avtopark/" class="footer__link">Наш автопарк</a>
		  <a href="/blog/" class="footer__link">Блог</a>
          <a href="/sotrudnichestvo" class="footer__link">Сотрудничество</a>
          <a href="/vakansii" class="footer__link">Вакансии</a>
          <a href="/контакты" class="footer__link">Контакты</a>
        </div>

        <div class="footer__places">
          <h4 class="footer__title">Интересные места</h4>
          <a href="/русские-музеи" class="footer__link">Русские музеи</a>
          <a href="/квартиры-музеи" class="footer__link">Квартиры-музеи</a>
          <a href="/сады-и-парки" class="footer__link">Сады и парки</a>
          <a href="/государственные-музеи" class="footer__link">Гос.музеи СПБ</a>
          <a href="/необычный-петербург" class="footer__link">Необычный СПБ</a>
		  <div id="ya_frame" class="rate_block"></div>
		  
		  <?php if (get_theme_mod( 'login_registr_show', 0 )): ?>
			<div class="member-auth-links">
				<?php if(!is_user_logged_in()): ?>
					<a href="/register/">Регистрация</a>
					<a href="/login/">Авторизация</a>
				<?php else: ?>
					<a href="/account/">Личный кабинет</a>
				<?php endif; ?>
			</div>
		  <?php endif; ?>
        </div>

      </div>

      <div class="container container--footer for-mobile">
          
        <div class="footer__info">
            
          <div class="footer__contacts">
              <h4 class="footer__title">Контакты</h4>
            <div class="footer__contacts-col" >


                <div class="footer__icon footer__icon--phone"><a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a>, <a target="_blank" href="tg://resolve?domain=excursion_parus">Telegram</a></div>
              <a
                href="mailto:info@parus-peterburg.ru"
                class="footer__icon footer__icon--mail">
                info@parus-peterburg.ru
              </a>
              <div class="mm-item">
                <a target="_blank" rel="nofollow" href="https://vk.com/parus_peterburg" class="vk icon"></a><span>Мы в ВК</span> 
                <?php /*
                <a target="_blank" rel="nofollow" href="#" class="facebook icon"></a>
                */ ?>
              </div>
            </div>
              

            <div class="footer__contacts-col footer__contacts-col--2">
              <div class="footer__icon footer__icon--metro">
                «Маяковская»
              </div>
              <div class="footer__icon footer__icon--address">
                Санкт-Петербург, Лиговский пр-т, 47, 3-й этаж, офис 4
              </div>
              <div class="footer__icon footer__icon--time" style="margin-bottom: 35px;">
                по Москве <br>
                с 9.00 до 21.00 ежедневно
				
              </div>
            </div>
          </div>
            
          <div class="footer__menu">
	          <h4 class="footer__title">Экскурсии</h4>
	          <a href="/obzornyye/" class="footer__link">Обзорные </a>
	          <a href="/teplokhodnyye/" class="footer__link">Водные </a>
	          <a href="/nochnyye/" class="footer__link">Ночные  </a>
	          <a href="/petergof/" class="footer__link">Петергоф  </a>
	          <a href="/pushkin/" class="footer__link">Царское село </a>
	          <a href="/tury/" class="footer__link">Туры с выездом из СПб</a>
              
            </div>
          
           <div class="footer__menu">
	          <h4 class="footer__title">Меню</h4>
	          <a href="/" class="footer__link">Главная</a>
	          <a href="/skidki" class="footer__link">Акции и скидки</a>
	          <a href="/gidy/" class="footer__link">Наши экскурсоводы</a>
	          <a href="/reviews" class="footer__link">Отзывы</a>
	          <a href="/o-kompanii" class="footer__link">О компании</a>
			   <a href="/blog/" class="footer__link">Блог</a>
          <a href="/wp-content/uploads/2024/01/parus-price-new-2024.pdf" class="footer__link" download>Скачать прайс на экскурсии 2024</a>
       	 	</div> </div>
    <div class="register">          
   
           <div class="footer-reester"> <img src="<?=get_template_directory_uri()?>/img/logo-rosturizm.png" alt="" class="rgisterImg">
            <div><span class="footer__company"> Мы внесены в Единый реестр туроператоров РТО 024208</span>
            <span class="rgistText">ООО «Транзит Тур Лайн»</span></div>
	        </div>
          <div class="safe_travels">	
              <img src="<?=get_template_directory_uri()?>/img/safetravels.png" alt="" class="safetravels">
                <span>Участвуем в международной<br>программе Safe Travels<br>(безопасные путешествия)</span>
          </div>
			<div class="rate_block"></div>          
    </div>
      	
 <?php $output=ob_get_contents();ob_end_clean(); ?>
 <span id="content_footer_observer" data-inf='<?php echo htmlspecialchars(json_encode($output), ENT_QUOTES, 'UTF-8'); ?>'><?php echo strip_tags($output);?></span>
<script>init_lazy_html_section('content_footer_observer');</script>     
    </footer>
		<!-- wheel -->
	<?php if (is_user_logged_in() || 1==1): ?>		

		<div class="modalwheel-wrapper"> 
			<div class="modalwheel">
				<div class="modalcontent">
					<a class="btn-close trigger" href="#">x</a>
					<div class="wheel-left">
						<div class="wheeltitle">Крутите рулетку и выиграйте подарок<br> при заказе 2-х <a target="_blank" href="/prigorodnyye/">ПРИГОРОДНЫХ</a> экскурсий!</div>
						<div class="wheel"></div>
					</div>
					<div class="wheel-right">       

						<form class="wheel-prize">
							<div class="wheeltitle">Крутите рулетку и выиграйте подарок<br> при заказе 2-х <a target="_blank" href="/prigorodnyye/">ПРИГОРОДНЫХ</a> экскурсий!</div>
							<div class="wheeltitlesubtitle">
								<p>У вас есть <b class="wheelcount">3 попытки</b>, чтобы испытать удачу. </p>
								<p>После этого выберите приз и укажите свой номер телефона. Мы свяжемся с вами, чтобы активировать ваш подарок.</p>
								<p>Бонус действителен только в случае оплаченных вами <a target="_blank" href="/prigorodnyye/">пригородных экскурсий</a>. Скидки, предложенные на сайте, не суммируются.</p>
								<p>На теплоходные экскурсии (<a href="/excursiya-po-nochnomu-peterburgu">кроме Ночной экскурсии с прогулкой на теплоходе</a>), скидка в -30% не распространяется.</p>
							</div>

							<div class="wheel-input-container">
								<div class="wheelradio"></div>
								<a href="#" class="spin-to-win">Вращать колесо (3)</a>

								<div class="input-block">
									<div class="flex">                              
										<input type="text" class="wheelemail" name="wheelemail" placeholder="Введите номер телефона">
										<input type="submit" class="spin-to-submit" value="Отправить">
									</div>
									<p style="margin-top: 14px;">С вами свяжется менеджер для активации вашего бонуса.</p>
								</div>
							</div>
						</span>
					</form>
				</div>      
			</div>
		</div>
		</div>  
	<?php endif ?>
	<!-- /wheel -->
	<div class="modal">
      <div class="modal__content modal__content--callback modal__content--callback_clear">
        <form class="modal__form call_form">
          <h3 class="modal__title">
            Заказать обратный звонок
          </h3>
          <input type="hidden" name="subject" value="Заказ обратного звонка" />
          <input type="text" placeholder="Имя" name="name" class="modal__input" />
          <input type="text" placeholder="Телефон*" name="phone" class="modal__input" />
          <input type="submit" value="Отправить" class="modal__submit" />
		    <div style="margin-top: 15px;" class="form-agreement">Нажимая “Отправить” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.</div>
        </form>
        <span class="modal__close">&#10006;</span>
      </div>

      <div class="modal__content modal__content--filter">
    		<h3 class="modal__title">
    			Фильтр
    		</h3>
    		
				<form role="search" method="get" id="searchform_popup" action="<?php echo home_url( '/' ) ?>" >
					<input class="d1" type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Что хотите найти?" />


          <input type="hidden" value="1" name="sentence" />
          <input type="hidden" value="tours" name="post_type" />
          <input type="hidden" value="grup-ekskursii" name="excursion" />
					<button class="d2">
						<img src="<?php echo get_template_directory_uri()?>/img/search.png" alt="" style="margin: auto;">
					</button>
				</form>

      <div class="tl-tour-search--group filter_calendar input-group mob">
				<div class="input-group-append">
					<img src="<?php echo get_template_directory_uri()?>/img/shape.svg" alt="" style="margin-left: 10px;">
				</div>
        <div class="tl-dropdown" data-type="calendar">
            <div class="tl-dropdown--head">
                <input class="tl-datapicker--input" value="<?php echo $date;?>" name="date" type="text" readonly placeholder="Даты проведения">
            </div>
            <div class="tl-dropdown--menu">
                <div class="tl-dropdown--menu-head">
                    <button class="tl-toggle--btn active" data-clndr-toggle="day">Дни</button>
                    <button class="tl-toggle--btn" data-clndr-toggle="month">Месяцы</button>
                </div>
                <div class="tl-dropdown--menu-inner">
                    <div data-clndr="month" class="tl-datapicker-month"
                         data-min-view="months"
                         data-view="months"
                         data-date-format="MM yyyy"
                    ></div>
                    <div data-clndr="day" class="tl-datapicker active " data-range="true" data-multiple-dates-separator=" - "></div>
                </div>
                <div class="tl-dropdown--footer">
                    <?php if ($category->taxonomy =="tip-tura"): ?>
                        <button class="tl-btn--default" data-dn-canceltour>
                            Найти
                        </button>
                    <?php else: ?>    
                        <button class="tl-btn--default" data-dn-cancel>
                            Найти
                        </button>
                    <?php endif ?>
                </div>
            </div>
        </div>
      </div>
      <?php /*
				<div class="input-group_popup">
					<div class="input-group-append">
						<img src="<?php echo get_template_directory_uri()?>/img/shape.png" alt="" style="margin-left: 10px;margin-right: 5px;">
					</div>
					<input class="popup-input rent-start form-control datepicker hasDatepicker" type="text" name="rent-start" id="rent-start_mob"  data-position="right top" placeholder="Даты проведения" readonly="">

					<div class="input-group-prepend">
					<img src="<?php echo get_template_directory_uri()?>/img/down.png" alt="Длительность" style="margin-left: auto;margin-right: 10px;">
					</div>
				</div>
				*/ ?>
				<div class="setting__item_popup">
					<div class="title_filter">Длительность</div>
					<div class="setting__item-inner" data-select="select-4">
						<label>
							<div class="setting__item-radio js-4">
								<input type="radio"  name="duration" value="all">
								<span>Любая</span>
							</div>
						</label>
						<label>
							<div class="setting__item-radio js-4">
								<input type="radio"  name="duration" value="3">
								<span>до 3-х часов</span>
							</div>
						</label>

						<label>
							<div class="setting__item-radio js-4">
								<input type="radio" name="duration" value="5">
								<span>3-5 часов</span>
							</div>
						</label>
						<label>
							<div class="setting__item-radio js-4">
								<input type="radio" name="duration" value="more5">
								<span>более 5 часов</span>
							</div>
						</label>
					</div>
				</div>

				<div class="page-radio-wrap-body_popup js-4">
					<label>
						<div class="input-radio-wrap input-radio-wrap-yes">
							<input type="checkbox" name="have_sale_popup">
							<span>Со скидкой</span>
						</div>
					</label>

					<label>
						<div class="input-radio-wrap">
							<input type="checkbox" name="exclusive_popup">
							<span>Эксклюзив</span>
						</div>
					</label>
				</div>

				<div class="popup_bottom">
					<span class="modal__close btn">Показать все экскурсии</span>
					<span class="clear">Сбросить</span>
				</div>


        <span class="modal__close">&#10006;</span>
      </div>

      <div class="modal__content modal__content--image">
        <div class="modal__gallery">
          <span class="modal__close">&#10006;</span>
        </div>
        <button class="next-img-button"></button>
        <button class="prev-img-button"></button>
      </div>

      <div class="modal__content modal__content--callback modal__content--success">
    		<h3 class="modal__title">
    			Ваша заявка отправлена!
    		</h3>
    		<p>Скоро менеджер свяжется с Вами для уточнения деталей.</p>
        <span class="modal__close">&#10006;</span>
      </div>

      <div class="modal__content modal__content--callback modal__content--copy">
        <p style="text-align: center;padding-right: 7px;">Промокод скопирован</p>
        <span class="modal__close">&#10006;</span>
      </div>

      <div class="modal__content modal__content--callback modal__content--successreq">
    		<h3 class="modal__title">
    			Ваша заявка отправлена!
    		</h3>
    		<p>Скоро менеджер свяжется с Вами для уточнения деталей. <br>Или напишите нам в <a target="_blank" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru">WhatsApp</a></p>
        <span class="modal__close">&#10006;</span>
      </div>
      
      <div class="modal__content modal__content--callback modal__reviews--success">
        <h3 class="modal__title">
          Ваш отзыв отправлен!
        </h3>
        <p class="modal__reviews--success-text-1">Спасибо за ваш отзыв, после модерации мы его обязательно опубликуем!</p>
        <p class="modal__reviews--success-text-2">Положительные отзывы мы публикуем быстрее, потому как отзывы с жалобами требуют времени на подготовку ответа.</p>
        <span class="modal__close">&#10006;</span>
      </div>
		
		<?php
			//$groups = get_field('popup_cats', 'option');
			$menu = wp_get_nav_menu_items('Header');
			
			$menu_items = [];
			$parent = '4222';
			foreach($menu as $item){
				if ($item->menu_item_parent == $parent)
					$menu_items[$item->ID] = [
						'title' => $item->title,
						'url' => $item->url,
						'childs' => []
					];
				if(isset($menu_items[$item->menu_item_parent]))
					$menu_items[$item->menu_item_parent]['childs'][$item->ID] = [
						'title' => $item->title,
						'url' => $item->url
					];
			}			
		?>
		<div class="modal__content modal__content--callback modal__content--more more_popup">
			<h3 class="modal__title more_popup__title">Все экскурсии</h3>
			<div class="modal__content--content more_popup__content">
				<?php /*foreach($groups as $item): ?>
					<div class="more_popup__group">
						<div class="more_popup__grop_title"><?=$item['group']?></div>
						<div class="more_popup__cats">
							<?php foreach($item['cats'] as $item2):?>
								<?php if($item2->count):?>
									<a href="/<?=$item2->slug?>/" class="content__filter more_popup__filter" data-slug="<?=$item2->slug?>">
										<?php echo str_replace('экскурсии', '', $item2->name);?>
										<span><?=$item2->count?></span>
									</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach;*/ ?>
				
				<?php foreach($menu_items as $item): ?>
					<?php if(count($item['childs'])): ?>
						<div class="more_popup__group">
							<div class="more_popup__grop_title"><?=$item['title']?></div>
							<div class="more_popup__cats">
								<?php foreach($item['childs'] as $item2):?>
									<a href="<?=$item2['url']?>" class="content__filter more_popup__filter"><?=$item2['title']?></a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>			
			</div>
			<span class="modal__close">&#10006;</span>
		</div>
	</div>

</div>
<div class="page-loader"></div>
<?php wp_footer();  ?>

<?php //Modals ?>
<?php //Modal - wish ?>
<div class="wish-modal-block--wrapper"></div>
<div class="wish-modal-block">
    <button class="close-modal close-modal__icon">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px" viewBox="0 0 14 14" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(1.000000, 1.000000)" stroke="#979797" stroke-width="2">
                    <path d="M0,0 L12,12"/>
                    <path d="M12,0 L0,12"/>
                </g>
            </g>
        </svg>
    </button>
    <div class="wish-modal-block__container">
        <div class="wish-modal-block__text"><span class="wish-modal-block__transport-name"></span> в Избранном</div>
        <a href="/wishlist" class="wish-modal-block__link">Посмотреть Избранное</a>
        <button href="/wishlist" class="close-modal wish-modal-block__close">Закрыть</button>
    </div>
</div>

<?php //success - wish ?>
<div class="success-modal-block--wrapper"></div>
<div class="success-modal-block">
    <button class="close-modal close-modal__icon">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px" viewBox="0 0 14 14" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(1.000000, 1.000000)" stroke="#979797" stroke-width="2">
                    <path d="M0,0 L12,12"/>
                    <path d="M12,0 L0,12"/>
                </g>
            </g>
        </svg>
    </button>
    <div class="success-modal-block__container">
        <div class="success-modal-block__icon-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="108" height="108" viewBox="0 0 108 108" fill="none">
                <rect width="108" height="108" rx="54" fill="#FDF4D3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M54 24C37.44 24 24 37.44 24 54C24 70.56 37.44 84 54 84C70.56 84 84 70.56 84 54C84 37.44 70.56 24 54 24ZM54 78C40.77 78 30 67.23 30 54C30 40.77 40.77 30 54 30C67.23 30 78 40.77 78 54C78 67.23 67.23 78 54 78ZM65.6399 42.8702L47.9999 60.5102L42.3599 54.8702C41.1899 53.7002 39.2999 53.7002 38.1299 54.8702C36.9599 56.0402 36.9599 57.9302 38.1299 59.1002L45.8999 66.8702C47.0699 68.0402 48.9599 68.0402 50.1299 66.8702L69.8999 47.1002C71.0699 45.9302 71.0699 44.0402 69.8999 42.8702C68.7299 41.7002 66.8099 41.7002 65.6399 42.8702Z" fill="#FED532"/>
            </svg>
        </div>
        <div class="success-modal-block__title">Ваша заявка отправлена!</div>
        <div class="success-modal-block__text">Мы скоро с вами свяжемся. Если не хотите ждать, напишите нам
            <a href="https://api.whatsapp.com/send?phone=79516853733&amp;text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru" class="success-modal-block__text__whatsapp" target="_blank" rel="nofollow">
                <svg xmlns="http://www.w3.org/2000/svg" width="94" height="20" viewBox="0 0 94 20" fill="none" class="success-modal-block__text__svg">
                    <g clip-path="url(#clip0_472_397)">
                        <path d="M5.17591 16.0154L5.4415 16.1729C6.5575 16.8352 7.83697 17.1854 9.14173 17.1861H9.14458C13.1516 17.1861 16.4129 13.9256 16.4144 9.91829C16.4151 7.97618 15.6596 6.15024 14.2871 4.7764C12.9144 3.40281 11.0893 2.64582 9.14717 2.64501C5.13708 2.64501 1.87581 5.90502 1.8743 9.91234C1.87377 11.2856 2.25791 12.623 2.98575 13.78L3.15875 14.055L2.42415 16.7369L5.17591 16.0154ZM0.324219 18.8143L1.56509 14.2833C0.799707 12.9572 0.397059 11.4529 0.397689 9.91193C0.399555 5.09075 4.32307 1.1684 9.14476 1.1684C11.4845 1.1694 13.6805 2.07999 15.332 3.73279C16.9832 5.38556 17.8923 7.58252 17.8916 9.91899C17.8895 14.7399 13.9652 18.663 9.14476 18.663C9.1444 18.663 9.14494 18.663 9.14476 18.663H9.14102C7.67717 18.6625 6.23878 18.2953 4.96125 17.5985L0.324219 18.8143Z" fill="#4ECB5C"/>
                        <path d="M0.396712 9.91392C0.396183 11.4549 0.798831 12.9594 1.56421 14.2853L0.323242 18.816L4.96012 17.6003C6.23773 18.297 7.67604 18.6641 9.1399 18.6647H9.14363C13.9641 18.6647 17.8884 14.7416 17.8904 9.9207C17.8913 7.58411 16.9821 5.3872 15.3308 3.7345C13.6793 2.0818 11.4834 1.17111 9.14363 1.1701C4.32219 1.1701 0.398582 5.09246 0.396565 9.91364M3.15787 14.0569L2.98478 13.7819C2.25694 12.6248 1.8728 11.2874 1.87332 9.9143C1.87491 5.90724 5.13611 2.64697 9.1462 2.64697C11.0881 2.64773 12.9132 3.40479 14.2861 4.77836C15.6588 6.15202 16.4141 7.97811 16.4136 9.92C16.4118 13.9273 13.1505 17.1878 9.14345 17.1878H9.14061C7.83587 17.1871 6.5563 16.8368 5.44038 16.1747L5.17479 16.0172L2.42307 16.7387L3.15787 14.0569ZM9.14363 18.6647C9.14345 18.6647 9.14354 18.6647 9.14363 18.6647V18.6647Z" fill="#4ECB5C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.9576 6.25804C6.79386 5.89407 6.62157 5.88678 6.46583 5.88038C6.33837 5.87496 6.1926 5.87531 6.04699 5.87531C5.90121 5.87531 5.66444 5.93001 5.46422 6.14872C5.26383 6.36743 4.69922 6.89612 4.69922 7.97137C4.69922 9.04672 5.48248 10.0858 5.5916 10.2317C5.70091 10.3774 7.10359 12.6546 9.32486 13.5306C11.1711 14.2586 11.5468 14.1138 11.9475 14.0773C12.3482 14.0409 13.2406 13.5488 13.4226 13.0384C13.6048 12.5282 13.6048 12.0907 13.5502 11.9994C13.4956 11.9083 13.3498 11.8536 13.1312 11.7444C12.9126 11.6351 11.8382 11.1063 11.6379 11.0334C11.4375 10.9605 11.2918 10.9241 11.146 11.1429C11.0003 11.3615 10.5817 11.8536 10.4542 11.9994C10.3267 12.1454 10.1992 12.1637 9.98063 12.0544C9.76201 11.9447 9.0581 11.7141 8.22308 10.9697C7.57334 10.3904 7.13474 9.67501 7.00719 9.45618C6.87973 9.23765 6.99358 9.11927 7.10316 9.0103C7.20136 8.91237 7.32179 8.75512 7.43111 8.62757C7.54015 8.49993 7.57653 8.40885 7.64938 8.26307C7.72231 8.1172 7.68585 7.98956 7.63123 7.88024C7.57653 7.77092 7.15194 6.69021 6.9576 6.25804Z" fill="#4ECB5C"/>
                    </g>
                    <path d="M23.9219 13.1953L26.1875 3.625H27.4531L27.7422 5.21875L25.3281 15H23.9688L23.9219 13.1953ZM22.7578 3.625L24.6328 13.1953L24.4766 15H22.9609L20.4375 3.625H22.7578ZM29.7344 13.1562L31.5859 3.625H33.9062L31.3906 15H29.875L29.7344 13.1562ZM28.1641 3.625L30.4453 13.2344L30.3828 15H29.0234L26.5938 5.21094L26.9062 3.625H28.1641ZM37.2344 3V15H34.9844V3H37.2344ZM36.9141 10.4766H36.2969C36.3021 9.88802 36.3802 9.34635 36.5312 8.85156C36.6823 8.35156 36.8984 7.91927 37.1797 7.55469C37.4609 7.1849 37.7969 6.89844 38.1875 6.69531C38.5833 6.49219 39.0208 6.39062 39.5 6.39062C39.9167 6.39062 40.2943 6.45052 40.6328 6.57031C40.9766 6.6849 41.2708 6.8724 41.5156 7.13281C41.7656 7.38802 41.9583 7.72396 42.0938 8.14062C42.2292 8.55729 42.2969 9.0625 42.2969 9.65625V15H40.0312V9.64062C40.0312 9.26562 39.9766 8.97135 39.8672 8.75781C39.763 8.53906 39.6094 8.38542 39.4062 8.29688C39.2083 8.20312 38.9635 8.15625 38.6719 8.15625C38.349 8.15625 38.0729 8.21615 37.8438 8.33594C37.6198 8.45573 37.4401 8.6224 37.3047 8.83594C37.1693 9.04427 37.0703 9.28906 37.0078 9.57031C36.9453 9.85156 36.9141 10.1536 36.9141 10.4766ZM48.5703 13.0938V9.32812C48.5703 9.05729 48.526 8.82552 48.4375 8.63281C48.349 8.4349 48.2109 8.28125 48.0234 8.17188C47.8411 8.0625 47.6042 8.00781 47.3125 8.00781C47.0625 8.00781 46.8464 8.05208 46.6641 8.14062C46.4818 8.22396 46.3411 8.34635 46.2422 8.50781C46.1432 8.66406 46.0938 8.84896 46.0938 9.0625H43.8438C43.8438 8.70312 43.9271 8.36198 44.0938 8.03906C44.2604 7.71615 44.5026 7.43229 44.8203 7.1875C45.138 6.9375 45.5156 6.74219 45.9531 6.60156C46.3958 6.46094 46.8906 6.39062 47.4375 6.39062C48.0938 6.39062 48.6771 6.5 49.1875 6.71875C49.6979 6.9375 50.099 7.26562 50.3906 7.70312C50.6875 8.14062 50.8359 8.6875 50.8359 9.34375V12.9609C50.8359 13.4245 50.8646 13.8047 50.9219 14.1016C50.9792 14.3932 51.0625 14.6484 51.1719 14.8672V15H48.8984C48.7891 14.7708 48.7057 14.4844 48.6484 14.1406C48.5964 13.7917 48.5703 13.4427 48.5703 13.0938ZM48.8672 9.85156L48.8828 11.125H47.625C47.3281 11.125 47.0703 11.1589 46.8516 11.2266C46.6328 11.2943 46.4531 11.3906 46.3125 11.5156C46.1719 11.6354 46.0677 11.776 46 11.9375C45.9375 12.099 45.9062 12.276 45.9062 12.4688C45.9062 12.6615 45.9505 12.8359 46.0391 12.9922C46.1276 13.1432 46.2552 13.263 46.4219 13.3516C46.5885 13.4349 46.7839 13.4766 47.0078 13.4766C47.3464 13.4766 47.6406 13.4089 47.8906 13.2734C48.1406 13.138 48.3333 12.9714 48.4688 12.7734C48.6094 12.5755 48.6823 12.388 48.6875 12.2109L49.2812 13.1641C49.1979 13.3776 49.0833 13.599 48.9375 13.8281C48.7969 14.0573 48.6172 14.2734 48.3984 14.4766C48.1797 14.6745 47.9167 14.8385 47.6094 14.9688C47.3021 15.0938 46.9375 15.1562 46.5156 15.1562C45.9792 15.1562 45.4922 15.0495 45.0547 14.8359C44.6224 14.6172 44.2786 14.3177 44.0234 13.9375C43.7734 13.5521 43.6484 13.1146 43.6484 12.625C43.6484 12.1823 43.7318 11.7891 43.8984 11.4453C44.0651 11.1016 44.3099 10.8125 44.6328 10.5781C44.9609 10.3385 45.3698 10.1589 45.8594 10.0391C46.349 9.91406 46.9167 9.85156 47.5625 9.85156H48.8672ZM56.7109 6.54688V8.14062H51.7891V6.54688H56.7109ZM53.0078 4.46094H55.2578V12.4531C55.2578 12.6979 55.2891 12.8854 55.3516 13.0156C55.4193 13.1458 55.5182 13.237 55.6484 13.2891C55.7786 13.3359 55.9427 13.3594 56.1406 13.3594C56.2812 13.3594 56.4062 13.3542 56.5156 13.3438C56.6302 13.3281 56.7266 13.3125 56.8047 13.2969L56.8125 14.9531C56.6198 15.0156 56.4115 15.0651 56.1875 15.1016C55.9635 15.138 55.7161 15.1562 55.4453 15.1562C54.9505 15.1562 54.5182 15.0755 54.1484 14.9141C53.7839 14.7474 53.5026 14.4818 53.3047 14.1172C53.1068 13.7526 53.0078 13.2734 53.0078 12.6797V4.46094ZM62.5625 12.6641C62.5625 12.5026 62.5156 12.3568 62.4219 12.2266C62.3281 12.0964 62.1536 11.9766 61.8984 11.8672C61.6484 11.7526 61.2865 11.6484 60.8125 11.5547C60.3854 11.4609 59.987 11.3438 59.6172 11.2031C59.2526 11.0573 58.9349 10.8828 58.6641 10.6797C58.3984 10.4766 58.1901 10.237 58.0391 9.96094C57.888 9.67969 57.8125 9.35938 57.8125 9C57.8125 8.64583 57.888 8.3125 58.0391 8C58.1953 7.6875 58.4167 7.41146 58.7031 7.17188C58.9948 6.92708 59.349 6.73698 59.7656 6.60156C60.1875 6.46094 60.6615 6.39062 61.1875 6.39062C61.9219 6.39062 62.5521 6.50781 63.0781 6.74219C63.6094 6.97656 64.0156 7.29948 64.2969 7.71094C64.5833 8.11719 64.7266 8.58073 64.7266 9.10156H62.4766C62.4766 8.88281 62.4297 8.6875 62.3359 8.51562C62.2474 8.33854 62.1068 8.20052 61.9141 8.10156C61.7266 7.9974 61.4818 7.94531 61.1797 7.94531C60.9297 7.94531 60.7135 7.98958 60.5312 8.07812C60.349 8.16146 60.2083 8.27604 60.1094 8.42188C60.0156 8.5625 59.9688 8.71875 59.9688 8.89062C59.9688 9.02083 59.9948 9.13802 60.0469 9.24219C60.1042 9.34115 60.1953 9.43229 60.3203 9.51562C60.4453 9.59896 60.6068 9.67708 60.8047 9.75C61.0078 9.81771 61.2578 9.88021 61.5547 9.9375C62.1641 10.0625 62.7083 10.2266 63.1875 10.4297C63.6667 10.6276 64.0469 10.8984 64.3281 11.2422C64.6094 11.5807 64.75 12.026 64.75 12.5781C64.75 12.9531 64.6667 13.2969 64.5 13.6094C64.3333 13.9219 64.0938 14.1953 63.7812 14.4297C63.4688 14.6589 63.0938 14.8385 62.6562 14.9688C62.224 15.0938 61.737 15.1562 61.1953 15.1562C60.4089 15.1562 59.7422 15.0156 59.1953 14.7344C58.6536 14.4531 58.2422 14.0964 57.9609 13.6641C57.6849 13.2266 57.5469 12.7786 57.5469 12.3203H59.6797C59.6901 12.6276 59.7682 12.875 59.9141 13.0625C60.0651 13.25 60.2552 13.3854 60.4844 13.4688C60.7188 13.5521 60.9714 13.5938 61.2422 13.5938C61.5339 13.5938 61.776 13.5547 61.9688 13.4766C62.1615 13.3932 62.3073 13.2839 62.4062 13.1484C62.5104 13.0078 62.5625 12.8464 62.5625 12.6641ZM70.9766 5.57031L67.8828 15H65.3906L69.6172 3.625H71.2031L70.9766 5.57031ZM73.5469 15L70.4453 5.57031L70.1953 3.625H71.7969L76.0469 15H73.5469ZM73.4062 10.7656V12.6016H67.3984V10.7656H73.4062ZM78.9609 8.17188V18.25H76.7109V6.54688H78.7969L78.9609 8.17188ZM84.3125 10.6797V10.8438C84.3125 11.4583 84.2396 12.0286 84.0938 12.5547C83.9531 13.0807 83.7448 13.5391 83.4688 13.9297C83.1927 14.3151 82.849 14.6172 82.4375 14.8359C82.0312 15.0495 81.5625 15.1562 81.0312 15.1562C80.5156 15.1562 80.0677 15.0521 79.6875 14.8438C79.3073 14.6354 78.987 14.3438 78.7266 13.9688C78.4714 13.5885 78.2656 13.1484 78.1094 12.6484C77.9531 12.1484 77.8333 11.612 77.75 11.0391V10.6094C77.8333 9.99479 77.9531 9.43229 78.1094 8.92188C78.2656 8.40625 78.4714 7.96094 78.7266 7.58594C78.987 7.20573 79.3047 6.91146 79.6797 6.70312C80.0599 6.49479 80.5052 6.39062 81.0156 6.39062C81.5521 6.39062 82.0234 6.49219 82.4297 6.69531C82.8411 6.89844 83.1849 7.1901 83.4609 7.57031C83.7422 7.95052 83.9531 8.40365 84.0938 8.92969C84.2396 9.45573 84.3125 10.0391 84.3125 10.6797ZM82.0547 10.8438V10.6797C82.0547 10.3203 82.0234 9.98958 81.9609 9.6875C81.9036 9.38021 81.8099 9.11198 81.6797 8.88281C81.5547 8.65365 81.388 8.47656 81.1797 8.35156C80.9766 8.22135 80.7292 8.15625 80.4375 8.15625C80.1302 8.15625 79.8672 8.20573 79.6484 8.30469C79.4349 8.40365 79.2604 8.54688 79.125 8.73438C78.9896 8.92188 78.888 9.14583 78.8203 9.40625C78.7526 9.66667 78.7109 9.96094 78.6953 10.2891V11.375C78.7214 11.7604 78.7943 12.1068 78.9141 12.4141C79.0339 12.7161 79.2188 12.9557 79.4688 13.1328C79.7188 13.3099 80.0469 13.3984 80.4531 13.3984C80.75 13.3984 81 13.3333 81.2031 13.2031C81.4062 13.0677 81.5703 12.8828 81.6953 12.6484C81.8255 12.4141 81.9167 12.1432 81.9688 11.8359C82.026 11.5286 82.0547 11.1979 82.0547 10.8438ZM87.9609 8.17188V18.25H85.7109V6.54688H87.7969L87.9609 8.17188ZM93.3125 10.6797V10.8438C93.3125 11.4583 93.2396 12.0286 93.0938 12.5547C92.9531 13.0807 92.7448 13.5391 92.4688 13.9297C92.1927 14.3151 91.849 14.6172 91.4375 14.8359C91.0312 15.0495 90.5625 15.1562 90.0312 15.1562C89.5156 15.1562 89.0677 15.0521 88.6875 14.8438C88.3073 14.6354 87.987 14.3438 87.7266 13.9688C87.4714 13.5885 87.2656 13.1484 87.1094 12.6484C86.9531 12.1484 86.8333 11.612 86.75 11.0391V10.6094C86.8333 9.99479 86.9531 9.43229 87.1094 8.92188C87.2656 8.40625 87.4714 7.96094 87.7266 7.58594C87.987 7.20573 88.3047 6.91146 88.6797 6.70312C89.0599 6.49479 89.5052 6.39062 90.0156 6.39062C90.5521 6.39062 91.0234 6.49219 91.4297 6.69531C91.8411 6.89844 92.1849 7.1901 92.4609 7.57031C92.7422 7.95052 92.9531 8.40365 93.0938 8.92969C93.2396 9.45573 93.3125 10.0391 93.3125 10.6797ZM91.0547 10.8438V10.6797C91.0547 10.3203 91.0234 9.98958 90.9609 9.6875C90.9036 9.38021 90.8099 9.11198 90.6797 8.88281C90.5547 8.65365 90.388 8.47656 90.1797 8.35156C89.9766 8.22135 89.7292 8.15625 89.4375 8.15625C89.1302 8.15625 88.8672 8.20573 88.6484 8.30469C88.4349 8.40365 88.2604 8.54688 88.125 8.73438C87.9896 8.92188 87.888 9.14583 87.8203 9.40625C87.7526 9.66667 87.7109 9.96094 87.6953 10.2891V11.375C87.7214 11.7604 87.7943 12.1068 87.9141 12.4141C88.0339 12.7161 88.2188 12.9557 88.4688 13.1328C88.7188 13.3099 89.0469 13.3984 89.4531 13.3984C89.75 13.3984 90 13.3333 90.2031 13.2031C90.4062 13.0677 90.5703 12.8828 90.6953 12.6484C90.8255 12.4141 90.9167 12.1432 90.9688 11.8359C91.026 11.5286 91.0547 11.1979 91.0547 10.8438Z" fill="#4ECB5C"/>
                    <defs>
                        <clipPath id="clip0_472_397">
                            <rect width="18" height="18" fill="white" transform="translate(0 1)"/>
                        </clipPath>
                    </defs>
                </svg>
            </a>
        </div>
        <button  class="success-modal-block__btn close-modal">Хорошо!</button>
    </div>
</div>

<?php //Modal - single_attention_modal ?>
<?php
if (is_singular('tours')) { ?>
    <div class="single_attention_modal--wrapper"></div>
    <div class="single_attention_modal">
        <button class="close-modal close-modal__icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px" viewBox="0 0 14 14" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(1.000000, 1.000000)" stroke="#979797" stroke-width="2">
                        <path d="M0,0 L12,12"/>
                        <path d="M12,0 L0,12"/>
                    </g>
                </g>
            </svg>
        </button>
        <div class="single_attention_modal__container">
            <div class="single_attention_modal__title"><?php echo get_the_title(6857);?></div>
            <div class="single_attention_modal__content">
                <div class="single_attention_modal__content__wrap">
                    <?php
                    $post_attention = get_post( 6857 );
                    echo apply_filters('the_content', $post_attention->post_content);
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<span style="display: none;">
<a id="scroller" class="link-to-top">
  <i>
      <svg id="icon-arrow-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g data-name="Layer 2"><path d="M24,21a1,1,0,0,1-.71-.29L16,13.41l-7.29,7.3a1,1,0,1,1-1.42-1.42l8-8a1,1,0,0,1,1.42,0l8,8a1,1,0,0,1,0,1.42A1,1,0,0,1,24,21Z" fill="#fff "/></g></svg>
  </i>
</a>
</span>

<a href="https://api.whatsapp.com/send?phone=79516853733&text=%D0%97%D0%B4%D1%80%D0%B0%D0%B2%D1%81%D1%82%D0%B2%D1%83%D0%B9%D1%82%D0%B5.+%D0%AF+%D0%BE%D0%B1%D1%80%D0%B0%D1%89%D0%B0%D1%8E%D1%81%D1%8C+%D1%81+%D1%81%D0%B0%D0%B9%D1%82%D0%B0+parus-peterburg.ru" class="whatsapp-button__wrap" target="_blank" title="Написать в Whatsapp" rel="noopener noreferrer">
	 <svg xmlns="http://www.w3.org/2000/svg" height="800" width="1200" viewBox="-83.77245 -140.29175 726.0279 841.7505"><path d="M407.185 336.283c-6.948-3.478-41.108-20.284-47.477-22.606-6.368-2.318-11-3.476-15.632 3.478-4.632 6.954-17.948 22.606-22.001 27.244-4.052 4.636-8.106 5.218-15.054 1.738-6.948-3.477-29.336-10.813-55.874-34.486-20.655-18.424-34.6-41.176-38.652-48.132-4.054-6.956-.434-10.716 3.045-14.18 3.127-3.114 6.95-8.116 10.423-12.174 3.474-4.056 4.632-6.956 6.948-11.59 2.316-4.639 1.158-8.695-.58-12.172-1.736-3.478-15.632-37.679-21.422-51.592-5.64-13.547-11.368-11.712-15.633-11.927-4.048-.201-8.685-.244-13.316-.244-4.632 0-12.16 1.739-18.53 8.693-6.367 6.956-24.317 23.767-24.317 57.964 0 34.202 24.896 67.239 28.371 71.876 3.475 4.639 48.993 74.818 118.695 104.914 16.576 7.16 29.518 11.434 39.609 14.636 16.644 5.289 31.79 4.542 43.763 2.753 13.349-1.993 41.108-16.807 46.898-33.036 5.79-16.233 5.79-30.144 4.052-33.041-1.736-2.899-6.368-4.638-13.316-8.116m-126.776 173.1h-.093c-41.473-.016-82.15-11.159-117.636-32.216l-8.44-5.01-87.475 22.947 23.348-85.288-5.494-8.745c-23.136-36.798-35.356-79.328-35.338-123 .051-127.431 103.734-231.106 231.22-231.106 61.734.022 119.763 24.094 163.402 67.782 43.636 43.685 67.653 101.754 67.629 163.51-.052 127.442-103.733 231.126-231.123 231.126M477.113 81.55C424.613 28.989 354.795.03 280.407 0 127.136 0 2.392 124.736 2.33 278.053c-.02 49.011 12.784 96.847 37.118 139.019L0 561.167l147.41-38.668c40.617 22.153 86.346 33.83 132.886 33.845h.115c153.254 0 278.009-124.748 278.072-278.068.028-74.301-28.87-144.165-81.37-196.725" fill="#ffffff" fill-rule="evenodd"/></svg>
</a>
  
<script>
window.onload = function () {
	jQuery(document).ready(function ($) {
		var count_scripts = 0;
		$(document).on('mousemove touchstart scroll', 'body', function(){
			if (++count_scripts < 2) {
				var srcorig =  $('.yaRate').data('src');
						$('.yaRate').attr('src', srcorig);
					}
		});	
		
		
		var prices = $('.ajax_price, .old-price-front, .single_ajax_price, .old-price-front, .content__price span');
		
		prices.each(function() {
        var content = $(this).html();
		var contetnNew = content.replace(/./g, function(c, i, a) {
    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? " " + c : c;
  });
		$(this).html(contetnNew);
});
	});

  
    jQuery(document).ready(function ($) {
		if(jQuery(window).width()<=636){
			jQuery('.regnum').insertBefore(jQuery('.header__nav .menu-header-container'));
			var search = jQuery('<div class="search_wrapper-mobile"></div>');
			
			search.append(jQuery('.searchform-top'));
			search.insertAfter(jQuery('header'));
		}

		/*if (screen.width > 768){
			setTimeout('loadScripts()',0);
		}
		else{
			setTimeout('loadScripts()',500);
		}*/
	});
}
</script>

<script>
  jQuery(document).ready(function ($) {
      $(".excursion-tury .content-form_wrap .tours-wrap__title").html("Оставить заявку");
      $(".excursion-tury .content-form_wrap .form__submit").val("Отправить");
      $(".excursion-tury .content-form_wrap .form__textarea").css("display", "none");
      $(".excursion-tury .content-form_wrap .form__label").css("margin-botton", "5px");
   });
</script>
<script>
    jQuery(document).ready(function($) {
        $('.wp-block-gallery--fancybox a').fancybox();
    });
</script>

<?php /*get_template_part('ny/ny');*/ ?>
</body>
</html>