<?php
/*
Template Name: партнерам - Сотрудничество
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <?php require_once get_template_directory() . '/template/numbers.php' ?>

    <section class="p1-container">
      <div class="p1-container__wrapper block-wrapper">
        <h2 class="p1-container__title h2-title" data-reveal="txt"><?php the_field('b2_t') ?></h2>
        <div class="p1-container__image-box" data-reveal="img">
          <div class="image">
            <?php $img = get_field('b2_img'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/random-image-2.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
        <?php if ($el = get_field('b2_d')): ?>
          <div class="p1-container__description description" data-reveal="txt">
            <?= $el ?>
          </div>
        <?php endif; ?>
        <?php $el = get_field('b2_list');
        if ($el) { ?>

          <div class="p1-container__piece-box" data-reveal-container>
            <?php foreach ($el as $it) { ?>
              <div class="p1-container__piece" data-reveal="txt">
                <div class="p1-container__piece-icon">
                  <?php $img = $it['img']; ?>
                  <img src="<?= $img['url'] ?: $dir . "img/svg/icon-piece-1.svg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
                </div>
                <div class="p1-container__piece-caption"><?= $it['t'] ?></div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>

    <section class="partner-container">
      <div class="partner-container__wrapper block-wrapper">
        <h2 class="partner-container__title h2-title" data-reveal="txt"><?php the_field('b3_t') ?></h2>

        <?php $el = get_field('b3_list');
        if ($el) { ?>
          <div class="partner-container__set" data-reveal-container>
            <?php foreach ($el as $it) { ?>
              <?php $link = $it['link'];
              if ($link) {
                $url    = $link['url'] ?: '#';
                $title  = $link['title'] ?: __('Подробнее', 'theme-sp');
                $target = $link['target'] ? ' target="_blank"' : '';
                ?>
                <div class="partner-container__item" data-reveal="img">
                  <a href="<?= $url ?>" class="partner-item"<?= $target ?>>
                    <div class="partner-item__bg">
                      <div class="ar-image">
                        <?php $img = $it['img']; ?>
                        <img data-src="<?= $img['url'] ?: $dir . "img/photos/partner-card-image-1.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                        <div class="ar-image__overlay"></div>
                      </div>
                    </div>
                    <div class="partner-item__info">
                      <h3 class="partner-item__title h4-title h4-title--bold h4-title--white"><?= $title ?></h3>
                      <div class="partner-item__icon">
                        <img src="<?= $dir ?>img/svg/icon-partner-item-arrow.svg" inline-svg alt="">
                      </div>
                    </div>
                  </a>
                </div>
                <?php
              } ?>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();