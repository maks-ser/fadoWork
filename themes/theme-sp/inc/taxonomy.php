<?php

/**
 * кастомный тип записи для ACF
 */
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array (
    //'page_title' => 'Основные настройки сайта',
    'menu_title' => 'Основные настройки', 'menu_slug' => 'theme-general-settings', //'capability' => 'edit_posts',
    //'redirect' => false
  ));

  acf_add_options_sub_page(array (
    'page_title' => 'Общие для всех страниц', 'menu_title' => 'Общие', 'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array (
    'page_title' => 'Настройки шапки', 'menu_title' => 'Шапка сайта', 'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array (
    'page_title' => 'Настройки подвала', 'menu_title' => 'Подвал сайта', 'parent_slug' => 'theme-general-settings',
  ));

}

add_action('admin_init', '_psAcfAddNewType');
function _psAcfAddNewType ()
{
  add_filter('acf/location/rule_types', 'acf_location_rules_types');

  function acf_location_rules_types ($choices)
  {

    $choices['Категории']['_spCats'] = 'Названия категории';

    return $choices;

  }

  add_filter('acf/location/rule_values/_spCats', 'acf_location_rule_values_spCats');

  function acf_location_rule_values_spCats ($choices)
  {
    $terms = get_terms([
      'taxonomy' => 'category', 'hide_empty' => false,
    ]);

    if ($terms) {
      foreach ($terms as $term) {
        $choices[ $term->term_id ] = $term->name;
      }
    }
    return $choices;
  }


  add_filter('acf/location/rule_match/_spCats', 'asp_location_rules_match_spCats', 10, 3);
  function asp_location_rules_match_spCats ($match, $rule, $options)
  {

    $screen = get_current_screen();
    if ($screen->base !== 'term' || $screen->id !== 'edit-category') {
      return $match;
    }
    $term_id     = $_GET['tag_ID'];
    $select_term = $rule['value'];
    if ($rule['operator'] === '==') {
      $match = ($term_id == pll_get_term($select_term));
    }
    else if ($rule['operator'] === '!=') {
      $match = ($term_id != pll_get_term($select_term));
    }
    return $match;
  }
}

/**
 * rename custom single
 */
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels ($labels)
{
  $new = array (
//    'name'                  => 'Продукция и статьи',
//    'singular_name'         => 'Продукция и статьи',
//    'add_new'               => 'Добавить статью',
//    'add_new_item'          => 'Добавить статью',
//    'edit_item'             => 'Редактировать статью',
//    'new_item'              => 'Новая статья',
//    'view_item'             => 'Просмотреть статью',
//    'search_items'          => 'Поиск статей',
//    'not_found'             => 'Статей не найдено.',
//    'not_found_in_trash'    => 'Статей в корзине не найдено.',
//    'parent_item_colon'     => '',
//    'all_items'             => 'Все статьи',
//    'archives'              => 'Архивы статей',
//    'insert_into_item'      => 'Вставить в статью',
//    'uploaded_to_this_item' => 'Загруженные для этой статьи',
//    'featured_image'        => 'Миниатюра статьи',
//    'filter_items_list'     => 'Фильтровать список статей',
//    'items_list_navigation' => 'Навигация по списку статей',
//    'items_list'            => 'Список статей',
'menu_name' => 'Статьи и новости',
//    'name_admin_bar'        => 'Статью', // пункте "добавить"
  );
  return (object)array_merge((array)$labels, $new);
}

// standart acf return from new acf update plugin
//add_filter('acf/settings/remove_wp_meta_box', '__return_false');

/**
 * new post type
 */
