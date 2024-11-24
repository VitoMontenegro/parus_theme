<?php
error_reporting(0);
/**
 * Функции шаблона (function.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
remove_action('wp_head', 'feed_links_extra', 3); // Remove Every Extra Links to Rss Feeds.
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'wc_products_rss_feed');
remove_action('wp_head', 'alternate', 2);

add_filter('after_setup_theme', 'remove_redundant_shortlink');

function remove_redundant_shortlink() {
    // remove HTML meta tag
    // <link rel='shortlink' href='http://example.com/?p=25' />
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);

    // remove HTTP header
    // Link: <https://example.com/?p=25>; rel=shortlink
    remove_action( 'template_redirect', 'wp_shortlink_header', 11);
}

remove_action('wp_head', 'wp_generator');

//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');


//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' ); // Wordpress core
    wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme		
}

if (is_home() || ($_SERVER['REQUEST_URI'] == '/')) {
    function my_deregister_scripts(){
        wp_deregister_script( 'wp-embed' );
    }
    add_action( 'wp_footer', 'my_deregister_scripts' );
    add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
}
add_theme_support('title-tag'); // теперь тайтл управляется самим вп

register_nav_menus(array( // Регистрируем 2 меню
    'top' => 'Верхнее', // Верхнее
    'excursion' => 'Экскурсии',
    'bottom' => 'Внизу' // Внизу
));




add_theme_support('post-thumbnails'); // включаем поддержку миниатюр
set_post_thumbnail_size(250, 150); // задаем размер миниатюрам 250x150
add_image_size('big-thumb', 400, 400, true);//добавляем еще один размер картинкам 400x400 с обрезкой
add_image_size('newpost-thumb', 790, 400, true);// а этот для постов блога

register_sidebar(array( // регистрируем левую колонку, этот кусок можно повторять для добавления новых областей для виджитов
    'name' => 'Сайдбар', // Название в админке
    'id' => "sidebar", // идентификатор для вызова в шаблонах
    'description' => 'Обычная колонка в сайдбаре', // Описалово в админке
    'before_widget' => '<div id="%1$s" class="widget %2$s">', // разметка до вывода каждого виджета
    'after_widget' => "</div>\n", // разметка после вывода каждого виджета
    'before_title' => '<span class="widgettitle">', //  разметка до вывода заголовка виджета
    'after_title' => "</span>\n", //  разметка после вывода заголовка виджета
));

if (!class_exists('clean_comments_constructor')) { // если класс уже есть в дочерней теме - нам не надо его определять
    class clean_comments_constructor extends Walker_Comment { // класс, который собирает всю структуру комментов
        public function start_lvl( &$output, $depth = 0, $args = array()) { // что выводим перед дочерними комментариями
            $output .= '<ul class="children">' . "\n";
        }
        public function end_lvl( &$output, $depth = 0, $args = array()) { // что выводим после дочерних комментариев
            $output .= "</ul><!-- .children -->\n";
        }
        protected function comment( $comment, $depth, $args ) { // разметка каждого комментария, без закрывающего </li>!
            $classes = implode(' ', get_comment_class()).($comment->comment_author_email == get_the_author_meta('email') ? ' author-comment' : ''); // берем стандартные классы комментария и если коммент пренадлежит автору поста добавляем класс author-comment
            echo '<li id="comment-'.get_comment_ID().'" class="'.$classes.' media">'."\n"; // родительский тэг комментария с классами выше и уникальным якорным id
            echo '<div class="media-left">'.get_avatar($comment, 64, '', get_comment_author(), array('class' => 'media-object'))."</div>\n"; // покажем аватар с размером 64х64
            echo '<div class="media-body">';
            echo '<span class="meta media-heading">Автор: '.get_comment_author()."\n"; // имя автора коммента
            //echo ' '.get_comment_author_email(); // email автора коммента, плохой тон выводить почту
            echo ' '.get_comment_author_url(); // url автора коммента
            echo ' Добавлено '.get_comment_date('F j, Y в H:i')."\n"; // дата и время комментирования
            if ( '0' == $comment->comment_approved ) echo '<br><em class="comment-awaiting-moderation">Ваш комментарий будет опубликован после проверки модератором.</em>'."\n"; // если комментарий должен пройти проверку
            echo "</span>";
            comment_text()."\n"; // текст коммента
            $reply_link_args = array( // опции ссылки "ответить"
                'depth' => $depth, // текущая вложенность
                'reply_text' => 'Ответить', // текст
                'login_text' => 'Вы должны быть залогинены' // текст если юзер должен залогинеться
            );
            echo get_comment_reply_link(array_merge($args, $reply_link_args)); // выводим ссылку ответить
            echo '</div>'."\n"; // закрываем див
        }
        public function end_el( &$output, $comment, $depth = 0, $args = array() ) { // конец каждого коммента
            $output .= "</li><!-- #comment-## -->\n";
        }
    }
}

if (!function_exists('pagination')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function pagination() { // функция вывода пагинации
        global $wp_query; // текущая выборка должна быть глобальной
        $big = 999999999; // число для замены
        $links = paginate_links(array( // вывод пагинации с опциями ниже
            'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))), // что заменяем в формате ниже
            'format' => '?paged=%#%', // формат, %#% будет заменено
            'current' => max(1, get_query_var('paged')), // текущая страница, 1, если $_GET['page'] не определено
            'type' => 'array', // нам надо получить массив
            'prev_text'    => 'Назад', // текст назад
            'next_text'    => 'Вперед', // текст вперед
            'total' => $wp_query->max_num_pages, // общие кол-во страниц в пагинации
            'show_all'     => false, // не показывать ссылки на все страницы, иначе end_size и mid_size будут проигнорированны
            'end_size'     => 15, //  сколько страниц показать в начале и конце списка (12 ... 4 ... 89)
            'mid_size'     => 15, // сколько страниц показать вокруг текущей страницы (... 123 5 678 ...).
            'add_args'     => false, // массив GET параметров для добавления в ссылку страницы
            'add_fragment' => '',	// строка для добавления в конец ссылки на страницу
            'before_page_number' => '', // строка перед цифрой
            'after_page_number' => '' // строка после цифры
        ));
        if( is_array( $links ) ) { // если пагинация есть
            echo '<ul class="pagination">';
            foreach ( $links as $link ) {
                if ( strpos( $link, 'current' ) !== false ) echo "<li class='active'>$link</li>"; // если это активная страница
                else echo "<li>$link</li>";
            }
            echo '</ul>';
        }
    }
}

if (!function_exists('add_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function add_scripts() { // добавление скриптов
        if(is_admin()) return false; // если мы в админке - ничего не делаем
        wp_deregister_script('jquery'); // выключаем стандартный jquery

        wp_enqueue_style( 'slick', get_template_directory_uri().'/assets/slick/slick.css',[],0.6074 );
        wp_enqueue_style( 'fancy', get_template_directory_uri().'/assets/fancybox/jquery.fancybox.min.css',[],0.6074 );
        wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/assets/slick/slick-theme.css',[],0.6074 );
        wp_enqueue_style( 'main', get_template_directory_uri().'/style.css',['slick','slick-theme','fancy'],0.6129 ); // основные стили шаблона
        wp_enqueue_style( 'wheel', get_template_directory_uri().'/wheel/superwheel.min.css',[],0.6074 ); // wheel
        wp_enqueue_style( 'datepicker-style', get_template_directory_uri().'/assets/css/datepicker.css',[],0.6074 );
        wp_enqueue_style( 'datetimepicker-style', get_template_directory_uri().'/assets/css/jquery.datetimepicker.css',[],0.6074 );

        wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery.min.js', '', '', true);
        wp_enqueue_script('datepicker', get_template_directory_uri().'/js/datepicker.js', 'jquery', '', true);
        wp_enqueue_script('datetimepicker', get_template_directory_uri().'/js/jquery.datetimepicker.full.min.js', 'jquery', '', true);
        wp_enqueue_script('slick', get_template_directory_uri().'/assets/slick/slick.min.js', 'jquery', '', true);
        wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/fancybox/jquery.fancybox.min.js', 'jquery', '', true);
        wp_enqueue_script('superwheel', get_template_directory_uri().'/wheel/superwheel.min.js', 'jquery', '', true);
        wp_enqueue_script('scrolling', get_template_directory_uri().'/js/scrolling.js', 'jquery', '', true);
        wp_enqueue_script('moment', get_template_directory_uri().'/js/moment.min.js', 'jquery', '', true);
        wp_enqueue_script('daterangepicker', get_template_directory_uri().'/js/jquery.daterangepicker.js', 'jquery', '', true);
        wp_enqueue_script('sticky', get_template_directory_uri().'/js/jquery.sticky.js', 'jquery', '', true);
        wp_enqueue_script('formstyler', get_template_directory_uri().'/assets/formstyler/jquery.formstyler.min.js', 'jquery', '', true);
        wp_enqueue_script('maskedinput', get_template_directory_uri().'/js/maskedinput.min.js', 'jquery', '', true);
        wp_enqueue_script('custom-wheel', get_template_directory_uri().'/wheel/wheel.js', 'jquery', '', true);
        wp_enqueue_script('script', get_template_directory_uri().'/js/script.js?v0.42', 'jquery', '', true);
        if (is_page(1698)) {
            wp_enqueue_style( 'form-styler-style', get_template_directory_uri().'/assets/formstyler/jquery.formstyler.css',[],0.6074 );
            //wp_enqueue_script('form-styler-script',get_template_directory_uri().'/assets/formstyler/jquery.formstyler.min.js','','',true);
        }
		
		if(get_post_type()=='tours'){
			wp_enqueue_style( 'vanilla-style', get_template_directory_uri().'/assets/vanilla-calendar/index.css?5');
			wp_enqueue_script('vanilla-script', get_template_directory_uri().'/assets/vanilla-calendar/index.js');
			wp_enqueue_script('vanilla-custom-script', get_template_directory_uri().'/js/vanilla.js?3', 'vanilla-script');
		}

        wp_enqueue_script('cookie-script',get_template_directory_uri().'/js/jquery.cookie.js', array('jquery'),'0.6074',true);

    }
}
add_action('wp_footer', 'add_scripts'); // приклеем ф-ю на добавление скриптов в футер

// add optionpage
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Основные настройки сайта',
        'menu_title'    => 'Настройки сайта',
        'menu_slug'     => 'theme-general-settings',
        'capability' 	=> 'edit_posts'
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Настройки экскурсий',
        'menu_title'	=> 'Настройки экскурсий',
        'menu_slug'     => 'tours_settings',
        'parent_slug'	=> 'edit.php?post_type=tours'
    ));
}
add_action('acf/init', 'my_acf_init');
function my_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        acf_register_block(array(
            'name'				=> 'gid',
            'title'				=> __('Гид'),
            'description'		=> __('Карточка гида'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'common',
            'icon'				=> 'id'
        ));
        acf_register_block(array(
            'name'		=> 'cost',
            'title'		=> __('Список "Стоимость + доп.оплата"'),
            'description'       => __('Список "Стоимость"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'			=> 'common',
            'icon'				=> 'id',
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'tables',
            'title'		=> __('Таблица'),
            'description'       => __('Таблица'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'			=> 'common',
            'icon'				=> 'id',
            'example'           => [],
        ));
    }
}

function my_acf_block_render_callback( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
    }
}

function cptui_register_my_cpts() {

    /**
     * Post Type: Отзывы.
     */

    $labels = array(
        "name" => __( "Отзывы", "allegro_tour" ),
        "singular_name" => __( "Отзыв", "allegro_tour" ),
        "menu_name" => __( "Отзывы", "allegro_tour" ),
        "all_items" => __( "Все отзывы", "allegro_tour" ),
        "add_new" => __( "Добавить отзыв", "allegro_tour" ),
        "add_new_item" => __( "Добавить новый отзыв", "allegro_tour" ),
        "edit_item" => __( "Редактировать отзыв", "allegro_tour" ),
        "new_item" => __( "Новый отзыв", "allegro_tour" ),
        "view_item" => __( "Смотреть отзыв", "allegro_tour" ),
        "view_items" => __( "Смотреть отзывы", "allegro_tour" ),
        "search_items" => __( "Найти отзыв", "allegro_tour" ),
        "not_found" => __( "Отзывы не найдены", "allegro_tour" ),
        "not_found_in_trash" => __( "Отзывы не найдены в корзине", "allegro_tour" ),
        "parent_item_colon" => __( "Родительский отзыв", "allegro_tour" ),
        "featured_image" => __( "Изображение", "allegro_tour" ),
        "set_featured_image" => __( "Установить изображение", "allegro_tour" ),
        "remove_featured_image" => __( "Удалить изображение", "allegro_tour" ),
        "use_featured_image" => __( "Использовать как изображение к отзыву", "allegro_tour" ),
        "archives" => __( "Архив отзывов", "allegro_tour" ),
        "insert_into_item" => __( "Вставить в отзыв", "allegro_tour" ),
        "uploaded_to_this_item" => __( "Загружено к этому отзыву", "allegro_tour" ),
        "filter_items_list" => __( "Фильтровать список отзывов", "allegro_tour" ),
        "items_list_navigation" => __( "Навигация по списку отзывов", "allegro_tour" ),
        "items_list" => __( "Список отзывов", "allegro_tour" ),
        "attributes" => __( "Атрибуты отзыва", "allegro_tour" ),
        "name_admin_bar" => __( "Отзыв", "allegro_tour" ),
        "parent_item_colon" => __( "Родительский отзыв", "allegro_tour" ),
    );

    $args = array(
        "label" => __( "Отзывы", "allegro_tour" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "reviews", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor"),
    );

    register_post_type( "reviews", $args );

    /**
     * Post Type: Акции.
     */

    $labels = [
        "name" => __( "Акции", "allegro_tour" ),
        "singular_name" => __( "Акция", "allegro_tour" ),
        "menu_name" => __( "Акции", "allegro_tour" ),
        "all_items" => __( "Все акции", "allegro_tour" ),
        "add_new" => __( "Добавить акцию", "allegro_tour" ),
        "add_new_item" => __( "Добавить новую акцию", "allegro_tour" ),
        "edit_item" => __( "Редактировать акцию", "allegro_tour" ),
        "new_item" => __( "Новая акция", "allegro_tour" ),
        "view_item" => __( "Смотреть акцию", "allegro_tour" ),
        "view_items" => __( "Смотреть акции", "allegro_tour" ),
        "search_items" => __( "Найти акцию", "allegro_tour" ),
        "not_found" => __( "Акции не найдены", "allegro_tour" ),
        "not_found_in_trash" => __( "Акции не найдены в корзине", "allegro_tour" ),
        "parent" => __( "Родительская акция", "allegro_tour" ),
        "featured_image" => __( "Картинка к этой акции", "allegro_tour" ),
        "set_featured_image" => __( "Установить картинку к этой акции", "allegro_tour" ),
        "remove_featured_image" => __( "Удалить картинку акции", "allegro_tour" ),
        "use_featured_image" => __( "Использовать как изображение к акции", "allegro_tour" ),
        "archives" => __( "Архивы акций", "allegro_tour" ),
        "insert_into_item" => __( "Вставить в акцию", "allegro_tour" ),
        "uploaded_to_this_item" => __( "Загружено к этой акции", "allegro_tour" ),
        "filter_items_list" => __( "Фильтровать список акций", "allegro_tour" ),
        "items_list_navigation" => __( "Навигация по списку акций", "allegro_tour" ),
        "items_list" => __( "Список акций", "allegro_tour" ),
        "attributes" => __( "Атрибуты акции", "allegro_tour" ),
        "name_admin_bar" => __( "Акция", "allegro_tour" ),
        "parent_item_colon" => __( "Родительская акция", "allegro_tour" ),
    ];

    $args = [
        "label" => __( "Акции", "allegro_tour" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [ "slug" => "promos", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "promos", $args );
}
add_action( 'init', 'cptui_register_my_cpts' );


// скрыть в меню от пользоватля с ролью 'author'
function parus_remove_menu_items() {
    if( current_user_can( 'author' ) ):
        remove_menu_page( 'edit.php?post_type=promos' );
        remove_menu_page( 'edit.php?post_type=reviews' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'tools.php' );
    endif;
}
add_action( 'admin_menu', 'parus_remove_menu_items' );

add_action( 'template_redirect', function() {

    if( strpos($_SERVER['REQUEST_URI'], '/page/') !== false  ){
        global $wp_query;
        $wp_query->set_404(); //set to 404 not found page
        status_header(404);
    }
    if( strpos($_SERVER['REQUEST_URI'], '/reviews/Page') !== false  ){
        global $wp_query;
        $wp_query->set_404(); //set to 404 not found page
        status_header(404);
    }
} );

function changeSeoTitle( $title ) {
    $tmp_title = preg_replace('/[^ a-zа-яё\d]/ui', '',$title );
    $tmp_title2 = preg_replace('/[^ a-zа-яё\d]/ui', '',html_entity_decode(get_the_title()) );

    if( is_singular('post') ){
        $h1 = (get_field('h1'))?get_field('h1'):get_the_title();

        foreach(get_the_category() as $item){
            if($item->term_id==5 || $item->term_id==7 || $item->term_id==4 || $item->term_id==6)
                $title = $h1;
        }

    }elseif(get_post_type()=='tours'&&$tmp_title==$tmp_title2){
        $_min_price = (get_field('p_shkolniki_sale'))?get_field('p_shkolniki_sale'):get_field('p_shkolniki');
        $h1 = (get_field('h1'))?get_field('h1'):get_the_title();
        $min_price = ($_min_price)?' от '.$_min_price.' руб., ':' ';
        $title = $h1.$min_price.'расписание, билеты';
    }
    $scool = false;
    $cur_terms = get_the_terms(get_the_ID(), 'excursion');
    if( is_array( $cur_terms ) ){
        if(is_single()) {
            foreach ($cur_terms as $cur_term) {
                if ($cur_term->term_id == 92)
                    $scool = true;
            }
        }
    }
    if($scool){
        $title = get_the_title();
        if($_tmp = get_field('from_price'))
            $title .= ' от '.$_tmp.' руб';
    }

    return $title;
}
add_filter( 'wpseo_title', 'changeSeoTitle' );

function changeSeoDesc( $metadesc ) {
    if( is_singular('post') ){
        $h1 = (get_field('h1'))?get_field('h1'):get_the_title();

        foreach(get_the_category() as $item){
            if($item->term_id==5 || $item->term_id==7 || $item->term_id==4 || $item->term_id==6)
                $metadesc = $h1.' - интересные места Санкт-Петербурга';
        }

    } elseif(get_post_type()=='tours'&&!$metadesc){
        $h1 = (get_field('h1'))?get_field('h1'):get_the_title();
        $scool = false;
        $cur_terms = get_the_terms(get_the_ID(), 'excursion');
        if( is_array( $cur_terms ) ){
            foreach( $cur_terms as $cur_term ){
                if($cur_term->term_id == 92)
                    $scool = true;
            }
        }

        if($scool){
            $metadesc = get_the_title().'. ';
            if($_tmp = get_field('duration'))
                $metadesc .= 'Длительность экскурсии '.$_tmp.'. ';
            if($_tmp = get_field('periodicity'))
                $metadesc .= $_tmp.'. ';
            $metadesc .= 'Насыщенная программа для школьников';
        }else{
            $metadesc = $h1.'. Скидки до 50% при покупке на сайте. Цены. Расписание';
        }
    }
    return $metadesc;
}
$custom_yoast_canonical = '';
add_filter( 'wpseo_metadesc', 'changeSeoDesc' );

// Удалить каноническую ссылку - SEO by Yoast
function at_remove_dup_canonical_link($link) {
    global $custom_yoast_canonical;
    if($link)
        $custom_yoast_canonical = $link;

    return false;
}
add_filter( 'wpseo_canonical', 'at_remove_dup_canonical_link',10, 1 );

/*** Функция вывода rel="canonical" ***/
/***
 ***/
function mayak_wp_canonical(){
    global $custom_yoast_canonical;

    if ( !is_singular()||$custom_yoast_canonical) {
        return;
    }

    global $wp_the_query;
    if ( !$id = $wp_the_query->get_queried_object_id() )
        return;
    $link = get_permalink( $id );

    if ( $page = get_query_var('cpage') )
        $link = get_comments_pagenum_link( $page );
    //echo "<link rel='canonical' href='$link' />\n";
}
remove_action('wp_head', 'rel_canonical');

function mayak_canonical(){
    global $custom_yoast_canonical;
    if($_SERVER['REQUEST_URI']=='/kronshtadt')
        echo "".'<link rel="canonical" href="https://parus-peterburg.ru/kronshtadt" />'."\n";
    elseif ($custom_yoast_canonical)
        echo "".'<link rel="canonical" href="'.$custom_yoast_canonical.'" />'."\n";
    elseif (is_home() ) {
        $mayak_chief_link = get_option('home');
        $mayak_home_link = mayak_link_paged($mayak_chief_link);
        echo "".'<link rel="canonical" href="'.$mayak_home_link.'" />'."\n";
    } else if (is_category()) {
        $mayak_cat_link = get_category_link(get_query_var('cat'));
        $mayak_category_link = mayak_link_paged($mayak_cat_link);
        echo "".'<link rel="canonical" href="'.$mayak_category_link.'" />'."\n";
    } else if (function_exists('is_tag') && is_tag()){
        $tag = get_term_by('slug',get_query_var('tag'),'post_tag');
        if (!empty($tag->term_id)) {
            $tag_link = get_tag_link($tag->term_id);
        }
        $mayak_tag_link = mayak_link_paged($tag_link);
        $mayak_tag_link = trailingslashit($mayak_tag_link);
        echo "".'<link rel="canonical" href="'.$mayak_tag_link.'" />'."\n";
    } else if (is_author()){
        global $cache_userdata;
        $userid = get_query_var('author');
        $mayak_auth_link = get_author_posts_url ( 'ID' );
        $mayak_author_link = mayak_link_paged($mayak_auth_link);
        echo "".'<link rel="canonical" href="'.$mayak_author_link.'" />'."\n";
    } else if (is_date()){
        if (get_query_var('m')) {
            $m = preg_replace('/[^0-9]/', '', get_query_var('m'));
            switch (strlen($m)) {
                case 0:
                    $mayak_date_link = get_year_link($m);
                    $mayak_date_link = mayak_link_paged( $mayak_date_link );
                    break;
                case 1:
                    $mayak_date_link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
                    $mayak_date_link = mayak_link_paged( $mayak_date_link );
                    break;
                case 2:
                    $mayak_date_link = get_day_link( substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
                    $mayak_date_link = mayak_link_paged( $mayak_date_link );
                    break;
                default:
                    $mayak_date_link = '';
            }
        }
        if (is_day()) {
            $mayak_date_link = get_day_link(get_query_var('year'),  get_query_var('monthnum'), get_query_var('day'));
            $mayak_date_link = mayak_link_paged($mayak_date_link);
        } else if (is_month()) {
            $mayak_date_link = get_month_link(get_query_var('year'), get_query_var('monthnum'));
            $mayak_date_link = mayak_link_paged($mayak_date_link);
        } else if (is_year()) {
            $mayak_date_link = get_year_link(get_query_var('year'));
            $mayak_date_link = mayak_link_paged($mayak_date_link);
        }
        echo "".'<link rel="canonical" href="'.$mayak_date_link.'" />'."\n";

    }
}
add_action('wp_head', 'mayak_wp_canonical',3);

function mayak_link_paged($link) {
    $mayak_page = get_query_var('paged');
    $mayak_check = function_exists('user_trailingslashit');
    if ($mayak_page && $mayak_page > 1) {
        $link = trailingslashit($link) ."page/". "$mayak_page";
        if ($mayak_check) {
            $link = user_trailingslashit($link, 'paged');
        } else {
            $link .= '/';
        }
    }
    return $link;
}
add_action('wp_head', 'mayak_canonical');

add_shortcode( 'gates', 'gates' );
function gates( $atts ){
    /*
    $id = get_the_ID();
    if (get_the_terms( get_the_ID(), 'excursion' )){
        foreach(get_the_terms( get_the_ID(), 'excursion' ) as $item){
            if($item->term_id=='41'){
                $term = 'en';
                $priceMain = 'on request';
            }
        }
    }

    $gates = get_field('gates',$id);
    if($gates){

        $html = ($term=='en')?'<h3 class="gates-title">Route</h3>':'<h3 class="gates-title">Маршрут</h3>';
        $html .= '<div class="gates">';
        $i=0;
        foreach($gates as $item){
            $i++;
            $html .= '<span class="gate gate-'.$i.'">'.$item['gate'];
                $html .= '<span class="gate-circle"></span>';
                if ($i==1){
                    $html .= '<div class="gate-arrow"></div>';
                    $html .= '<div class="gate-arc"></div>';
                }
            $html .= '</span>';
        }
        $html .= '</div>';
        return $html;
    } else {
        return '';
    }
    */
}
/**
 * Redirect page
 */

// if ( $_SERVER['REQUEST_URI'] == '/%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B3%D0%BE%D1%84-%D1%84%D0%BE%D0%BD%D1%82%D0%B0%D0%BD%D1%8B' ) {
//     wp_redirect( '/tours/петергоф-2020-трассовая-экскурсиянижни/', 301 );
//     exit;
// }

if ( $_SERVER['REQUEST_URI'] == '/avtorskaya-ekskursiya-parkovoe-ojerele' ) {
    wp_redirect( '/tours/парковое-ожерелье-парки-и-дворцовые/', 301 );
    exit;
}
if ( $_SERVER['REQUEST_URI'] == '/%D0%BD%D0%BE%D1%87%D0%BD%D0%BE%D0%B9-%D0%BF%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3' ) {
    wp_redirect( '/excursiya-po-nochnomu-peterburgu', 301 );
    exit;
}
if ( $_SERVER['REQUEST_URI'] == '/%D0%BE%D0%B1%D0%B7%D0%BE%D1%80%D0%BD%D0%B0%D1%8F-2' ) {
    wp_redirect( '/obzornaya-excursia-po-gorodu-s-posescheniem-petropavlovskoy-kreposti', 301 );
    exit;
}
if ( $_SERVER['REQUEST_URI'] == '/%D0%BF%D0%B5%D1%82%D0%B5%D1%80%D0%B3%D0%BE%D1%84' ) {
    wp_redirect( '/exkursiya-v-petergof-s-posescheniem-bolshogo-dvorca-fontanov', 301 );
    exit;
}




/*** Конец функции вывода rel="canonical" ***/

if ($_SERVER['REQUEST_URI']=='/page/4/' || $_SERVER['REQUEST_URI']=='/tours/') {
    status_header( 404 );
    nocache_headers();
    include( get_query_template( '404' ) );
    die();
}
if($_SERVER['REQUEST_URI'] == '/valaam' || $_SERVER['REQUEST_URI'] == '/oranienbaum/'){
    status_header( 404 );
    nocache_headers();
    include( get_query_template( '404' ) );
    die();
}
/*
add_action('init', function(){
	$all_posts = get_posts( array(
		'numberposts' => -1,
		'post_type' => 'tours',
		'suppress_filters' => true,
		'post_status' => 'any',
		'tax_query' => array(                                  // элемент (термин) таксономии 
			array(
				'taxonomy' => 'excursion',         // таксономия 
				'field' => 'slug',
				'terms'    => 'grup-ekskursii' // термин 
			)
		),
	) );
	foreach($all_posts as $item){
		update_post_meta( $item->ID, 'sort', 9999 );
	}
});*/

function remove_post_slug( $post_link, $post, $leavename ) {

    if ( 'tours' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

//    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'remove_post_slug', 10, 3 );


function parse_request_trick( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'tours', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'parse_request_trick' );

function correctTime($time){
    if (stripos($time,'h')>-1) return $time;
	if (stripos($time,'мин')>-1) return $time;
    if (stripos($time,'час')===false&&stripos($time,'-')===false){
        if (stripos($time,':')>-1){
            $arr_time = explode(':',$time);
            if ($arr_time[1]=='30')
                $time = $arr_time[0]+0.5;
            else
                $time = $arr_time[0];
        }
        if ($time == 1.5)
            $time = $time.' часа';
        else
            $time = $time.' '.getNumEnding($time, array('час', 'часа', 'часов'));
    }
    return $time;
}

function getNumEnding($number, $endingArray) {
    $number = (int)$number;
    $number = $number % 100;
    if ($number>=11 && $number<=19) {
        $ending=$endingArray[2];
    }
    else {
        $i = $number % 10;
        switch ($i)
        {
            case (1): $ending = $endingArray[0]; break;
            case (2):
            case (3):
            case (4): $ending = $endingArray[1]; break;
            default: $ending=$endingArray[2];
        }
    }
    return $ending;
}

function custom_redirect_pagination_page() {
    if(is_paged() && !is_category() && !is_home()) {
        wp_redirect(get_permalink(), 301);
    }
}

function custom_redirect_pagination() {
    if(is_home() && is_paged()) {
        wp_redirect(home_url(), 301);
    }
}

add_action('template_redirect', 'custom_redirect_pagination');
add_action('template_redirect', 'custom_redirect_pagination_page');


//Вывод массива рейтингов экскурсий [excursion] => rating
function get_rating_excursion () {

    $arr = [];

    $args = array(
        'posts_per_page' => '999',
        'post_type' => 'reviews'
    );
    $query = new WP_Query( $args );

    while ( $query->have_posts() ) {
        $query->the_post();


        if (get_field('excursion') &&  get_field('rating')) {
            $excurs_arr = explode(',', get_field('excursion'));
            foreach ($excurs_arr as  $value) {
                $arr[$value][] = get_field('rating');
            }
        }

    }
    wp_reset_postdata();

    foreach ($arr as $key => $value) {
        if (!empty($key)) {
            $slice = array_slice($value, 0, 3);
            $arr[$key] = array_sum($slice) / sizeof($slice);
        } else {
            unset($arr[$key]);
        }
    }

    return $arr;
}

// ОБработка изображений
function RemapFilesArray($name, $type, $tmp_name, $error, $size) {
    return array(
        'name' => $name,
        'type' => $type,
        'tmp_name' => $tmp_name,
        'error' => $error,
        'size' => $size,
    );
}
function my_update_attachment($f,$pid,$t='',$c='') {
    wp_update_attachment_metadata( $pid, $f );
    if( !empty( $f['name'] )) { //New upload
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        $override['test_form'] = false;
        $file = wp_handle_upload( $f, $override );

        if ( isset( $file['error'] )) {
            return new WP_Error( 'upload_error', $file['error'] );
        }

        $file_type = wp_check_filetype($f['name'], array(
            'jpg|jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'png' => 'image/png',
        ));
        if ($file_type['type']) {
            $name_parts = pathinfo( $file['file'] );
            $name = $f['name'];
            $type = $file['type'];
            $title = $t ? $t : $name;
            $content = $c;

            $attachment = array(
                'post_title' => $title,
                'post_type' => 'attachment',
                'post_content' => $content,
                'post_parent' => $pid,
                'post_mime_type' => $type,
                'guid' => $file['url'],
            );


            foreach( get_intermediate_image_sizes() as $s ) {
                $sizes[$s] = array( 'width' => '', 'height' => '', 'crop' => true );
                $sizes[$s]['width'] = get_option( "{$s}_size_w" ); // For default sizes set in options
                $sizes[$s]['height'] = get_option( "{$s}_size_h" ); // For default sizes set in options
                $sizes[$s]['crop'] = get_option( "{$s}_crop" ); // For default sizes set in options
            }

            $sizes = apply_filters( 'intermediate_image_sizes_advanced', $sizes );

            foreach( $sizes as $size => $size_data ) {
                $resized = image_make_intermediate_size( $file['file'], $size_data['width'], $size_data['height'], $size_data['crop'] );
                if ( $resized )
                    $metadata['sizes'][$size] = $resized;
            }

            $attach_id = wp_insert_attachment( $attachment, $file['file'] /*, $pid - for post_thumbnails*/);

            if ( !is_wp_error( $attach_id )) {
                $attach_meta = wp_generate_attachment_metadata( $attach_id, $file['file'] );
                wp_update_attachment_metadata( $attach_id, $attach_meta );
            }

            return array(
                'pid' =>$pid,
                'url' =>$file['url'],
                'file'=>$file,
                'attach_id'=>$attach_id
            );
        }
    }
}




// add_filter('request', 'rudr_change_term_request', 1, 1 );

// function rudr_change_term_request($query){

//   $tax_name = 'excursion'; // specify you taxonomy name here, it can be also 'category' or 'post_tag'

//   // Request for child terms differs, we should make an additional check
//   if( $query['attachment'] ) :
//     $include_children = true;
//   $name = $query['attachment'];
//   else:
//     $include_children = false;
//   $name = $query['name'];
//   endif;


//   $term = get_term_by('slug', $name, $tax_name); // get the current term to make sure it exists

//   if (isset($name) && $term && !is_wp_error($term)): // check it here

//   if( $include_children ) {
//     unset($query['attachment']);
//     $parent = $term->parent;
//     while( $parent ) {
//       $parent_term = get_term( $parent, $tax_name);
//       $name = $parent_term->slug . '/' . $name;
//       $parent = $parent_term->parent;
//     }
//   } else {
//     unset($query['name']);
//   }

//   switch( $tax_name ):
//   case 'category':{
//         $query['category_name'] = $name; // for categories
//         break;
//       }
//       case 'post_tag':{
//         $query['tag'] = $name; // for post tags
//         break;
//       }
//       default:{
//         $query[$tax_name] = $name; // for another taxonomies
//         break;
//       }
//       endswitch;

//       endif;

//       return $query;
//     }

//     add_filter( 'term_link', 'rudr_term_permalink', 10, 3 );

//     function rudr_term_permalink( $url, $term, $taxonomy ){

//   $taxonomy_name = 'excursion'; // your taxonomy name here
//   $taxonomy_slug = 'excursion'; // the taxonomy slug can be different with the taxonomy name (like 'post_tag' and 'tag' )

//   // exit the function if taxonomy slug is not in URL
//   if ( strpos($url, $taxonomy_slug) === FALSE || $taxonomy != $taxonomy_name ) return $url;

//   $url = str_replace('/' . $taxonomy_slug, '', $url);

//   return $url;
// }


/**********Шорткоды*********/

add_shortcode( 'banner_obzornyye', 'banner_obzornyye_func' );
function banner_obzornyye_func($atts){
ob_start();
    $atts = shortcode_atts(array(
    'id' => '',
    'img' => '/wp-content/uploads/2024/02/banner-block-img.jpg',
    'size' => '',
    'name' => '',
    'slogan' => '',
    ), $atts);
    $terms_items = $atts['id'];
    $items = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'suppress_filters' => true,
        'meta_query' => array(
            'product_rank' => array(
                'key' => 'sort',
                'type' => 'NUMERIC'
            ),
        ),
        'orderby' => 'product_rank',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'excursion',
                'field' => 'id',
                'terms'    => $terms_items,
            )
        ),
    ) );
    $items_times = [];
    $items_prices = [];
    foreach ($items as $item) {
        //time
        $t = get_field('duration', $item->ID) ;
        $time = preg_replace("/[^,.0-9]/", ' ' , $t); // "/[^,.0-9]/" получим только цифры, точки и запятые
        $time = explode(" ", $time);
        if($time[0]) {
            $items_times[] = (float)str_replace(',', '.', $time[0]);
        }
        if($time[1]) {
            $items_times[] = (float)str_replace(',', '.', $time[1]);
        }

        //price
        if (get_field('p_doshkolniki_sale', $item->ID)) {
            $m=(int)get_field('p_doshkolniki_sale', $item->ID);
        } elseif ( get_field('p_doshkolniki', $item->ID) ) {
            $m=(int)get_field('p_doshkolniki', $item->ID);
        } elseif (get_field('p_shkolniki_sale', $item->ID)){
            $m=(int)get_field('p_shkolniki_sale', $item->ID);
        }  else {
            $m=(int)get_field('p_shkolniki', $item->ID);
        }
        if ($m<1) continue;
        $items_prices[] = (int) $m;
    }
    if ($items_prices && count($items_prices)>1) {
        $min_price = min($items_prices);
    }

    $items_time_min = ($items_times && count($items_times)>1) ? min($items_times) : 0;
    $items_time_max = ($items_times && count($items_times)>1) ? max($items_times) : 0;
    if ($items_time_max == 1.5){
        $items_time_max = $items_time_max.'&nbsp;часа';
    } else {
        $items_time_max = $items_time_max.'&nbsp;'.getNumEnding($items_time_max, array('час', 'часа', 'часов'));
    }
    if($items_time_max == $items_time_min) { //если одинакрвые часы
        $times = $items_time_max;
    } else {
        $times = $items_time_min . ' до ' . $items_time_max;
    }

    $current_term = get_term( $atts['id'],'excursion');
    $title = $current_term->name;
    if($atts['name']){
        $title = $atts['name'];
    }
    $slogan = $atts['slogan'];
    $id_int = (int)$atts['id'];
    //$link = get_term_link($id_int);
    $link = 'asdfghjk';
    ?>



<div class="banner-block<?php if($atts['size']){echo' banner-block--'.$atts['size'];}?>">
    <img src="<?php echo get_webp($atts['img'], true, 630); ?>?2" class="banner-block__img" alt="Обзорные экскурсии">
    <div class="banner-block__time">
        <i class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.3041 17C14.1067 17 18 13.1944 18 8.5C18 3.80558 14.1067 0 9.3041 0C4.5015 0 0.608227 3.80558 0.608227 8.5C0.608227 10.5534 1.35819 12.4881 2.67467 14.0016H0.668914C0.299483 14.0016 1.1134e-08 14.2944 0 14.6555C-1.11359e-08 15.0166 0.299483 15.3093 0.668913 15.3093H4.45286C4.82229 15.3093 5.12177 15.0166 5.12177 14.6555V10.9567C5.12177 10.5956 4.82229 10.3029 4.45286 10.3029C4.08343 10.3029 3.78395 10.5956 3.78395 10.9567V13.2562C2.61413 11.9609 1.94605 10.2842 1.94605 8.5C1.94605 4.5278 5.24037 1.30769 9.3041 1.30769C13.3678 1.30769 16.6622 4.5278 16.6622 8.5C16.6622 12.4722 13.3678 15.6923 9.3041 15.6923C8.93467 15.6923 8.63519 15.985 8.63519 16.3462C8.63519 16.7073 8.93467 17 9.3041 17ZM9.30415 4.18521C9.67358 4.18521 9.97306 4.47794 9.97306 4.83905V9.10093L12.1455 11.2244C12.4067 11.4797 12.4067 11.8937 12.1455 12.1491C11.8842 12.4044 11.4607 12.4044 11.1995 12.1491L8.83115 9.8341C8.70571 9.71148 8.63523 9.54517 8.63523 9.37176V4.83905C8.63523 4.47794 8.93472 4.18521 9.30415 4.18521Z" fill="#2C84D1"/>
            </svg>
        </i>
        <span>
            от <?php echo $times;?>
        </span>
    </div>
    <div class="banner-block__text">
        <div class="name"><?php echo $title;?></div>
        <?php if($slogan){?>
        <div class="text text-default"><?php echo $slogan;?></div>
        <?php } ?>
        <div class="text text-price">от <?php echo $min_price;?> ₽/чел</div>
    </div>
    <?php if(!$atts['size']){echo'<div class="width-100"></div>';}?>
    <a href="<?php echo $link;?>" class="banner-block__btn">Посмотреть экскурсии</a>
    <?php if($slogan && $atts['size'] !== 'small' && $atts['size'] !== 'col-3'){?>
        <div class="text text-desktop"><?php echo $slogan;?></div>
    <?php } ?>
</div>

<?php
$result = ob_get_clean();
return $result;
}



add_shortcode( 'min_price', 'parus_pp_min_price' );
function parus_pp_min_price($atts) {
    ob_start();

    $atts = shortcode_atts(array(
        'min' => '',
    ), $atts);

    if (is_front_page()) {
        $terms_items = 'grup-ekskursii';
    } else {
        $terms_items = get_queried_object()->slug;
    }
    $items = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'suppress_filters' => true,
        'meta_query' => array(
            'product_rank' => array(
                'key' => 'sort',
                'type' => 'NUMERIC'
            ),
        ),
        'orderby' => 'product_rank',
        'order' => 'ASC',
        'tax_query' => array(                                  // элемент (термин) таксономии
            array(
                'taxonomy' => 'excursion',         // таксономия
                'field' => 'slug',
                'terms'    => $terms_items // термин
            )
        ),
    ) );

    wp_reset_postdata(); // сброс


    $items_prices = [];
    foreach ($items as $item) {


        if (get_field('p_doshkolniki_sale', $item->ID)) {
            $m=(int)get_field('p_doshkolniki_sale', $item->ID);
        } elseif ( get_field('p_doshkolniki', $item->ID) ) {
            $m=(int)get_field('p_doshkolniki', $item->ID);
        } elseif (get_field('p_shkolniki_sale', $item->ID)){
            $m=(int)get_field('p_shkolniki_sale', $item->ID);
        }  else {
            $m=(int)get_field('p_shkolniki', $item->ID);
        }
        if ($m<1) continue;
        $items_prices[] = (int) $m;
    }

    if (count($items_prices)>1)
        $min_price = min($items_prices);
    else
        $min_price = 850;

    $min_price = $atts['min'] ? $atts['min'] : $min_price;

    echo $min_price;
    $result = ob_get_clean();
    return $result;
}

