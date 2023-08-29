<?php

/**
 * current-menu-item на active
 */
function special_nav_class ($classes, $item)
{
  if (in_array('current-menu-item', $classes)) {
    $classes[] = '_active ';
  }
  return $classes;
}

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

//разрешаем новый тип записи
//add_filter('upload_mimes', 'upload_allow_types');
function upload_allow_types ($mimes)
{
  $mimes['svg']          = 'image/svg+xml';
  $existing_mimes['dwg'] = 'image/vnd.dwg';
  $existing_mimes['stp'] = 'application/STEP';
  return $mimes;
}


function breadcrumb ($title, $parent = '')
{
  $num = 1; ?>
  <div class="breadcrumbs-container">
    <div class="breadcrumbs-container__wrapper block-wrapper">
      <div class="breadcrumbs-container__breadcrumbs" data-reveal="elem">
        <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
          <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="<?php echo home_url(); ?>" class="breadcrumb__link">
              <span class="breadcrumb__name" itemprop="name">
                <img src="<?php bloginfo("template_directory") ?>/img/svg/icon-breadcrumb-home.svg" inline-svg alt="">
              </span>
            </a>
            <meta itemprop="position" content="<?= $num++ ?>"/>
          </li>
          <?php if (!empty($parent)): ?>
            <?php if (is_array($parent)): ?>
              <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="<?php the_permalink($parent['0']); ?>" class="breadcrumb__link">
                  <span class="breadcrumb__name" itemprop="name"><?= get_the_title($parent['0']) ?></span>
                </a>
                <meta itemprop="position" content="<?= $num++ ?>"/>
              </li>
            <?php else: ?>
              <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="<?php the_permalink($parent); ?>" class="breadcrumb__link">
                  <span class="breadcrumb__name" itemprop="name"><?= get_the_title($parent) ?></span>
                </a>
                <meta itemprop="position" content="<?= $num++ ?>"/>
              </li>
            <?php endif ?>
          <?php endif; ?>
          <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <?php ?>
            <span class="breadcrumb__cur breadcrumb__name" itemprop="name"><?= strip_tags($title) ?></span>
            <meta itemprop="position" content="<?= $num ?>"/>
          </li>
        </ul>
      </div>
    </div>
  </div>
<?php }


function breadcrumbSub ($title, $parent = '')
{
  $num = 1; ?>
  <div class="sub-head__breadcrumbs" data-reveal="elem">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?php echo home_url(); ?>" class="breadcrumb__link">
          <span class="breadcrumb__name" itemprop="name">
            <img src="<?php bloginfo("template_directory") ?>/img/svg/icon-breadcrumb-home.svg" inline-svg alt="">
          </span>
        </a>
        <meta itemprop="position" content="<?= $num++ ?>"/>
      </li>
      <?php if (!empty($parent)): ?>
        <?php if (is_array($parent)): ?>
          <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="<?php the_permalink($parent['0']); ?>" class="breadcrumb__link">
              <span class="breadcrumb__name" itemprop="name"><?= get_the_title($parent['0']) ?></span>
            </a>
            <meta itemprop="position" content="<?= $num++ ?>"/>
          </li>
        <?php else: ?>
          <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="<?php the_permalink($parent); ?>" class="breadcrumb__link">
              <span class="breadcrumb__name" itemprop="name"><?= get_the_title($parent) ?></span>
            </a>
            <meta itemprop="position" content="<?= $num++ ?>"/>
          </li>
        <?php endif ?>
      <?php endif; ?>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <?php ?>
        <span class="breadcrumb__cur breadcrumb__name" itemprop="name"><?= strip_tags($title) ?></span>
        <meta itemprop="position" content="<?= $num ?>"/>
      </li>
    </ul>
  </div>
<?php }


function breadcrumbСhead ($title, $parent = '')
{
  $num = 1; ?>
  <div class="c-head__breadcrumbs" data-reveal="elem">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?php echo home_url(); ?>" class="breadcrumb__link">
          <span class="breadcrumb__name" itemprop="name">
            <img src="<?php bloginfo("template_directory") ?>/img/svg/icon-breadcrumb-home.svg" inline-svg alt="">
          </span>
        </a>
        <meta itemprop="position" content="<?= $num++ ?>"/>
      </li>
      <?php if (!empty($parent)): ?>
        <?php if (is_array($parent)): ?>
          <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="<?php the_permalink($parent['0']); ?>" class="breadcrumb__link">
              <span class="breadcrumb__name" itemprop="name"><?= get_the_title($parent['0']) ?></span>
            </a>
            <meta itemprop="position" content="<?= $num++ ?>"/>
          </li>
        <?php else: ?>
          <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="<?php the_permalink($parent); ?>" class="breadcrumb__link">
              <span class="breadcrumb__name" itemprop="name"><?= get_the_title($parent) ?></span>
            </a>
            <meta itemprop="position" content="<?= $num++ ?>"/>
          </li>
        <?php endif ?>
      <?php endif; ?>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <?php ?>
        <span class="breadcrumb__cur breadcrumb__name" itemprop="name"><?= strip_tags($title) ?></span>
        <meta itemprop="position" content="<?= $num ?>"/>
      </li>
    </ul>
  </div>
<?php }

