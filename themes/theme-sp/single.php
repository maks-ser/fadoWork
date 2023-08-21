<?php
/*
Template Name: новина
Template Post Type: post
*/
$dir              = get_bloginfo("template_directory") . "/";
$h1               = get_field('t') ?: get_the_title();
$id               = get_the_ID();
$post_categories  = get_post_primary_category($id, 'category');
$primary_category = $post_categories['primary_category'];
$mainCatId        = $primary_category->term_id;
$ancestors        = $mainCatId ?: pll_get_term(1);
get_header();
?>

  <section class="c-head c-head--blog">
    <div class="c-head__wrapper block-wrapper">

      <?php breadcrumbTerm($h1, $ancestors) ?>

      <h1 class="c-head__title h2-title h2-title--orange" data-reveal="txt"><?= $h1 ?></h1>

      <div class="c-head__button" data-reveal="txt">
        <a href="<?= get_category_link($ancestors) ?>" class="back-btn">
          <span class="back-btn__icon">
            <img src="<?= $dir ?>img/svg/icon-back-btn.svg" inline-svg alt="">
          </span>
          <span class="back-btn__name"><?php _e('повернутись', 'theme-sp') ?></span>
        </a>
      </div>

    </div>
  </section>

  <main class="main main--blog">
    <section class="page-container">
      <div class="page-container__wrapper block-wrapper">

        <?php
        $query = get_posts([
          'numberposts'      => 3,
          'category'         => $ancestors,
          'orderby'          => 'date',
          'order'            => 'DESC',
          'exclude'          => [$id],
          'post_type'        => 'post',
          'post_status'      => 'publish',
          'suppress_filters' => true,
        ]);
        if ($query):?>
          <div class="page-container__sidebar">
            <aside class="other-box">
              <h2 class="other-box__title h4-title h4-title--bold h4-title--orange" data-reveal="txt"><?php _e('Схожі новини', 'theme-sp') ?></h2>
              <?php
              foreach ($query as $post) {
                setup_postdata($post);
                $post_categories1  = get_post_primary_category(get_the_ID(), 'category');
                $primary_category1 = $post_categories1['primary_category'];
                ?>
                <div class="other-box__item" data-reveal="img">
                  <a href="<?php the_permalink() ?>" class="news-item">
                    <div class="news-item__tagline">
                      <span class="news-item__tag news-item__tag_date"><?php the_time('d.m.Y') ?></span>
                      <span class="news-item__tag news-item__tag_div">•</span>
                      <span class="news-item__tag news-item__tag_type"><?= $primary_category1->name; ?></span>
                    </div>
                    <h3 class="news-item__title"><?= get_field('t')?: get_the_title() ?></h3>
                    <div class="news-item__button">
                      <button class="inline-btn">
                        <span class="inline-btn__name"><?php _e('читати далі','theme-sp') ?></span>
                        <span class="inline-btn__icon">
                          <img src="<?= $dir ?>img/svg/icon-inline-btn.svg" inline-svg alt="">
                        </span>
                      </button>
                    </div>
                  </a>
                </div>
              <?php }

              wp_reset_postdata(); ?>
            </aside>
          </div>
        <?php endif; ?>

        <div class="page-container__content">
          <div class="page-container__image" data-reveal="img">
            <div class="image">
              <?php $img = get_field('img'); ?>
              <img data-src="<?= $img['url'] ?: $dir . "img/photos/news-item-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
            </div>
          </div>
          <div class="page-container__tagline" data-reveal="img">
            <span class="page-container__tag page-container__tag_date"><?php the_time('d.m.Y') ?></span>
            <span class="page-container__tag page-container__tag_div">•</span>
            <span class="page-container__tag page-container__tag_type"><?= $primary_category->name; ?></span>
          </div>

          <div class="page-container__article" data-reveal="img">
            <article class="article"><?php the_field('d') ?></article>
          </div>

          <div class="page-container__socials-list" data-reveal="img">
            <span><?php _e('Поделиться', 'theme-sp') ?>:</span>
            <ul class="socials-list">
              <li class="socials-list__item">
                <a href="viber://forward?text=<?php the_permalink(); ?> <?= $h1 ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-viber.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="https://telegram.me/share/url?url=<?php the_permalink(); ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="whatsapp://send?text=<?php the_permalink(); ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-whatsapp.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php the_permalink(); ?>&p[title]=<?= $h1 ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?= $h1; ?>&amp;hashtags=my_hashtag" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-twitter.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?= $h1; ?>&summary=&source=<?php bloginfo('name'); ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <?php
    $query = get_posts([
      'numberposts'      => 3,
      'orderby'          => 'rand',
      'order'            => 'DESC',
      'exclude'          => [$id],
      'post_type'        => 'post',
      'post_status'      => 'publish',
      'suppress_filters' => true,
    ]);
    if ($query):?>
      <section class="news-container">
        <div class="news-container__wrapper block-wrapper">
          <h2 class="news-container__title h2-title" data-reveal="txt"><?php _e('Інші новини','theme-sp') ?></h2>
          <div class="news-container__set" data-reveal-container>
            <?php
            foreach ($query as $post) {
              setup_postdata($post);
              $post_categories2  = get_post_primary_category(get_the_ID(), 'category');
              $primary_category2 = $post_categories2['primary_category'];
              ?>

              <div class="news-container__item" data-reveal="img">
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
                    <h3 class="news-item__title"><?= get_field('t')?: get_the_title() ?></h3>
                    <div class="news-item__button">
                      <button class="inline-btn">
                        <span class="inline-btn__name"><?php _e('читать полностью','theme-sp') ?></span>
                        <span class="inline-btn__icon">
                          <img src="<?= $dir ?>img/svg/icon-inline-btn--full.svg" inline-svg alt="">
                        </span>
                      </button>
                    </div>
                  </div>
                </a>
              </div>
            <?php }

            wp_reset_postdata(); ?>

            <div class="news-container__item news-container__item_all" data-reveal="img">
              <a href="<?= get_category_link(pll_get_term(1)) ?>" class="all-item">
                <div class="all-item__info">
                  <h3 class="all-item__title h4-title h4-title--bold h4-title--white"><?php _e('Все новости','theme-sp') ?></h3>
                  <div class="all-item__icon">
                    <img src="<?= $dir ?>img/svg/icon-c-item-all.svg" inline-svg alt="">
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </section>
    <?php endif; ?>


    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();