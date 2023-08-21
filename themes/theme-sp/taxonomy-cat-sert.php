<?php
$dir = get_bloginfo("template_directory") . "/";

// data for category
$category = get_queried_object();
$taxonomy = $category->taxonomy; //'cat-sert'
$term_id  = $category->term_id;

$ancestors = $category->parent;

$term      = ($taxonomy . '_' . $term_id);
$term_name = $category->name;
$h1        = get_field('t', $term) ?: $term_name;
$id        = $term_id;
$outCountPost =  get_option('ps_per_page_sert') ?: get_option('posts_per_page');
$postType = 't-sert';
get_header();
?>
  <section class="sub-head sub-head--tech">
    <div class="sub-head__wrapper">
      <div class="sub-head__bg">
        <div class="sub-head__gradient"></div>
        <div class="sub-head__image" data-reveal="elem">
          <div class="image">
            <?php $img = get_field('cat_sert_fon', 'options'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/sub-head-image-2_orig.png" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
      </div>

      <div class="sub-head__content">
        <div class="sub-head__info">
          <?php breadcrumbTerm($h1, $ancestors); ?>
          <h1 class="sub-head__title h2-title h2-title--white" data-reveal="txt"><?= get_field('cat_sert_t', 'options') ?: 'Сертификаты' ?></h1>

          <?php $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'pad_counts' => true,
            'order'      => 'ASC',
            //        'orderby'    => 'ID',
            'orderby'    => 'term_order',
          ]);
          if ($terms):?>
            <div class="sub-head__tabs-box" data-reveal-container>
              <div class="tabs-box">
                <?php foreach ($terms as $n => $it) { ?>
                  <a href="<?= get_category_link($it->term_id) ?>" class="tabs-box__item tab<?php if ($it->term_id === $term_id) echo ' active' ?>" data-reveal="txt">
                    <span class="tab__name"><?= $it->name ?></span>
                  </a>
                <?php } ?>
              </div>
            </div>

            <div class="sub-head__sorting" data-reveal="txt">
              <div class="sorting tech-sorting">
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
      </div>
    </div>
  </section>

  <main class="main main--sub">
    <section class="tech-container tech-container--doc">
      <div class="tech-container__wrapper block-wrapper">

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
          <div class="tech-container__set" data-reveal-container>
            <?php
            while ($query->have_posts()): $query->the_post();
              $countView++;
              $file = get_field('file');
              $pdf = $file['subtype'] !== 'pdf'? ' download' : '';?>
              <div class="tech-container__item" data-reveal="img">
                <a href="<?= $file['url'] ?: '#' ?>" class="document" target="_blank"<?= $pdf ?>>
                  <div class="document__title"><?php the_title() ?></div>
                  <div class="document__button">
                    <div class="document__button-name"><?php _e('скачать','theme-sp') ?></div>
                    <div class="document__button-icon">
                      <img src="<?= $dir ?>img/svg/icon-button-figure.svg" inline-svg alt="">
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