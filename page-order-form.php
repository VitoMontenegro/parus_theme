<?php
/**
 * Страница с кастомным шаблоном (page-custom.php)
 * @package WordPress
 * Template Name: Страница "Форма заказа"
 */
get_header(); 
$h1 = (get_field('h1'))?get_field('h1'):get_the_title();

$tours = get_posts( array(
		'numberposts' => -1,
		'post_type' => 'tours',
		'suppress_filters' => true,
		'tax_query' => array(                                  // элемент (термин) таксономии 
			array(
				'taxonomy' => 'excursion',         // таксономия 
				'field' => 'slug',
				'terms'    => 'grup-ekskursii' // термин 
			)
		),
	) );
?>
<section class="content content--reviews content--tour-order">
	<div class="container">
		<a href="skidki" class="banner">
          <span class="banner__title">Скидки</span>
          <span class="banner__percent">до 20%</span>
          <div class="banner__conditions"><span>При покупке</span> билетов на сайте</div>
          <span class="banner__details">Подробнее</span>
        </a>
		<h1><?=$h1?></h1>
		
		<form class="content__form form" id="order_form-page" method="post" enctype="multipart/form-data" >
          <label class="form__label">
            <span class="form__text">ФИО *:</span>
            <input type="text" name="name"  class="form__input"/>
          </label>

          <label class="form__label">
            <span class="form__text">E-mail:</span>
            <input type="text" name="mail" class="form__input" />
          </label>

          <label class="form__label">
            <span class="form__text">Телефон *:</span>
            <input type="text" name="phone"  class="form__input" />
          </label>
		  
		  <label class="form__label form__label--tours">
            <span class="form__text">Экскурсия:</span>
            <select class="form__select form__select--tours">
				<?php foreach($tours as $k => $item): ?>
					<option 
						<?php if($k==0): ?>selected <?php endif; ?>
						value="<?=get_field('id_crm', $item->ID)?>" 
						data-price_students="<?=get_field('p_studenty', $item->ID)?>" 
						data-price_school="<?=get_field('p_shkolniki', $item->ID)?>" 
						data-price_adults="<?=get_field('p_vzroslie', $item->ID)?>" 
						data-price_childs="<?=get_field('p_doshkolniki', $item->ID)?>" 
						data-price_old="<?=get_field('p_pensionery', $item->ID)?>"
					>
						<?=$item->post_title?>
					</option>
				<?php endforeach; ?>
            </select>
          </label>

          <label class="form__label form__label--tickets">
            <span class="form__text">Дата и время*:</span>
            <div class="form__date-wrapper">
              <input
                type="date"
                value="2020-04-01"
                required
                class="form__date"
				name="form_date"
              />
            </div>
            <div class="form__tickets-left-wrapper">
              <select required class="form__select" name="trip"></select>
              <span class="form__tickets-left">Осталось 30 бил.</span>
            </div>
          </label>

          <h3>Введите количество билетов:</h3>

          <label class="form__label form__label--number">
            <span class="form__text form__text--tickets">Дошкольники:</span>
            <div class="form__input-wrapper">
              <div class="form__number-up">+</div>
              <input
                type="number"
                class="form__input form__input--number"
                value="0"
                min="0"
				name="sold_childs"
              />
              <div class="form__number-down">-</div>
            </div>
            <span class="form__text form__text--price">0 руб.</span>
          </label>
		  
		  <label class="form__label form__label--number">
            <span class="form__text form__text--tickets">Школьники:</span>
            <div class="form__input-wrapper">
              <div class="form__number-up">+</div>
              <input
                type="number"
                class="form__input form__input--number"
                value="0"
                min="0"
				name="sold_school"
              />
              <div class="form__number-down">-</div>
            </div>
            <span class="form__text form__text--price">0 руб.</span>
          </label>
		  

          <label class="form__label form__label--number">
            <span class="form__text form__text--tickets">Студенты:</span>
            <div class="form__input-wrapper">
              <div class="form__number-up">+</div>
              <input
                type="number"
                class="form__input form__input--number"
                value="0"
                min="0" 
				name="sold_students" 
              />
              <div class="form__number-down">-</div>
            </div>
            <span class="form__text form__text--price">0 руб.</span>
          </label>

          <label class="form__label form__label--number">
            <span class="form__text form__text--tickets">Взрослые:</span>
            <div class="form__input-wrapper">
              <div class="form__number-up">+</div>
              <input
                type="number"
                class="form__input form__input--number"
                value="0"
                min="0"
				name="sold_adults"
              />
              <div class="form__number-down">-</div>
            </div>
            <span class="form__text form__text--price">0 руб.</span>
          </label>
		  
		  <label class="form__label form__label--number">
            <span class="form__text form__text--tickets">Пенсионеры:</span>
            <div class="form__input-wrapper">
              <div class="form__number-up">+</div>
              <input
                type="number"
                class="form__input form__input--number"
                value="0"
                min="0" 
				name="sold_old"
              />
              <div class="form__number-down">-</div>
            </div>
            <span class="form__text form__text--price">0 руб.</span>
          </label>

          <label class="form__label">
            <span class="form__text">Введите промо-код:</span>
            <input type="text" name="promo" class="form__input form__input--short" />
			<span id="promo_ok"></span>
          </label>

          <label class="form__label form__label--summary">
            <span class="form__text">Сумма к оплате:</span>
            <input
              type="text"
              readonly 
              value="0"
              class="form__input form__input--short form__input--readonly" 
			  name="amount"
            />
          <p>
			  <input
              type="submit"
              value="Купить билеты"
              class="form__submit form__submit--buy single_form"
            />
			
          </label>
			<input type="hidden" name="discount" id="discount" data-fulldiscount="0" value="200">
			<input type="hidden" name="title" value="">
			<input type="hidden" name="true_price" value="">
			<input type="hidden" name="price_adults" value="" />
			<input type="hidden" name="price_childs" value="" />
			<input type="hidden" name="price_old" value="" />
			<input type="hidden" name="price_students" value="" />
			<input type="hidden" name="price_school" value="" />
			<input type="hidden" name="date_and_time" id="date_and_time" value="" />   
<div style="margin-top: 15px;margin-bottom: 20px;" class="form-agreement">Нажимая “Отправить” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.</div>			
        </form>
		<p class="content__red content__text--footer">
          После нажатия на кнопку "Купить билеты" у вас будет 15 минут, чтобы
          совершить оплату. По истечении этого срока бронь автоматически
          снимется.
        </p>

        <p class="content__red">
          Если турист не имеет при себе документ удостоверяющий личность и
          документ подтверждающий льготу, то турист обязан доплатить разницу
          перед отправкой экскурсии. При отказе доплатить, турист снимается с
          экскурсии и стоимость билета не возвращается.
        </p>
	</div>
</section>
<?php get_footer(); ?>