<?php
/*
Template Name: Бренд FADO
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors); ?>

    <section class="t-d-container t-d-container--c2">
      <div class="t-d-container__wrapper block-wrapper" data-reveal-container>
        <h2 class="t-d-container__title h2-title" data-reveal="txt"><?= $h1 ?></h2>
        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('d') ?></div>
        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('d1') ?></div>
      </div>
    </section>

    <?php $el = get_field('list');
    if($el){ ?>
    <section class="slider-container bg mx-relative">
        <div class="stop__btn">
            <a href="#" class="stop__btn-item">
                Пропустити
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                        <rect x="19.0464" y="9.75873" width="12.9763" height="2.26569" transform="rotate(135 19.0464 9.75873)" fill="#EC6A2D"/>
                        <rect x="11.1519" y="0.577393" width="16.1374" height="2.26569" transform="rotate(90 11.1519 0.577393)" fill="#EC6A2D"/>
                        <rect x="2.29712" y="8.15662" width="12.9763" height="2.26569" transform="rotate(45 2.29712 8.15662)" fill="#EC6A2D"/>
                    </svg>
                </span>
            </a>
        </div>
      <div class="slider-container__wrapper block-wrapper" data-reveal="elem">
        <div class="slider-container__bg block-wrapper">
          <div class="slider-container__circle">
            <img src="<?= $dir ?>img/svg/circle-slider.svg" alt="">
          </div>
        </div>
        
        <div class="slider-container__content">
          <div class="slider-container__info-slider">
            <div class="about-info-slider swiper">
              <div class="swiper-wrapper">
                <?php foreach($el as $it) { ?>
                  <div class="about-info-slide swiper-slide">
                    <h3 class="about-info-slide__title"><?= $it['date'] ?></h3>
                    <div class="about-info-slide__description"><?= $it['d'] ?></div>
                  </div>
                <?php }  ?>
              </div>
            </div>
          </div>
          
          <div class="slider-container__static">
            <span><?= get_field('listYear', 'options') ?: '20' ?></span>
          </div>
          
          <div class="slider-container__year-slider">
            <div class="about-year-slider swiper">
              <div class="swiper-wrapper">
                <?php foreach($el as $it) { ?>
                  <div class="about-year-slide swiper-slide">
                    <span><?= $it['year'] ?></span>
                  </div>
                <?php }  ?>
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
      <div class="slider-container__flow"></div>
    </section>
    <?php }  ?>

    <?php $el = get_field('b_list');
    if($el){ ?>
    <section class="t-d-container t-d-container--c2">
      <div class="t-d-container__wrapper block-wrapper" data-reveal-container>
        <h2 class="t-d-container__title h2-title" data-reveal="txt"><?php the_field('b_t') ?></h2>
        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('b_d') ?></div>

        <div class="t-d-container__price-set">
          <?php foreach($el as $it) { ?>
            <div class="t-d-container__price-item" data-reveal="img">
              <a href="<?= $it['file'] ?: '#' ?>" class="price-item" target="_blank">
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

      </div>
    </section>
    <?php }  ?>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();