<?php
$dir = get_bloginfo("template_directory") . "/";

// data for category
$category = get_queried_object();
$taxonomy = $category->taxonomy;
$term_id  = $category->term_id;

$ancestors = $category->parent;

$term      = ($taxonomy . '_' . $term_id);
$term_name = $category->cat_name;
$h1        = get_field('t', $term) ?: $term_name;
$id        = $term_id;

$outCountPost = get_option('posts_per_page');

?>

<section class="c-head">

  <div class="c-head__wrapper block-wrapper" data-reveal-container>
    <?php breadcrumbTerm($h1, $ancestors); ?>

    <?php $terms = get_terms([
      'taxonomy'   => 'category',
      'hide_empty' => false,
      'pad_counts' => true,
      'order'      => 'ASC',
      //        'orderby'    => 'ID',
      'orderby'    => 'term_order',
    ]);
    
    if ($terms):?>
    <h1 class="c-head__title h2-title h2-title--orange" data-reveal="txt"><?php echo $h1; ?></h1>
      <div class="c-head__tabs-box">
        <div class="tabs-box">
          <?php foreach ($terms as $n => $it) { ?>
            <a href="<?= get_category_link($it->term_id) ?>" class="tabs-box__item tab<?php if ($it->term_id === $term_id) echo ' active' ?>" data-reveal="txt">
              <span class="tab__name"><?= $it->name ?></span>
            </a>
          <?php } ?>
        </div>
      </div>

      <div class="c-head__sorting" data-reveal="txt">
        <div class="sorting category-sorting">
          <div class="sorting__select-box">
            <div class="sorting__options-container">
              <div class="sorting__options-wrapper">

                <?php foreach ($terms as $n => $it) { ?>
                  <a href="<?= get_category_link($it->term_id) ?>" class="sorting__option">
                    <span class="sorting__name"><?= $it->name ?></span>
                  </a>
                <?php } ?>

              </div>
            </div>
            <?php foreach ($terms as $n => $it) {
              if ($it->term_id === $term_id):?>
                <div class="sorting__selected">
                  <span class="sorting__name"><?= $it->name ?></span>
                </div>
              <?php endif;
            } ?>
          </div>
        </div>
      </div>

    <?php endif; ?>
  </div>
</section>

<main class="main main--sub">
  <section class="blog-container">
    <div class="blog-container__wrapper block-wrapper">
      <?php
      $current_page = 1;
      if (get_query_var('paged')) $current_page = get_query_var('paged');
      else if (get_query_var('page')) $current_page = get_query_var('page');

      $args = array (
        'taxonomy' => 'category',
        'cat'            => $term_id,
        'posts_per_page' => $outCountPost,
        'paged'          => $current_page,
        'post_type'      => 'post',
        'post_status'    => 'publish',
      );

      $query     = new WP_Query($args);
      $countView = 0;
      if ($current_page > 1) $countView = $outCountPost * ($current_page - 1);

      if ($query->have_posts()):?>
        <div class="blog-container__set" data-reveal-container>
          <?php
          while ($query->have_posts()): $query->the_post();
            $countView++;
            $post_categories2  = get_post_primary_category(get_the_ID(), 'category');
            $primary_category2 = $post_categories2['primary_category']; ?>
            <div class="blog-container__item" data-reveal="img">
              <a href="<?php the_permalink() ?>" class="news-item">
                <div class="news-item__bg">
                  <div class="news-item__image">
                    <?php $img = get_field('img'); ?>
                    <img data-src="<?= $img['url'] ?: $dir . "img/photos/news-item-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                  </div>
                  <div class="news-item__overlay"></div>
                </div>
                <div class="news-item__content">
                  <div class="news-item__tagline">
                    <span class="news-item__tag news-item__tag_date"><?php the_time('d.m.Y') ?></span>
                    <span class="news-item__tag news-item__tag_div">•</span>
                    <span class="news-item__tag news-item__tag_type"><?= $primary_category2->name; ?></span>
                  </div>
                  <h3 class="news-item__title"><?= get_field('t') ?: get_the_title() ?></h3>
                  <div class="news-item__button">
                    <button class="inline-btn">
                      <span class="inline-btn__name"><?php _e('читать полностью', 'theme-sp') ?></span>
                      <span class="inline-btn__icon">
                        <img src="<?= $dir ?>img/svg/icon-inline-btn--full.svg" inline-svg alt="">
                      </span>
                    </button>
                  </div>
                </div>
              </a>
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
      <?php
      else: ?>
        <p class="text-nomore" data-reveal="img"><?php _e('идет наполнения раздела...', 'theme-sp'); ?></p>
      <?php endif; ?>

      <div class="blog-container__pagination" data-reveal="img">
        <div class="pagination-box">

          <div class="pagination-box__result"><?php _e('Показано', 'theme-sp') ?>
            <span class="pagination-box__result-cur"><?= $countView ?></span>
            <?php _e('из', 'theme-sp') ?>
            <span class="pagination-box__result-total"><?= $query->found_posts ?></span>
          </div>

          <?php
          if (function_exists('ps_pagenavi')) {
            $pagRes = ps_pagenavi($query);
            if ($pagRes):?>
              <div class="pagination-box__pagination"><?= $pagRes ?></div>
            <?php endif;
          } ?>

        </div>
      </div>

    </div>
  </section>

  <?php require_once get_template_directory() . '/template/subscribe.php' ?>
</main>