add_shortcode( 'min_price_exc', 'parus_pp_min_price_exc' );
function parus_pp_min_price_exc($atts)
{
    ob_start();

    if(get_field('from_price', $post->ID)){
        $price = get_field('from_price', $post->ID);
    } elseif($price = get_field('p_shkolniki_sale', $post->ID)){
        $price = get_field('p_shkolniki_sale', $post->ID);
    } elseif(get_field('p_shkolniki', $post->ID)){
        $price = get_field('p_shkolniki', $post->ID);
    } elseif(get_field('turi_price', $post->ID)){
        $price = get_field('turi_price', $post->ID);
    } elseif(get_field('price', $post->ID)){
        $price = get_field('price', $post->ID);
    }
    echo $price;

    $result = ob_get_clean();
    return $result;
}
add_shortcode( 'duration_exc', 'duration_exc' );
function duration_exc($atts) {
    ob_start();
    echo the_field('duration', get_the_ID());
    $result = ob_get_clean();
    return $result;
}

add_shortcode( 'transport', 'get_transport' );
function get_transport( $atts ){
    ob_start();?>
    <style>
        .content p.for-mobile {
            display: none;
        }
        .content--bus .content__tours, .content--group-tour-page .content__tours {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin: 0 -5px;
        }
        .tour {
            margin: 5px;
        }
        .tour img{
            object-fit: cover;
            width: 100%;
            height: 100%;
            min-height: 268px;
        }
        .options__tabs {
            display: flex;
            flex-wrap: wrap;
            margin: 5px 0 15px;
            justify-content: space-between;
        }
        .options__tab {
            margin: 8px 0;
            padding: 15px 10px;
            border-radius: 5px;
            background-color: #e2f2f8;
            color: #000;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
            width: 24%;
            text-align: center;
            cursor: pointer;
        }
        .options__tab.active {
            background-color: #2c84d1;
            color: #fff;
        }
        @media screen and (max-width: 540px) {
            .options__tab {
                width: 48%;
            }
            .content p.for-mobile {
                display: block;
            }
            .content p.for-pc {
                display: none;
            }
        }
    </style>
    <div class="content--bus">
        <div class="tabs options__tabs">
            <span class="options__tab active" data-filter="all">Весь транспорт</span>
            <span class="options__tab" data-filter=".autobbus">Автобусы</span>
            <span class="options__tab" data-filter=".microbus">Микроавтобусы</span>
            <span class="options__tab" data-filter=".teplohod">Теплоходы</span>
        </div>
        <div class="items-content content__tours">
            <?php
            global $post;
            $id = 4025;
            // Check rows exists.
            if( have_rows('transprt_items',$id) ):

                // Loop through rows.
                while( have_rows('transprt_items',$id) ) : the_row();

                    // Load sub field value.
                    $photo = get_sub_field('фото');
                    $cat = get_sub_field('категория'); ?>

                    <div class="tour mix <?php echo $cat ?>">
                        <a class="review_slider--img_href" data-fancybox="<?php echo $cat ?>" href="<?php echo $photo; ?>">
                            <img class="lazy" src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" data-src="<?php echo $photo; ?>" alt="img" />
                        </a>
                    </div>
                <?php
                    // Do something...

                    // End loop.
                endwhile;
                // Do something...
            endif; ?>
        </div>
    </div>
    <?php

    $result = ob_get_clean();
    return $result;
}

