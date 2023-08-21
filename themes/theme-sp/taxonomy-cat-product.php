<?php
$dir = get_bloginfo("template_directory") . "/";

// data for category
$category = get_queried_object();
$taxonomy = $category->taxonomy; //'cat-product'
$term_id  = $category->term_id;

$ancestors = get_field('cat_product_page', 'options') ?: pll_get_post(783); // page Catalog

$term      = ($taxonomy . '_' . $term_id);
$term_name = $category->name;
$h1        = get_field('t', $term) ?: $term_name;
$id        = $term_id;
$outCountPost =  get_option('ps_per_page_product') ?: get_option('posts_per_page');
$postType = 't-product';
$description = category_description( $id );
get_header();
?>
  <section class="sub-head">
    <div class="sub-head__wrapper">
      <div class="sub-head__bg">
        <div class="sub-head__gradient"></div>
        <div class="sub-head__image" data-reveal="elem">
          <div class="image">
            <?php $img = get_field('img', $term); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/sub-head-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
      </div>

      <div class="sub-head__content">
        <div class="sub-head__info">
          <?php breadcrumbSub($h1, $ancestors); ?>
          <h1 class="sub-head__title h2-title h2-title--white" data-reveal="txt"><?= $h1 ?></h1>
          <?php if($description): ?>
          <div class="sub-head__description description description--gray" data-reveal="txt"><?= $description ?></div>
          <?php endif?>
        </div>
      </div>
    </div>
  </section>

  <main class="main main--sub">
    <section class="item-container">
      <div class="item-container__wrapper block-wrapper">
        <?php
        $current_page = 1;
        if (get_query_var('paged')) $current_page = get_query_var('paged');
        else if (get_query_var('page')) $current_page = get_query_var('page');
        $args = array (
          'tax_query'      => array (
            array (
              'taxonomy' => $taxonomy,
              'field'    => 'id',
              'terms'    => $term_id // id tax
            )
          ),
          'post_type'      => $postType,
          'post_status'    => 'publish',
          'posts_per_page' => $outCountPost,
          'paged'          => $current_page,
          'orderby'    => 'data',
          'order'    => 'DESC',
        );

        $query     = new WP_Query($args);
        $countView = 0;
        if($current_page > 1) $countView = $outCountPost * ($current_page - 1);

        if ($query->have_posts()):?>
          <div class="item-container__set" data-reveal-container>
            <?php
            while ($query->have_posts()): $query->the_post();
              $countView++; ?>
              <div class="item-container__item" data-reveal="img">
                <a href="<?php the_permalink() ?>" class="p-item">
                  <div class="p-item__content">
                    <div class="p-item__bg">
                      <div class="ar-image">
                        <?php $img = get_field('img'); ?>
                        <img data-src="<?= $img['url'] ?: $dir . "img/photos/category-item-image-16.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                        <div class="ar-image__overlay"></div>
                      </div>
                    </div>
                    <div class="p-item__info">
                      <?php if ($el = get_field('sku')): ?>
                        <div class="p-item__article"><?= $el ?></div>
                      <?php endif; ?>
                      <div class="p-item__icon">
                        <img src="<?= $dir ?>img/svg/icon-c-item.svg" inline-svg alt="">
                      </div>
                    </div>
                  </div>
                  <h3 class="p-item__title"><?= get_field('t')?: get_the_title() ?></h3>
                </a>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          </div>
        <?php
        else: ?>
          <p class="text-nomore" data-reveal="img"><?php _e('идет наполнения раздела...', 'theme-sp'); ?></p>
        <?php endif; ?>
        <div class="tech-container__pagination" data-reveal="img">
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

<?php
get_footer();