function breadcrumbTerm ($title, $parent)
{
  $num = 1; ?>
  <div class="c-head__breadcrumbs" data-reveal="elem">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?php echo home_url(); ?>" class="breadcrumb__link">
          <span class="breadcrumb__name" itemprop="name">
            <img src="<?php bloginfo("template_directory") ?>/img/svg/icon-breadcrumb-home.svg" inline-svg alt="">
          </span>
        </a>
        <meta itemprop="position" content="<?= $num++ ?>"/>
      </li>
      <?php if (!empty($parent)):
        $chItTerm = get_term($parent);
        $chItName = $chItTerm->name;
        ?>
        <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
          <a itemprop="item" href="<?= get_category_link($parent) ?>" class="breadcrumb__link">
            <span class="breadcrumb__name" itemprop="name"><?= $chItName ?></span>
          </a>
          <meta itemprop="position" content="<?= $num++ ?>"/>
        </li>
      <?php endif; ?>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span class="breadcrumb__cur breadcrumb__name" itemprop="name"><?= strip_tags($title) ?></span>
        <meta itemprop="position" content="<?= $num ?>"/>
      </li>
    </ul>
  </div>
  <?php
}

function breadcrumbProduct ($title, $parent, $catalog)
{
  $num = 1; ?>
  <section class="breadcrumbs-container">
    <div class="breadcrumbs-container__wrapper block-wrapper">
      <div class="breadcrumbs-container__breadcrumbs" data-reveal="elem">
        <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
          <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="<?php echo home_url(); ?>" class="breadcrumb__link">
              <span class="breadcrumb__name" itemprop="name">
                <img src="<?php bloginfo("template_directory") ?>/img/svg/icon-breadcrumb-home.svg" inline-svg alt="">
              </span>
            </a>
            <meta itemprop="position" content="<?= $num++ ?>"/>
          </li>
          <?php if (!empty($catalog)):
            $titlePar = get_field('t', $catalog) ?: get_the_title($catalog);
            ?>
            <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
              <a itemprop="item" href="<?= get_permalink($catalog) ?>" class="breadcrumb__link">
                <span class="breadcrumb__name" itemprop="name"><?= $titlePar ?></span>
              </a>
              <meta itemprop="position" content="<?= $num++ ?>"/>
            </li>
          <?php endif; ?>
          <?php if (!empty($parent)):
            $chItTerm = get_term($parent);
            $chItName = $chItTerm->name;
            ?>
            <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
              <a itemprop="item" href="<?= get_category_link($parent) ?>" class="breadcrumb__link">
                <span class="breadcrumb__name" itemprop="name"><?= $chItName ?></span>
              </a>
              <meta itemprop="position" content="<?= $num++ ?>"/>
            </li>
          <?php endif; ?>
          <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <span class="breadcrumb__cur breadcrumb__name" itemprop="name"><?= strip_tags($title) ?></span>
            <meta itemprop="position" content="<?= $num ?>"/>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <?php
}

add_action('after_setup_theme', 'true_load_theme_textdomain');

function true_load_theme_textdomain ()
{
  load_theme_textdomain('theme-sp', get_template_directory() . '/languages');
}

/**
 * admin ajax url
 */
add_action('wp_enqueue_scripts', 'ajaxurl_data', 99);
function ajaxurl_data ()
{
  wp_localize_script('main', 'ajaxurl',
    array (
      'url' => admin_url('admin-ajax.php'),
    )
  );
}

/**
 * option for admin email
 */
add_action('admin_init', 'ps_custom_settings');
function ps_custom_settings ()
{
  add_settings_section(
    'ps_main_section', // section
    'Email для отправки всех форм на сайте',
    'ps_section_cb',
    'reading' // page
  );
  add_settings_field(
    'ps_main_email',
    'Email куда будут приходить письма от клиетов',
    'ps_option_email_cb',
    'reading', // page
    'ps_main_section' // section
  );
  register_setting('reading', 'ps_main_email');
}