add_shortcode( 'max_price', 'parus_pp_max_price' );
function parus_pp_max_price() {
    ob_start();


    if (is_front_page()) {
        $terms_items = 'grup-ekskursii';
    } else {
        $terms_items = get_queried_object()->slug;
    }
    $items = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'suppress_filters' => true,
        'meta_query' => array(
            'product_rank' => array(
                'key' => 'sort',
                'type' => 'NUMERIC'
            ),
        ),
        'orderby' => 'product_rank',
        'order' => 'ASC',
        'tax_query' => array(                                  // элемент (термин) таксономии
            array(
                'taxonomy' => 'excursion',         // таксономия
                'field' => 'slug',
                'terms'    => $terms_items // термин
            )
        ),
    ) );

    wp_reset_postdata(); // сброс



    $items_prices = [];
    foreach ($items as $item) {


        if (get_field('p_doshkolniki_sale', $item->ID)) {
            $m=(int)get_field('p_doshkolniki_sale', $item->ID);
        } elseif ( get_field('p_doshkolniki', $item->ID) ) {
            $m=(int)get_field('p_doshkolniki', $item->ID);
        } elseif (get_field('p_shkolniki_sale', $item->ID)){
            $m=(int)get_field('p_shkolniki_sale', $item->ID);
        }  else {
            $m=(int)get_field('p_shkolniki', $item->ID);
        }
        if ($m<1) continue;
        $items_prices[] = (int) $m;
    }

    if (count($items_prices)>1)
        $max_price = max($items_prices);
    else
        $max_price = 850;
    echo $max_price;
    $result = ob_get_clean();
    return $result;
}


