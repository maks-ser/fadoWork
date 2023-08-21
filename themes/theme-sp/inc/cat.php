<?php


function in_array_r ($needle, $haystack, $strict = false)
{
  foreach ($haystack as $item) {
    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
      return true;
    }
  }

  return false;
}

/**
 * posts category
 */
function getPosts ()
{
  global $post;
  $dir   = get_bloginfo("template_directory") . "/";
  $count = !empty($_POST['count']) ? $_POST['count'] : 9;
  $child = !empty($_POST['child']) ? $_POST['child'] : false; // array
  $id    = !empty($_POST['id']) ? $_POST['id'] : false;       // one value

  $args = array (
    'cat'              => $id,
    'posts_per_page'   => $count,
    'offset'           => $child,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true,
  );

  $query = new WP_Query($args);
  if ($query->have_posts()):
    $hide = $query->found_posts <= $child + $count;
    while ($query->have_posts()): $query->the_post(); ?>
      <a href="<?php the_permalink() ?>" class="s-slider__slide" <?php if ($hide)
        echo ' data-no' ?>>
        <div class="image">
          <img src="<?= get_field('prev_img') ?: "{$dir}img/home-page/12.png" ?>" alt="Alpha Grissin">
        </div>
        <p class="middle-text"><?= get_field('prev_t') ?: get_the_title() ?></p>
        <?php if ($d = get_field('prev_d')): ?>
          <p class="page-text"><?= $d ?></p>
        <?php endif; ?>
      </a>
    <?php endwhile;
    wp_reset_postdata(); // сброс
  endif;
  die();
}

add_action('wp_ajax_getPosts', 'getPosts');
add_action('wp_ajax_nopriv_getPosts', 'getPosts');

/**
 * getProducts
 */
function getProducts ()
{
  session_start();
  $dir = get_bloginfo("template_directory") . "/";
  global $post;
  $args                    = !empty($_POST['args']) ? $_POST['args'] : 0;
  $filterLabel             = !empty($_POST['filterLabel']) ? $_POST['filterLabel'] : false; // array
  $_SESSION['filterLabel'] = !empty($filterLabel['label-products']) ? $filterLabel['label-products'] : false;

  $filterCat             = !empty($_POST['filterCat']) ? $_POST['filterCat'] : false;     // one value
  $_SESSION['filterCat'] = !empty($filterCat['cat-products']) ? $filterCat['cat-products'] : false;

  if ($filterLabel || $filterCat) {

    $args['tax_query'] = [
      'relation' => "AND",
    ];

    if ($filterLabel) {
      $args['tax_query'][] = array (
        'taxonomy' => 'label-products',
        'field'    => 'id',
        'terms'    => $filterLabel['label-products'],
        'operator' => 'AND'
      );
    }
    if ($filterCat) {
      $args['tax_query'][] = array (
        'taxonomy' => 'cat-products',
        'field'    => 'id',
        'terms'    => $filterCat['cat-products'],
        'operator' => 'AND'
      );
    }
  }

  $query = new WP_Query($args);
  if ($query->have_posts()):
    $hide = count($query->posts) <= $query->max_num_pages;
    while ($query->have_posts()): $query->the_post(); ?>
      <div class="grid-item"<?php if ($hide) echo ' data-no' ?>>
        <a href="<?php the_permalink() ?>" class="product-item">
          <div class="product-item__image">
            <picture>
              <img class="product-img" src="<?= get_field('prev_img') ?: get_bloginfo("template_directory") . '/img/catalog/01.png' ?>" alt="">
            </picture>
          </div>
          <div class="product-item__name middle-text"><?= get_field('t') ?: get_the_title() ?></div>
        </a>
      </div>
    <?php endwhile;
    wp_reset_postdata(); // сброс

  else:
    ?>
    <p data-no class="text-nomore"><?php _e('не знайдено...', 'theme-sp'); ?></p>
  <?php
  endif;
  wp_reset_postdata();
  die();
}

add_action('wp_ajax_getProducts', 'getProducts');
add_action('wp_ajax_nopriv_getProducts', 'getProducts');


/**
 * more product
 */
