<?php
$dir = get_bloginfo("template_directory") . "/";

// data for category
$category = get_queried_object();
$taxonomy = $category->taxonomy; //'cat-instruction'
$term_id  = $category->term_id;

$ancestors = $category->parent;

$term         = ($taxonomy . '_' . $term_id);
$term_name    = $category->name;
$h1           = get_field('t', $term) ?: $term_name;
$id           = $term_id;
$outCountPost = get_option('ps_per_page_instruction') ?: get_option('posts_per_page');
$postType     = 't-instruction';
get_header();
?>

  <section class="c-head">
    <div class="c-head__wrapper block-wrapper" data-reveal-container>
      <?php breadcrumbСhead($h1, $ancestors); ?>

      <h1 class="c-head__title h2-title h2-title--white" data-reveal="txt"><?= get_field('cat_instruction_t', 'options') ?: 'Відеоінструкції' ?></h1>

      <div class="c-head__search" data-reveal="txt">
        <form action="<?= get_pagenum_link(1) ?>" class="b-search">
          <input name="search" class="b-search__input" type="search" placeholder="<?php _e('Введіть назву', 'theme-sp') ?>..." value="<?= get_query_var('search') ?>">
          <button class="b-search__button" type="submit">
            <img src="<?= $dir ?>img/svg/icon-search.svg" inline-svg alt="">
          </button>
        </form>
      </div>

      <?php $terms = get_terms([
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
        'pad_counts' => true,
        'order'      => 'ASC',
//        'orderby'    => 'ID',
        'orderby'    => 'term_order',
      ]);
      if ($terms):?>
        <div class="c-head__tabs-box" data-reveal-container>
          <div class="tabs-box">
            <?php foreach ($terms as $n => $it) { ?>
              <a href="<?= get_category_link($it->term_id) ?>" class="tabs-box__item tab<?php if ($it->term_id === $term_id) echo ' active' ?>" data-reveal="txt">
                <span class="tab__name"><?= $it->name ?></span>
              </a>
            <?php } ?>
          </div>
        </div>

        <div class="c-head__sorting" data-reveal="txt">
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
  </section>

  <main class="main main--sub">

    <section class="tech-container">
      <div class="tech-container__wrapper block-wrapper">
        <?php
        $search = get_query_var('search');
        $current_page = 1;
        if (get_query_var('paged')) $current_page = get_query_var('paged');
        else if (get_query_var('page')) $current_page = get_query_var('page');
        $args         = array (
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
          'orderby'        => 'data',
          'order'          => 'DESC',
          's'              => $search,
        );

        $query     = new WP_Query($args);
        $countView = 0;
        if ($current_page > 1) $countView = $outCountPost * ($current_page - 1);

        if ($query->have_posts()):?>
          <div class="tech-container__set" data-reveal-container>
            <?php
            while ($query->have_posts()): $query->the_post();
              $countView++; ?>
              <div class="tech-container__item" data-reveal="img">
                <div class="video-item" data-modal-button="video">
                  <div class="video-item__thumb">
                    <div class="ar-image">
                      <?php $img = get_field('img'); ?>
                      <img data-src="<?= $img['url'] ?: $dir . "img/photos/category-item-image-12.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                      <div class="ar-image__overlay"></div>
                    </div>
                    <div class="video-item__play-btn">
                      <img src="<?= $dir ?>img/svg/icon-video-play.svg" inline-svg alt="">
                    </div>
                  </div>
                  <h3 class="video-item__title h4-title"><?php the_title() ?></h3>
                  <div class="video-item__video" data-video-source>
                    <div class="video">
                      <?php if ($youtubeLink = get_field('youtube')):
                        $youtube = strstr($youtubeLink, '=');
                        if ($youtube !== false) {
                          $posAmpersand = strpos($youtube, '&');
                          if ($posAmpersand !== false) {
                            $youtube = substr($youtube, 1, $posAmpersand - 1);
                          }
                          $youtube = ltrim($youtube, '=');
                        }
                        else {
                          $youtube = strstr($youtubeLink, 'embed/');
                          if ($youtube !== false) {
                            $youtube = ltrim($youtube, 'embed/');
                          }
                        }
                        if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') && !is_admin()) {
                          ?>
                          <iframe class="video__video" src="" data-video-src="https://www.youtube.com/embed/<?= $youtube ?: "680mP9pYp_0" ?>?autoplay=1&modestbranding=1&rel=0&hl=sv" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen allowTransparency="true"></iframe>
                          <!-- <video class="video__video" src="" data-video-src="/video/video-1.m4v" autoplay controls></video> -->
                        <?php } endif; ?>

                      <div class="video__caption" data-video-play-button>
                        <div class="video__poster">
                          <div class="image image--h100">
                            <?php $img = get_field('img1'); ?>
                            <img data-src="<?= $img['url'] ?: $dir . "img/photos/category-item-image-4.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                          </div>
                          <div class="video__overlay"></div>
                        </div>
                        <div class="video__icon">
                          <img src="<?= $dir ?>img/svg/icon-video-play.svg" inline-svg alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          </div>
        <?php
        else: ?>
        <?php if($search): ?>
            <p class="text-nomore" data-reveal="img"><?php _e('за вашим запросом совпадений не обнаружено...', 'theme-sp'); ?></p>
        <?php else: ?>
            <p class="text-nomore" data-reveal="img"><?php _e('идет наполнения раздела...', 'theme-sp'); ?></p>
        <?php endif?>
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