add_shortcode( 'times', 'parus_pp_times' );
function parus_pp_times() {
    ob_start();

    if (is_front_page()) {
        $terms_items = 'grup-ekskursii';
    } else {
        $terms_items = get_queried_object()->slug;
    }
    $items = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'suppress_filters' => true,
        'meta_query' => array(
            'product_rank' => array(
                'key' => 'sort',
                'type' => 'NUMERIC'
            ),
        ),
        'orderby' => 'product_rank',
        'order' => 'ASC',
        'tax_query' => array(                                  // элемент (термин) таксономии
            array(
                'taxonomy' => 'excursion',         // таксономия
                'field' => 'slug',
                'terms'    => $terms_items // термин
            )
        ),
    ) );

    wp_reset_postdata(); // сброс

        $items_prices = [];
        foreach ($items as $key => $item) {
            $m = get_field('duration', $item->ID) ;

            $items_price = preg_replace("/[^,.0-9]/", ' ' , $m); // "/[^,.0-9]/" получим только цифры, точки и запятые

            $items_price = explode(" ", $items_price);
            if($items_price[0]) {
                $items_prices[] = (float)str_replace(',', '.', $items_price[0]);
            }
            if($items_price[1]) {
                $items_prices[] = (float)str_replace(',', '.', $items_price[1]);
            }
        }

        $items_prices_min = min($items_prices);
        $items_prices_max = max($items_prices);

        if ($items_prices_max == 1.5){
            $items_prices_max = $items_prices_max.'&nbsp;часа';
        } else{
            $items_prices_max = $items_prices_max.'&nbsp;'.getNumEnding($items_prices_max, array('час', 'часа', 'часов'));
        }

    echo $items_prices_min . '&nbsp;-&nbsp;' . $items_prices_max;

    $result = ob_get_clean();
    return $result;
}

