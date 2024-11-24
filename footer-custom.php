<?php
/**
 * Шаблон подвала (footer.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>

    <footer class="footer">
      <div class="container container--footer">
        <div class="footer__info">
          <div class="footer__logo logo">
            <div class="logo__image logo__image--footer"></div>
            <p class="logo__title logo__title--footer">
              Экскурсии <br />
              по Санкт-Петербургу
            </p>
            <p class="logo__text logo__text--footer">
              <span>отправление от Московского вокзала</span>
            </p>
          </div>
          <div class="footer__contacts">
            <div class="footer__contacts-col">
              <a
                href="tel:+79516853733"
                class="footer__icon footer__icon--phone"
              >
                +7(951)685-37-33
              </a>
              <a
                href="mailto:info@parus-peterburg.ru"
                class="footer__icon footer__icon--mail"
              >
                info@parus-peterburg.ru
              </a>
            </div>

            <div class="footer__contacts-col">
              <div class="footer__icon footer__icon--metro">
                «Пл. Восстания»
              </div>
              <div class="footer__icon footer__icon--address">
                Лиговский проспект д.43/45(оф 404)
              </div>
              <div class="footer__icon footer__icon--time">
                с 7:30 до 23:30
              </div>
            </div>
          </div>
          <span class="footer__company">ООО «Транзит Тур Лайн»</span>
        </div>
        <div class="footer__tours">
          <h4 class="footer__title">Экскурсии</h4>
          <a href="/" class="footer__link">Автобусные экскурсии</a>
          <a href="/sobytiinye-ekskursii-v-sankt-peterburge" class="footer__link">Событийные экскурсии</a>
          <a href="/indiv-ekskursii" class="footer__link">Индивидуальные экскурсии</a>
          <a href="/wp-content/uploads/price_vesna_2020.docx" class="footer__link" download>Скачать прайс на экскурсии 2020</a>
        </div>
        <div class="footer__menu">
          <h4 class="footer__title">Меню</h4>
          <a href="/" class="footer__link">Главная</a>
          <a href="/skidki" class="footer__link">Скидки</a>
          <a href="/отзывы" class="footer__link">Отзывы</a>
          <a href="/o-kompanii" class="footer__link">О компании</a>
          <a href="/gidy" class="footer__link">Наши экскурсоводы</a>
          <a href="/sotrudnichestvo" class="footer__link">Сотрудничество</a>
          <a href="/Вакансии" class="footer__link">Вакансии</a>
          <a href="/контакты" class="footer__link">Контакты</a>
        </div>
        <div class="footer__places">
          <h4 class="footer__title">Интересные места</h4>
          <a href="/русские-музеи" class="footer__link">Русские музеи</a>
          <a href="/квартиры-музеи" class="footer__link">Квартиры-музеи</a>
          <a href="/сады-и-парки" class="footer__link">Сады и парки</a>
          <a href="/государственные-музеи" class="footer__link">Гос.музеи СПБ</a>
          <a href="/достопримечательности" class="footer__link">Достопримечательности</a>
          <a href="/необычный-петербург" class="footer__link">Необычный СПБ</a>
        </div>
      </div>
    </footer>
	
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
      <div class="modal__content modal__content--callback modal__reviews--success">
    <h3 class="modal__title">
      Ваш отзыв отправлен!
    </h3>
    <p>Спасибо за ваш отзыв, после модерации мы его, обязательно, опубликуем!</p>
        <span class="modal__close">&#10006;</span>
      </div>


      </div>

</div>
<?php wp_footer();  ?>
</body>
</html>