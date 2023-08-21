<?php
/*
Template Name: Мар.под. - Программа лояльности
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <section class="gift-container">
      <div class="gift-container__wrapper block-wrapper">
        <div class="gift-container__info" data-reveal-container>
          <h1 class="gift-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>

          <div class="gift-container__description description" data-reveal="txt"><?php the_field('d') ?></div>
          <?php if ($el = get_field('d1')): ?>
            <div class="gift-container__description description" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>

          <?php if ($el = get_field('btn_t')): ?>
            <div class="gift-container__button" data-reveal="txt">
              <a href="<?= get_field('btn_link') ?: '#' ?>" class="button" target="_blank" rel="nofollow">
                <span class="button__name"><?= $el ?></span>
                <span class="button__icon">
                  <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
                </span>
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div class="gift-container__gift-box gift-box">
          <?php if ($el = get_field('list_t')): ?>
            <h3 class="gift-box__title h3-title h3-title--orange" data-reveal="txt"><?= $el ?></h3>
          <?php endif; ?>
          <?php if ($el = get_field('list_d')): ?>
            <div class="gift-box__description description description--gray" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>
          <?php $el = get_field('list_img');
          if ($el) { ?>
            <div class="gift-box__set" data-reveal-container>
              <?php foreach ($el as $it) { ?>
                <div class="gift-box__item gift-item" data-reveal="img">
                  <div class="gift-item__image">
                    <div class="ar-image">
                      <?php $img = $it['img'];
                      if ($img['url']): ?>
                        <img data-src="<?= $img['url'] ?: $dir . "img/photos/gift-item-image-1.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                      <?php endif; ?>
                    </div>
                  </div>
                  <h4 class="gift-item__title h4-title h4-title--orange"><?= $it['t'] ?></h4>
                  <div class="gift-item__caption"><?= $it['t1'] ?></div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>

        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();