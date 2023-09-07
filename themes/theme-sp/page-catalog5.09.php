<?php
/*
Template Name: Каталог
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();

$taxonomy = 'cat-product';
$id       = get_the_ID();
$postType = 't-product';

global $wpdb;

$terms = $wpdb->get_results("SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy = 'cat-product' AND parent = '0' ORDER BY term_id ASC");
$ids   = [];
if ($terms):
  foreach ($terms as $it) {
    $itId = get_term($it->term_id);
    if (!$itId) continue;
    if (in_array($itId->term_id, $ids, true)) continue;
    else $ids[ $itId->term_id ] = get_term($itId);
  }
endif;
$terms = $ids;
function sort_nested_arrays ($array, $args = array ('votes' => 'desc'))
{
  usort($array, function ($a, $b) use ($args) {
    $res = 0;

    $a = (object)$a;
    $b = (object)$b;

    foreach ($args as $k => $v) {
      if ($a->$k == $b->$k) continue;

      $res = ($a->$k < $b->$k) ? -1 : 1;
      if ($v == 'desc') $res = -$res;
      break;
    }

    return $res;
  });

  return $array;
}

$terms  = sort_nested_arrays($terms, array ('term_order' => 'asc'));
$search = get_query_var('search');
?>

  <section class="c-head">
    <div class="c-head__wrapper block-wrapper" data-reveal-container>
      <?php breadcrumbСhead($h1, $ancestors); ?>
      <h1 class="c-head__title h2-title h2-title--white" data-reveal="txt"><?= $h1 ?></h1>

      <div class="c-head__search" data-reveal="txt">
        <form action="<?= get_pagenum_link(1) ?>" class="b-search">
          <input name="search" class="b-search__input" type="search" placeholder="<?php _e('Введите название', 'theme-sp') ?>..." value="<?= get_query_var('search') ?>">
          <button class="b-search__button" type="submit">
            <img src="<?= $dir ?>img/svg/icon-search.svg" inline-svg alt="">
          </button>
        </form>
      </div>

      <div class="c-head__tabs-box">
        <div class="tabs-box">
          <button class="tabs-box__item tab active" data-catalog-category-button="all" data-reveal="txt">
            <span class="tab__name"><?php _e('Все категории', 'theme-sp') ?></span>
          </button>
          <?php if ($terms): ?>
            <?php foreach ($terms as $n => $it) { ?>
                      <?php  var_dump($it );?>
              <button class="tabs-box__item tab" data-catalog-category-button="<?= $it->term_id ?>" data-reveal="txt">
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

                <div class="sorting__option" data-catalog-category-button="all">
                  <span class="sorting__name"><?php _e('Все категории', 'theme-sp') ?></span>
                </div>

                <?php if ($terms): ?>
                  <?php foreach ($terms as $n => $it) { ?>
                    <div class="sorting__option" data-catalog-category-button="<?= $it->term_id ?>">
                      <span class="sorting__name"><?= $it->name ?></span>
                    </div>
                  <?php } ?>
                <?php endif; ?>

              </div>
            </div>
            <div class="sorting__selected">
              <span class="sorting__name"><?php _e('Категории', 'theme-sp') ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main class="main main--sub">
    <section class="catalog-container">
      <div class="catalog-container__wrapper block-wrapper">
        <div class="catalog-container__storage storage">
          <?php if ($terms):

            if ($search) {
              function cf_search_join_ajax ($join)
              {
                global $wpdb;

                $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';

                return $join;
              }

              add_filter('posts_join', 'cf_search_join_ajax');

              function cf_search_where_ajax ($where)
              {
                global $pagenow, $wpdb;

                $where = preg_replace(
                  "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                  "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);

                return $where;
              }

              add_filter('posts_where', 'cf_search_where_ajax');

              function cf_search_distinct_ajax ($where)
              {
                global $wpdb;
                return "DISTINCT";
              }

              add_filter('posts_distinct', 'cf_search_distinct_ajax');
              ?>
              <?php foreach ($terms as $n => $it) { ?>
                <div class="storage__block<?php if ($n < 1) echo ' show-block' ?>" data-catalog-category-target="<?= $it->term_id ?>">
                  <h2 class="storage__title h3-title" data-reveal="txt"><?= $it->name ?></h2>

                  <?php
                  $chTerms        = get_terms([
                    'taxonomy'   => $taxonomy,
                    'parent'     => $it->term_id,
                    'hide_empty' => false,
                    'pad_counts' => true,
                    'order'      => 'ASC',
                    'orderby'    => 'term_order',
                  ]);
                  $notResultChild = 0;
                  if ($chTerms): ?>
                    <div class="storage__set" data-reveal-container>
                      <?php foreach ($chTerms as $nCh => $itCh) {
                        $hasPosts = new WP_Query(array (
                          'tax_query'      => array (
                            array (
                              'taxonomy' => $itCh->taxonomy,
                              'field'    => 'id',
                              'terms'    => $itCh->term_id // id tax
                            )
                          ),
                          'post_type'      => 't-product',
                          'post_status'    => 'publish',
                          'posts_per_page' => -1,
                          'paged'          => 1,
                          'orderby'        => 'data',
                          'order'          => 'DESC',
                          's'              => $search
                        ));
                        if ($hasPosts->have_posts()): $notResultChild++;
                          while ($hasPosts->have_posts()): $hasPosts->the_post();
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
                                <h3 class="p-item__title"><?= get_field('t') ?: get_the_title() ?></h3>
                              </a>
                            </div>
                          <?php endwhile;
                          wp_reset_postdata(); ?>
                        <?php endif; ?>
                      <?php } ?>
                    </div>
                    <?php
                    if (empty($notResultChild)): ?>
                      <p class="text-nomore" data-reveal="img"><?php _e('за вашим запросом в текущей категории совпадений не обнаружено...', 'theme-sp'); ?></p>
                    <?php endif; ?>
                  <?php else: ?>
                    <p class="text-nomore" data-reveal="img"><?php _e('идет наполнения раздела...', 'theme-sp'); ?></p>
                  <?php endif; ?>

                </div>
              <?php }
            }
            else { ?>
              <?php foreach ($terms as $n => $it) { ?>
                <div class="storage__block<?php if ($n < 1) echo ' show-block' ?>" data-catalog-category-target="<?= $it->term_id ?>">
                  <h2 class="storage__title h3-title" data-reveal="txt"><?= $it->name ?></h2>

                  <?php
                  $chTerms        = get_terms([
                    'taxonomy'   => $taxonomy,
                    'parent'     => $it->term_id,
                    'hide_empty' => false,
                    'pad_counts' => true,
                    'order'      => 'ASC',
                    //        'orderby'    => 'ID',
                    'orderby'    => 'term_order',
                    //'search'     => $search,
                    //'name__like'        => $search,
                  ]);
                  $notResultChild = 0;
                  if ($chTerms): ?>
                    <div class="storage__set" data-reveal-container>
                      <?php foreach ($chTerms as $nCh => $itCh) { ?>

                        <div class="storage__item" data-reveal="img">
                          <a href="<?= get_category_link($itCh->term_id) ?>" class="c-item">
                            <div class="c-item__bg">
                              <div class="ar-image" style="height: 0;">
                                <?php
                                $termAcf = ($itCh->taxonomy . '_' . $itCh->term_id);
                                $img     = get_field('img', $termAcf); ?>
                                <img data-src="<?= $img['url'] ?: $dir . "img/photos/category-item-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                                <div class="ar-image__overlay"></div>
                              </div>
                            </div>
                            <div class="c-item__info">
                              <h3 class="c-item__title h4-title h4-title--bold h4-title--white"><?= $itCh->name ?></h3>
                              <div class="c-item__icon">
                                <img src="<?= $dir ?>img/svg/icon-c-item.svg" inline-svg alt="">
                              </div>
                            </div>
                          </a>
                        </div>

                      <?php } ?>
                    </div>
                  <?php else: ?>
                    <p class="text-nomore" data-reveal="img"><?php _e('идет наполнения раздела...', 'theme-sp'); ?></p>
                  <?php endif; ?>

                </div>
              <?php }
            }
          endif; ?>
        </div>
      </div>
    </section>

    <section class="r-container r-container--sub bg">
      <div class="r-container__wrapper block-wrapper">
        <h2 class="r-container__title h2-title h2-title--orange" data-reveal="txt"><?php the_field('b_t') ?></h2>
        <div class="r-container__info">
          <?php if ($el = get_field('b_d')): ?>
            <div class="r-container__description description description--white" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>
          <?php if ($el = get_field('b_btn_file')): ?>
            <div class="r-container__button" data-reveal="img">
              <a href="<?= $el ?>" class="button button--hover-w" download>
                <span class="button__name"><?= get_field('b_btn_t') ?: 'Скачать' ?></span>
                <span class="button__icon">
                  <img src="<?= $dir ?>img/svg/icon-button-download.svg" inline-svg alt="">
                </span>
              </a>
            </div>
          <?php endif; ?>
        </div>
        <div class="r-container__image" data-reveal="img">
          <div class="ar-image ar-image--hd">
            <?php $img = get_field('b_img'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/random-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
      </div>
    </section>

    <section class="seo-container">
      <div class="seo-container__wrapper block-wrapper">
        <h2 class="seo-container__title h3-title" data-reveal="txt"><?php the_field('seo_t') ?></h2>
        <div class="seo-container__block" data-reveal="txt">
          <div class="seo-block">
            <div class="seo-block__content">
              <div class="seo-block__description"><?php the_field('seo_d') ?></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>
<?php
get_footer();

