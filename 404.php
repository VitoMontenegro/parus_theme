<?php
/**
 * Страница 404 ошибки (404.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?>
    <section class="content content--404">
      <div class="container">
        <h1>Ошибка 404</h1>

        <p>Вы ищете страницу, которой не существует.</p>

        <a href="/">← Перейти на главную страницу сайта</a>
      </div>
    </section>
<?php get_footer(); // подключаем footer.php ?>