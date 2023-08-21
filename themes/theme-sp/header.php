<?php
/**
 * @package theme-sp
 */
$dir = get_bloginfo("template_directory") . "/";
?>
<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  if (is_paged() || get_query_var('paged') >= 2) { ?>
    <meta name="robots" content="noindex, follow"/>
  <?php }
  if (is_search()): ?>
    <link rel="canonical" href="<?= pll_home_url() ?>">
  <?php else: ?>
    <link rel="canonical" href="<?= get_pagenum_link(1) ?>">
  <?php endif; ?>

   <meta property="og:image" content="<?= $dir ?>img/opengraph.jpg"/>
   <meta property="og:image:width" content="1595"/>
   <meta property="og:image:height" content="960"/>

  <link id="favicon" rel="icon" href="<?= $dir ?>img/favicon.svg" type="image/x-icon">
  <link type="image/png" sizes="16x16" rel="icon" href="<?= $dir ?>img/favicon/favicon-16x16.png">
  <link type="image/png" sizes="32x32" rel="icon" href="<?= $dir ?>img/favicon/favicon-32x32.png">
  <link type="image/png" sizes="48x48" rel="icon" href="<?= $dir ?>img/favicon/favicon-48x48.png">
  <link sizes="180x180" rel="apple-touch-icon" href="<?= $dir ?>img/favicon/apple-touch-icon-180x180.png">
  <link color="#CB0D58" rel="mask-icon" href="<?= $dir ?>img/favicon/safari-pinned-tab-16x16.svg">
  <meta name="msapplication-TileColor" content="#CB0D58">
  <meta name="msapplication-TileImage" content="<?= $dir ?>img/favicon/mstile-144x144.png">
  <meta name="application-name" content="Sitename">
  <meta name="msapplication-config" content="<?= $dir ?>others/browserconfig.xml">
  <link rel="manifest" href="<?= $dir ?>others/manifest.json">
  <meta name="theme-color" content="#ffffff">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="opacity: 0;">
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.body.style.opacity = 1;
  });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134710651-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134710651-1');