function moreProduct ()
{
  session_start();
  $dir = get_bloginfo("template_directory") . "/";
  global $post;
  $args        = !empty($_POST['args']) ? $_POST['args'] : 0;
  $filterLabel = !empty($_POST['filterLabel']) ? $_POST['filterLabel'] : false; // array
  $filterCat   = !empty($_POST['filterCat']) ? $_POST['filterCat'] : false;     // one value
  if (!$args) die();

  if ($filterLabel || $filterCat) {

    $args['tax_query'] = [
      'relation' => "AND",
    ];

    if ($filterLabel) {
      $args['tax_query'][] = array (
        'taxonomy' => 'label-products',
        'field'    => 'id',
        'terms'    => $filterLabel['label-products'],
        'operator' => 'AND'
      );
    }
    if ($filterCat) {
      $args['tax_query'][] = array (
        'taxonomy' => 'cat-products',
        'field'    => 'id',
        'terms'    => $filterCat['cat-products'],
        'operator' => 'AND'
      );
    }
  }

  $query = new WP_Query($args);

  if ($query->have_posts()):
    $hide = count($query->posts) <= $query->max_num_pages;
    while ($query->have_posts()): $query->the_post(); ?>
      <div class="grid-item"<?php if ($hide) echo ' data-no' ?>>
        <a href="<?php the_permalink() ?>" class="product-item">
          <div class="product-item__image">
            <picture>
              <img class="product-img" src="<?= get_field('prev_img') ?: get_bloginfo("template_directory") . '/img/catalog/01.png' ?>" alt="">
            </picture>
          </div>
          <div class="product-item__name middle-text"><?= get_field('t') ?: get_the_title() ?></div>
        </a>
      </div>
    <?php endwhile;
    wp_reset_postdata(); // сброс
  endif;
  die();
}

add_action('wp_ajax_moreProduct', 'moreProduct');
add_action('wp_ajax_nopriv_moreProduct', 'moreProduct');


/**
 * pagination
 */
function ps_pagenavi ($query = '', $echo = false, $pageLink = '', $pageFirst = '')
{
  // параметры по умолчанию
  $before          = '';        // Текст до навигации.
  $after           = '';        // Текст после навигации.
  $text_num_page   = '';        // Текст перед пагинацией. {current} - текущая. {last} - последняя (пр: 'Страница {current} из {last}' получим: "Страница 4 из 60").
  $num_pages       = 3;         // Сколько ссылок показывать.
  $step_link       = 10;        // Ссылки с шагом (если 10, то: 1,2,3...10,20,30. Ставим 0, если такие ссылки не нужны.
  $dotright_text   = '…';       // Промежуточный текст "до".
  $dotright_text2  = '…';       // Промежуточный текст "после".
  $back_text       = '&lsaquo;';// Текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
  $next_text       = '&rsaquo;';// Текст "перейти на следующую страницу".  Ставим 0, если эта ссылка не нужна.
  $first_page_text = '&laquo;'; // Текст "к первой странице".    Ставим 0, если вместо текста нужно показать номер страницы.
  $last_page_text  = '&raquo;'; // Текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.

  if (!$query) {
    global $wp_query;
    $paged    = (int)$wp_query->query_vars['paged'] ?: 1;
    $max_page = $wp_query->max_num_pages;
  }
  else {
    $paged    = (int)$query->query_vars['paged'];
    $max_page = $query->max_num_pages;
  }
  if ($max_page <= 1)
    return false; //проверка на надобность в навигации

  if (empty($paged) || $paged == 0)
    $paged = 1;

  $pages_to_show         = intval($num_pages);
  $pages_to_show_minus_1 = $pages_to_show - 1;

  $half_page_start = floor($pages_to_show_minus_1 / 2); //сколько ссылок до текущей страницы
  $half_page_end   = ceil($pages_to_show_minus_1 / 2);  //сколько ссылок после текущей страницы

  $start_page = $paged - $half_page_start; //первая страница
  $end_page   = $paged + $half_page_end;   //последняя страница (условно)

  if ($start_page <= 0)
    $start_page = 1;
  if (($end_page - $start_page) != $pages_to_show_minus_1)
    $end_page = $start_page + $pages_to_show_minus_1;
  if ($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page   = (int)$max_page;
  }

  if ($start_page <= 0)
    $start_page = 1;

  // создаем базу чтобы вызвать get_pagenum_link один раз
  $link_base = !empty($pageLink) ? $pageLink : str_replace(99999999, '___', get_pagenum_link(99999999));
  $first_url = !empty($pageFirst) ? $pageFirst : get_pagenum_link(1);
  if (false === strpos($first_url, '?'))
    $first_url = user_trailingslashit($first_url);

  // собираем елементы
  $els = array ();

  if ($text_num_page) {
    $text_num_page = preg_replace('!{current}|{last}!', '%s', $text_num_page);
    $els['pages']  = sprintf('<span>' . $text_num_page . '</span>', $paged, $max_page);
  }

  // в начало
  if ($start_page >= 2 && $pages_to_show < $max_page) {
    $els['first'] = '<li class="pagination__first"><a href="' . $first_url . '">' . ($first_page_text ?: 1) . '</a></li>';
  }

  // назад
  if ($back_text != false && $paged != 1)
    $els['prev'] = '<li class="pagination__prev"><a href="' . (($paged - 1) == 1 ? $first_url : str_replace('___', ($paged - 1), $link_base)) . '">' . $back_text . '</a></li>';

  // ...
  if ($start_page >= 2 && $pages_to_show < $max_page) {
    if ($dotright_text && $start_page != 2)
      $els[] = '<li class="pagination__dots"><span>' . $dotright_text . '</span></li>';
  }

  for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $paged)
      $els['current'] = '<li class="pagination__item active"><span>' . $i . '</span></li>';
    else if ($i == 1)
      $els[] = '<li class="pagination__item"><a href="' . $first_url . '">1</a></li>';
    else
      $els[] = '<li class="pagination__item"><a href="' . str_replace('___', $i, $link_base) . '">' . $i . '</a></li>';
  }

  // ...
  if ($end_page < $max_page) {
    if ($dotright_text && $end_page != ($max_page - 1))
      $els[] = '<li class="pagination__dots"><span>' . $dotright_text2 . '</span>';
  }

  // ссылки с шагом
  $dd = 0;
  if ($step_link && $end_page < $max_page) {
    for ($i = $end_page + 1; $i <= $max_page; $i++) {
      if ($i % $step_link == 0 && $i !== $num_pages) {
        if (++$dd == 1)
          $els[] = '<li class="pagination__item"><a href="' . str_replace('___', $i, $link_base) . '">' . $i . '</a></li>';
      }
    }
  }

  // вперед
  if ($next_text != false && $paged != $end_page)
    $els['next'] = '<li class="pagination__next"><a href="' . str_replace('___', ($paged + 1), $link_base) . '">' . $next_text . '</a></li>';

  // в конец
  if ($end_page < $max_page) {
    $els['last'] = '<li class="pagination__last"><a href="' . str_replace('___', $max_page, $link_base) . '">' . ($last_page_text ?: $max_page) . '</a></li>';
  }

  // обвертка
  $out = $before . '<ul class="pagination">' . implode(' ', $els) . '</ul>' . $after;
  if ($echo) {
    echo $out;
    return false;
  }
  else return $out;
}

