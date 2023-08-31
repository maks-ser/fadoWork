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
    <link rel="canonical" href="<?= home_url() ?>">
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

          <div class="header__lang">
              <?php echo do_shortcode('[language-switcher]') ?>
         </div>
      </div>
    </div>

    <nav class="navbar" data-reveal="elem">
      <div class="navbar__wrapper block-wrapper">
        <div class="navbar__logo">
          <a href="<?= home_url() ?>">
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
          <div class="mx-search">
              <a href="#" class="mx__seach-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0749 12.1127C15.4917 12.1127 11.7763 15.8282 11.7763 20.4114C11.7763 24.9945 15.4917 28.71 20.0749 28.71C24.6581 28.71 28.3735 24.9945 28.3735 20.4114C28.3735 15.8282 24.6581 12.1127 20.0749 12.1127ZM9.27954 20.4114C9.27954 14.4492 14.1128 9.616 20.0749 9.616C26.037 9.616 30.8702 14.4492 30.8702 20.4114C30.8702 26.3735 26.037 31.2067 20.0749 31.2067C14.1128 31.2067 9.27954 26.3735 9.27954 20.4114Z" fill="#787878"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M31.5886 33.4361L26.0691 27.9166L27.8346 26.1511L33.3541 31.6706L31.5886 33.4361Z" fill="#787878"/>
                  </svg>
              </a>
              <div class="menu__search">
                  <form class="b-search" role="search" method="get" action="<?= home_url() ?>" novalidate>
                      <input name="s" type="text" class="b-search__input" required placeholder="<?php _e('Поиск по сайту...', 'theme-sp') ?>" value="">
                      <button type="submit" class="b-search__button">
                          <img src="<?= $dir ?>img/svg/icon-search.svg" inline-svg alt="">
                      </button>
                      <a href="#" class="search-close" id="m-search-close">
                          <svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43" fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7604 29.1369L11.6438 13.0203L13.7651 10.899L29.8817 27.0155L27.7604 29.1369Z" fill="#787878"/>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M29.8817 13.0203L13.7651 29.1369L11.6438 27.0156L27.7603 10.899L29.8817 13.0203Z" fill="#787878"/>
                          </svg>
                      </a>
                  </form>
              </div>
          </div>
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
          <form class="b-search" role="search" method="get" action="<?= home_url() ?>" novalidate>
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
            wp_nav_menu( [
                    'menu'            => 'lang',
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'lang-select',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
            ] );
            ?>


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