<?php
/*
Template Name: Маркетинговая поддержка
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

        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('d') ?></div>

        <div class="t-d-container__m-set" data-reveal-container>

          <?php
          $query = get_children([
            'post_parent' => get_the_ID(),
            'post_type'   => 'page',
            'numberposts' => -1,
            'post_status' => 'publish',
            'order' => 'ASC',
            'orderby' => 'menu_order'
          ]);
          if ($query):?>

          <?php
            foreach ($query as $n => $post) {
              setup_postdata($post);
              $n++;
              ?>
              <div class="t-d-container__m-item" data-reveal="img">
                <a href="<?php the_permalink() ?>" class="m-item">
                  <div class="m-item__bg">
                    <div class="ar-image">
                      <?php $img = get_field('img'); ?>
                      <img data-src="<?= $img['url'] ?: $dir . "img/photos/marketing-item-image-1.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                      <div class="ar-image__overlay"></div>
                    </div>
                  </div>
                  <div class="m-item__info">
                    <h3 class="m-item__title h4-title h4-title--bold"><?= get_field('t')?: get_the_title() ?></h3>
                    <div class="m-item__icon">
                      <img src="<?= $dir ?>img/svg/icon-partner-item-arrow.svg" inline-svg alt="">
                    </div>
                  </div>
                </a>
              </div>
            <?php }

            wp_reset_postdata();?>

            <?php endif; ?>
        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();