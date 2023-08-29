<?php
/*
Template Name: товар
Template Post Type: t-product
*/
$dir              = get_bloginfo("template_directory") . "/";
$h1               = get_field('t') ?: get_the_title();
$id               = get_the_ID();
$post_categories  = get_post_primary_category($id, 'cat-product');
$primary_category = $post_categories['primary_category'];
$mainCatId        = $primary_category->term_id;
$catalogId        = get_field('cat_product_page', 'options') ?: get_post(783)->ID; // page Catalog
get_header();
?>

  <main class="main main--etc">
    <?php breadcrumbProduct($h1, $primary_category, $catalogId) ?>

    <section class="product-container">

      <div class="product-container__wrapper block-wrapper">
        <div class="product-container__title-box">
          <h1 class="product-container__title" data-reveal="txt"><?= $h1 ?></h1>
          <?php if ($el = get_field('sku')): ?>
            <div class="product-container__article" data-reveal="txt">
              <span class="product-container__article-name"><?php _e('Артикул товара:', 'theme-sp') ?></span>
              <span class="product-container__article-value"><?= $el ?></span>
            </div>
          <?php endif; ?>
        </div>

        <?php $el = get_field('gal');
        if ($el) { ?>
          <div class="product-container__slider-box">
            <div class="product-container__slider" data-reveal="img">
              <div class="product-slider swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($el as $it) { ?>
                    <div class="swiper-slide">
                      <div class="ar-image ar-image--square">
                        <?php $img = $it['img']; ?>
                        <img data-src="<?= $img['url'] ?: $dir . "img/photos/category-item-image-3.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="product-container__pagination arrow-box">
                <div class="arrow-box__arrow arrow-box__arrow_prev product-slider-arrow-prev">
                  <img src="<?= $dir ?>img/svg/icon-slider-arrow-left-grey.svg" alt="">
                </div>
                <div class="arrow-box__arrow arrow-box__arrow_next product-slider-arrow-next">
                  <img src="<?= $dir ?>img/svg/icon-slider-arrow-right-grey.svg" alt="">
                </div>
              </div>
            </div>

            <div class="product-container__sub-slider" data-reveal="img">
              <div class="sub-product-slider swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($el as $it) { ?>
                    <div class="swiper-slide">
                      <div class="ar-image ar-image--square">
                        <?php $img = $it['img']; ?>
                        <img data-src="<?= $img['url'] ?: $dir . "img/photos/category-item-image-3.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if ($el = get_field('d')): ?>
          <div class="product-container__description description" data-reveal="txt"><?= $el ?></div>
        <?php endif; ?>

        <div class="product-container__info">
          <?php $el = get_field('figure');
          if ($el) { ?>
            <div class="product-container__figure-box" data-reveal="img">
              <?php foreach ($el as $it) { ?>
                <div class="product-container__figure-btn">
                  <a href="<?= $it['file'] ?: '#' ?>" class="figure-btn" download>
                    <div class="figure-btn__icon">
                      <img src="<?= $dir ?>img/svg/icon-button-figure.svg" inline-svg alt="">
                    </div>
                    <div class="figure-btn__info">
                      <div class="figure-btn__name"><?= $it['t'] ?></div>
                      <div class="figure-btn__size"><?= $it['size'] ?></div>
                    </div>
                  </a>
                </div>
              <?php } ?>
            </div>
          <?php } ?>

          <div class="product-container__button-box" data-reveal-container>

            <div class="product-container__button" data-reveal="img">
              <button class="button" data-popup-button="product">
                <span class="button__name"><?php _e('Заказать товар', 'theme-sp') ?></span>
                <span class="button__icon">
                  <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
                </span>
              </button>
            </div>

            <?php if ($el = get_field('downloadPrice')): ?>
              <div class="product-container__button" data-reveal="img">
                <a href="<?= $el ?>" class="inline-btn" target="_blank">
                  <span class="inline-btn__name"><?php _e('Скачать прайс', 'theme-sp') ?></span>
                  <span class="inline-btn__icon">
                    <img src="<?= $dir ?>img/svg/icon-button-download.svg" inline-svg alt="">
                  </span>
                </a>
              </div>
            <?php endif; ?>

          </div>

        </div>
      </div>
    </section>

    <?php $tabShow = true; ?>
    <section class="details-container">
      <div class="details-container__wrapper block-wrapper">
        <div class="details-container__switcher" data-reveal="elem">
          <div class="switcher">
            <div class="switcher__tabs-box">
              <?php if (!get_field('b1_hide')): ?>
                <div class="switcher__tab active" data-product-detail-button="description">
                  <span class="switcher__tab-icon">
                    <img src="<?= $dir ?>img/svg/icon-detail-description.svg" inline-svg alt="">
                  </span>
                  <span class="switcher__tab-name"><?= get_field('b1_tab') ?: 'Опис' ?></span>
                </div>
                <?php $tabShow = false; endif; ?>

              <?php if (!get_field('b2_hide')): ?>
                <div class="switcher__tab<?php if ($tabShow) echo ' active' ?>" data-product-detail-button="features">
                  <span class="switcher__tab-icon">
                    <img src="<?= $dir ?>img/svg/icon-detail-features.svg" inline-svg alt="">
                  </span>
                  <span class="switcher__tab-name"><?= get_field('b2_tab') ?: 'Характеристики' ?></span>
                </div>
                <?php $tabShow = false; endif; ?>

              <?php if (!get_field('b3_hide')): ?>
                <div class="switcher__tab<?php if ($tabShow) echo ' active' ?>" data-product-detail-button="material">
                  <span class="switcher__tab-icon">
                    <img src="<?= $dir ?>img/svg/icon-detail-material.svg" inline-svg alt="">
                  </span>
                  <span class="switcher__tab-name"><?= get_field('b3_tab') ?: 'Матеріали' ?></span>
                </div>
                <?php $tabShow = false; endif; ?>

              <?php if (!get_field('b4_hide')): ?>
                <div class="switcher__tab<?php if ($tabShow) echo ' active' ?>" data-product-detail-button="dimensions">
                  <span class="switcher__tab-icon">
                    <img src="<?= $dir ?>img/svg/icon-detail-dimensions.svg" inline-svg alt="">
                  </span>
                  <span class="switcher__tab-name"><?= get_field('b4_tab') ?: 'Габарити' ?></span>
                </div>
                <?php $tabShow = false; endif; ?>

              <?php if (!get_field('b5_hide')): ?>
                <div class="switcher__tab<?php if ($tabShow) echo ' active' ?>" data-product-detail-button="documentation">
                  <span class="switcher__tab-icon">
                    <img src="<?= $dir ?>img/svg/icon-detail-documentation.svg" inline-svg alt="">
                  </span>
                  <span class="switcher__tab-name"><?= get_field('b5_tab') ?: 'Документація' ?></span>
                </div>
                <?php $tabShow = false; endif; ?>

            </div>
            <div class="switcher__indicator">
              <div class="switcher__line"></div>
            </div>
          </div>
        </div>

        <?php $tabCont = true; ?>
        <div class="details-container__storage storage" data-reveal="img">

          <?php if (!get_field('b1_hide')): ?>
            <div class="storage__block show-block" data-product-detail-target="description">
              <h2 class="storage__title h3-title"><?= get_field('b1_t') ?: 'Опис' ?></h2>
              <?php $el = get_field('b1_table');
              if ($el) {
                $col = get_field('b1_colCount') ?: 5;
                ?>
                <div class="storage__content">
                  <div class="table table--c<?= $col ?>">
                    <div class="table__wrapper">
                      <?php foreach ($el as $it) { ?>
                        <div class="table__row">
                          <?php if ($it['1']): ?>
                            <div class="table__col"><?= $it['1'] ?></div>
                          <?php endif; ?>
                          <?php if ($it['2']): ?>
                            <div class="table__col"><?= $it['2'] ?></div>
                          <?php endif; ?>
                          <?php if ($it['3']): ?>
                            <div class="table__col"><?= $it['3'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 3 && $it['4']): ?>
                            <div class="table__col"><?= $it['4'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 4 && $it['5']): ?>
                            <div class="table__col"><?= $it['5'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 5 && $it['6']): ?>
                            <div class="table__col"><?= $it['6'] ?></div>
                          <?php endif; ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <?php $tabCont = false; endif; ?>

          <?php if (!get_field('b2_hide')): ?>
            <div class="storage__block<?php if ($tabCont) echo ' show-block' ?>" data-product-detail-target="features">
              <h2 class="storage__title h3-title"><?= get_field('b2_t') ?: 'Характеристики' ?></h2>
              <?php $el = get_field('b2_table');
              if ($el) {
                $col = get_field('b2_colCount') ?: 3;
                ?>
                <div class="storage__content">
                  <div class="table table--n<?= $col ?>">
                    <div class="table__wrapper">
                      <?php foreach ($el as $it) { ?>
                        <div class="table__row">
                          <?php if ($it['1']): ?>
                            <div class="table__col"><?= $it['1'] ?></div>
                          <?php endif; ?>
                          <?php if ($it['2']): ?>
                            <div class="table__col"><?= $it['2'] ?></div>
                          <?php endif; ?>
                          <?php if ($it['3']): ?>
                            <div class="table__col"><?= $it['3'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 3 && $it['4']): ?>
                            <div class="table__col"><?= $it['4'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 4 && $it['5']): ?>
                            <div class="table__col"><?= $it['5'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 5 && $it['6']): ?>
                            <div class="table__col"><?= $it['6'] ?></div>
                          <?php endif; ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <?php $tabCont = false; endif; ?>

          <?php if (!get_field('b3_hide')): ?>
            <div class="storage__block<?php if ($tabCont) echo ' show-block' ?>" data-product-detail-target="material">
              <h2 class="storage__title h3-title"><?= get_field('b3_t') ?: 'Матеріали' ?></h2>
              <?php $el = get_field('b3_table');
              if ($el) {
                $col = get_field('b3_colCount') ?: 3;?>
                <div class="storage__content">
                  <div class="table table--c<?= $col ?>">
                    <div class="table__wrapper">
                      <?php foreach ($el as $it) { ?>
                        <div class="table__row">
                          <?php if ($it['1']): ?>
                            <div class="table__col"><?= $it['1'] ?></div>
                          <?php endif; ?>
                          <?php if ($it['2']): ?>
                            <div class="table__col"><?= $it['2'] ?></div>
                          <?php endif; ?>
                          <?php if ($it['3']): ?>
                            <div class="table__col"><?= $it['3'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 3 && $it['4']): ?>
                            <div class="table__col"><?= $it['4'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 4 && $it['5']): ?>
                            <div class="table__col"><?= $it['5'] ?></div>
                          <?php endif; ?>
                          <?php if ($col > 5 && $it['6']): ?>
                            <div class="table__col"><?= $it['6'] ?></div>
                          <?php endif; ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <?php $tabCont = false; endif; ?>

          <?php if (!get_field('b4_hide')): ?>
            <div class="storage__block<?php if ($tabCont) echo ' show-block' ?>" data-product-detail-target="dimensions">
              <?php if (!get_field('b4_hide1')): ?>
                <?php if ($el = get_field('b4_t')): ?>
                  <h2 class="storage__title h3-title"><?= $el ?></h2>
                <?php endif; ?>
                <div class="storage__content">
                  <div class="dimensions-block">
                    <?php if ($img = get_field('b4_img')): ?>
                      <div class="dimensions-block__image">
                        <div class="image">
                          <img data-src="<?= $img['url'] ?: $dir . "img/photos/dimensions-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php $el = get_field('b4_table');
                    if ($el) {
                      $col = get_field('b4_colCount') ?: 6;
                      ?>
                      <div class="dimensions-block__table">
                        <div class="table table--c<?= $col ?>">
                          <div class="table__wrapper">
                            <?php foreach ($el as $it) { ?>
                              <div class="table__row">
                                <?php if ($it['1']): ?>
                                  <div class="table__col"><?= $it['1'] ?></div>
                                <?php endif; ?>
                                <?php if ($it['2']): ?>
                                  <div class="table__col"><?= $it['2'] ?></div>
                                <?php endif; ?>
                                <?php if ($it['3']): ?>
                                  <div class="table__col"><?= $it['3'] ?></div>
                                <?php endif; ?>
                                <?php if ($col > 3 && $it['4']): ?>
                                  <div class="table__col"><?= $it['4'] ?></div>
                                <?php endif; ?>
                                <?php if ($col > 4 && $it['5']): ?>
                                  <div class="table__col"><?= $it['5'] ?></div>
                                <?php endif; ?>
                                <?php if ($col > 5 && $it['6']): ?>
                                  <div class="table__col"><?= $it['6'] ?></div>
                                <?php endif; ?>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (!get_field('b4_hide2')): ?>
                <?php if ($el = get_field('b4_t1')): ?>
                  <h2 class="storage__title h3-title"><?= $el ?></h2>
                <?php endif; ?>
                <div class="storage__content">
                  <div class="dimensions-block dimensions-block--double">
                    <?php if ($img = get_field('b4_img1')): ?>
                      <div class="dimensions-block__image">
                        <div class="ar-image ar-image--hd">
                          <img data-src="<?= $img['url'] ?: $dir . "img/photos/dimensions-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if ($img = get_field('b4_img2')): ?>
                      <div class="dimensions-block__image">
                        <div class="ar-image ar-image--hd">
                          <img data-src="<?= $img['url'] ?: $dir . "img/photos/dimensions-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php $el = get_field('b4_table1');
                    if ($el) {
                      $col = get_field('b4_colCount1') ?: 6;
                      ?>
                      <div class="dimensions-block__table">
                        <div class="table table--c<?= $col ?>">
                          <div class="table__wrapper">
                            <?php foreach ($el as $it) { ?>
                              <div class="table__row">
                                <?php if ($it['1']): ?>
                                  <div class="table__col"><?= $it['1'] ?></div>
                                <?php endif; ?>
                                <?php if ($it['2']): ?>
                                  <div class="table__col"><?= $it['2'] ?></div>
                                <?php endif; ?>
                                <?php if ($it['3']): ?>
                                  <div class="table__col"><?= $it['3'] ?></div>
                                <?php endif; ?>
                                <?php if ($col > 3 && $it['4']): ?>
                                  <div class="table__col"><?= $it['4'] ?></div>
                                <?php endif; ?>
                                <?php if ($col > 4 && $it['5']): ?>
                                  <div class="table__col"><?= $it['5'] ?></div>
                                <?php endif; ?>
                                <?php if ($col > 5 && $it['6']): ?>
                                  <div class="table__col"><?= $it['6'] ?></div>
                                <?php endif; ?>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
            <?php $tabCont = false;
          endif; ?>

          <?php if (!get_field('b5_hide')): ?>
            <div class="storage__block<?php if ($tabCont) echo ' show-block' ?>" data-product-detail-target="documentation">
              <h2 class="storage__title h3-title"><?= get_field('b5_t') ?: 'Технічна документація' ?></h2>
              <?php $el = get_field('b5_list');
              if ($el) { ?>
                <div class="storage__content">
                  <div class="documentation-block">
                    <?php foreach ($el as $it) { ?>
                      <div class="documentation-block__item">
                        <a href="<?= $it['file'] ?: '#' ?>" class="document" download>
                          <div class="document__title"><?= $it['t'] ?></div>
                          <div class="document__button">
                            <div class="document__button-name"><?php _e('скачать', 'theme-sp') ?></div>
                            <div class="document__button-icon">
                              <img src="<?= $dir ?>img/svg/icon-button-figure.svg" inline-svg alt="">
                            </div>
                          </div>
                        </a>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
            <?php $tabCont = false; endif; ?>

        </div>

        <div class="details-container__dropdown-box">
          <?php if (!get_field('b1_hide')): ?>
            <div class="details-container__dropdown" data-reveal="img">
              <div class="dropdown dropdown--details">
                <div class="dropdown__header">
                  <h3 class="dropdown__title">
                    <span class="dropdown__title-icon">
                      <img src="<?= $dir ?>img/svg/icon-detail-description.svg" inline-svg alt="">
                    </span>
                    <span class="dropdown__title-name"><?= get_field('b1_tab') ?: 'Опис' ?></span>
                  </h3>
                  <div class="dropdown__icon">
                    <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                  </div>
                </div>
                <div class="dropdown__content">
                  <div class="dropdown__wrapper">
                    <?php $el = get_field('b1_table');
                    if ($el) {
                      $col = get_field('b1_colCount') ?: 5;
                      ?>
                      <div class="table table--c<?= $col ?>">
                        <div class="table__wrapper">
                          <?php foreach ($el as $it) { ?>
                            <div class="table__row">
                              <?php if ($it['1']): ?>
                                <div class="table__col"><?= $it['1'] ?></div>
                              <?php endif; ?>
                              <?php if ($it['2']): ?>
                                <div class="table__col"><?= $it['2'] ?></div>
                              <?php endif; ?>
                              <?php if ($it['3']): ?>
                                <div class="table__col"><?= $it['3'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 3 && $it['4']): ?>
                                <div class="table__col"><?= $it['4'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 4 && $it['5']): ?>
                                <div class="table__col"><?= $it['5'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 5 && $it['6']): ?>
                                <div class="table__col"><?= $it['6'] ?></div>
                              <?php endif; ?>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if (!get_field('b2_hide')): ?>
            <div class="details-container__dropdown" data-reveal="img">
              <div class="dropdown dropdown--details">
                <div class="dropdown__header">
                  <h3 class="dropdown__title">
                    <span class="dropdown__title-icon">
                      <img src="<?= $dir ?>img/svg/icon-detail-features.svg" inline-svg alt="">
                    </span>
                    <span class="dropdown__title-name"><?= get_field('b2_tab') ?: 'Характеристики' ?></span>
                  </h3>
                  <div class="dropdown__icon">
                    <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                  </div>
                </div>
                <div class="dropdown__content">
                  <div class="dropdown__wrapper">
                    <?php $el = get_field('b2_table');
                    if ($el) {
                      $col = get_field('b2_colCount') ?: 3;
                      ?>
                      <div class="table table--n<?= $col ?>">
                        <div class="table__wrapper">
                          <?php foreach ($el as $it) { ?>
                            <div class="table__row">
                              <?php if ($it['1']): ?>
                                <div class="table__col"><?= $it['1'] ?></div>
                              <?php endif; ?>
                              <?php if ($it['2']): ?>
                                <div class="table__col"><?= $it['2'] ?></div>
                              <?php endif; ?>
                              <?php if ($it['3']): ?>
                                <div class="table__col"><?= $it['3'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 3 && $it['4']): ?>
                                <div class="table__col"><?= $it['4'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 4 && $it['5']): ?>
                                <div class="table__col"><?= $it['5'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 5 && $it['6']): ?>
                                <div class="table__col"><?= $it['6'] ?></div>
                              <?php endif; ?>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if (!get_field('b3_hide')): ?>
            <div class="details-container__dropdown" data-reveal="img">
              <div class="dropdown dropdown--details">
                <div class="dropdown__header">
                  <h3 class="dropdown__title">
                    <span class="dropdown__title-icon">
                      <img src="<?= $dir ?>img/svg/icon-detail-material.svg" inline-svg alt="">
                    </span>
                    <span class="dropdown__title-name"><?= get_field('b3_tab') ?: 'Матеріали' ?></span>
                  </h3>
                  <div class="dropdown__icon">
                    <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                  </div>
                </div>
                <div class="dropdown__content">
                  <div class="dropdown__wrapper">
                    <?php $el = get_field('b3_table');
                    if ($el) {
                      $col = get_field('b3_colCount') ?: 3;
                      ?>
                      <div class="table table--c<?= $col ?>">
                        <div class="table__wrapper">
                          <?php foreach ($el as $it) { ?>
                            <div class="table__row">
                              <?php if ($it['1']): ?>
                                <div class="table__col"><?= $it['1'] ?></div>
                              <?php endif; ?>
                              <?php if ($it['2']): ?>
                                <div class="table__col"><?= $it['2'] ?></div>
                              <?php endif; ?>
                              <?php if ($it['3']): ?>
                                <div class="table__col"><?= $it['3'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 3 && $it['4']): ?>
                                <div class="table__col"><?= $it['4'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 4 && $it['5']): ?>
                                <div class="table__col"><?= $it['5'] ?></div>
                              <?php endif; ?>
                              <?php if ($col > 5 && $it['6']): ?>
                                <div class="table__col"><?= $it['6'] ?></div>
                              <?php endif; ?>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if (!get_field('b4_hide')): ?>
            <div class="details-container__dropdown" data-reveal="img">
              <div class="dropdown dropdown--details">
                <div class="dropdown__header">
                  <h3 class="dropdown__title">
                    <span class="dropdown__title-icon">
                      <img src="<?= $dir ?>img/svg/icon-detail-dimensions.svg" inline-svg alt="">
                    </span>
                    <span class="dropdown__title-name"><?= get_field('b4_tab') ?: 'Габарити' ?></span>
                  </h3>
                  <div class="dropdown__icon">
                    <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                  </div>
                </div>
                <div class="dropdown__content">
                  <div class="dropdown__wrapper">

                    <?php if (!get_field('b4_hide1')): ?>
                      <div class="dimensions-block">
                        <?php if ($el = get_field('b4_t')): ?>
                          <h3 class="dimensions-block__title h3-title"><?= $el ?></h3>
                        <?php endif; ?>
                        <?php if ($img = get_field('b4_img')): ?>
                          <div class="dimensions-block__image">
                            <div class="image">
                              <img data-src="<?= $img['url'] ?: $dir . "img/photos/dimensions-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php $el = get_field('b4_table');
                        if ($el) {
                          $col = get_field('b4_colCount') ?: 6;
                          ?>
                          <div class="dimensions-block__table">
                            <div class="table table--c<?= $col ?>">
                              <div class="table__wrapper">
                                <?php foreach ($el as $it) { ?>
                                  <div class="table__row">
                                    <?php if ($it['1']): ?>
                                      <div class="table__col"><?= $it['1'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($it['2']): ?>
                                      <div class="table__col"><?= $it['2'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($it['3']): ?>
                                      <div class="table__col"><?= $it['3'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($col > 3 && $it['4']): ?>
                                      <div class="table__col"><?= $it['4'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($col > 4 && $it['5']): ?>
                                      <div class="table__col"><?= $it['5'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($col > 5 && $it['6']): ?>
                                      <div class="table__col"><?= $it['6'] ?></div>
                                    <?php endif; ?>
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    <?php endif; ?>

                    <?php if (!get_field('b4_hide2')): ?>
                      <div class="dimensions-block dimensions-block--double">
                        <?php if ($el = get_field('b4_t1')): ?>
                          <h3 class="dimensions-block__title h3-title"><?= $el ?></h3>
                        <?php endif; ?>
                        <?php if ($img = get_field('b4_img1')): ?>
                          <div class="dimensions-block__image">
                            <div class="ar-image ar-image--hd">
                              <img data-src="<?= $img['url'] ?: $dir . "img/photos/dimensions-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($img = get_field('b4_img2')): ?>
                          <div class="dimensions-block__image">
                            <div class="ar-image ar-image--hd">
                              <img data-src="<?= $img['url'] ?: $dir . "img/photos/dimensions-image-1.jpeg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php $el = get_field('b4_table1');
                        if ($el) {
                          $col = get_field('b1_colCount') ?: 6;
                          ?>
                          <div class="dimensions-block__table">
                            <div class="table table--c<?= $col ?>">
                              <div class="table__wrapper">
                                <?php foreach ($el as $it) { ?>
                                  <div class="table__row">
                                    <?php if ($it['1']): ?>
                                      <div class="table__col"><?= $it['1'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($it['2']): ?>
                                      <div class="table__col"><?= $it['2'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($it['3']): ?>
                                      <div class="table__col"><?= $it['3'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($col > 3 && $it['4']): ?>
                                      <div class="table__col"><?= $it['4'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($col > 4 && $it['5']): ?>
                                      <div class="table__col"><?= $it['5'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($col > 5 && $it['6']): ?>
                                      <div class="table__col"><?= $it['6'] ?></div>
                                    <?php endif; ?>
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if (!get_field('b5_hide')): ?>
            <div class="details-container__dropdown" data-reveal="img">
              <div class="dropdown dropdown--details">
                <div class="dropdown__header">
                  <h3 class="dropdown__title">
                    <span class="dropdown__title-icon">
                      <img src="<?= $dir ?>img/svg/icon-detail-documentation.svg" inline-svg alt="">
                    </span>
                    <span class="dropdown__title-name"><?= get_field('b5_tab') ?: 'Документація' ?></span>
                  </h3>
                  <div class="dropdown__icon">
                    <img src="<?= $dir ?>img/svg/icon-mob-sorting.svg" alt="">
                  </div>
                </div>
                <div class="dropdown__content">
                  <div class="dropdown__wrapper">
                    <?php $el = get_field('b5_list');
                    if ($el) { ?>
                      <div class="documentation-block">
                        <?php foreach ($el as $it) { ?>
                          <div class="documentation-block__item">
                            <a href="<?= $it['file'] ?: '#' ?>" class="document" download>
                              <div class="document__title"><?= $it['t'] ?></div>
                              <div class="document__button">
                                <div class="document__button-name"><?php _e('скачать', 'theme-sp') ?></div>
                                <div class="document__button-icon">
                                  <img src="<?= $dir ?>img/svg/icon-button-figure.svg" inline-svg alt="">
                                </div>
                              </div>
                            </a>
                          </div>
                        <?php } ?>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php
    $args  = array (
      'tax_query'      => array (
        array (
          'taxonomy' => 'cat-product',
          'field'    => 'id',
          'terms'    => $mainCatId // id tax
        )
      ),
      'post_type'      => 't-product',
      'post_status'    => 'publish',
      'post__not_in'   => [$id],
      'posts_per_page' => 4,
      'orderby'        => 'data',
      'order'          => 'DESC',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()):?>
      <section class="other-container">
        <div class="other-container__wrapper block-wrapper">
          <h2 class="other-container__title h2-title" data-reveal="txt"><?= get_field('cat_product_othersT', 'options') ?: 'Другие товары' ?></h2>

          <div class="other-container__set" data-reveal-container>
            <?php
            while ($query->have_posts()): $query->the_post();
              $countView++; ?>
              <div class="other-container__item" data-reveal="img">
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
          </div>


          <div class="other-container__button" data-reveal="img">
            <a href="<?= get_permalink($catalogId) ?>" class="button">
              <span class="button__name"><?php _e('Каталог', 'theme-sp') ?></span>
              <span class="button__icon">
                <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
              </span>
            </a>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();