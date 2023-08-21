<?php
/*
Template Name: партнерам - Проектантам
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <section class="t-d-container">
      <div class="t-d-container__wrapper block-wrapper" data-reveal-container>
        <h1 class="t-d-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>
        <?php if ($el = get_field('d')): ?>
          <div class="t-d-container__description description" data-reveal="txt">
            <?= $el ?></div>
        <?php endif; ?>
      </div>
    </section>

    <section class="program-container">
      <div class="program-container__wrapper block-wrapper">
        <?php if ($el = get_field('t1')): ?>
          <h2 class="program-container__title h2-title" data-reveal="txt"><?= $el ?></h2>
        <?php endif; ?>

        <?php $el = get_field('list');
        if ($el) { ?>
          <div class="program-container__item-box" data-reveal-container>
            <?php foreach ($el as $it) { ?>
              <div class="program-container__item">
                <div class="program">
                  <?php if ($it['t']): ?>
                  <h3 class="program__title h4-title h4-title--bold" data-reveal="txt"><?= $it['t'] ?></h3>
                  <?php endif; ?>
                  <?php $elCh = $it['files'];
                  if ($elCh) { ?>
                    <div class="program__document-box">
                      <?php foreach ($elCh as $itCh) { ?>
                        <div class="program__document" data-reveal="img">
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
              </div>
            <?php } ?>
          </div>
        <?php } ?>

      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();