function create_posts ()
{
  function registerType ($title, $slug, $slugRewrite, $icon)
  {
    register_post_type($slug, array (
      'label'              => null, 'labels' => array (
        'name' => $title, 'singular_name' => $title, 'add_new' => 'Добавить', 'add_new_item' => 'Добавление', 'edit_item' => 'Редактирование', 'new_item' => 'Новая', 'view_item' => 'Смотреть', 'search_items' => 'Искать', 'not_found' => 'Не найдено', 'not_found_in_trash' => 'Не найдено в корзине', 'parent_item_colon' => '', 'menu_name' => $title,
      ), 'public'          => true, //'publicly_queryable' => false,
      'show_ui'            => true, 'show_in_nav_menus' => true, //'query_var' => false,
      'rewrite'            => array (
        'slug' => $slugRewrite, 'edit_item' => 'Редактировать', 'new_item' => 'Новая', 'with_front' => false,
        //'feeds' 	=> false,
      ), 'capability_type' => 'page', 'has_archive' => false, 'hierarchical' => true, 'menu_position' => 25, 'menu_icon' => $icon, 'supports' => array (
        'title',
        //'page-attributes',
      ),
    ));
  }


  function registerTypeAdm ($title, $slug, $slugRewrite, $icon)
  {
    register_post_type($slug, array (
      'label'               => null, 'labels' => array (
        'name'               => $title,
        'singular_name'      => $title,
        'add_new'            => 'Добавить',
        'add_new_item'       => 'Добавление',
        'edit_item'          => 'Редактирование',
        'new_item'           => 'Новая',
        'view_item'          => 'Смотреть',
        'search_items'       => 'Искать',
        'not_found'          => 'Не найдено',
        'not_found_in_trash' => 'Не найдено в корзине',
        'parent_item_colon'  => '', 'menu_name' => $title,
      ), 'public'           => true,
      'publicly_queryable'  => false,
      'show_ui'             => true,
      'show_in_nav_menus'   => true,
      'query_var'           => false,
      'exclude_from_search' => false,
      'rewrite'             => false,
      'capability_type' => 'post',
      'has_archive' => false,
      'hierarchical' => false,
      'menu_position' => 25,
      'menu_icon' => $icon,
      'supports' => array (
        'title', 'editor',
      ),

    ));
  }


  registerType(" Вакансии ", "t-vacancy", '', 'dashicons-id-alt');
  registerTypeAdm(" Портфолио ", "t-portfolio", '', 'dashicons-portfolio');
  registerTypeAdm(" Сертификаты ", "t-sert", '', 'dashicons-media-text');
  registerTypeAdm(" Паспорта продукции ", "t-passport", '', 'dashicons-media-document');
  registerTypeAdm(" Техническая литература ", "t-tex", '', 'dashicons-welcome-write-blog');
  registerTypeAdm(" Готовые решения ", "t-solution", '', 'dashicons-text-page');
  registerTypeAdm(" Чертежи, схемы ", "t-scheme", '', 'dashicons-analytics');
  registerTypeAdm(" Видеоинструкции ", "t-instruction", '', 'dashicons-video-alt2');
  registerType(" Товары ", "t-product", '', 'dashicons-cart');

  function registerTypeAdmEmail ($title, $slug, $slugRewrite, $icon)
  {
    register_post_type($slug,
      array (
        'label'               => null,
        'labels'              => array (
          'name'              => $title,
          'singular_name'     => $title,
          'parent_item_colon' => '',
          'menu_name'         => $title,
        ),
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'query_var'           => false,
        'exclude_from_search' => true,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 25,
        'menu_icon'           => $icon,
        'supports'            => array (
          'title',
          'editor',
          //'page-attributes',
        ),

      )
    );
  }

  registerTypeAdmEmail(__('Почта от клиетов', 'theme-sp'), "t-mail", '', 'dashicons-email-alt');
}

add_action('init', 'create_posts');

/**
 * new taxonomies
 */
function add_new_taxonomies ()
{
  function registerTax_adm ($typePost, $title, $slug, $slugRewrite, $public = false)
  {
    register_taxonomy($slug, $typePost, array (
      'hierarchical' => true, /* true - по типу рубрик, false - по типу меток,
        по умолчанию - false */ 'labels' => array (
        'name'                  => $title, 'singular_name' => $title, 'search_items' => 'Найти', 'popular_items' => 'Популярные', 'all_items' => 'Все ' . $title, 'parent_item' => null, 'parent_item_colon' => null, 'edit_item' => 'Редактировать', 'update_item' => 'Обновить', 'add_new_item' => 'Добавить новую', 'new_item_name' => 'Название', 'separate_items_with_commas' => 'Разделяйте запятыми', 'add_or_remove_items' => 'Добавить или удалить',
        'choose_from_most_used' => 'Выбрать из наиболее часто используемых', 'menu_name' => $title
      ), 'public'    => true, /* каждый может использовать таксономию, либо
        только администраторы, по умолчанию - true */ 'show_in_nav_menus' => false, /* добавить на страницу создания меню */ 'show_ui' => true, /* добавить интерфейс создания и редактирования */ 'show_tagcloud' => true, /* нужно ли разрешить облако тегов для этой таксономии */ 'update_count_callback' => '_update_post_term_count', /* callback-функция для обновления счетчика $object_type */ 'query_var' => true, 'publicly_queryable' => $public, /* разрешено ли использование query_var, также можно
        указать строку, которая будет использоваться в качестве
        него, по умолчанию - имя таксономии */ //        'rewrite'             => false,
      'rewrite'      => array (
        /* настройки URL пермалинков */ 'slug' => $slugRewrite, // ярлык
        'hierarchical'                         => false, // разрешить вложенность
        'with_front'                           => false,
      ),
    ));
  }

  registerTax_adm(array ('t-portfolio'), 'Категории', 'cat-portfolio', '');
  registerTax_adm(array ('t-portfolio'), 'Города', 'cat-portfolio-city', '');


  function registerTax ($typePost, $title, $slug, $slugRewrite)
  {
    register_taxonomy($slug, $typePost, array (
      'hierarchical' => true, /* true - по типу рубрик, false - по типу меток,
        по умолчанию - false */ 'labels' => array (
        'name'                  => $title, 'singular_name' => $title, 'search_items' => 'Найти', 'popular_items' => 'Популярные', 'all_items' => 'Все ' . $title, 'parent_item' => null, 'parent_item_colon' => null, 'edit_item' => 'Редактировать', 'update_item' => 'Обновить', 'add_new_item' => 'Добавить новую', 'new_item_name' => 'Название', 'separate_items_with_commas' => 'Разделяйте запятыми', 'add_or_remove_items' => 'Добавить или удалить',
        'choose_from_most_used' => 'Выбрать из наиболее часто используемых', 'menu_name' => $title
      ), 'public'    => true, /* каждый может использовать таксономию, либо
        только администраторы, по умолчанию - true */ 'show_in_nav_menus' => false, /* добавить на страницу создания меню */ 'show_ui' => true, /* добавить интерфейс создания и редактирования */ 'show_tagcloud' => true, /* нужно ли разрешить облако тегов для этой таксономии */ 'update_count_callback' => '_update_post_term_count', /* callback-функция для обновления счетчика $object_type */ 'query_var' => true, /* разрешено ли использование query_var, также можно
        указать строку, которая будет использоваться в качестве
        него, по умолчанию - имя таксономии */ 'rewrite' => array (
        /* настройки URL пермалинков */ 'slug' => $slugRewrite, // ярлык
        'hierarchical'                         => true // разрешить вложенность
      ),
    ));
  }

  registerTax(array ('t-sert'), 'Категории', 'cat-sert', '');
  registerTax(array ('t-passport'), 'Категории', 'cat-passport', '');
  registerTax(array ('t-tex'), 'Категории', 'cat-tex', '');
  registerTax(array ('t-solution'), 'Категории', 'cat-solution', '');
  registerTax(array ('t-scheme'), 'Категории', 'cat-scheme', '');
  registerTax(array ('t-instruction'), 'Категории', 'cat-instruction', '');
  registerTax(array ('t-product'), 'Категории', 'cat-product', 'katalog');
}

