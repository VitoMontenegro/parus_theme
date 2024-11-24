<?php

// Добавляем свой раздел блоков
add_filter( 'block_categories', 'custom_block_category', 10, 2 );
function custom_block_category( $default_categories, $post ) {
    $res =  array_merge(
        $default_categories,
        [
            [
                'slug'  => 'lpb-category',     // Слаг категории который будем использовать при регистрации блока
                'title' => __( 'lpb Blocks', 'my-plugin' ),      // Отображаемое название категории
                'icon'  => 'wordpress'      // Иконка для категории, можно передать null если иконка не нужна
            ],
        ]
    );

    return array_reverse ($res);
}


add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
    // check function exists
    if( function_exists('acf_register_block') ) {

        acf_register_block(array(
            'name'                  => 'news',
            'title'                 => __('Новости'),
            'description'           => __('Блок с новостями'),
            'render_callback'       => 'my_acf_block_render_callback',
            'category'              => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'              => 'smaltle',
            'title'             => __('Малый заголовок'),
            'description'       => __('Малый заголовок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'              => 'stepstitle',
            'title'             => __('Блок "три шага"'),
            'description'       => __('Блок "три шага"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'              => 'experts',
            'title'             => __('Блок "Эксперты"'),
            'description'       => __('Блок "Эксперты"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'              => 'reviewslide',
            'title'             => __('Слайдер отзывы'),
            'description'       => __('Слайдер отзывы'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'bigtle',
            'title'		=> 'Большой заголовок',
            'description'       => 'Большой заголовок',
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'iconblock',
            'title'             => __('Иконки + заголовок(без описания)'),
            'description'       => __('Иконки + заголовок(без описания)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'iconblockbig',
            'title'             => __('Иконки+заголовок(без описания) большие'),
            'description'       => __('Иконки+заголовок(без описания) большие'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'iconblockdesc',
            'title'             => __('Иконки + заголовок + описание'),
            'description'       => __('Иконки + заголовок + описание'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'request',
            'title'             => __('Блок с формой связи'),
            'description'       => __('Блок с формой связи'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'banner',
            'title'		=> __('Банер с каруселью иконок'),
            'description'       => __('Банер с каруселью иконок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'bannercard',
            'title'     => __('Банер с картами'),
            'description'       => __('Банер с картами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'sep',
            'title'     => __('Разделитель'),
            'description'       => __('Разделитель'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'bannerslider',
            'title'     => __('Банер с иконками(карусель)'),
            'description'       => __('Банер с каруселью иконок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'bannerempty',
            'title'		=> __('Банер без иконок'),
            'description'       => __('Банер без иконок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        // acf_register_block(array(
        // 	'name'				=> 'titlesublink',
        // 	'title'				=> __('Заголовок+ссылка'),
        // 	'description'		=> __('Блок заголовка + подзаголовок+ ссылка'),
        // 	'render_callback'	=> 'my_acf_block_render_callback',
        // 	'category'			=> 'lpb-category',
        // 	'icon' => array(
        // 	  // Specifying a background color to appear with the icon e.g.: in the inserter.
        // 	  'background' => '#eccb13',
        // 	  // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
        // 	  'foreground' => '#fff',
        // 	  // Specifying a dashicon for the block
        // 	  'src' => 'lpb',
        // 	),
        // ));
        // acf_register_block(array(
        // 	'name'				=> 'quote',
        // 	'title'				=> __('Блок цитата+ссылка'),
        // 	'description'		=> __('Блок с цитатой'),
        // 	'render_callback'	=> 'my_acf_block_render_callback',
        // 	'category'			=> 'lpb-category',
        // 	'icon' => array(
        // 	  // Specifying a background color to appear with the icon e.g.: in the inserter.
        // 	  'background' => '#eccb13',
        // 	  // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
        // 	  'foreground' => '#fff',
        // 	  // Specifying a dashicon for the block
        // 	  'src' => 'lpb',
        // 	),
        // ));
        acf_register_block(array(
            'name'		=> 'button',
            'title'		=> __('Кнопка'),
            'description'       => __('Кнопка для блока с цитатой'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'buttondocs',
            'title'     => __('Кнопка-ссылка на документ'),
            'description'       => __('Кнопка-ссылка на документ'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'desc',
            'title'		=> __('Описание'),
            'description'       => __('Описание'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'icontext',
            'title'     => __('Текст + иконка'),
            'description'       => __('Текст + иконка'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#eccb13',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'		=> 'titlledesc',
            'title'		=> __('Заголовок описания'),
            'description'       => __('Заголовок описания'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'		=> 'lpb-category',
            'icon' => array(
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'slidericons',
            'title'     => __('Слайдер с иконками'),
            'description'       => __('Слайдер с иконками'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'titletip',
            'title'     => __('Малое описание'),
            'description'       => __('Малое описание'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block(array(
            'name'      => 'counter',
            'title'     => __('О банке в цифрах'),
            'description'       => __('О банке в цифрах'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => array(
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ),
            'example'           => [],
        ));
        acf_register_block([
            'name'      => 'facts',
            'title'     => __('Факты блок (аним.)'),
            'description'       => __('Факты блок (аним.)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'industries',
            'title'     => __('Карточки (сорудничество)'),
            'description'       => __('Карточки (сорудничество)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'historyempty',
            'title'     => __('Блок "история банка" (неаним.)'),
            'description'       => __('Блок "история банка" (неаним.)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'history',
            'title'     => __('Блок "история банка"'),
            'description'       => __('Блок "история банка"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'justbanner',
            'title'     => __('Пустой банер'),
            'description'       => __('Пустой банер'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'justbannerbrand',
            'title'     => __('Пустой банер (+ бренд)'),
            'description'       => __('Пустой банер (+ бренд)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'infocards',
            'title'     => __('Блок с банковскими карточками'),
            'description'       => __('Блок с банковскими карточками'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'tabs',
            'title'     => __('Блок навигации'),
            'description'       => __('Блок навигации'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'contacts',
            'title'     => __('Блок с контактами'),
            'description'       => __('Блок с контактами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'personimg',
            'title'     => __('Фото персоны'),
            'description'       => __('Фото персоны'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'tendencies',
            'title'     => __('Блок "Тенденции"'),
            'description'       => __('Блок "Тенденции"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'financing',
            'title'     => __('Блок "financing"'),
            'description'       => __('Блок "financing"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'logical',
            'title'     => __('Блок "logical"'),
            'description'       => __('Блок "logical"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'staff',
            'title'     => __('Блок "Сотрудники"'),
            'description'       => __('Блок "Сотрудники"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'docaccordion',
            'title'     => __('Аккордион с документами'),
            'description'       => __('Аккордион с документами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'timeline',
            'title'     => __('Блок "Временная шкала"'),
            'description'       => __('Блок "Временная шкала"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'featureitem',
            'title'     => __('Блок "Список в рамке"'),
            'description'       => __('Блок "Список в рамке"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'kinditem',
            'title'     => __('Финансовые иконки'),
            'description'       => __('Финансовые иконки'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'linksblock',
            'title'     => __('Блок ссылок'),
            'description'       => __('Блок ссылок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'popupblock',
            'title'     => __('Блок popup'),
            'description'       => __('Блок popup'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'doclinks',
            'title'     => __('Блок ссылок на документы'),
            'description'       => __('Блок ссылок на документы'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'questioitem',
            'title'     => __('Блок аккордион (title + txt)'),
            'description'       => __('Блок аккордион (title + txt)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'infoline',
            'title'     => __('Блок "Иконка + текст"'),
            'description'       => __('Блок "Иконка + текст"'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'share',
            'title'     => __('Блок соцсетей'),
            'description'       => __('Блок соцсетей'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'linkemail',
            'title'     => __('Ссылка на email'),
            'description'       => __('Ссылка на email'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'infoimg',
            'title'     => __('Title с иконкой (в рамке)'),
            'description'       => __('Title с иконкой (в рамке)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'cardimg',
            'title'     => __('Три карты (hover)'),
            'description'       => __('Три карты (hover)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'nums',
            'title'     => __('Номера (анимация)'),
            'description'       => __('Номера (анимация)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'popupblocktable',
            'title'     => __('Блок popup таблица'),
            'description'       => __('Блок popup таблица'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'customcource',
            'title'     => __('Валюты(временный)'),
            'description'       => __('Валюты(временный)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'terminals',
            'title'     => __('Терминалы'),
            'description'       => __('Терминалы'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'threecol',
            'title'     => __('Кредиты'),
            'description'       => __('Кредиты'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'sadarbiba',
            'title'     => __('Sadarbība(шапка)'),
            'description'       => __('Sadarbība(шапка)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'valutas',
            'title'     => __('Valūtas(шапка)'),
            'description'       => __('Valūtas(шапка)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'iconscontact',
            'title'     => __('Блок иконок (контакты)'),
            'description'       => __('Блок иконок (контакты)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'conactfull',
            'title'     => __('Контакты (полный)'),
            'description'       => __('Контакты (полный)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'map',
            'title'     => __('Карта'),
            'description'       => __('Карта'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'contactbtns',
            'title'     => __('Телефоны в шапке'),
            'description'       => __('Телефоны в шапке'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
        acf_register_block([
            'name'      => 'bubbles',
            'title'     => __('Фон (bubble)'),
            'description'       => __('Фон (bubble)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'      => 'lpb-category',
            'icon' => [
              // Specifying a background color to appear with the icon e.g.: in the inserter.
              'background' => '#eccb13',
              // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
              'foreground' => '#fff',
              // Specifying a dashicon for the block
              'src' => 'lpb',
            ],
            'example'           => [],
        ]);
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


