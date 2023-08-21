<?php
/*
Template Name: FAQ & Гарантии
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors); ?>

    <section class="info-container">
      <div class="info-container__wrapper block-wrapper">
        <h1 class="info-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>

        <?php $el = get_field('list');
        if ($el) { ?>
          <div class="info-container__list">
            <ul class="q-list">
              <?php foreach ($el as $n => $it) { ?>
                <li class="q-list__item<?php if ($n < 1) echo ' active' ?>" data-reveal="txt">
                  <a href="#a-<?= $n ?>"><?= $it['tab'] ?></a>
                </li>
              <?php } ?>
            </ul>
          </div>

          <div class="info-container__box">
            <?php foreach ($el as $n => $it) { ?>
              <div class="info-container__box-item" data-reveal="elem">
                <a id="a-<?= $n ?>" class="anchor"></a>
                <div class="a-box">
                  <?php if ($it['t']): ?>
                    <h2 class="a-box__title"><?= $it['t'] ?></h2>
                  <?php endif; ?>
                  <?php if ($it['d']): ?>
                    <div class="a-box__description description"><?= $it['d'] ?></div>
                  <?php endif; ?>
                  <?php $elCh = $it['list'];
                  if ($elCh) { ?>
                    <ul class="a-box__list list">
                      <?php foreach ($elCh as $itCh) { ?>
                        <li class="list__item"><?= $itCh['t'] ?></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>
                  <?php if ($it['d1']): ?>
                    <div class="a-box__description description"><?= $it['d1'] ?></div>
                  <?php endif; ?>
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