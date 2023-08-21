<?php
/*
Template Name: Тех. - Каталоги, прайсы
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <section class="t-d-container t-d-container--c2">
      <div class="t-d-container__wrapper block-wrapper">
        <h2 class="t-d-container__title h2-title" data-reveal="txt"><?= $h1 ?></h2>

        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('d') ?></div>

        <?php $el = get_field('list');
        if($el){ ?>
        <div class="t-d-container__price-set" data-reveal-container>
          <?php foreach($el as $it) { ?>
            <div class="t-d-container__price-item" data-reveal="img">
              <a href="<?= $it['file'] ?: '#' ?>" target="_blank" class="price-item">
                <div class="price-item__date"><?= $it['date'] ?></div>
                <div class="price-item__caption">
                  <h3 class="price-item__title h4-title h4-title--bold"><?= $it['t'] ?></h3>
                  <div class="price-item__icon">
                    <img src="<?= $dir ?>img/svg/icon-c-item.svg" inline-svg alt="">
                  </div>
                </div>
              </a>
            </div>
          <?php }  ?>
        </div>
        <?php }  ?>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();