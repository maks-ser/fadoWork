<?php
/*
Template Name: Главная
*/

$h1     = get_field('t') ?: get_the_title();
$dir    = get_bloginfo("template_directory") . "/";
$allCat = get_field('cat_product_page', 'options') ?: get_post(189);

get_header(); ?>
  <!-- preloader -->
  <style>
    .bg-color-fade {
      background-color: rgba(247, 243, 231, 0);
      opacity: 0;
      pointer-events: none;

      position: absolute;
      z-index: 1;
    }

    .body-hidden {
      overflow: hidden;
    }

    .preloader {
      background-color: #000000;

      width: 100%;
      height: 100vh;
      z-index: 100;

      position: fixed;
      top: 0;
      left: 0;
      overflow: hidden;

      /* opacity: 1; */
      transition: opacity 1s ease, background-color 1s ease;
    }

    .preloader__wrapper {
      width: 100%;
      height: 100%;
      margin: 0 auto;

      display: flex;
      justify-content: center;
      align-items: center;

      position: relative;
    }

    .preloader__icon-box {
      width: 320px;
      height: 96px;
      position: relative;

      display: flex;
      justify-content: center;
      align-items: center;
    }

    .preloader__icon {
      position: absolute;
      top: 50%;
      left: 50%;
      /* transform: translate(-50%, -50%); */

      opacity: 0;
    }

    .preloader__icon svg {
      display: block;
    }

    .preloader__logo {
      width: 100px;
      height: 96px;
      margin-right: 24px;

      opacity: 1;
      transform: translate(-50%, -50%);
      /*animation: preloaderMoveLogo 0.5s cubic-bezier(0.05, 0.85, 0.5, 1) 1.75s forwards;*/
      animation: preloaderMoveLogo 0.1s cubic-bezier(0.05, 0.85, 0.5, 1) .15s forwards;
    }

    .preloader__f {
      width: 42px;
      height: 53px;
      margin-right: -16px;

      /* transform: translate(calc(-50% - (160px - 21px - (100px + 24px))), -50%); not mx */
      transform: translate(calc(-50% - 15px), -50%);
      /*animation: preloaderFillF 1s cubic-bezier(0.2, 0.1, 0.8, 1) 3s forwards;*/
      animation: preloaderFillF .1s cubic-bezier(0.2, 0.1, 0.8, 1) .3s forwards;
    }

    .preloader__a {
      width: 61px;
      height: 53px;

      /* transform: translate(calc(-50% - (160px - (30.5px - 16px) - (100px + 24px + 42px))), -50%); not mx */
      transform: translate(calc(-50% + 20.5px), -50%);
      /*animation: preloaderFillA 0.9s cubic-bezier(0.2, 0.1, 0.8, 1) 3s forwards;*/
      animation: preloaderFillA 0.1s cubic-bezier(0.2, 0.1, 0.8, 1) .3s forwards;
    }

    .preloader__d {
      width: 52px;
      height: 53px;

      /* transform: translate(calc(-50% - (160px - 26px - (100px + 24px + 42px + (61px - 16px)))), -50%); not mx*/
      transform: translate(calc(-50% + 77px), -50%);
      /*animation: preloaderFillD 0.8s cubic-bezier(0.2, 0.1, 0.8, 1) 3s forwards;*/
      animation: preloaderFillD 0.1s cubic-bezier(0.2, 0.1, 0.8, 1) .3s forwards;
    }

    .preloader__o {
      width: 57px;
      height: 53px;

      /* transform: translate(calc(-50% - (160px - 28.5px - (100px + 24px + 42px + (61px - 16px) + 52px))), -50%); not mx*/
      transform: translate(calc(-50% + 131.5px), -50%);
      /*animation: preloaderFillO 0.7s cubic-bezier(0.2, 0.1, 0.8, 1) 3s forwards;*/
      animation: preloaderFillO 0.1s cubic-bezier(0.2, 0.1, 0.8, 1) .3s forwards;
    }

    @media screen and (max-width: 1023.5px) {
      .preloader__logo {
        /*animation: preloaderMoveLogo 0.75s cubic-bezier(0.05, 0.85, 0.5, 1) 3s forwards;*/
        animation: preloaderMoveLogo 0.1s cubic-bezier(0.05, 0.85, 0.5, 1) .3s forwards;
      }

      .preloader__f {
        /*animation: preloaderFillF 1s cubic-bezier(0.2, 0.1, 0.8, 1) 4.25s forwards;*/
        animation: preloaderFillF .1s cubic-bezier(0.2, 0.1, 0.8, 1)  .25s forwards;
      }

      .preloader__a {
        /*animation: preloaderFillA 0.9s cubic-bezier(0.2, 0.1, 0.8, 1) 4.25s forwards;*/
        animation: preloaderFillA 0.1s cubic-bezier(0.2, 0.1, 0.8, 1) .25s forwards;
      }

      .preloader__d {
        /*animation: preloaderFillD 0.8s cubic-bezier(0.2, 0.1, 0.8, 1) 4.25s forwards;*/
        animation: preloaderFillD 0.1s cubic-bezier(0.2, 0.1, 0.8, 1) .25s forwards;
      }

      .preloader__o {
        /*animation: preloaderFillO 0.75s cubic-bezier(0.2, 0.1, 0.8, 1) 4.25s forwards;*/
        animation: preloaderFillO 0.15s cubic-bezier(0.2, 0.1, 0.8, 1) 0.25s forwards;
      }
    }

    @keyframes preloaderMoveLogo {
      0% {
        transform: translate(-50%, -50%);
      }
      100% {
        transform: translate(calc(-50% - (160px - 50px)), -50%);
      }
    }

    @keyframes preloaderFillF {
      0% {
        opacity: 0;
      }
      20% {
        opacity: 0.5;
      }
      40% {
        opacity: 1;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes preloaderFillA {
      0% {
        opacity: 0;
      }
      20% {
        opacity: 0;
      }
      40% {
        opacity: 0.5;
      }
      60% {
        opacity: 1;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes preloaderFillD {
      0% {
        opacity: 0;
      }
      40% {
        opacity: 0;
      }
      60% {
        opacity: 0.5;
      }
      80% {
        opacity: 1;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes preloaderFillO {
      0% {
        opacity: 0;
      }
      60% {
        opacity: 0;
      }
      80% {
        opacity: 0.5;
      }
      100% {
        opacity: 1;
      }
    }

    [data-reveal-after-preloader="txt"] {
      opacity: 0;
      transform: translateY(50px) scaleY(1.05);
      transition: opacity 1s ease, transform 1s ease;
    }

    [data-reveal-after-preloader="txt"].reveal-active {
      opacity: 1;
      transform: translateY(0) scaleY(1);
    }

    [data-reveal-after-preloader="elem"] {
      opacity: 0;
      transition: opacity 1s ease;
    }

    [data-reveal-after-preloader="elem"].reveal-active {
      opacity: 1;
    }

    [data-reveal-after-preloader="img"] {
      opacity: 0;
      transform: translateY(100px);
      transition: opacity 1s ease, transform 1s ease;
    }

    [data-reveal-after-preloader="img"].reveal-active {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      loadPreloader();
    })

    function loadPreloader() {
      let preloaderWrapper = document.querySelector('.preloader');
      let preloaderLastIcon = document.querySelector('.preloader__icon_last');

      document.body.style.paddingRight = getScrollWidth() + 'px';
      preloaderWrapper.style.paddingRight = getScrollWidth() + 'px';

      preloaderLastIcon.addEventListener("animationend", () => {
        setTimeout(() => { //
          preloaderWrapper.classList.add('bg-color-fade');
          document.body.classList.remove('body-hidden');
          document.body.style.paddingRight = '0';
          preloaderWrapper.style.paddingRight = '0';
        }, 100); //убрал по ноль

        setTimeout(() => {
          return revealOnScroll('[data-reveal-after-preloader]');
        }, 200);//убрал по ноль
      })
    }

    function getScrollWidth() {
      let _divCreate = document.createElement('div');
      let scrollWidth = 0;

      _divCreate.style.overflowY = 'scroll';
      _divCreate.style.width = '50px';
      _divCreate.style.height = '50px';
      _divCreate.style.visibility = 'hidden';
      document.body.appendChild(_divCreate);

      scrollWidth = _divCreate.offsetWidth - _divCreate.clientWidth;
      document.body.removeChild(_divCreate);
      return scrollWidth;
    }
  </script>

  <div class="preloader">
    <div class="preloader__wrapper">
      <div class="preloader__icon-box">
        <div class="preloader__icon preloader__logo">
          <svg width="100" height="97" viewBox="0 0 100 97" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M64.6112 68.2002H48.821V42.366H60.3414V58.366H65.0141C71.8619 58.366 76.454 54.6977 76.454 48.0636C76.454 41.6636 71.8619 37.7612 65.0141 37.7612H60.8248H60.3414H19.4961V28.0051H48.821H64.8529C79.6765 28.0051 88.2161 36.2782 88.2161 47.9856C88.2161 59.6148 79.5153 68.2002 64.6112 68.2002ZM41.4092 51.1075H31.0166V68.2002H19.4961V42.366H45.2762L41.4092 51.1075ZM85.3964 0.687988H13.7762C6.20333 0.687988 0 6.69774 0 14.0343V83.4197C0 90.8343 6.20333 96.766 13.7762 96.766H85.3964C92.9693 96.766 99.1726 90.7563 99.1726 83.4197V14.0343C99.1726 6.69774 92.9693 0.687988 85.3964 0.687988Z"
              fill="#e27138"/>
          </svg>
        </div>
        <div class="preloader__icon preloader__f">
          <svg width="42" height="53" viewBox="0 0 42 53" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M41.9781 0.683105H0.810547V13.327H36.4192L41.9781 0.683105Z" fill="#e27138"/>
            <path d="M34.0024 18.9463H0.810547V52.6634H15.6341V30.8097H28.8463L34.0024 18.9463Z" fill="#e27138"/>
          </svg>
        </div>
        <div class="preloader__icon preloader__a">
          <svg width="61" height="53" viewBox="0 0 61 53" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M38.134 0.29248H23.7938L0.914062 52.6632H16.5432L30.8028 17.3852L36.7644 32.2144H30.9639L26.533 43.3754H41.1148L44.9818 52.6632H60.9332L38.134 0.29248Z" fill="#e27138"/>
          </svg>
        </div>
        <div class="preloader__icon preloader__d">
          <svg width="52" height="53" viewBox="0 0 52 53" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.6368 0.683105H0.932155V13.327H20.1866H21.7978C30.6597 13.327 36.6214 18.3221 36.6214 26.5953C36.6214 35.1026 30.7403 39.8636 21.7978 39.8636H15.7557V18.8685H0.851562V52.5855H21.234C40.569 52.5855 51.8478 41.4246 51.8478 26.4392C51.9283 11.3758 40.8107 0.683105 21.6368 0.683105Z" fill="#e27138"/>
          </svg>
        </div>
        <div class="preloader__icon preloader__icon_last preloader__o">
          <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.5998 19.0246C41.1304 21.2881 41.9361 23.9417 41.9361 26.7515C41.9361 34.0881 36.6995 40.2539 28.8043 40.2539C20.9898 40.2539 15.5921 33.932 15.5921 26.7515C15.5921 19.4149 20.8287 13.249 28.6433 13.249H52.7315C47.9783 5.6783 39.2775 0.76123 28.8043 0.76123C12.8529 0.76123 0.929688 12.3905 0.929688 26.8295C0.929688 41.3466 12.7724 52.8978 28.7238 52.8978C44.6752 52.8978 56.5984 41.2685 56.5984 26.8295C56.5984 24.0978 56.1956 21.5222 55.39 19.1027H39.5998V19.0246Z"
                  fill="#e27138"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

<?php $el = get_field('top');
if ($el) { ?>

    <section class="hero">
    <!--           style="background-color: --><?php //echo get_field('bgcol') ?><!--"-->


    <div class="hero__color-slider">
      <div class="hero-color-slider swiper">
        <div class="swiper-wrapper">

          <?php foreach ($el as $it) { ?>
              <div class="swiper-slide">
                <div class="hero-bg-slide" style="background-color: <?= $it['bgcol'] ?> !important;"></div>
              </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="hero__wrapper block-wrapper mx-slider">

      <div class="hero__bg hero__bg_title block-wrapper">
        <div class="hero__title-slider" data-reveal-after-preloader="txt">
          <div class="hero-title-slider swiper">
            <div class="swiper-wrapper">
              <?php foreach ($el as $it) { ?>
                <div class="swiper-slide">
                  <h1 class="hero-title-slide h2-title h2-title--white"><?= $it['t'] ?></h1>
                  <h2 class="hero-subtitle-slide h3-title h3-title--white"><?= $it['sub_title'] ?></h2>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <div class="hero__bg block-wrapper">
        <div class="hero__list" data-reveal-after-preloader="txt">
          <?php foreach ($el as $n => $it) { ?>
            <li class="hero__list-item <?php if ($n === 0) echo"active" ?>" data-hero-button="<?= $n++ ?>">
              <?php $num = $n < 10 ? '0' . $n : $n; ?>
              <span><?= $num ?></span>
            </li>
          <?php } ?>
        </div>
      </div>

      <div class="hero__slider">
        <div class="hero-slider swiper">
          <div class="swiper-wrapper">

            <?php foreach ($el as $n => $it) {
              $n++ ?>
              <div class="swiper-slide">
                <div class="hero-slide" data-hero-slide="0">
                  <div class="hero-slide__info" data-reveal-after-preloader="txt">
                    <div class="hero-slide__description description--o400"><?= $it['d'] ?></div>
                    <div class="hero-slide__button">
                        <?php
                        $m_link =  get_page_link( 6951 );
                        if($it['link']) {
                            $m_link = $it['link'];
                        } ?>
                        <a href="<?php echo $m_link ?>" class="button ">

                        <span class="button__name"><?= $it['btntxt'] ?></span>   
                        <span class="button__icon">
                          <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
                        </span>
                      </a>
                    </div>
                  </div>
                  <picture class="hero-slide__image" >
                      <img src="<?= $it['foto_product'] ?>" alt="">
                  </picture>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>
      </div>

    </div> 
  </section>


<?php } ?>

  <main class="main">
    <?php require_once get_template_directory() . '/template/numbers.php' ?>

    <?php global $wpdb;
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

    $terms = sort_nested_arrays($terms, array ('term_order' => 'asc'));
    if ($terms): ?>
      <section class="category-container bg">
        <div class="category-container__wrapper block-wrapper">
          <h2 class="category-container__title main-title h2-title h2-title--orange">
            <span><?= get_field('b3_t') ?: 'Каталог' ?></span>
          </h2>
          <div class="category-container__set" data-reveal-container>

            <?php foreach ($terms as $nCh => $itCh) { ?>
              <div class="category-container__item" data-reveal="img">
                <a href="<?= get_category_link($itCh->term_id) ?>" class="c-item">
                  <div class="c-item__bg">
                    <div class="ar-image">
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

            <div class="category-container__item" data-reveal="img">
              <a href="<?= get_permalink($allCat) ?>" class="all-item">
                <div class="all-item__info">
                  <h3 class="all-item__title h4-title h4-title--bold h4-title--white"><?php _e('Все категории', 'theme-sp') ?></h3>
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

    <?php
    $query = get_posts(array (
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'posts_per_page' => 3,
      'orderby'        => 'date',
      'order'          => 'DESC',
    ));
    if ($query):?>
      <section class="news-container">
        <div class="news-container__wrapper block-wrapper">
          <h2 class="news-container__title main-title h2-title">
            <span><?= get_field('b4_t') ?: 'Новости' ?></span>
          </h2>
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
            <?php }

            wp_reset_postdata(); ?>

            <div class="news-container__item news-container__item_all" data-reveal="img">
              <a href="<?= get_category_link(get_term(1)) ?>" class="all-item">
                <div class="all-item__info">
                  <h3 class="all-item__title h4-title h4-title--bold h4-title--white"><?php _e('Все новости', 'theme-sp') ?></h3>
                  <div class="all-item__icon">
                    <img src="<?= $dir ?>img/svg/icon-c-item-all.svg" inline-svg alt="">
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="news-container__button" data-reveal="img">
            <a href="<?= get_category_link(get_term(1)) ?>" class="button">
              <span class="button__name"><?php _e('Все новости', 'theme-sp') ?></span>
              <span class="button__icon">
                <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
              </span>
            </a>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <section class="r-container bg">
      <div class="r-container__wrapper block-wrapper">
        <h2 class="r-container__title main-title main-title--cut h2-title h2-title--orange">
          <span><?php the_field('b5_t') ?></span>
        </h2>
        <div class="r-container__info">
          <?php if ($el = get_field('b5_d')): ?>
            <div class="r-container__description description description--white" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>
          <?php $link = get_field('b5_btn');
          if ($link) {
            $url    = $link['url'] ?: '#';
            $title  = $link['title'] ?: __('Узнать больше', 'theme-sp');
            $target = $link['target'] ? ' target="_blank"' : '';
            ?>
            <div class="r-container__button" data-reveal="img">
              <a href="<?= $url ?>" class="button button--hover-w"<?= $target ?>>
                <span class="button__name"><?= $title ?></span>
                <span class="button__icon">
                  <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
                </span>
              </a>
            </div>
            <?php
          } ?>
        </div>
        <div class="r-container__image" data-reveal="img">
          <div class="ar-image ar-image--hd">
            <?php $img = get_field('b5_img'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/random-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php get_footer(); ?>