</script>
<div class="body-wrapper">
  <a id="top"></a>
  <header class="header lock-padding">
    <div class="sub-header" data-reveal="elem">
      <div class="sub-header__wrapper block-wrapper">
        <?php if ($el = get_field('h_tel', 'options')): ?>
          <?php
          $tel     = $el;
          $telLink = preg_replace("/[^+\d]/", "", $tel);
          ?>
          <div class="sub-header__tel">
            <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
          </div>
        <?php endif; ?>

        <div class="sub-header__socials-list">
          <ul class="socials-list">
            <?php $link = get_field('h_instagram', 'options');
            if ($link) { ?>
              <li class="socials-list__item">
                <a href="<?= $link ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-instagram.svg" inline-svg alt="">
                </a>
              </li>
            <?php } ?>
            <?php $link = get_field('h_facebook', 'options');
            if ($link) { ?>
              <li class="socials-list__item">
                <a href="<?= $link ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                </a>
              </li>
            <?php } ?>
            <?php $link = get_field('h_youtube', 'options');
            if ($link) { ?>
              <li class="socials-list__item">
                <a href="<?= $link ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-youtube.svg" inline-svg alt="">
                </a>
              </li>
            <?php } ?>
            <?php $link = get_field('h_linkedin', 'options');
            if ($link) { ?>
              <li class="socials-list__item">
                <a href="<?= $link ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                </a>
              </li>
            <?php } ?>
            <?php $link = get_field('h_telegram', 'options');
            if ($link) { ?>
              <li class="socials-list__item">
                <a href="<?= $link ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>

         <?php
        $languages = pll_the_languages([
          'raw'           => 1,
          'hide_if_empty' => 1,
        ]);
        if ($languages):
          ?>
          <div class="sub-header__lang">
            <div class="lang-select">
              <div class="lang-select__select-box">

                <div class="lang-select__options-container">
                  <div class="lang-select__options-wrapper">
                    <?php foreach ($languages as $lang) {
                      if (!$lang['current_lang']):?>
                        <a class="lang-select__option" href="<?= $lang['url'] ?>">
                          <div class="lang-select__item">
                            <span class="lang-select__item-name"><?= strtoupper($lang['slug']) ?></span>
                          </div>
                        </a>
                      <?php endif;
                    } ?>
                  </div>
                </div>
                <?php foreach ($languages as $lang) {
                  if ($lang['current_lang']): ?>
                    <div class="lang-select__selected">
                      <div class="lang-select__item">
                        <span class="lang-select__item-name"><?= strtoupper($lang['slug']) ?></span>
                      </div>
                    </div>
                  <?php endif;
                } ?>
              </div>
            </div>
          </div>
        <?php endif; ?>  
      </div>
    </div>

    <nav class="navbar" data-reveal="elem">
      <div class="navbar__wrapper block-wrapper">
        <div class="navbar__logo">
          <a href="<?= pll_home_url() ?>">
            <?php $img = get_field('h_logo', 'options'); ?>
            <img src="<?= $img['url'] ?: $dir . "img/svg/logo.svg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
          </a>
        </div>

        <?php $el = get_field('h_list', 'options');
        if ($el) { ?>
          <ul class="navbar__navlist">
            <?php foreach ($el as $n => $it) { ?>
              <li class="navbar__navitem" data-flyout-button="navIt-<?= $n ?>"><?= $it['t'] ?></li>
            <?php } ?>
          </ul>
        <?php } ?>

        <?php $link = get_field('h_btn', 'options');
        if ($link) {
          $url    = $link['url'] ?: '#';
          $title  = $link['title'] ?: 'LINK';
          $target = $link['target'] ? ' target="_blank"' : '';
          ?>
          <div class="navbar__button">
            <a href="<?= $url ?>" class="button button--header"<?= $target ?>>>
              <span class="button__name"><?= $title ?></span>
            </a>
          </div>
          <?php
        } ?>

        <div class="navbar__burger">
          <svg class="burger" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="5" y="12" width="31" height="2" fill="#202020"/>
            <rect x="13" y="19" width="23" height="2" fill="#787878"/>
            <rect x="5" y="26" width="31" height="2" fill="#787878"/>
          </svg>
        </div>
      </div>
    </nav>

    <?php $el = get_field('h_list', 'options');
    if ($el) { ?>
      <div class="flyout-box">
        <?php foreach ($el as $n => $it) { ?>
          <div class="flyout-box__item flyout <?php if ($it['check'] && $it['file']['file'])echo ' flyout_mod-btn' ?>" data-flyout-target="navIt-<?= $n ?>">
            <div class="flyout__wrapper block-wrapper">
              <?php $elCh = $it['sub'];
              if ($elCh) { ?>
                <ul class="flyout__list">
                  <?php foreach ($elCh as $itCh) { ?>
                    <?php $link = $itCh['link'];
                    if ($link) {
                      $url    = $link['url'] ?: '#';
                      $title  = $link['title'] ?: __('Подробнее', 'theme-sp');
                      $target = $link['target'] ? ' target="_blank"' : '';
                      ?>
                      <li class="flyout__list-item">
                        <a href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                      </li>
                      <?php
                    } ?>
                  <?php } ?>
                </ul>
              <?php } ?>
              <?php if ($it['check'] && $it['file']['file']): ?>
                <div class="flyout__button">
                  <a href="<?= $it['file']['file'] ?>" class="button" download>
                    <span class="button__name"><?= $it['file']['t'] ?: 'Скачать каталог' ?></span>
                    <span class="button__icon">
                      <img src="<?= $dir ?>img/svg/icon-button-download.svg" inline-svg alt="">
                    </span>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <div class="menu">
      <div class="menu__wrapper block-wrapper">

        <div class="menu__search">
          <form class="b-search" role="search" method="get" action="<?= pll_home_url() ?>" novalidate>
            <input name="s" type="text" class="b-search__input" required placeholder="<?php _e('Поиск по сайту...', 'theme-sp') ?>" value="">
            <button type="submit" class="b-search__button">
              <img src="<?= $dir ?>img/svg/icon-search.svg" inline-svg alt="">
            </button>
          </form>
        </div>

        <div class="menu__list-container">
          <?php $el = get_field('h_list1', 'options');
          if ($el) { ?>
            <?php foreach ($el as $n => $it) { ?>
              <div class="menu__block">
                <h3 class="menu__title"><?= $it['t'] ?></h3>
                <?php $elCh = $it['sub'];
                if ($elCh) { ?>
                  <ul class="menu__list">
                    <?php foreach ($elCh as $itCh) { ?>
                      <?php $link = $itCh['link'];
                      if ($link) {
                        $url    = $link['url'] ?: '#';
                        $title  = $link['title'] ?: __('Подробнее', 'theme-sp');
                        $target = $link['target'] ? ' target="_blank"' : '';
                        ?>
                        <li class="menu__list-item">
                          <a href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                        </li>
                        <?php
                      } ?>
                    <?php } ?>
                  </ul>
                <?php } ?>
              </div>
            <?php } ?>
          <?php } ?>

          <div class="menu__block">
            <h3 class="menu__title"><?php the_field('h_cont_t', 'options') ?></h3>
            <?php if ($el = get_field('h_tel', 'options')): ?>
              <?php
              $tel     = $el;
              $telLink = preg_replace("/[^+\d]/", "", $tel);
              ?>
              <div class="menu__contact">
                <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                <div class="menu__contact-info"><?php the_field('h_cont_telT', 'options') ?></div>
              </div>
            <?php endif; ?>

            <?php if ($el = get_field('h_cont_email', 'options')): ?>
              <div class="menu__contact">
                <a href="mailto:<?= $el ?>"><?= $el ?></a>
              </div>
            <?php endif; ?>
            <div class="menu__socials-list">
              <ul class="socials-list">
                <?php $link = get_field('h_instagram', 'options');
                if ($link) { ?>
                  <li class="socials-list__item">
                    <a href="<?= $link ?>" target="_blank">
                      <img src="<?= $dir ?>img/svg/icon-social-instagram.svg" inline-svg alt="">
                    </a>
                  </li>
                <?php } ?>
                <?php $link = get_field('h_facebook', 'options');
                if ($link) { ?>
                  <li class="socials-list__item">
                    <a href="<?= $link ?>" target="_blank">
                      <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                    </a>
                  </li>
                <?php } ?>
                <?php $link = get_field('h_youtube', 'options');
                if ($link) { ?>
                  <li class="socials-list__item">
                    <a href="<?= $link ?>" target="_blank">
                      <img src="<?= $dir ?>img/svg/icon-social-youtube.svg" inline-svg alt="">
                    </a>
                  </li>
                <?php } ?>
                <?php $link = get_field('h_linkedin', 'options');
                if ($link) { ?>
                  <li class="socials-list__item">
                    <a href="<?= $link ?>" target="_blank">
                      <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                    </a>
                  </li>
                <?php } ?>
                <?php $link = get_field('h_telegram', 'options');
                if ($link) { ?>
                  <li class="socials-list__item">
                    <a href="<?= $link ?>" target="_blank">
                      <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>

        </div>

        <div class="menu__dropdown-container">
          <?php
          $languages = pll_the_languages([
            'raw'           => 1,
            'hide_if_empty' => 1,
          ]);
          if ($languages):
            ?>
            <div class="menu__lang">
              <div class="lang-select">
                <div class="lang-select__select-box">

                  <div class="lang-select__options-container">
                    <div class="lang-select__options-wrapper">
                      <?php foreach ($languages as $lang) {
                        if (!$lang['current_lang']):?>
                          <a class="lang-select__option" href="<?= $lang['url'] ?>">
                            <div class="lang-select__item">
                              <span class="lang-select__item-name"><?= strtoupper($lang['slug']) ?></span>
                            </div>
                          </a>
                        <?php endif;
                      } ?>
                    </div>
                  </div>
                  <?php foreach ($languages as $lang) {
                    if ($lang['current_lang']): ?>
                      <div class="lang-select__selected">
                        <div class="lang-select__item">
                          <span class="lang-select__item-name"><?= strtoupper($lang['slug']) ?></span>
                        </div>
                      </div>
                    <?php endif;
                  } ?>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php $el = get_field('h_list1', 'options');
          if ($el) { ?>
            <?php foreach ($el as $n => $it) { ?>
              <div class="menu__dropdown">
                <div class="dropdown dropdown--menu">
                  <div class="dropdown__header">
                    <h3 class="dropdown__title"><?= $it['t'] ?></h3>
                    <div class="dropdown__icon">
                      <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                    </div>
                  </div>
                  <div class="dropdown__content">
                    <div class="dropdown__wrapper">
                      <?php $elCh = $it['sub'];
                      if ($elCh) { ?>
                        <ul class="dropdown__list">
                          <?php foreach ($elCh as $itCh) { ?>
                            <?php $link = $itCh['link'];
                            if ($link) {
                              $url    = $link['url'] ?: '#';
                              $title  = $link['title'] ?: __('Подробнее', 'theme-sp');
                              $target = $link['target'] ? ' target="_blank"' : '';
                              ?>
                              <li class="dropdown__list-item">
                                <a href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                              </li>
                              <?php
                            } ?>
                          <?php } ?>
                        </ul>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          <?php } ?>

          <div class="menu__dropdown">
            <div class="dropdown">
              <div class="dropdown__header">
                <h3 class="dropdown__title"><?php the_field('h_cont_t', 'options') ?></h3>
                <div class="dropdown__icon">
                  <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                </div>
              </div>
              <div class="dropdown__content">
                <div class="dropdown__wrapper">
                  <div class="dropdown__contact-box">

                    <?php if ($el = get_field('h_tel', 'options')): ?>
                      <?php
                      $tel     = $el;
                      $telLink = preg_replace("/[^+\d]/", "", $tel);
                      ?>
                      <div class="dropdown__contact">
                        <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                        <div class="dropdown__contact-info"><?php the_field('h_cont_telT', 'options') ?></div>
                      </div>
                    <?php endif; ?>

                    <?php if ($el = get_field('h_cont_email', 'options')): ?>
                      <div class="dropdown__contact">
                        <a href="mailto:<?= $el ?>"><?= $el ?></a>
                      </div>
                    <?php endif; ?>

                    <div class="dropdown__socials-list">
                      <ul class="socials-list">
                        <?php $link = get_field('h_instagram', 'options');
                        if ($link) { ?>
                          <li class="socials-list__item">
                            <a href="<?= $link ?>" target="_blank">
                              <img src="<?= $dir ?>img/svg/icon-social-instagram.svg" inline-svg alt="">
                            </a>
                          </li>
                        <?php } ?>
                        <?php $link = get_field('h_facebook', 'options');
                        if ($link) { ?>
                          <li class="socials-list__item">
                            <a href="<?= $link ?>" target="_blank">
                              <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                            </a>
                          </li>
                        <?php } ?>
                        <?php $link = get_field('h_youtube', 'options');
                        if ($link) { ?>
                          <li class="socials-list__item">
                            <a href="<?= $link ?>" target="_blank">
                              <img src="<?= $dir ?>img/svg/icon-social-youtube.svg" inline-svg alt="">
                            </a>
                          </li>
                        <?php } ?>
                        <?php $link = get_field('h_linkedin', 'options');
                        if ($link) { ?>
                          <li class="socials-list__item">
                            <a href="<?= $link ?>" target="_blank">
                              <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                            </a>
                          </li>
                        <?php } ?>
                        <?php $link = get_field('h_telegram', 'options');
                        if ($link) { ?>
                          <li class="socials-list__item">
                            <a href="<?= $link ?>" target="_blank">
                              <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                            </a>
                          </li>
                        <?php } ?>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php $link = get_field('h_btn', 'options');
        if ($link) {
          $url    = $link['url'] ?: '#';
          $title  = $link['title'] ?: 'LINK';
          $target = $link['target'] ? ' target="_blank"' : '';
          ?>
          <div class="menu__mob-button">
            <a href="<?= $url ?>" class="button button--header"<?= $target ?>>
              <span class="button__name"><?= $title ?></span>
            </a>
          </div>
          <?php
        } ?>

      </div>
    </div>
  </header>