function paginationAjax ()
{
  session_start();
  global $post;
  $args                    = !empty($_POST['args']) ? $_POST['args'] : 0;
  $filterLabel             = !empty($_POST['filterLabel']) ? $_POST['filterLabel'] : false; // array
  $_SESSION['filterLabel'] = !empty($filterLabel['label-products']) ? $filterLabel['label-products'] : false;

  $filterCat             = !empty($_POST['filterCat']) ? $_POST['filterCat'] : false;     // one value
  $_SESSION['filterCat'] = !empty($filterCat['cat-products']) ? $filterCat['cat-products'] : false;

  $pageLink  = !empty($_POST['pageLink']) ? $_POST['pageLink'] : false;
  $pageFirst = !empty($_POST['pageFirst']) ? $_POST['pageFirst'] : false;

  if ($filterLabel || $filterCat) {

    $args['tax_query'] = [
      'relation' => "AND",
    ];

    if ($filterLabel) {
      $args['tax_query'][] = array (
        'taxonomy' => 'label-products',
        'field'    => 'id',
        'terms'    => $filterLabel['label-products'],
        'operator' => 'AND'
      );
    }
    if ($filterCat) {
      $args['tax_query'][] = array (
        'taxonomy' => 'cat-products',
        'field'    => 'id',
        'terms'    => $filterCat['cat-products'],
        'operator' => 'AND'
      );
    }
  }

  $query = new WP_Query($args);


  $res = ps_pagenavi($query, false, $pageLink, $pageFirst);
  if ($res) echo $res;
  die();
}

add_action('wp_ajax_paginationAjax', 'paginationAjax');
add_action('wp_ajax_nopriv_paginationAjax', 'paginationAjax');