add_action('init', 'add_new_taxonomies');

/**
 * default tax in admin
 */
if (is_admin()) {

  add_action('wp_loaded', function () {

    $taxonomy = 'cat-sert';
    $term_id  = get_option("default_{$taxonomy}");
    if (!$term_id) {
      $term    = get_term_by('name', 'Все категории', $taxonomy);
      $term_id = $term ? $term->term_id : 0;
      update_option("default_{$taxonomy}", $term_id);
    }

    $taxonomy = 'cat-passport';
    $term_id  = get_option("default_{$taxonomy}");
    if (!$term_id) {
      $term    = get_term_by('name', 'Все линейки', $taxonomy);
      $term_id = $term ? $term->term_id : 0;
      update_option("default_{$taxonomy}", $term_id);
    }

    $taxonomy = 'cat-tex';
    $term_id  = get_option("default_{$taxonomy}");
    if (!$term_id) {
      $term    = get_term_by('name', 'Все темы', $taxonomy);
      $term_id = $term ? $term->term_id : 0;
      update_option("default_{$taxonomy}", $term_id);
    }

    $taxonomy = 'cat-solution';
    $term_id  = get_option("default_{$taxonomy}");
    if (!$term_id) {
      $term    = get_term_by('name', 'Все схемы', $taxonomy);
      $term_id = $term ? $term->term_id : 0;
      update_option("default_{$taxonomy}", $term_id);
    }

    $taxonomy = 'cat-scheme';
    $term_id  = get_option("default_{$taxonomy}");
    if (!$term_id) {
      $term    = get_term_by('name', 'Все категории', $taxonomy);
      $term_id = $term ? $term->term_id : 0;
      update_option("default_{$taxonomy}", $term_id);
    }

    $taxonomy = 'cat-scheme';
    $term_id  = get_option("default_{$taxonomy}");
    if (!$term_id) {
      $term    = get_term_by('name', 'Все категории', $taxonomy);
      $term_id = $term ? $term->term_id : 0;
      update_option("default_{$taxonomy}", $term_id);
    }

  });
}

/**
 * default tax in post check always
 */
function spTaxDef ($taxonomy, $post)
{
  $def_term_id = get_option("default_$taxonomy");
  if (!$def_term_id) return;

  if (get_term($def_term_id)) {
    wp_set_object_terms($post->ID, (int)$def_term_id, $taxonomy, true);
  }
}

add_action('save_post', function ($post_id, $post) {

  if ($post->post_type === 't-sert') {
    spTaxDef('cat-sert', $post);
  }
  if ($post->post_type === 't-passport') {
    spTaxDef('cat-passport', $post);
  }
  if ($post->post_type === 't-tex') {
    spTaxDef('cat-tex', $post);
  }
  if ($post->post_type === 't-solution') {
    spTaxDef('cat-solution', $post);
  }
  if ($post->post_type === 't-scheme') {
    spTaxDef('cat-scheme', $post);
  }

}, 11, 2);

