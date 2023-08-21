<?php
/*
Template Name: Мар.под. - Общая
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <section class="sub-marketing-container">
      <div class="sub-marketing-container__wrapper block-wrapper">
        <h1 class="sub-marketing-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>

        <div class="sub-marketing-container__description-box">
          <div class="sub-marketing-container__description description" data-reveal="txt"><?php the_field('d') ?></div>
          <?php if ($el = get_field('d1')): ?>
            <div class="sub-marketing-container__description description" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>
        </div>

        <?php $el = get_field('list');
        if ($el) { ?>

          <?php foreach ($el as $it) { ?>

            <div class="sub-marketing-container__block sub-marketing-block" data-reveal-container>
              <?php if ($it['t']): ?>
                <h2 class="sub-marketing-block__title" data-reveal="txt"><?= $it['t'] ?></h2>
              <?php endif; ?>
              <?php if ($it['d']): ?>
                <div class="sub-marketing-block__info">
                  <div class="sub-marketing-block__description description" data-reveal="txt"><?= $it['d'] ?></div>
                </div>
              <?php endif; ?>
              <div class="sub-marketing-block__box">
                <?php $elCh = $it['img'];
                if ($elCh) { ?>
                  <div class="sub-marketing-block__image-box">
                    <?php foreach ($elCh as $itCh) { ?>
                      <div class="sub-marketing-block__image" data-reveal="img">
                        <div class="ar-image">
                          <?php $img = $itCh['img']; ?>
                          <img data-src="<?= $img['url'] ?: $dir . "img/photos/sub-marketing-image-1.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
                <?php if ($it['d1']): ?>
                  <div class="sub-marketing-block__box-description" data-reveal="txt"><?= $it['d1'] ?></div>
                <?php endif; ?>
              </div>
            </div>
          <?php } ?>

        <?php } ?>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();