add_shortcode( 'social_icons', 'parus_pp_social_icons' );
function parus_pp_social_icons() {
    ob_start();?>
    <div class="mm-item">
        <a target="_blank" rel="nofollow" href="https://vk.com/parus_peterburg" class="vk icon"></a>
        <a target="_blank" rel="nofollow" href="https://www.instagram.com/peterburgparus/" class="instagram icon"></a>
        <a target="_blank" rel="nofollow" href="#" class="facebook icon"></a>
    </div>
    <?php
    $result = ob_get_clean();
    return $result;
}
add_shortcode( 'timesmin', 'parus_pp_timesmin' );
function parus_pp_timesmin() {
    ob_start();
    if (is_front_page()) {
        $terms_items = 'grup-ekskursii';
    } else {
        $terms_items = get_queried_object()->slug;
    }
    $items = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'suppress_filters' => true,
        'meta_query' => array(
            'product_rank' => array(
                'key' => 'sort',
                'type' => 'NUMERIC'
            ),
        ),
        'orderby' => 'product_rank',
        'order' => 'ASC',
        'tax_query' => array(                                  // элемент (термин) таксономии
            array(
                'taxonomy' => 'excursion',         // таксономия
                'field' => 'slug',
                'terms'    => $terms_items // термин
            )
        ),
    ) );

    wp_reset_postdata(); // сброс



    $items_prices = [];
    foreach ($items as $item) {
        //$m = floatval(str_replace(',', '.', get_field('duration', $item->ID)) );
        $m = get_field('duration', $item->ID) ;
        if (stripos($m,':')>-1){
            $m = floatval(str_replace(':', '.', $m) );
            $m = $m+0.5;
        } else {
            $m = floatval(str_replace(',', '.', $m) );
        }
        if ($m<1) continue;
        $items_prices[] = $m;
    }

    if (count($items_prices)>1) {
        $min_duration = min($items_prices);
    } else {
        $min_duration = 3;
    }




    if ($min_duration == 1){
        $min_duration = $min_duration.' часа';
    } else{
        $min_duration = $min_duration.' часов';
    }

    echo $min_duration ;
    $result = ob_get_clean();
    return $result;
}

function register_custom_extra_replacements() {
    wpseo_register_var_replacement( '%%min_price%%', 'parus_pp_min_price', 'advanced', 'Получает минимальую цену' );
    wpseo_register_var_replacement( '%%max_price%%', 'parus_pp_max_price', 'advanced', 'Получает минимальую цену' );
    wpseo_register_var_replacement( '%%times%%', 'parus_pp_times', 'advanced', 'Получает кол-во часов' );
    wpseo_register_var_replacement( '%%timesmin%%', 'parus_pp_timesmin', 'advanced', 'Получает кол-во часов' );
    wpseo_register_var_replacement( '%%min_price_exc%%', 'parus_pp_min_price_exc', 'advanced', 'Минимальная цена' );
    wpseo_register_var_replacement( '%%duration_exc%%', 'duration_exc', 'advanced', 'Продолжительность' );
}
add_action('wpseo_register_extra_replacements', 'register_custom_extra_replacements');

add_action( 'wp_ajax_get_ny', 'get_ny' );
add_action( 'wp_ajax_nopriv_get_ny', 'get_ny' );

function get_ny(){
    get_template_part('ny/ny');
    die();
}

add_action( 'wp_ajax_img_caption', 'img_caption' );
add_action( 'wp_ajax_nopriv_img_caption', 'img_caption' );
function img_caption(){
	$ids = explode(',', trim($_POST['ids'], ','));
	$return = [];
	
	foreach($ids as $item){
		$pure_id = str_replace('wp-image-', '', $item);
		$cap = wp_get_attachment_caption($pure_id);
		
		$return[$item] = $cap;
	}
	
	echo json_encode($return);

    die();
}

