<?php
/*
Template Name: Мар.под. - Брендбук
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <section class="brandbook-container">
      <div class="brandbook-container__wrapper block-wrapper" data-reveal-container>
        <h1 class="brandbook-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>

        <?php $el = get_field('list');
        if ($el) { ?>

          <?php foreach ($el as $it) { ?>

            <div class="brandbook-container__block brandbook-block">

              <?php if ($it['t']): ?>
                <h2 class="brandbook-block__title h4-title h4-title--bold" data-reveal="txt"><?= $it['t'] ?></h2>
              <?php endif; ?>
              <?php if ($it['d']): ?>
                <div class="brandbook-block__info">
                  <div class="brandbook-block__description description" data-reveal="txt"><?= $it['d'] ?></div>
                </div>
              <?php endif; ?>

              <div class="brandbook-block__box">
                <?php $elCh = $it['logo'];
                if ($elCh) { ?>
                  <div class="brandbook-block__item-box">
                    <?php foreach ($elCh as $itCh) { ?>
                      <div class="brandbook-block__item" data-reveal="img">
                        <div class="logo-item">
                          <div class="ar-image">
                            <?php $img = $itCh['img']; ?>
                            <img data-src="<?= $img['url'] ?: $dir . "img/photos/brandbook-image-1.png" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>


                <?php $elCh = $it['colors'];
                if ($elCh) { ?>
                  <div class="brandbook-block__item-box">
                    <?php foreach ($elCh as $itCh) { ?>
                      <div class="brandbook-block__item" data-reveal="img">
                        <div class="color-item">
                          <div class="color-item__color" style="background-color: <?= $itCh['color']?: '#EC6A2D' ?>"></div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>

                <?php $elCh = $it['files'];
                if ($elCh) { ?>
                  <div class="brandbook-block__document-box">
                    <?php foreach ($elCh as $itCh) { ?>
                      <div class="brandbook-block__document" data-reveal="img">
                        <a href="<?= $itCh['file'] ?: '#' ?>" class="document" download>
                          <div class="document__title"><?= $itCh['t'] ?></div>
                          <div class="document__button">
                            <div class="document__button-name"><?php _e('скачать', 'theme-sp') ?></div>
                            <div class="document__button-icon">
                              <img src="<?= $dir ?>img/svg/icon-button-figure.svg" inline-svg alt="">
                            </div>
                          </div>
                        </a>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>

              <?php if ($it['btn_file']): ?>
                <div class="brandbook-block__button" data-reveal="txt">
                  <a href="<?= $it['btn_file'] ?: '#' ?>" class="button" download>
                    <span class="button__name"><?= $it['btn_t'] ?: 'Скачать' ?></span>
                    <span class="button__icon">
                      <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
                    </span>
                  </a>
                </div>
              <?php endif; ?>

            </div>
          <?php } ?>

        <?php } ?>

      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();