function ps_section_cb ()
{
  echo '<p>Введите корректный email, на него будут приходить все заявки с форм на сайте</p>';
}

function ps_option_email_cb ()
{
  echo '<input name="ps_main_email" type="email" value="' . get_option('ps_main_email') . '" class="code2" require style="width: 300px;">';
}


add_action('admin_init', 'ps_custom_per_page');
function ps_custom_per_page ()
{
  add_settings_section(
    'ps_section_per_page', // section
    'Количество записей на одной странице',
    '',
    'reading' // page
  );
  add_settings_field(
    'ps_per_page_sert',
    'Сертификаты',
    'ps_option_per_page',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_sert');

  add_settings_field(
    'ps_per_page_passport',
    'Паспорта продукции',
    'ps_option_per_page_passport',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_passport');

  add_settings_field(
    'ps_per_page_tex',
    'Техническая литература',
    'ps_option_per_page_tex',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_tex');

  add_settings_field(
    'ps_per_page_solution',
    'Готовые решения',
    'ps_option_per_page_solution',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_solution');

  add_settings_field(
    'ps_per_page_scheme',
    'Чертежи, схемы',
    'ps_option_per_page_scheme',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_scheme');

  add_settings_field(
    'ps_per_page_instruction',
    'Видеоинструкции',
    'ps_option_per_page_instruction',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_instruction');

  add_settings_field(
    'ps_per_page_product',
    'Товары',
    'ps_option_per_page_product',
    'reading', // page
    'ps_section_per_page' // section
  );
  register_setting('reading', 'ps_per_page_product');
}


function ps_section_per_page ()
{
  echo '<p>Количество на одной странице</p>';
}

function ps_option_per_page ()
{
  echo '<input name="ps_per_page_sert" type="number" value="' . get_option('ps_per_page_sert') . '" class="code2" require style="width: 300px;">';
}

function ps_option_per_page_passport ()
{
  echo '<input name="ps_per_page_passport" type="number" value="' . get_option('ps_per_page_passport') . '" class="code2" require style="width: 300px;">';
}

function ps_option_per_page_tex ()
{
  echo '<input name="ps_per_page_tex" type="number" value="' . get_option('ps_per_page_tex') . '" class="code2" require style="width: 300px;">';
}

function ps_option_per_page_solution ()
{
  echo '<input name="ps_per_page_solution" type="number" value="' . get_option('ps_per_page_solution') . '" class="code2" require style="width: 300px;">';
}

function ps_option_per_page_scheme ()
{
  echo '<input name="ps_per_page_scheme" type="number" value="' . get_option('ps_per_page_scheme') . '" class="code2" require style="width: 300px;">';
}

function ps_option_per_page_instruction ()
{
  echo '<input name="ps_per_page_instruction" type="number" value="' . get_option('ps_per_page_instruction') . '" class="code2" require style="width: 300px;">';
}

function ps_option_per_page_product ()
{
  echo '<input name="ps_per_page_product" type="number" value="' . get_option('ps_per_page_product') . '" class="code2" require style="width: 300px;">';
}

function getPostCount ($query)
{
  if (!is_admin() && is_archive()) {
    if (is_tax('cat-sert')) {
      if ($count = get_option('ps_per_page_sert')) //5
        $query->set('posts_per_page', $count);
    }
    else if (is_tax('cat-passport')) {
      if ($count = get_option('ps_per_page_passport')) //9
        $query->set('posts_per_page', $count);
    }
    else if (is_tax('cat-tex')) {
      if ($count = get_option('ps_per_page_tex')) //9
        $query->set('posts_per_page', $count);
    }
    else if (is_tax('cat-solution')) {
      if ($count = get_option('ps_per_page_solution')) //9
        $query->set('posts_per_page', $count);
    }
    else if (is_tax('cat-scheme')) {
      if ($count = get_option('ps_per_page_scheme')) //9
        $query->set('posts_per_page', $count);
    }
    else if (is_tax('cat-instruction')) {
      if ($count = get_option('ps_per_page_instruction')) //9
        $query->set('posts_per_page', $count);
    }
    else if (is_tax('cat-product')) {
      if ($count = get_option('ps_per_page_product')) //12
        $query->set('posts_per_page', $count);
    }
    else {
      //$query->set( 'posts_per_page',  1);//14
    }
  }
  return $query;
}

add_action('pre_get_posts', 'getPostCount');