add_action('admin_head', 'moi_novii_style');
function moi_novii_style() {
    print '<style>
	/*Стили в админку*/
	body .edit-post-layout .interface-interface-skeleton__content{padding-bottom: 65px; background-color: #fff;}
	</style>';
}

function crop_str($string, $limit, $after = '') {
    if (strlen($string) > $limit) {
        $substring_limited = substr($string, 0, $limit); //режем строку от 0 до limit
        $return = substr($substring_limited, 0, strrpos($substring_limited, ' ')) . $after;
    } else {
        $return = $string;
    }

    return $return;
}

function wp_nav_menu_no_current_link( $atts, $item, $args, $depth ) {
    if ( $item->current ) $atts['href'] = '';
    return $atts;
}
add_action( 'nav_menu_link_attributes', 'wp_nav_menu_no_current_link', 10, 4 );

function png_to_jpg($file){
    $filePath = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads'.explode('uploads',$file)[1];
    if (file_exists($filePath."_converted.jpg")){
        return $file."_converted.jpg";
    } else {
        $image = imagecreatefrompng($filePath);
        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
        imagedestroy($image);
        $quality = 50; // 0 = worst / smaller file, 100 = better / bigger file
        imagejpeg($bg, $filePath . "_converted.jpg", $quality);
        imagedestroy($bg);
        return $file."_converted.jpg";
    }
}

function remove_redirect_guess_404_permalink( $redirect_url ) {
    if ( is_404() )
        return false;
    return $redirect_url;
}

add_filter( 'redirect_canonical', 'remove_redirect_guess_404_permalink' );

/*
function __search_by_title_only( $search, $wp_query ) {
 // $wp_query was a reference
    global $wpdb;
    if ( empty( $search ) ) {
        return $search;
    } // skip processing - no search term in query
    $q = $wp_query->query_vars;
    $n = ! empty( $q['exact'] ) ? '' : '%';
    $search =
    $searchand = '';
    foreach ( (array) $q['search_terms'] as $term ) {
        $term      = esc_sql( $wpdb->esc_like( $term ) );
      	$search    .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() ) {
            $search .= " AND ($wpdb->posts.post_password = '') ";
        }
    }
    return $search;
}
add_filter('posts_search', '__search_by_title_only', 500, 2);
*/


function wpse_disable_pagination( $query ) {
    if($query->is_search() ) {
        $query->set( 'nopaging' , true );
    }
}
add_action( 'pre_get_posts', 'wpse_disable_pagination' );


// `Disable Emojis` Plugin Version: 1.7.2
if( 'Отключаем Emojis в WordPress' ){

    /**
     * Disable the emoji's
     */
    function disable_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        //remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        //add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
        add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
    }
    add_action( 'init', 'disable_emojis' );

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param    array  $plugins
     * @return   array             Difference betwen the two arrays
     */
    function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        }

        return array();
    }

    /**
     * Remove emoji CDN hostname from DNS prefetching hints.
     *
     * @param  array  $urls          URLs to print for resource hints.
     * @param  string $relation_type The relation type the URLs are printed for.
     * @return array                 Difference betwen the two arrays.
     */
    function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {

        if ( 'dns-prefetch' == $relation_type ) {

            // Strip out any URLs referencing the WordPress.org emoji location
            $emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
            foreach ( $urls as $key => $url ) {
                if ( strpos( $url, $emoji_svg_url_bit ) !== false ) {
                    unset( $urls[$key] );
                }
            }

        }

        return $urls;
    }

}

add_filter( 'wp_mail_content_type', 'true_content_type' );

function true_content_type( $content_type ) {
    return 'text/html';
}

function save_func($ID, $post,$update) {
    $slug = 'reviews';

    // Проверяем тип записи, если не reviews то выходим.
    if ( $slug != $_POST['post_type'] ) {
        return;
    }


    // Если это ревизия, то не отправляем письмо
    if ( wp_is_post_revision( $post_id ) ){
        return;
    }

    // Если статус записи отличается от "Опубликовано", то не отправляем письмо
    /*if ( get_post($post_id)->post_status != 'publish' ){
        return;
    }*/

    if($update == false) {
        return;
    }



    $post_title = get_the_title( $post_id );
    $post_url = get_permalink( $post_id );
    $subject = 'Ответ на отзыв с сайта parus-peterburg.ru';
    $fields = get_fields($post_id);
    $printfields = print_r($fields, true);


    if ($fields['letter_sending'] == 1) {
        return;
    }

    if(isset($fields['review_answer'])&&$fields['review_answer']){
        $message = "Здравствуйте! Благодарим за обратную связь.<br>".PHP_EOL;
        $message .= "На ваш отзыв получен ответ:<br>".PHP_EOL;
        $message .= $fields['review_answer'];
    } else {
        $message = "Здравствуйте! Благодарим за обратную связь.<br>".PHP_EOL;
        $message .= "Ваш отзыв опубликован на нашем сайте https://parus-peterburg.ru/reviews";
        $subject = 'Ваш отзыв опубликован на сайте parus-peterburg.ru';
    }

    // Отправляем письмо.

    if (  $fields['email']  && wp_mail( $fields['email'], $subject, $message )) {
        update_field('letter_sending', 1, $post_id);
    }




}

add_action( 'save_post', 'save_func', 10, 3 );






