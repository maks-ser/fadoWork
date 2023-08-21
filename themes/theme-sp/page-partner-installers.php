<?php
/*
Template Name: партнерам - Инсталляторам
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>


  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <?php require_once get_template_directory() . '/template/numbers.php' ?>

    <section class="t-d-container t-d-container--c2">
      <div class="t-d-container__wrapper block-wrapper">
        <h2 class="t-d-container__title h2-title" data-reveal="txt"><?php the_field('b2_t') ?></h2>
        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('b2_d') ?></div>
        <?php if ($el = get_field('b2_d2')): ?>
          <div class="t-d-container__description description" data-reveal="txt">
            <?= $el ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <section class="t-d-container t-d-container--c2 bg bg--xl">
      <div class="t-d-container__wrapper block-wrapper">
        <h2 class="t-d-container__title h2-title h2-title--orange" data-reveal="txt"><?php the_field('b3_t') ?></h2>
        <div class="t-d-container__description description description--white" data-reveal="txt"><?php the_field('b3_d') ?></div>
        <?php if ($el = get_field('b3_d2')): ?>
          <div class="t-d-container__description description description--white" data-reveal="txt">
            <?= $el ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <section class="gift-container">
      <div class="gift-container__wrapper block-wrapper">
        <div class="gift-container__info">
          <h2 class="gift-container__title h2-title" data-reveal="txt"><?php the_field('b4_t') ?></h2>
          <div class="gift-container__description description" data-reveal="txt"><?php the_field('b4_d') ?></div>
          <?php if ($el = get_field('b4_d1')): ?>
            <div class="gift-container__description description" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>
          <?php $link = get_field('b4_btn');
          if ($link) {
            $url    = $link['url'] ?: '#';
            $title  = $link['title'] ?: __('Детальніше', 'theme-sp');
            $target = $link['target'] ? ' target="_blank"' : '';
            ?>
            <div class="gift-container__button" data-reveal="img">
              <a href="<?= $url ?>" class="button"<?= $target ?>>
                <span class="button__name"><?= $title ?></span>
                <span class="button__icon">
                  <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
                </span>
              </a>
            </div>
            <?php
          } ?>
        </div>

        <div class="gift-container__gift-box gift-box">
          <h3 class="gift-box__title h3-title h3-title--orange" data-reveal="txt"><?php the_field('b5_t') ?></h3>
          <?php if ($el = get_field('b5_d')): ?>
            <div class="gift-box__description description description--gray" data-reveal="txt">
              <?= $el ?>
            </div>
          <?php endif; ?>
          <?php $el = get_field('b5_list');
          if ($el) { ?>
            <div class="gift-box__set" data-reveal-container>
              <?php foreach ($el as $it) { ?>
                <div class="gift-box__item gift-item" data-reveal="img">
                  <div class="gift-item__image">
                    <div class="ar-image">
                      <?php $img = $it['img']; ?>
                       <img data-src="<?= $img['url'] ?: $dir . "img/photos/gift-item-image-1.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
                    </div>
                  </div>
                  <h4 class="gift-item__title h4-title h4-title--orange"><?= $it['t'] ?></h4>
                  <div class="gift-item__caption"><?= $it['t1'] ?></div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>

        </div>
      </div>
    </section>

    <section class="r1-container">
      <div class="r1-container__wrapper block-wrapper">
        <h2 class="r1-container__title h2-title" data-reveal="txt"><?php the_field('b6_t') ?></h2>
        <?php if ($el = get_field('b6_d')): ?>
          <div class="r1-container__info">
            <div class="r1-container__description description" data-reveal="txt">
              <?= $el ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="r1-container__image" data-reveal="txt">
          <div class="image">
            <?php $img = get_field('b6_img'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/random-image-5.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
        <?php $link = get_field('b6_btn');
        if ($link) {
          $url    = $link['url'] ?: '#';
          $title  = $link['title'] ?: __('Подробнее', 'theme-sp');
          $target = $link['target'] ? ' target="_blank"' : '';
          ?>
          <div class="r1-container__button" data-reveal="img">
            <a href="<?= $url ?>" class="button"<?= $target ?>>
              <span class="button__name"><?= $title ?></span>
              <span class="button__icon">
                <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
              </span>
            </a>
          </div>
          <?php
        } ?>
      </div>
    </section>

    <section class="t-d-container t-d-container--c2">
      <div class="t-d-container__wrapper block-wrapper">
        <h2 class="t-d-container__title h2-title" data-reveal="txt"><?php the_field('b7_t') ?></h2>
        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('b7_d') ?></div>
        <?php if ($el = get_field('b7_d2')): ?>
          <div class="t-d-container__description description" data-reveal="txt">
            <?= $el ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <section class="form-container bg" id="form-anchor">
      <div class="form-container__wrapper block-wrapper">
        <h2 class="form-container__title h2-title h2-title--orange" data-reveal="txt"><?php the_field('form_t') ?></h2>
        <div class="form-container__description description description--white" data-reveal="txt"><?php the_field('form_d') ?></div>
        <div class="form-container__form" data-reveal="elem">

          <form class="form" action="#" novalidate>
            <input type="hidden" name="form_name" value="<?php the_field('form_t') ?> - <?= $h1 ?>">
            <div class="form__input form-input">
              <input name="name" class="form-input__input _required" placeholder="<?= get_field('form_name', 'options') ?: 'Имя' ?>" type="text">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__input form-input">
              <input name="surname" class="form-input__input _required" placeholder="<?= get_field('form_surname', 'options') ?: 'Фамилия' ?>" type="text">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__input form-input">
              <input name="email" class="form-input__input _email _required" placeholder="<?= get_field('form_email', 'options') ?: 'Email' ?>" type="email">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__input form-input">
              <input name="tel" class="form-input__input _tel _required" placeholder="<?= get_field('form_tel', 'options') ?: '+ (380) ___ ___ ___' ?>" type="tel">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__footer">
              <?php if ($el = get_field('form_policy', 'options')): ?>
                <div class="form__checkbox">
                  <label class="checkbox">
                    <span class="checkbox__name"><?= $el ?></span>
                    <input class="checkbox__box _checkbox _required" type="checkbox" checked>
                    <span class="checkbox__mark"></span>
                  </label>
                </div>
              <?php endif; ?>
              <div class="form__button">
                <button class="button button--ni button--hover-w" type="submit">
                  <span class="button__name"><?= get_field('form_btn', 'options') ?: 'Отправить' ?></span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();