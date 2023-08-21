<?php
/*
Template Name: Портфолио
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();
get_header();

$terms  = get_terms([
  'taxonomy'   => 'cat-portfolio',
  'hide_empty' => true,
  'pad_counts' => true,
]);
$cities = get_terms([
  'taxonomy'   => 'cat-portfolio-city',
  'hide_empty' => true,
  'pad_counts' => true,
]);
?>

  <section class="c-head">
    <div class="c-head__wrapper block-wrapper" data-reveal-container>
      <?php breadcrumbСhead($h1, $ancestors); ?>

      <h1 class="c-head__title h2-title h2-title--orange" data-reveal="txt"><?= $h1 ?></h1>

      <div class="c-head__tabs-box" data-reveal="txt">
        <div class="tabs-box">
          <button class="tabs-box__item tab active" data-portfolio-category-button="all" data-reveal="txt">
            <span class="tab__name"><?php _e('Все категории', 'theme-sp') ?></span>
          </button>

          <?php if ($terms): ?>
            <?php foreach ($terms as $n => $it) {
              $n++; ?>
              <button class="tabs-box__item tab" data-portfolio-category-button="<?= $n ?>" data-reveal="txt">
                <span class="tab__name"><?= $it->name ?></span>
              </button>
            <?php } ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="c-head__sorting" data-reveal="txt">
        <div class="sorting category-sorting">
          <div class="sorting__select-box">

            <div class="sorting__options-container">
              <div class="sorting__options-wrapper">

                <div class="sorting__option" data-portfolio-category-button="all">
                  <span class="sorting__name"><?php _e('Все категории', 'theme-sp') ?></span>
                </div>

                <?php if ($terms): ?>
                  <?php foreach ($terms as $n => $it) {
                    $n++; ?>
                    <div class="sorting__option" data-portfolio-category-button="<?= $n ?>">
                      <span class="sorting__name"><?= $it->name ?></span>
                    </div>
                  <?php } ?>
                <?php endif; ?>

              </div>
            </div>

            <div class="sorting__selected">
              <span class="sorting__name"><?php _e('Все категории', 'theme-sp') ?></span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <main class="main main--sub">
    <section class="catalog-container">
      <div class="catalog-container__wrapper block-wrapper">
        <div class="catalog-container__storage storage storage--portfolio">

          <?php if ($terms): ?>
            <?php foreach ($terms as $n => $it) {
              $n++; ?>
              <div class="storage__block<?php if ($n < 2) echo ' show-block' ?>" data-portfolio-category-target="<?= $n ?>">

                <?php foreach ($cities as $city) {
                  $query = get_posts(array (
                    'tax_query'      => array (
                      'relation' => 'AND',
                      array (
                        'taxonomy' => $it->taxonomy,
                        'field'    => 'id',
                        'terms'    => $it->term_id
                      ),
                      array (
                        'taxonomy' => $city->taxonomy,
                        'field'    => 'id',
                        'terms'    => $city->term_id
                      ),
                    ),
                    'post_type'      => 't-portfolio',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1
                  ));
                  if ($query):
                    ?>
                    <div class="portfolio-box" data-reveal-container>
                      <div class="portfolio-box__info">
                        <h2 class="portfolio-box__title h3-title" data-reveal="txt"><?= $city->name ?></h2>
                      </div>
                      <div class="portfolio-box__set">
                        <?php
                        foreach ($query as $post) {
                          setup_postdata($post); ?>
                          <div class="portfolio-box__item portfolio-item" data-popup-button="project">
                            <div class="portflolio-item__thumb" data-reveal="img">
                              <div class="ar-image ar-image--square">
                                <?php $img = get_field('logo'); ?>
                                <img data-src="<?= $img['url'] ?: $dir . "img/photos/portfolio-image-1.png" ?>" class="lazy-img" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
                              </div>
                            </div>
                            <div class="portfolio-item__project">
                              <div class="project">
                                <?php if ($el = get_field('t') ?: get_the_title()): ?>
                                  <h2 class="project__title h4-title h4-title--bold"><?= $el ?></h2>
                                <?php endif; ?>
                                <div class="project__image">
                                  <div class="image image--h100">
                                    <?php $img = get_field('img'); ?>
                                    <img data-src="<?= $img['url'] ?: $dir . "img/photos/popup-project-image-1.png" ?>" class="lazy-img" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
                                  </div>
                                </div>
                                <div class="project__info">

                                  <?php if ($el = get_field('list_t')): ?>
                                    <h3 class="project__subtitle"><?= $el ?></h3>
                                  <?php endif; ?>
                                  <?php $el = get_field('list_list');
                                  if ($el) { ?>
                                    <ul class="project__list list">
                                      <?php foreach ($el as $listIt) { ?>
                                        <li class="list__item"><?= $listIt['t'] ?></li>
                                      <?php } ?>
                                    </ul>
                                  <?php } ?>
                                  <?php if ($img = get_field('list_img')): ?>
                                    <div class="project__icon">
                                      <img src="<?= $img['url'] ?: $dir . "img/svg/popup-project-icon-set.svg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
                                    </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php }

                        wp_reset_postdata();
                        ?>
                      </div>
                    </div>

                  <?php
                  endif;
                } ?>
              </div>
            <?php } ?>
          <?php endif; ?>

        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>
<?php
get_footer();