function getYoutubeEmbedUrl($url) {
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

function getDzenSrc($url) {
	$pattern = '/(https.*)(")/U';
	preg_match($pattern, $url, $matches);
	 
	return (isset($matches[1])) ? $matches[1] : false;
}

if(strtok($_SERVER['REQUEST_URI'],'?')=='/feed/turbo/'){
    $str = '';
    $handle = fopen('/home/pp/web/parus-peterburg.ru/public_html/wp-content/themes/parus/pp.csv', 'r');
    while($row = fgetcsv($handle, 500, ',')){
        if($row[4]=='Url') continue;

        $str .= '<item turbo="false">
<link>'.$row[4].'</link>
</item>';
    }
    header('Content-Type: application/rss+xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>
<rss
    xmlns:yandex="http://news.yandex.ru"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:turbo="http://turbo.yandex.ru"
    version="2.0"><channel>
    <title>Теплоход-Ресторан</title>
    <link>https://teplohod-restoran.ru</link>
    <description>Аренда теплоходов в Санкт-Петербурге</description>
                                <language>ru</language>
								'.$str.'</channel>
</rss>'; die();
}


add_filter( 'render_block', 'wrap_my_image_block', 10, 2 );
function wrap_my_image_block( $block_content, $block ) {
    if ( 'core/image' !== $block['blockName'] ) {
        return $block_content;
    }
    $return .= $block_content;

    return $return;
}



//function send_tg_chat($chat_id="300193513", $bot_id="5309473099:AAEcvzdzq_tVs7LEK3Zebw5J9q7w9OEaAnU", $text ){
function send_tg_chat($chat_id="1731649696", $bot_id="5309473099:AAEcvzdzq_tVs7LEK3Zebw5J9q7w9OEaAnU", $text ){
    $disable_web_page_preview = null;
    $reply_to_message_id = null;
    $reply_markup = null;

    $data = array(
        'chat_id' => urlencode($chat_id),
        'text' => $text,
        'disable_web_page_preview' => urlencode($disable_web_page_preview),
        'reply_to_message_id' => urlencode($reply_to_message_id),
        'reply_markup' => urlencode($reply_markup)
    );

    $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage';

    //  open connection
    $ch = curl_init();
    //  set the url
    curl_setopt($ch, CURLOPT_URL, $url);
    //  number of POST vars
    curl_setopt($ch, CURLOPT_POST, count($data));
    //  POST data
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //  To display result of curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //  execute post
    $result = curl_exec($ch);
    //  close connection
    curl_close($ch);
}

// Adding additional fields to the settings in the admin panel START
add_action( 'customize_register', 'true_customizer_init' );

function true_customizer_init( $wp_customize ) {

    $wp_customize->add_section(
        'ultimate_member_auth', array(
            'title'         => 'Регистрация и авторизация',
            'description'   => 'Ссылки на страницы регистрации и авторизации в подвале сайта',
        )
    );

    $wp_customize->add_setting(
        'login_registr_show', array(
            'type'              => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'parus_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'login_registr_show', array(
            'label'             => 'Показать ссылки',
            'section'           => 'ultimate_member_auth',
            'type'              => 'checkbox'
        )
    );

    $wp_customize->add_panel('header_panel', array(
        'priority'    => 100,
        'title'       => 'Шапка сайта',
        'description' => 'Тут вы можете настроить шапку сайта.'
    ));

    $wp_customize->add_section('header_section', array(
        'title'       => 'Информационный блок',
        'priority'    => 1,
        'description' => 'Отобразится в верху шапки сайта (на главной)',
        'panel'       => 'header_panel'
    ));

    $wp_customize->add_setting('info_block', array(
        'type'    => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control('info_block',array(
        'section' => 'header_section',
        'label'   => 'Информационный блок',
        'type'    => 'textarea'
    ));

    $wp_customize->add_setting('info_block_on', array(
        'type'    => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control('info_block_on', array(
        'section' => 'header_section',
        'label'   => 'Включить информационный блок',
        'type'    => 'checkbox'
    ));

}// Adding additional fields to the settings in the admin panel END

function parus_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) );
}

add_action( 'admin_head', 'spbkater_orders' );
add_filter( 'cron_schedules', function ( $schedules ) {
    $schedules['my_daily'] = array(
        'interval' => 60*60*24,
        'display' => __( 'Сутки' )
    );
    return $schedules;
} );

function spbkater_orders() {
    if( ! wp_next_scheduled( 'my_daily' ) ) {
        wp_schedule_event( time(), 'my_daily', 'my_daily');
    }
}
add_action('my_daily', 'cleaning_pdf_folder');
function cleaning_pdf_folder(){
    $pdf_dir = wp_upload_dir()['basedir'].'/pdf';
    $files = scandir($pdf_dir);
    $one_week = 60*60*24*7;

    foreach($files as $item){

        if($item != '.' && $item != '..')
            if(filemtime($pdf_dir.'/'.$item)*1+$one_week < time())
                unlink($pdf_dir.'/'.$item);
    }
}

function contactspost($atts)
{
    $default = array(
        'address' => '',
        'tel' => '',
        'site' => '',
    );
    ob_start();
    $contacts = shortcode_atts($default, $atts);
    $pattern  = '/[^+0-9]/';
    $tel = preg_replace($pattern, '', $contacts['tel']);
    ?>
    <div class="container-contacts">
        <?php if($contacts['address']): ?>
            <div class="flex contact-item address"><img src="https://parus-peterburg.ru/wp-content/uploads/2022/08/Frame-2.png" alt="icon" /> <?php echo $contacts['address']; ?></div>
        <?php endif; ?>
        <?php if($contacts['tel']): ?>
            <div class="flex contact-item tel"> <img src="https://parus-peterburg.ru/wp-content/uploads/2022/08/Иконка.png" alt="icon" /><a href="tel:<?php echo $tel; ?>" ><?php echo $contacts['tel'] ?></a></div>
        <?php endif; ?>
        <?php if($contacts['site']): ?>
            <div class="flex contact-item email"><img src="https://parus-peterburg.ru/wp-content/uploads/2022/08/Frame-3.png" alt="icon" /><a target="_blank" href="<?php echo $contacts['site']; ?>" ><?php echo $contacts['site']; ?></a></div>
        <?php endif; ?>
    </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode('contactonpostpage', 'contactspost');

add_action( 'edit_post_tours', 'log_upd', 10, 2 );

/* disable rel */
function remove_canonical_pagination() {
    $paged = intval( get_query_var( 'paged' ) );

    if ($paged >= 2) {
        return false;
    }
}
add_action( 'wpseo_canonical', 'remove_canonical_pagination', 4);
remove_action('embed_head', 'rel_canonical');
add_filter('wpseo_canonical', 'return_false');
remove_action('wp_head', 'rel_canonical', 47);
/* disable rel */

function log_upd($post_ID, $post){
    $send_duration = $_REQUEST['acf']['field_5e98134e7f808'];
    $now_duration = get_field('duration',$post);
    $ip = $_SERVER['REMOTE_ADDR'];
    $logdir = TEMPLATEPATH.'/logs';

    if($send_duration && $send_duration != 'NULL'){
        $str = date('[H:i d.m.Y P]').' Duration from: '.$now_duration.' => to: '.$send_duration.' | '.$ip.PHP_EOL;
        file_put_contents($logdir. '/duration_'.date('m_Y').'.log', $str, FILE_APPEND);
    }

}

require get_template_directory() . '/shortcode-tours.php';

add_shortcode( 'recomend', 'recomend_func' );
function recomend_func( $atts ){
    $atts = shortcode_atts( array(
        'conteudo' => ''
    ), $atts );

    ob_start();



    ?>

    <div class="recomendation"> <?php echo $atts['conteudo']; ?></div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

function fineideas_body_class($classes) {

    global $wp_query;
    if ( is_single() ) {
        $wp_query->post = $wp_query->posts[0];
        setup_postdata($wp_query->post);

        $taxonomies = array_filter( get_post_taxonomies($wp_query->post->ID), "is_taxonomy_hierarchical" );
        foreach ( $taxonomies as $taxonomy ) {
            $tax_name = ( $taxonomy != 'category') ? $taxonomy . '-' : '';
            $terms = get_the_terms($wp_query->post->ID, $taxonomy);
            if ( $terms ) {
                foreach( $terms as $term ) {
                    if ( !empty($term->slug ) )
                        $classes[] = $single_term_prefix . $tax_name . sanitize_html_class($term->slug, $term->term_id);
                    while ( $term->parent ) {
                        $term = &get_term( (int) $term->parent, $taxonomy );
                        if ( !empty( $term->slug ) )
                            $classes[] = $single_parent_prefix . $tax_name . sanitize_html_class($term->slug, $term->term_id);
                    }
                }
            }
        }
    }

    return $classes;
}

add_filter('body_class', 'fineideas_body_class');


function subscriber_add_post(){
    $post_id = [14309, 14317];

    if(in_array(get_the_ID(), $post_id) && !is_user_logged_in()){
        wp_redirect('https://parus-peterburg.ru/login');
        exit;
    }
}
add_action('wp', 'subscriber_add_post');

function add_custom_capability_to_subscriber_role(){
    $role = get_role('subscriber');
    $role->add_cap('upload_files');
}
add_action('init', 'add_custom_capability_to_subscriber_role');

function get_webp($path, $url = true, $w = 0){
    $exist_webp = false;

    if($url){
        $sitename = get_site_url();
        $part_path = str_replace($sitename, '', $path);
        $true_path = ABSPATH. substr($part_path,1);
    }

    if(isset($true_path) && file_exists($true_path) && getExtension1($true_path)!='webp'){
        if(!file_exists($true_path.'.webp')){
            $info = getimagesize($true_path);
            if ($info['mime'] == 'image/jpeg')
                $img = imagecreatefromjpeg($true_path);
            elseif ($info['mime'] == 'image/gif') {
                $img = imagecreatefromgif($true_path);
            } elseif ($info['mime'] == 'image/png') {
                $img = imagecreatefrompng($true_path);
            }
			
			if($w && $w<$info[0]){
				$percent = ($w-$info[0])/$info[0]+1;
				$new_height = $info[1]*$percent;
				$thumb = imagecreatetruecolor($w, $new_height);
				imagecopyresized($thumb, $img, 0, 0, 0, 0, $w, $new_height, $info[0], $info[1]);
				
				imagepalettetotruecolor($thumb);
				imagealphablending($thumb, true);
				imagesavealpha($thumb, true);
				imagewebp($thumb, $true_path.'.webp', 100);
				imagedestroy($thumb);
				imagedestroy($img);
			} else {
				imagepalettetotruecolor($img);
				imagealphablending($img, true);
				imagesavealpha($img, true);
				imagewebp($img, $true_path.'.webp', 100);
				imagedestroy($img);
			}

           
        }
        $exist_webp = true;
    }
    return ($exist_webp)?$path.'.webp':$path;
}
function getExtension1($filename) {
    return end(explode(".", $filename));
}

function get_reviews(){
    if(isset($_POST['count']) && $_POST['count']){
        global $post;
        $count = 15;
        $myposts = get_posts([
            'numberposts' => $count,
            'post_type' => 'reviews',
            'offset' => $_POST['count']
        ]);
        if($count>count($myposts) || !count($myposts))
            $all = true;
        else
            $all = false;

        ob_start();
        foreach($myposts as $post){
            setup_postdata($post);
            get_template_part('template-parts/loop', 'reviews');
        }
        wp_reset_postdata();
        $content = ob_get_contents();
        ob_end_clean();

        echo json_encode([
            'status' => 'ok',
            'content' => $content,
            'all' => $all,
        ]);
    }
    die();
}
add_action('wp_ajax_get_reviews', 'get_reviews');
add_action('wp_ajax_nopriv_get_reviews', 'get_reviews');

function fix_cat_url(){
    $url = mb_strtolower(str_replace('/', '', $_SERVER['REQUEST_URI']));

    if(stripos($url, '%')!==false){
        $terms = get_terms([
            'taxonomy' => 'excursion'
        ]);
        foreach($terms as $item){
            if($item->slug==$url){
                $_SERVER['REQUEST_URI'] = mb_strtolower($_SERVER['REQUEST_URI']);
                /*wp_redirect(get_site_url().'', 301);
                exit;*/
            }
        }
    }
}
add_action('init', 'fix_cat_url');

function get_front_previews(){
    $offset = $_POST['offset'];
    $count_posts = $_POST['count']-1;
    $num = $offset;
    $i = -1;

    $all_posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'tax_query' => array(                                  // элемент (термин) таксономии
            array(
                'taxonomy' => 'excursion',         // таксономия
                'field' => 'slug',
                'terms'    => 'grup-ekskursii' // термин
            )
        ),
    ) );
    foreach($all_posts as $key => $item){
        $i++;
        if ($i<$offset || ($i>$offset+$count_posts && $_POST['count'] != -1)) continue;
        include('template-parts/loop-front-preview.php');
    }

    die();
}
add_action( 'wp_ajax_get_front_previews', 'get_front_previews');
add_action( 'wp_ajax_nopriv_get_front_previews', 'get_front_previews');

function clear_mem_cache(){
    $mc = memcache_connect('localhost', 11211);
    memcache_flush($mc);

}
if(strpos($_SERVER['REQUEST_URI'], 'purge_cache') !== false || strpos($_SERVER['REQUEST_URI'], 'flush_all') !== false){
    clear_mem_cache();
}

add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_script( 'a-name', get_stylesheet_directory_uri() .'/js/admin.js', array('jquery'), '1.0', true );
    wp_add_inline_script( 'a-name', 'const a = ' . wp_json_encode(['ajaxUrl'=>admin_url( 'admin-ajax.php' )]), 'before' );

    wp_enqueue_style( 'admin-stylemy', get_template_directory_uri().'/assets/css/admin.css',[],0.6074 );
}, 99 );

function get_term_tours(){
    $term = get_term($_POST['id'], 'excursion');
    $all_posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'tours',
        'tax_query' => array(                                  // элемент (термин) таксономии
            array(
                'taxonomy' => 'excursion',         // таксономия
                'field' => 'term_id',
                'terms'    => (int)$_POST['id'] // термин
            )
        ),
    ) );
    $field = get_field('excursion_sort', $term);
    $_all_posts = [];
	$_have_ids = [];

    if($field){
        
        foreach($all_posts as $item){
            $_all_posts[$item->ID] = $item;
			$_have_ids[] = $item->ID;
        }
        $all_posts = [];
		$ids = explode(',', $field);
		$ids = array_intersect($ids, $_have_ids);

        if(count($_all_posts)>count($ids)){
            foreach($_all_posts as $item){
                if(!in_array($item->ID, $ids)){
                    $ids[] = $item->ID;
                }
            }
        }

        foreach($ids as $item){
            $all_posts[] = $_all_posts[$item];
        }


    }

    ?>
    <div class="admin_tours">
        <?php if(count($all_posts)): ?>
            <?php foreach($all_posts as $k => $item): ?>
                <div class="admin_tours__item" data-id="<?=$item->ID?>">
                    <div class="admin_tours__title">
                        <div class="admin_tours__name"><?=$item->post_title?></div>
                        <a target="_blank" href="<?=get_permalink($item)?>" class="admin_tours__slug"><?=get_permalink($item)?></a>
                    </div>
                    <div class="admin_tours__input">
                        <input type="text" name="tour_sort[<?=$k?>]" value="<?=$k?>">
                        <div class="admin_tours__ud">
                            <button class="admin_tours__up" data-direction="up">
                                <i>
                                    <svg id="icon-arrow-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g data-name="Layer 2"><path d="M24,21a1,1,0,0,1-.71-.29L16,13.41l-7.29,7.3a1,1,0,1,1-1.42-1.42l8-8a1,1,0,0,1,1.42,0l8,8a1,1,0,0,1,0,1.42A1,1,0,0,1,24,21Z" fill="#fff "></path></g></svg>
                                </i>
                            </button>
                            <button class="admin_tours__down" data-direction="down">
                                <i>
                                    <svg id="icon-arrow-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g data-name="Layer 2"><path d="M24,21a1,1,0,0,1-.71-.29L16,13.41l-7.29,7.3a1,1,0,1,1-1.42-1.42l8-8a1,1,0,0,1,1.42,0l8,8a1,1,0,0,1,0,1.42A1,1,0,0,1,24,21Z" fill="#fff "></path></g></svg>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <p>В данной категории нет активных экскурсий</p>
        <?php endif ?>
    </div>
    <?php
    die();
}
add_action( 'wp_ajax_get_term_tours', 'get_term_tours');

function get_from_price($id){
	$old_price = $price = '';
	
	if($price = get_field('p_shkolniki_sale', $id)){
		$old_price = get_field('p_shkolniki', $id);
	} elseif(get_field('p_shkolniki', $id)){
		$price = get_field('p_shkolniki', $id);
	} elseif(get_field('turi_price', $id)){
		$price = get_field('turi_price', $id);
	} elseif(get_field('from_price', $id)){
		$price = get_field('from_price', $id);
	} elseif(get_field('price', $id)){
		$price = get_field('price', $id);
	} elseif(get_field('p_doshkolniki', $id)){
		$price = get_field('p_doshkolniki', $id);
	}
		
	if(stripos($price, 'руб/чел') !== false)
		$postfix = 'руб/чел';
	else
		$postfix = 'руб/чел';
	
	if($old_price){
		$old_price = number_format($old_price, 0, ',', ' ');
	}
	if($price){
		$price = number_format($price, 0, ',', ' ').' '.$postfix;
	} else {
		$price = 'по запросу';
	}
	
	return [
		'price' => $price,
		'old_price' => $old_price,
	];
}

add_action('wp_ajax_get_shedule_neva', 'get_shedule_neva');
add_action('wp_ajax_nopriv_get_shedule_neva', 'get_shedule_neva');
function get_shedule_neva(){
	global $wpdb;
	
	if($_POST['id'] && $_POST['date']){
		$from = strtotime($_POST['date']);
		$to = $from + 60*60*24-1;
		$shedule = $wpdb->get_results('SELECT DISTINCT neva_id,departure_time,program_id,ship_id,pier_id FROM wp_nevatickets WHERE program_id = \''.$_POST['id'].'\' AND departure_time>='.$from.' AND departure_time<='.$to.' ORDER BY departure_time ASC;');

		$piers = json_decode(get_field('piers_nevatravel', 'option'), true);
		$_piers = $resp = [];
		foreach($piers as $item){
			$_piers[$item['id']] = $item;
		}
		
		foreach($shedule as $k => $item){
			$shedule[$k]->pier_name = $_piers[$item->pier_id]['name'];
			$shedule[$k]->fix_time = date('H:i', $item->departure_time);
		}
		if(count($shedule))
		echo json_encode($shedule, JSON_UNESCAPED_UNICODE);
	}
	
	die();
}

add_action('template_redirect', 'tours_redir');
function tours_redir(){
	if(is_single() && get_post_type()=='tours'){
		$canon = wp_get_canonical_url(get_the_ID());
		$request_uri = explode('?', $_SERVER['REQUEST_URI']);
		$current_url = home_url($request_uri[0]);
		
		if($canon != $current_url){
			$params = (isset($request_uri[1]))?'?'.$request_uri[1]:'';
			$to_redirect = $canon.$params;

			wp_redirect($to_redirect, 301);
			exit;
		}
	}
}

add_action('template_redirect', 'meks_remove_wp_archives');
 
function meks_remove_wp_archives(){
	$o = get_queried_object();
  if($o->term_id == 120 || $o->term_id == 57) {
    global $wp_query;
    $wp_query->set_404();
  }
}

//Удалим пункты меню 'excursion', у которых нет записей
function filter_excursion_menu_items($items, $menu, $args) {
//    if ($menu->slug == 'top') {
        foreach ($items as $key => $item) {
            // Проверяем, является ли пункт меню рубрикой из таксономии 'excursion' (исключение id=76)
            if ($item->object == 'excursion' && $item->object_id != 76) {
                // Получаем посты, связанные с этой рубрикой
                $term_posts = get_posts(array(
                    'post_type' => 'tours',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'excursion',
                            'field'    => 'term_id',
                            'terms'    => $item->object_id,
                        ),
                    ),
                    'nopaging' => true, // Получаем все посты
                ));
                // Если постов нет, удаляем пункт меню
                if (empty($term_posts)) {
                    unset($items[$key]);
                }
            }
        }
//    }
    return $items;
}
add_filter('wp_get_nav_menu_items', 'filter_excursion_menu_items', 10, 3);


//Если термины 'excursion' без записей, тогда 404
add_action( 'template_redirect', 'check_excursion_terms_and_redirect' );
function check_excursion_terms_and_redirect() {
    if ( is_tax( 'excursion' ) ) {
        $term = get_queried_object();
        if ( $term instanceof WP_Term && $term->term_id != 76 ) { // Проверяем, что это не термин с ID 76
            $posts = get_posts( array(
                'post_type'      => 'any',
                'posts_per_page' => 1,
                'fields'         => 'ids',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'excursion',
                        'field'    => 'term_id',
                        'terms'    => $term->term_id,
                    ),
                ),
                'no_found_rows'  => true,
            ) );

            if ( empty( $posts ) ) {
                global $wp_query;
                $wp_query->set_404();
                status_header( 404 );
                nocache_headers();
                include( get_404_template() );
                exit;
            }
        }
    }
}

add_shortcode('attractions', 'attractions_func');
function attractions_func($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'id' => '',
        'images' => '',
        'title' => '',
    ), $atts, 'attractions');

    $post_ids = array_map('trim', explode(',', $atts['id']));
    $images = array_map('trim', explode(',', $atts['images']));

        ?>
        <h2><?php echo esc_html($atts['title']); ?></h2>
        <div class="attractions-slider">
            <?php
            foreach ($post_ids as $index => $post_id) {
                $post = get_post(intval($post_id));
                if ($post) {
                    $image = isset($images[$index]) ? esc_url(trim($images[$index])) : '';
                    ?>
                    <a href="<?php echo get_permalink($post->ID); ?>" class="attractions-slider__item">
                        <span class="attractions-slider__item__title">
                            <?php if($post->ID == 906){?>
                                Музей Академии художеств
                            <?php } elseif($post->ID == 79) { ?>
                                Эрмитаж
                            <?php } elseif($post->ID == 891) { ?>
                                Исаакиевский собор
                            <?php } else { ?>
                                <?php echo strip_tags($post->post_title); ?>
                            <?php }  ?>
                        </span>
                        <?php if ($image) : ?>
                            <img src="<?php echo $image; ?>" alt="<?php echo esc_attr($post->post_title); ?>" width="368" class="attractions-slider__item__img">
                        <?php endif; ?>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

function import_alts(){
	$row = 1;
	$total = [];
	$_checker = [];
	
	if (($handle = fopen(__DIR__."/all_images.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
			/*$num = count($data);
			echo "<p> $num полей в строке $row: <br /></p>\n";
			$row++;*/
			
			$src = $data[2];
			$src = str_replace('.jpg.webp', '.jpg', $src);
			$src = str_replace('.jpeg.webp', '.jpeg', $src);
			$src = str_replace('.png_converted.jpg', '.png', $src);
			$src = preg_replace('~-[0-9]+x[0-9]+(?=\..{2,6})~', '', $src);
			
			if(!in_array($src, $_checker) && stripos($data[2], 'uploads')!==false && $data[3]){
				$_checker[] = $src;
				
				//$src = str_replace('https://parus-peterburg.ru/wp-content/uploads/', '', $data[2]);
				
				
				$total[] = [
					'src' => $src,
					'alt' => $data[3]
				];
			}
		}

		fclose($handle);
		
		//$up = array_slice($total, 900, 100);
				
		//var_dump($up);
		//$attachment_id = attachment_url_to_postid($total[0]['src']);
		
		$i = 1;
		foreach($total as $item){
			$attachment_id = attachment_url_to_postid($item['src']);
			
			echo $i.'. Src: '.$item['src'].' Alt: '.get_post_meta($attachment_id, '_wp_attachment_image_alt', true).'<br>';
			/*if($attachment_id){
				update_post_meta($attachment_id, '_wp_attachment_image_alt', $item['alt']);
				var_dump($item['src']);
			}*/
			$i++;
		}
	}
	die();
}

if($_SERVER['REMOTE_ADDR']=='31.8.201.85sd')
	add_action('init', 'import_alts');

add_action('wp_ajax_get_current_prices', 'get_current_prices');
add_action('wp_ajax_nopriv_get_current_prices', 'get_current_prices'); 

function get_current_prices(){
	$id = $_POST['id'];
	
	$post_id = get_posts( array(
		'meta_key' => 'id_crm',
		'meta_value' => $id,
		'post_type' => 'tours',
		'suppress_filters' => true,
		'post_status' => 'any',
	) )[0]->ID;
	
	$prices = [
		'kid' => [
			get_field('p_doshkolniki', $post_id),
			get_field('p_doshkolniki_sale', $post_id)
		],
		'school' => [
			get_field('p_shkolniki', $post_id),
			get_field('p_shkolniki_sale', $post_id)
		],
		'student' => [
			get_field('p_studenty', $post_id),
			get_field('p_studenty_sale', $post_id)
		],
		'adult' => [
			get_field('p_vzroslie', $post_id),
			get_field('p_vzroslie_sale', $post_id)
		],
		'old' => [
			get_field('p_pensionery', $post_id),
			get_field('p_pensionery_sale', $post_id)
		],
		'adult_i' => [
			get_field('p_vzroslie_inostrancy', $post_id),
			get_field('p_vzroslie_inostrancy_sale', $post_id)
		],
		'kid_i' => [
			get_field('p_deti_inostrancy', $post_id),
			get_field('p_deti_inostrancy_sale', $post_id)
		],
	];
	
	echo json_encode($prices);
	
	die();
}